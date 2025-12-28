<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        "name",
        "slug",
        "thumbnail",
        "about",
        "price",
        "bedroom",
        "bathroom",
        "certificate",
        "electric",
        "building_area",
        "land_area",
        "category_id",
        "city_id"
    ];


    public function categories(){
        return $this->belongsTo(Category::class);
    }
    public function cities(){
        return $this->belongsTo(City::class);
    }
    public function facilities(){
        return $this->belongsTo(Facility::class);
    }
}
