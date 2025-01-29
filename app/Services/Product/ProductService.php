<?php

namespace App\Services\Product;

use App\Contracts\Product\ProductServiceInterface;
use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService implements ProductServiceInterface
{
    public function catalog(array $params = []): Collection
    {
        $query = Product::query();

        $service = new ProductFilterService();
        $result = $service->filter($query, $params)->get();

        return $result;
    }
}