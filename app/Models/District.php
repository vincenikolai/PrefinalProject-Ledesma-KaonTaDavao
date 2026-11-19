<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name'];

    public function eateries()
    {
        return $this->hasMany(Eatery::class);
    }

    public function reviews()
    {
        return $this->hasManyThrough(Review::class, Eatery::class);
    }
}