<?php

namespace App\Services\Product;

use App\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class ProductFilterService implements FilterInterface
{
    public function filter(Builder $query, array $params = []): Builder
    {
        if(isset($params['title'])) {
            $this->title($query, $params['title']);
        }

        if(isset($params['cost_from'])) {
            $this->costGreaterThan($query, $params['cost_from']);
        }

        if(isset($params['cost_to'])) {
            $this->costLessThan($query, $params['cost_to']);
        }

        if(isset($params['count_from'])) {
            $this->countGreaterThan($query, $params['count_from']);
        }

        if(isset($params['count_to'])) {
            $this->countLessThan($query, $params['count_to']);
        }
        
        return $query;
    }

    public function title($query, $title)
    {
        return $query->where('title', 'like', "%$title%");
    }

    public function costGreaterThan($query, $cost)
    {
        return $query->where('cost', '>=', $cost);
    }

    public function costLessThan($query, $cost)
    {
        return $query->where('cost', '<=', $cost);
    }

    public function countGreaterThan($query, $count)
    {
        return $query->where('count', '>=', $count);
    }

    public function countLessThan($query, $count)
    {
        return $query->where('count', '<=', $count);
    }
}