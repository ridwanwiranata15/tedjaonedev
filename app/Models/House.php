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
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function cities(){
        return $this->belongsTo(City::class, 'city_id');
    }

    public function houseFacility(){
        return $this->hasMany(FacilityHouse::class, 'facility_house_id');
    }
}
