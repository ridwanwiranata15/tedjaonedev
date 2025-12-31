<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
     protected $fillable = ['name','slug','photo'];
    public function houseFacility(){
        return $this->hasMany(FacilityHouse::class);
    }
}
