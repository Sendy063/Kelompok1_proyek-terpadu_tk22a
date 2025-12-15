<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'is_buyer'])->group(function () {
    Route::get('/', function () {
        $produk = \App\Models\ProdukTapioka::all();
        return view('welcome', compact('produk'));
    });
});


Route::get('/test-env', function () {
    // When config is cached, env() returns null. Always use config()
    return response()->json([
        'midtrans_config' => config('midtrans'), // Should show the full array
        'server_key_via_config' => config('midtrans.server_key'),
    ]);
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

Route::get('/produk/{id}', [ProductController::class, 'detail'])->name('produk.detail');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
    Route::post('/payment/complete', [CartController::class, 'completePayment'])->name('payment.complete');
});
Route::get('/checkout/success/{orderId}', [CartController::class, 'success'])->name('cart.success');

// Midtrans Notification Route
Route::post('midtrans/notification', [\App\Http\Controllers\MidtransController::class, 'notificationHandler']);

require __DIR__ . '/auth.php';
