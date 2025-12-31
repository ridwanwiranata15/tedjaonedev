<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use Illuminate\Http\Request;
use App\Models\MortgageRequest;
use Illuminate\Support\Facades\Validator;

class MortgageRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

         $imagehouse = MortgageRequest::with(['users', 'interests.houses', 'interests.banks'])
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
                'data' => $imagehouse
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
            'interest_id' => 'required',
            'dp_total_amount'  => 'required',
            'dp_percentage'  => 'required',
            'loan_total_amount'  => 'required',
            'loan_interest_total_amount'  => 'required',
            'monthly_amount'  => 'required',
            'status'  => 'required',
            'documents'  => 'required',
            'interst' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $mortgagerequest = MortgageRequest::create([
            'user_id' => 1,
            'interest_id' => $request->interest_id,
            'dp_total_amount' => $request->dp_total_amount,
            'dp_percentage' => $request->dp_percentage,
            'loan_total_amount' => $request->loan_total_amount,
            'loan_interest_total_amount' => $request->loan_interest_total_amount,
            'monthly_amount' => $request->monthly_amount,
            'status' => $request->status,
            'documents' => $request->documents,
            'interst'=> $request->interst
        ]);
        if ($mortgagerequest) {
            return response()->json([
                'status' => true,
                'message' => 'interest berhasil di tambahkan',
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
    public function update(Request $request, Interest $interest)
    {
        $validator = Validator::make($request->all(), [
            'interest_id' => 'required',
            'dp_total_amount'  => 'required',
            'dp_percentage'  => 'required',
            'loan_total_amount'  => 'required',
            'loan_interest_total_amount'  => 'required',
            'monthly_amount'  => 'required',
            'status'  => 'required',
            'documents'  => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $interest->update([
            'user_id' => auth()->user->id,
            'interest_id' => $request->interest_id,
            'dp_total_amount' => $request->dp_total_amount,
            'dp_percentage' => $request->dp_percentage,
            'loan_total_amount' => $request->loan_total_amount,
            'loan_interest_total_amount' => $request->loan_interest_total_amount,
            'monthly_amount' => $request->monthly_amount,
            'status' => $request->status,
            'documents' => $request->documents
        ]);
        if ($interest) {
            return response()->json([
                'status' => true,
                'message' => 'interest berhasil di ubah',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interest $interest)
    {
        $interest->delete();
        if ($interest) {
            return response()->json([
                'status' => true,
                'message' => 'interest berhasil di hapus',
            ]);
        }
    }
}
