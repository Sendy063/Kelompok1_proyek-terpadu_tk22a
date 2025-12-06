<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang - Acimart</title>
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
                <a href="/cart" class="text-red-600 font-semibold">Keranjang</a>
            </nav>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-red-700 mb-8">Keranjang Belanja</h1>
        @if(count($cartItems) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Item Keranjang -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $item['produk']->gambar) }}" class="w-20 h-20 object-cover rounded">
                    <div class="flex-1">
                        <h3 class="font-semibold">{{ $item['produk']->nama }}</h3>
                        <p class="text-red-600">Rp {{ number_format($item['produk']->harga) }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <form action="{{ route('cart.update', $item['produk']->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>-</button>
                        </form>
                        <span>{{ $item['quantity'] }}</span>
                        <form action="{{ route('cart.update', $item['produk']->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">+</button>
                        </form>
                    </div>
                    <form action="{{ route('cart.remove', $item['produk']->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                    </form>
                </div>
                @endforeach
            </div>

            <!-- Ringkasan -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Ringkasan Belanja</h3>
                <p>Total: <span class="text-red-600 font-bold">Rp {{ number_format($total) }}</span></p>
                <a href="{{ route('cart.checkout') }}" class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg mt-4 inline-block text-center">Lanjut ke Checkout</a>
            </div>
        </div>
        @else
        <p class="text-center text-gray-500">Keranjang kosong. <a href="/" class="text-red-600">Belanja sekarang</a></p>
        @endif
    </div>
</body>

</html>