<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $produk->nama }} - Acimart</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans antialiased">
    <!-- Header Sederhana (Sama seperti halaman utama) -->
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
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Gambar Produk -->
            <div class="space-y-4">
                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
                <!-- Thumbnail kecil (opsional) -->
                <div class="flex space-x-2">
                    <img src="{{ asset('storage/' . $produk->gambar) }}" class="w-20 h-20 object-cover rounded cursor-pointer border-2 border-red-500">
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="space-y-6">
                <h1 class="text-3xl font-bold text-red-700 dark:text-red-300">{{ $produk->nama }}</h1>
                <div class="flex items-center space-x-2">
                    <span class="text-yellow-400">⭐⭐⭐⭐⭐</span>
                    <span class="text-sm text-gray-600">(120 ulasan)</span>
                </div>
                <p class="text-2xl font-bold text-red-600">Rp {{ number_format($produk->harga) }}</p>
                <p class="text-gray-700 dark:text-gray-300">{{ $produk->deskripsi }}</p>
                <p class="text-sm text-gray-500">Metode: {{ ucfirst($produk->metode) }} | Terjual: 250+</p>

                <!-- Opsi Jumlah -->
                <div class="flex items-center space-x-4">
                    <label class="font-semibold">Jumlah:</label>
                    <button onclick="changeQty(-1)" class="bg-red-500 text-white px-3 py-1 rounded">-</button>
                    <span id="qty" class="px-4">1</span>
                    <button onclick="changeQty(1)" class="bg-red-500 text-white px-3 py-1 rounded">+</button>
                </div>

                <!-- Tombol Aksi -->
                <div class="space-y-4">
                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                        @csrf
                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                        <input type="hidden" name="quantity" id="quantityInput" value="1">
                        <input type="hidden" name="action" value="add">
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg font-semibold transition">Tambah ke Keranjang</button>
                    </form>
                    <button onclick="buyNow()" class="w-full bg-white border border-red-500 text-red-500 hover:bg-red-50 py-3 rounded-lg font-semibold transition">Beli Sekarang</button>
                </div>
            </div>
        </div>

        <!-- Ulasan -->
        <section class="mt-16">
            <h2 class="text-2xl font-bold text-red-700 mb-6">Ulasan Pelanggan</h2>
            <div class="space-y-4">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="text-yellow-400">⭐⭐⭐⭐⭐</span>
                        <span class="font-semibold">Ani</span>
                    </div>
                    <p class="text-gray-600">"Produknya enak dan pedas sesuai ekspektasi!"</p>
                </div>
                <!-- Tambah ulasan lainnya -->
            </div>
        </section>
    </div>

    <script>
        let qty = 1;

        function changeQty(delta) {
            qty += delta;
            if (qty < 1) qty = 1;
            document.getElementById('qty').textContent = qty;
            document.getElementById('quantityInput').value = qty;
        }

        function buyNow() {
            document.getElementById('addToCartForm').action = '{{ route("cart.add") }}';
            document.querySelector('input[name="action"]').value = 'buy_now';
            document.getElementById('addToCartForm').submit();
        }
    </script>
</body>

</html>