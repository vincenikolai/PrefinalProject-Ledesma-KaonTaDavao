<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    /** @use HasFactory<\Database\Factories\DishFactory> */
    use HasFactory;

    protected $fillable = [
        'eatery_id',
        'name',
        'price',
        'is_bestseller',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_bestseller' => 'boolean',
        ];
    }
}