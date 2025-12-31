<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagesHouse extends Model
{
    protected $fillable = ['house_id', 'image'];

    public function house(){
        return $this->belongsTo(House::class);
    }
}
