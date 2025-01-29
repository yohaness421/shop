<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cost',
        'count'
    ];

    public function setCostAttribute($value)
    {
        $this->attributes['cost'] = bcmul($value, 1, 2);
    }
}
