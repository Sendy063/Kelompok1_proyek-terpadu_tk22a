<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        // Set configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        try {
            $notification = new Notification();
            
            $status = $notification->transaction_status;
            $type = $notification->payment_type;
            $fraud = $notification->fraud_status;
            $orderId = $notification->order_id;
            
            // Find order
            $order = Order::findOrFail($orderId);
            
            if ($status == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $order->update(['status' => 'challenge']);
                    } else {
                        $order->update(['status' => 'paid']);
                    }
                }
            } else if ($status == 'settlement') {
                $order->update(['status' => 'paid']);
            } else if ($status == 'pending') {
                $order->update(['status' => 'pending']);
            } else if ($status == 'deny') {
                $order->update(['status' => 'failed']);
            } else if ($status == 'expire') {
                $order->update(['status' => 'expired']);
            } else if ($status == 'cancel') {
                $order->update(['status' => 'cancelled']);
            }
            
            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
