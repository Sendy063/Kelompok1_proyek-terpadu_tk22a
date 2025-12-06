<?php

namespace App\Http\Controllers;

use App\Models\ProdukTapioka;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
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
        $cart = Session::get('cart', []);

        $found = false;
        foreach ($cart as &$item) {
            if ($item['produk_id'] == $produkId) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = ['produk_id' => $produkId, 'quantity' => 1];
        }

        Session::put('cart', $cart);
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
        $cart = Session::get('cart', []);
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
        ]);

        $cart = Session::get('cart', []);
        $total = 0;

        if (!empty($cart)) {
            $produkIds = array_column($cart, 'produk_id');
            $produks = ProdukTapioka::whereIn('id', $produkIds)->get()->keyBy('id');

            foreach ($cart as $item) {
                $produk = $produks->get($item['produk_id']);
                if ($produk) {
                    $total += $produk->harga * $item['quantity'];
                }
            }
        }

        $order = Order::create([
            'customer' => $request->customer,
            'order_date' => now()->toDateString(),
            'total' => $total,
            'status' => 'baru'
        ]);

        Session::forget('cart');
        return redirect()->route('cart.success', ['orderId' => $order->id])->with('success', 'Pesanan berhasil dibuat! Terima kasih telah berbelanja.');
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('success', compact('order'));
    }
}
