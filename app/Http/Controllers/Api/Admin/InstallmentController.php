<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Installment;

class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $installments = Installment::with([
            'MortgageRequests.users',
            'MortgageRequests.interests',
            'MortgageRequests.interests.houses',
            'MortgageRequests.interests.houses.cities',
            'MortgageRequests.interests.houses.categories',
            'MortgageRequests.interests.banks'
        ])
            ->when(
                request('search'),
                fn($q) =>
                $q->where('name', 'like', '%' . request('search') . '%')
            )
            ->latest()
            ->paginate(5)
            ->appends(request()->only('search'));
        return response()->json([
            'status' => true,
            'message' => 'list mortgage request',
            'data' => $installments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mortgage_request_id' => 'required',
            'no_of_payment'  => 'required',
            'total_tax_payment'  => 'required',
            'grand_total_amount'  => 'required',
            'sub_total_amount'  => 'required',
            'insurance_amount'  => 'required',
            'proof'  => 'required',
            'is_paid'  => 'required',
            'payment_type' => 'required',
            'remaining_loan_amount' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $installment = Installment::create([
            'mortgage_request_id' => $request->mortgage_request_id,
            'no_of_payment'  => $request->no_of_payment,
            'total_tax_payment'  => $request->total_tax_payment,
            'grand_total_amount'  => $request->grand_total_amount,
            'sub_total_amount'  => $request->sub_total_amount,
            'insurance_amount'  => $request->insurance_amount,
            'proof'  => $request->proof,
            'is_paid'  => $request->is_paid,
            'payment_type' => $request->payment_type,
            'remaining_loan_amount' => $request->remaining_loan_amount
        ]);
        if ($installment) {
            return response()->json([
                'status' => true,
                'message' => 'installment berhasil di tambahkan',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Installment $installment)
    {
        $validator = Validator::make($request->all(), [
            'mortgage_request_id' => 'required',
            'no_of_payment'  => 'required',
            'total_tax_payment'  => 'required',
            'grand_total_amount'  => 'required',
            'sub_total_amount'  => 'required',
            'insurance_amount'  => 'required',
            'proof'  => 'required',
            'is_paid'  => 'required',
            'payment_type' => 'required',
            'remaining_loan_amount' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $installment->update([
            'mortgage_request_id' => $request->mortgage_request_id,
            'no_of_payment'  => $request->no_of_payment,
            'total_tax_payment'  => $request->total_tax_payment,
            'grand_total_amount'  => $request->grand_total_amount,
            'sub_total_amount'  => $request->sub_total_amount,
            'insurance_amount'  => $request->insurance_amount,
            'proof'  => $request->proof,
            'is_paid'  => $request->is_paid,
            'payment_type' => $request->payment_type,
            'remaining_loan_amount' => $request->remaining_loan_amount
        ]);
        if ($installment) {
            return response()->json([
                'status' => true,
                'message' => 'installment berhasil di tambahkan',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Installment $installment)
    {
        $installment->delete();
        return response()->json([
            'status' => true,
            'message' => 'installment berhasil di tambahkan',
        ]);
    }
}
