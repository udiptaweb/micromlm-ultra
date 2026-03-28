<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class CryptoPaymentController extends Controller
{
    public function webhook(Request $request)
    {
        $purchase = Purchase::find($request->order_id);

        $purchase->update([
            'status' => 'paid',
            'reference' => 'CRYPTO-' . now()->timestamp,
        ]);

        event(new \App\Events\PurchasePaid($purchase));

        return response()->json(['success' => true]);
    }
}
