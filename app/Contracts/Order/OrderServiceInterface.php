<?php

namespace App\Contracts\Order;

use App\Models\Order;

interface OrderServiceInterface
{
    public function create(array $data): Order;

    public function approve($id): bool;
}