<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityHouse extends Model
{
    protected $fillable = ['house_id', 'facility_id'];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
