<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrangeMoneyService;
use Log;

class OrangeMoneyController extends Controller
{
    protected $orange;

    public function __construct(OrangeMoneyService $orange)
    {
        $this->orange = $orange;
    }

    public function pay(Request $request)
    {
        $amount = $request->input('amount');
        $orderId = 'ORD-' . uniqid();

        try {
            $payment = $this->orange->initiatePayment($amount, $orderId);
            return response()->json([
                'payment_url' => $payment['payment_url'],
                'order_id' => $orderId,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        // User was redirected back from Orange after success
        return response()->json(['message' => 'Payment callback received', 'params' => $request->all()]);
    }

    public function cancel(Request $request)
    {
        return response()->json(['message' => 'Payment was cancelled']);
    }

    public function webhook(Request $request)
    {
        \Log::info('Orange Webhook:', $request->all());
        return response()->json(['message' => 'Webhook received']);
    }
}