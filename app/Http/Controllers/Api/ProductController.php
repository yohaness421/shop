<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Product\ProductServiceInterface;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Product\CatalogRequest;

class ProductController extends ApiController
{
    public function catalog(CatalogRequest $request, ProductServiceInterface $service)
    {
        return $this->sendResponse(
            true,
            $service->catalog(
                $request->validated()
            )->toArray()
        );
    }
}
