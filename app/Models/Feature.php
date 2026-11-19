<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['name'];

    public function eateries()
    {
        return $this->belongsToMany(Eatery::class);
    }
}