<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class CryptoPaymentService
{
    public function createPayment($amount, $orderId)
    {
        $response = Http::withHeaders([
            'x-api-key' => config('crypto.nowpayments_key')
        ])->post('https://api.nowpayments.io/v1/payment', [
            "price_amount" => $amount,
            "price_currency" => "inr",
            "pay_currency" => "trx",
            "order_id" => $orderId,
            "order_description" => "Order #".$orderId,
            "ipn_callback_url" => route('payment.crypto.webhook')
        ]);

        return $response->json();
    }
}