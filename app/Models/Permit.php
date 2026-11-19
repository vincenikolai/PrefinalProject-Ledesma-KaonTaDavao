<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    /** @use HasFactory<\Database\Factories\PermitFactory> */
    use HasFactory;

    protected $fillable = [
        'eatery_id',
        'permit_no',
        'expires_on',
    ];

    protected function casts(): array
    {
        return [
            'expires_on' => 'date',
        ];
    }
}