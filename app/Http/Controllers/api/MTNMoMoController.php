<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MTNMoMoService;

class MTNMoMoController extends Controller
{
    protected $momo;

    public function __construct(MTNMoMoService $momo)
    {
        $this->momo = $momo;
    }

    public function pay(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'phone' => 'required|string',
        ]);

        try {
            $payment = $this->momo->requestToPay($request->amount, $request->phone);
            return response()->json([
                'message' => 'Payment initiated',
                'transaction_id' => $payment['transaction_id'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkStatus($transactionId)
    {
        try {
            $status = $this->momo->getTransactionStatus($transactionId);
            return response()->json($status);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
