<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class City extends Model
{
     protected $fillable = ['name','slug','photo'];
       protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => url('/storage/cities/' . $image),
        );
    }
}
