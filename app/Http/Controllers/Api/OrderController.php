<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Order\OrderServiceInterface;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Order\ApproveOrderRequest;
use App\Http\Requests\Order\CreateOrderRequest;

class OrderController extends ApiController
{
    public function create(CreateOrderRequest $request, OrderServiceInterface $service)
    {
        return $this->sendResponse(
            true,
            $service->create(
                $request->validated()
            ),
        );
    }

    public function approve(ApproveOrderRequest $request, OrderServiceInterface $service)
    {
        return $this->sendResponse(
            $service->approve(
                $request->validated()
            ),
        );
    }
}