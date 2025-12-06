<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - Acimart</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans antialiased">
    <header class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="/" class="text-2xl font-bold text-red-600">Acimart</a>
            <nav class="space-x-6">
                <a href="/" class="hover:text-red-600">Home</a>
                <a href="/cart" class="hover:text-red-600">Keranjang</a>
            </nav>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-red-700 mb-8">Checkout</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Form Checkout -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Detail Pengiriman & Pembayaran</h3>
                <form action="{{ route('cart.processCheckout') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                        <input type="text" name="customer" required class="w-full p-3 border rounded" placeholder="Masukkan nama lengkap">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" required class="w-full p-3 border rounded" placeholder="Masukkan email">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Alamat Lengkap</label>
                        <textarea name="alamat" required class="w-full p-3 border rounded" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
                        <input type="text" name="telepon" required class="w-full p-3 border rounded" placeholder="Masukkan nomor telepon">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Metode Pembayaran</label>
                        <select name="payment_method" required class="w-full p-3 border rounded">
                            <option value="cod">COD (Bayar di Tempat)</option>
                            <option value="transfer_bank">Transfer Bank</option>
                            <option value="e_wallet">E-Wallet</option>
                        </select>
                    </div>
                    <p class="text-lg font-bold">Total: <span class="text-red-600">Rp {{ number_format($total) }}</span></p>
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg mt-4">Buat Pesanan</button>
                </form>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Ringkasan Pesanan</h3>
                @foreach($cartItems as $item)
                <div class="flex justify-between mb-2">
                    <span>{{ $item['produk']->nama }} ({{ $item['quantity'] }}x)</span>
                    <span>Rp {{ number_format($item['subtotal']) }}</span>
                </div>
                @endforeach
                <hr class="my-4">
                <div class="flex justify-between font-bold">
                    <span>Total</span>
                    <span class="text-red-600">Rp {{ number_format($total) }}</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>