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
    <header class="bg-white dark:bg-gray-800 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3 cursor-pointer" onclick="window.location.href='/'">
                <div class="bg-red-600 text-white p-2 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Acimart</h1>
            </div>
            <nav class="space-x-6 flex items-center">
                <a href="/" class="text-gray-700 dark:text-gray-300 hover:text-red-600 transition">Home</a>
                <span class="text-red-600 font-semibold border-b-2 border-red-600 pb-1">Keranjang</span>
                <a href="{{ route('orders.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 transition">Pesanan Saya</a>
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
                        <button type="button" onclick="updateQuantity({{ $item['produk']->id }}, -1)" class="bg-red-500 text-white px-2 py-1 rounded disabled:opacity-50 disabled:cursor-not-allowed" {{ $item['quantity'] <= 1 ? 'disabled' : '' }} id="btn-minus-{{ $item['produk']->id }}">-</button>
                        <span id="quantity-{{ $item['produk']->id }}">{{ $item['quantity'] }}</span>
                        <button type="button" onclick="updateQuantity({{ $item['produk']->id }}, 1)" class="bg-red-500 text-white px-2 py-1 rounded">+</button>
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
                <p>Total: <span id="cart-total" class="text-red-600 font-bold">Rp {{ number_format($total) }}</span></p>
                <a href="{{ route('cart.checkout') }}" class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg mt-4 inline-block text-center">Lanjut ke Checkout</a>
            </div>
        </div>
        @else
        <p class="text-center text-gray-500">Keranjang kosong. <a href="/" class="text-red-600">Belanja sekarang</a></p>
        @endif
    </div>

    <script>
        function updateQuantity(productId, change) {
            const qtySpan = document.getElementById(`quantity-${productId}`);
            const currentQty = parseInt(qtySpan.innerText);
            const newQty = currentQty + change;
            const btnMinus = document.getElementById(`btn-minus-${productId}`);

            if (newQty < 1) return;

            // Optimistic UI Update
            qtySpan.innerText = newQty;
            if (newQty <= 1) {
                btnMinus.disabled = true;
            } else {
                btnMinus.disabled = false;
            }

            fetch(`/cart/update/${productId}`, {
                method: 'POST', // Using POST with _method PATCH because Laravel routing
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    _method: 'PATCH',
                    quantity: newQty
                })
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if(data.status === 'success') {
                    document.getElementById('cart-total').innerText = 'Rp ' + data.total;
                } else {
                    // Revert if error
                    alert('Gagal update keranjang');
                    qtySpan.innerText = currentQty;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                qtySpan.innerText = currentQty; // Revert
                if (currentQty <= 1) btnMinus.disabled = true; else btnMinus.disabled = false;
            });
        }
    </script>
</body>

</html>