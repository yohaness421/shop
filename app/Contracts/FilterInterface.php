<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function filter(Builder $model, array $params = []): Builder;
}