<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MidtransService;

class MidtransController extends Controller
{
    protected $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }

    // Bisa POST (Postman)
    public function create(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000'
        ]);

        $transaction = $this->midtrans->createTransaction($request->amount);

        return response()->json([
            'status' => true,
            'snap_token' => $transaction->token,
            'redirect_url' => $transaction->redirect_url
        ]);
    }

    // Bisa GET (Browser)
    public function createViaBrowser($amount)
    {
        $transaction = $this->midtrans->createTransaction($amount);

        return redirect($transaction->redirect_url);
    }
}
