<?php

namespace App\Services\Order;

use App\Contracts\Order\OrderServiceInterface;
use App\Models\Order;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    public function create(array $data): Order
    {
        if(isset($data['products'])) {
            $products = Product::query()->whereIn('id', collect($data['products'])->pluck('id'))->get();
            $data['products'] = $products->toArray();
        }
        return Order::query()->create($data);
    }

    public function approve($id): bool
    {
        return DB::transaction(function() use($id) {
            $order = Order::query()->findOrFail($id);
        
            $products = collect($order->products ?? []);
    
            $user = $order->user;

            $sum = 0;
            $products->map(function($product) use(&$sum) {
                $sum += $product->cost * $product->count;
            });

            if ($user->balance < $sum) {
                throw new \Exception('Insufficient balance');
            }

            $order->status()->associate(Status::where('name', 'approved')->first());
            $order->save();
    
            $user->balance -= $sum;
            $user->save();
    
            return true;
        });
    }
}