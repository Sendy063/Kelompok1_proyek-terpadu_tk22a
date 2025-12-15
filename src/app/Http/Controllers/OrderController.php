<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Midtrans\Config;
use Midtrans\Transaction;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = auth()->user()->orders()->findOrFail($id);
        return view('orders.show', compact('order'));
    }


}
