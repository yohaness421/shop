<?php

namespace App\Contracts\Product;

use Illuminate\Support\Collection;

interface ProductServiceInterface
{
    public function catalog(array $params = []): Collection;
}