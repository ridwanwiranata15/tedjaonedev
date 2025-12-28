<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $fillable = [
        'mortgage_resquest_id',
        'no_of_payment',
        'total_tax_payment',
        'grand_total_amount',
        'sub_total_amount',
        'insurance_amount',
        'proof',
        'is_paid',
        'payment_type',
        'remaining_loan_amount'
    ];
    public function MortgageRequests(){
        return $this->belongsTo(MortgageRequest::class);
    }
}
