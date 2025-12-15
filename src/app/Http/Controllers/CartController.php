<?php

namespace App\Http\Controllers;

use App\Models\ProdukTapioka;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Midtrans\Config;
use Midtrans\Snap;

class CartController extends Controller
{
    public function index()
    {
        // Clear any direct checkout item if user visits the cart
        Session::forget('direct_checkout_item');

        $cart = Session::get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $item) {
            $produk = ProdukTapioka::find($item['produk_id']);
            if ($produk) {
                $cartItems[] = [
                    'produk' => $produk,
                    'quantity' => $item['quantity'],
                    'subtotal' => $produk->harga * $item['quantity']
                ];
                $total += $produk->harga * $item['quantity'];
            }
        }

        return view('cart', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $produkId = $request->produk_id;
        $quantity = $request->quantity ?? 1;

        // Check if it's a "buy now" action
        if ($request->action === 'buy_now') {
            Session::put('direct_checkout_item', [
                'produk_id' => $produkId,
                'quantity' => $quantity
            ]);
            return redirect()->route('cart.checkout');
        }

        $cart = Session::get('cart', []);

        $found = false;
        foreach ($cart as &$item) {
            if ($item['produk_id'] == $produkId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = ['produk_id' => $produkId, 'quantity' => $quantity];
        }

        Session::put('cart', $cart);

        // Clear direct checkout if standard add happens
        Session::forget('direct_checkout_item');

        if ($request->wantsJson()) {
            $totalQuantity = 0;
            foreach ($cart as $item) {
                $totalQuantity += $item['quantity'];
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Produk berhasil ditambahkan ke keranjang!',
                'cart_count' => $totalQuantity
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $quantity = $request->quantity;
        $cart = Session::get('cart', []);

        foreach ($cart as &$item) {
            if ($item['produk_id'] == $id) {
                $item['quantity'] = $quantity;
                break;
            }
        }

        Session::put('cart', $cart);

        if ($request->wantsJson()) {
            $total = 0;
            $totalQuantity = 0;
            foreach ($cart as $cItem) {
                // We need to re-fetch product price to be safe or store it in session (better to fetch)
                // Assuming efficient enough for now, or use the loaded models if possible.
                // Since this is a new request, models are not loaded.
                $produk = ProdukTapioka::find($cItem['produk_id']);
                if ($produk) {
                    $total += $produk->harga * $cItem['quantity'];
                }
                $totalQuantity += $cItem['quantity'];
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Keranjang diperbarui!',
                'total' => number_format($total),
                'cart_count' => $totalQuantity
            ]);
        }

        return redirect()->back()->with('success', 'Keranjang diperbarui!');
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        $cart = array_filter($cart, function ($item) use ($id) {
            return $item['produk_id'] != $id;
        });

        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
    }

    public function checkout()
    {
        // Check for direct checkout item first
        $directItem = Session::get('direct_checkout_item');
        
        if ($directItem) {
            $cart = [$directItem];
        } else {
            $cart = Session::get('cart', []);
        }

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $cartItems = [];
        $total = 0;

        $produkIds = array_column($cart, 'produk_id');
        $produks = ProdukTapioka::whereIn('id', $produkIds)->get()->keyBy('id');

        foreach ($cart as $item) {
            $produk = $produks->get($item['produk_id']);
            if ($produk) {
                $cartItems[] = [
                    'produk' => $produk,
                    'quantity' => $item['quantity'],
                    'subtotal' => $produk->harga * $item['quantity']
                ];
                $total += $produk->harga * $item['quantity'];
            }
        }

        return view('checkout', compact('cartItems', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'telepon' => 'required',
            'payment_method' => 'required',
        ]);

        // Check for direct checkout item
        $directItem = Session::get('direct_checkout_item');

        if ($directItem) {
            $cart = [$directItem];
            $isDirectCheckout = true;
        } else {
            $cart = Session::get('cart', []);
            $isDirectCheckout = false;
        }

        $total = 0;
        $items = [];

        if (!empty($cart)) {
            $produkIds = array_column($cart, 'produk_id');
            $produks = ProdukTapioka::whereIn('id', $produkIds)->get()->keyBy('id');

            foreach ($cart as $item) {
                $produk = $produks->get($item['produk_id']);
                if ($produk) {
                    $total += $produk->harga * $item['quantity'];
                    $items[] = [
                        'produk_id' => $produk->id,
                        'nama' => $produk->nama,
                        'quantity' => $item['quantity'],
                        'harga' => $produk->harga,
                        'subtotal' => $produk->harga * $item['quantity']
                    ];
                }
            }
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'customer' => $request->customer,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'order_date' => now()->toDateString(),
            'total' => $total,
            'items' => json_encode($items),
            'payment_method' => 'midtrans', // Default set to midtrans as it handles others
            'status' => 'pending_payment' // Initial status
        ]);

        // Midtrans Configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => (int) $order->total,
            ],
            'customer_details' => [
                'first_name' => $request->customer,
                'email' => $request->email,
                'phone' => $request->telepon,
            ],
            'callbacks' => [
                'finish' => route('orders.index'),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            
            // Save snap token to order if needed, or just pass to session
             $order->payment_token = $snapToken; // Assuming you might add this column, explicitly passing to view for now
             $order->save();

            // Only clear the cart if it was a regular checkout
            if (!$isDirectCheckout) {
                Session::forget('cart');
            } else {
                // Clear the direct item after use
                Session::forget('direct_checkout_item');
            }
            
            if ($request->wantsJson()) {
                return response()->json([
                    'snap_token' => $snapToken, 
                    'order_id' => $order->id
                ]);
            }

            return view('checkout.payment', compact('snapToken', 'order'));

        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                 return response()->json(['error' => $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('success', compact('order'));
    }

    public function completePayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'result_data' => 'nullable' // Optional: store full JSON from Midtrans if needed
        ]);

        $order = Order::findOrFail($request->order_id);

        // Security check: ensure the order belongs to the logged-in user
        if ($order->user_id !== auth()->id()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        // Force update status to paid
        $order->status = 'paid';
        $order->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Order status updated to paid'
        ]);
    }
}
