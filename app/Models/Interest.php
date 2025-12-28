<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = ['house_id','bank_id', 'interest', 'duration'];

    public function houses(){
        return $this->belongsTo(House::class);
    }
    public function banks(){
        return $this->belongsTo(Bank::class);
    }
}
