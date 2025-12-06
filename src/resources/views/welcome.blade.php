<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acimart - Marketplace Produk Aci</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans antialiased min-h-screen">
    <!-- Header Sticky Mirip Shopee -->
    <header class="sticky top-0 z-50 bg-white dark:bg-gray-800 shadow-lg border-b border-red-200 dark:border-red-700">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/logo.png') }}" alt="Acimart Logo" class="h-10 w-auto"> <!-- Ganti dengan logo Anda -->
                <h1 class="text-2xl font-bold text-red-600 dark:text-red-400">Acimart</h1>
            </div>

            <!-- Search Bar -->
            <div class="flex-1 max-w-lg mx-8">
                <div class="relative">
                    <input type="text" placeholder="Cari produk olahan aci..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-gray-700">
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-red-500 text-white px-4 py-1 rounded-full hover:bg-red-600 transition">
                        Cari
                    </button>
                </div>
            </div>

            <!-- Navigation & Cart -->
            <div class="flex items-center space-x-6">
                <nav class="hidden md:flex space-x-6">
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-red-600 transition">Kategori</a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-red-600 transition">Promo</a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-red-600 transition">Bantuan</a>
                </nav>
                <div class="relative">
                    <a href="{{ route('cart.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-red-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13l-1.1 5M7 13h10m0 0v5a2 2 0 01-2 2H9a2 2 0 01-2-2v-5"></path>
                        </svg>
                    </a>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ session('cart', []) ? count(session('cart')) : 0 }}</span> <!-- Badge cart -->
                </div>
                <div class="hidden md:block">
                    <button class="text-gray-700 dark:text-gray-300 hover:text-red-600 transition">Login</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Banner Carousel Mirip Shopee -->
    <section class="bg-gradient-to-r from-red-50 to-white dark:from-red-900 dark:to-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                <div class="flex transition-transform duration-500" id="carousel">
                    <!-- Slide 1 -->
                    <div class="min-w-full bg-cover bg-center h-64 flex items-center justify-center text-white" style="background-image: url('https://via.placeholder.com/1200x400?text=Promo+Sambal+Pedas');">
                        <div class="text-center">
                            <h2 class="text-4xl font-bold mb-4">Promo Sambal Pedas!</h2>
                            <p class="text-lg mb-6">Diskon hingga 50% untuk produk favorit Anda.</p>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-full font-semibold transition">Belanja Sekarang</button>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="min-w-full bg-cover bg-center h-64 flex items-center justify-center text-white" style="background-image: url('https://via.placeholder.com/1200x400?text=Tepung+Tapioka+Murni');">
                        <div class="text-center">
                            <h2 class="text-4xl font-bold mb-4">Tepung Tapioka Berkualitas!</h2>
                            <p class="text-lg mb-6">Olahan aci terbaik dari bahan murni.</p>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-full font-semibold transition">Lihat Produk</button>
                        </div>
                    </div>
                </div>
                <!-- Carousel Controls -->
                <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 text-red-600 p-2 rounded-full hover:bg-white transition" onclick="prevSlide()">❮</button>
                <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 text-red-600 p-2 rounded-full hover:bg-white transition" onclick="nextSlide()">❯</button>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-12 flex">

        <!-- Main Content: Grid Produk -->
        <main class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($produk as $item)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden group">
                    <!-- Gambar Produk -->
                    <div class="relative overflow-hidden">
                        <a href="{{ route('produk.detail', $item->id) }}">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                        </a>
                        @if ($item->promo)
                        <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">Diskon 20%</span>
                        @endif
                        <button class="absolute top-2 right-2 bg-white/80 text-red-600 p-2 rounded-full hover:bg-red-100 transition opacity-0 group-hover:opacity-100">
                            ❤️ <!-- Wishlist -->
                        </button>
                    </div>

                    <!-- Detail Produk -->
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1"><a href="{{ route('produk.detail', $item->id) }}" class="hover:text-red-600">{{ $item->nama }}</a></h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ Str::limit($item->deskripsi, 50) }}</p>
                        <!-- <div class="flex items-center mb-2">
                            <span class="text-yellow-400 text-sm">⭐⭐⭐⭐⭐</span>
                            <span class="text-xs text-gray-500 ml-2">(120 ulasan)</span>
                        </div> -->
                        <!-- <p class="text-xs text-gray-500 mb-2">Terjual 250+ | Metode: {{ ucfirst($item->metode) }}</p> -->
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-lg font-bold text-red-600 dark:text-red-400">Rp {{ number_format($item->harga) }}</p>
                                @if ($item->promo)
                                <p class="text-sm text-gray-500 line-through">Rp {{ number_format($item->harga * 1.2) }}</p>
                                @endif
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $item->id }}">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition transform hover:scale-105">
                                    + Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination Mirip Shopee -->
            <div class="mt-12 flex justify-center">
                <div class="flex space-x-2">
                    <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">1</button>
                    <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 transition">2</button>
                    <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 transition">3</button>
                    <span class="px-4 py-2">...</span>
                    <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 transition">Next</button>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Produk Detail (Placeholder) -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg max-w-lg w-full mx-4">
            <h3 class="text-2xl font-bold mb-4">Detail Produk</h3>
            <p>Detail lengkap produk akan muncul di sini.</p>
            <button onclick="closeModal()" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-lg">Tutup</button>
        </div>
    </div>

    <!-- Footer Lengkap Mirip Marketplace -->
    <footer class="bg-gray-800 dark:bg-gray-900 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h4 class="text-lg font-bold mb-4">Acimart</h4>
                <p class="text-sm">Marketplace produk olahan aci terbaik dengan cita rasa sambal dan kemurnian tepung tapioka.</p>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-4">Kategori</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-red-400 transition">Sambal</a></li>
                    <li><a href="#" class="hover:text-red-400 transition">Tepung Tapioka</a></li>
                    <li><a href="#" class="hover:text-red-400 transition">Olahan Aci</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-4">Bantuan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-red-400 transition">Cara Belanja</a></li>
                    <li><a href="#" class="hover:text-red-400 transition">Pengiriman</a></li>
                    <li><a href="#" class="hover:text-red-400 transition">Kontak Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-4">Ikuti Kami</h4>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-red-400 transition">📘 Facebook</a>
                    <a href="#" class="hover:text-red-400 transition">📷 Instagram</a>
                    <a href="#" class="hover:text-red-400 transition">💬 WhatsApp</a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm">
            <p>&copy; 2023 Acimart. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript Sederhana untuk Interaktivitas -->
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('#carousel > div');

        function showSlide(index) {
            const totalSlides = slides.length;
            if (index >= totalSlides) currentSlide = 0;
            if (index < 0) currentSlide = totalSlides - 1;
            document.querySelector('#carousel').style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        function nextSlide() {
            currentSlide++;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide--;
            showSlide(currentSlide);
        }

        // Auto-slide setiap 5 detik
        setInterval(nextSlide, 5000);

        // Modal functions
        function openModal(id) {
            const modal = document.getElementById('productModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('productModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>

</html>