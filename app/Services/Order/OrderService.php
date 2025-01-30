<?php

namespace App\Services\Order;

use App\Contracts\Order\OrderServiceInterface;
use App\Models\Order;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService implements OrderServiceInterface
{
    public function create(array $data): Order
    {
        if(!empty($data['products'])) {
            $incomeProductsById = collect($data['products'])->keyBy('id');

            $products = Product::query()->whereIn('id', collect($data['products'])->pluck('id'))->get()->keyBy('id');

            foreach ($incomeProductsById as $incomeId => $incomeProduct) {
                if (isset($products[$incomeId])) {
                    $products[$incomeId]->count = $incomeProduct['count'];
                }
            }

            $data['products'] = $products->values()->toArray();
        }

        if(empty($data['status_id'])) {
            $data['status_id'] = Status::query()->where('name', 'new')->value('id');
        }

        return Order::query()->create($data);
    }

    public function approve($id): bool
    {
        return DB::transaction(function() use($id) {
            $order = Order::query()->where('id', $id)->firstOrFail();
        
            $products = collect($order->products ?? []);
    
            $user = $order->user;

            $sum = 0;
            $products->map(function($product) use(&$sum) {
                $sum += $product['cost'] * $product['count'];
            });

            if ($user->balance < $sum) {
                throw ValidationException::withMessages([
                    'balance' => 'Insufficient balance',
                ]);
            }

            $order->status()->associate(Status::where('name', 'approved')->first());
            $order->save();
    
            $user->balance -= $sum;
            $user->save();
    
            return true;
        });
    }
}