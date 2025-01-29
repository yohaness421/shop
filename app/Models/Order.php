<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'number',
        'status_id',
        'user_id',
        'products'
    ];

    protected $casts = [
        'products' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function setProductsAttribute($newProducts)
    {
        if (!is_array($newProducts)) {
            return;
        }

        $currentProductsById = collect($this->products ?? [])->keyBy('id');
        $newProductsById = collect($newProducts)->keyBy('id');

        $this->validateProducts($newProductsById);

        $this->addNewProducts($newProductsById, $currentProductsById);

        $this->removeDeletedProducts($newProductsById, $currentProductsById);

        $this->attributes['products'] = $currentProductsById->values();
    }

    protected function validateProducts($products)
    {
        $rules = [
            'id' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'count' => 'required|integer|min:1',
        ];

        foreach ($products as $newProduct) {
            $validator = Validator::make($newProduct, $rules);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        }
    }

    protected function addNewProducts($newProductsById, &$currentProductsById)
    {
        foreach ($newProductsById as $id => $newProduct) {
            if (!$currentProductsById->has($id)) {
                $currentProductsById[$id] = $newProduct;
            }
        }
    }

    protected function removeDeletedProducts($newProductsById, &$currentProductsById)
    {
        foreach ($currentProductsById as $id => $product) {
            if (!$newProductsById->has($id)) {
                unset($currentProductsById[$id]);
            }
        }
    }
}
