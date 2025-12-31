<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MortgageRequest extends Model
{
    protected $fillable = [
        'user_id',
        'interest_id',
        'dp_total_amount',
        'dp_percentage',
        'loan_total_amount',
        'loan_interest_total_amount',
        'monthly_amount',
        'status',
        'documents',
        'interst'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function interests(){
        return $this->belongsTo(Interest::class, 'interest_id');
    }
}
