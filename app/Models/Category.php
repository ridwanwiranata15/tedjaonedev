<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug','photo'];

    public function houses(){
        return $this->hasOne(House::class);
    }
}
