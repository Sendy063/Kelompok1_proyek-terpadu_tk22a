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
    <!-- Header Sticky -->
    <!-- Alert Success -->
    @if(session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-24 right-5 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 transform transition-all duration-300" x-transition:enter="translate-y-[-20px] opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="translate-y-[-20px] opacity-0">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif
    
    <!-- Header Modern Simple & Elegant -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo & Brand -->
                <div class="flex-shrink-0 flex items-center gap-3 cursor-pointer" onclick="window.location.href='/'">
                    <!-- <img src="{{ asset('images/logo.png') }}" alt="Acimart" class="h-10 w-auto"> -->
                    <div class="bg-red-600 text-white p-2 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Acimart</h1>
                    </div>
                </div>

                <!-- Search Bar (Hidden on mobile, centered) -->
                <div class="hidden md:flex flex-1 max-w-xl mx-8">
                    <div class="relative w-full group">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-red-500 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input type="text" 
                               class="block w-full pl-10 pr-3 py-2.5 border-none leading-5 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 focus:outline-none focus:bg-white dark:focus:bg-gray-700 focus:ring-2 focus:ring-red-500/20 rounded-xl transition-all duration-200 sm:text-sm" 
                               placeholder="Cari camilan favoritmu...">
                    </div>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center gap-4">
                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" id="cart-button" class="relative p-2 text-gray-500 hover:text-red-600 transition-colors duration-200 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        @if(session('cart') && count(session('cart')) > 0)
                        <span id="cart-count" class="absolute top-1 right-1 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full border-2 border-white dark:border-gray-900">
                            {{ array_sum(array_column(session('cart'), 'quantity')) }}
                        </span>
                        @endif
                    </a>

                    <!-- Auth Links -->
                    <x-auth-navigation />
                    
                    <!-- Mobile Menu Button -->
                    <div class="sm:hidden">
                        <button type="button" class="p-2 text-gray-500 hover:text-red-600 transition-colors" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden sm:hidden border-t border-gray-100 dark:border-gray-800 py-4">
                <div class="space-y-1">
                    @auth
                        <a href="{{ route('orders.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800">Pesanan Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800">Masuk</a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800">Daftar</a>
                    @endauth
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
                            <h2 class="text-4xl font-bold mb-4">Promo Spesial ACIMART!</h2>
                            <p class="text-lg mb-6">Aneka produk aci pilihan, gurih, kenyal, dan berkualitas. 
    Diskon menarik setiap hari!</p>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-full font-semibold transition">Belanja Sekarang</button>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="min-w-full bg-cover bg-center h-64 flex items-center justify-center text-white" style="background-image: url('https://via.placeholder.com/1200x400?text=Tepung+Tapioka+Murni');">
                        <div class="text-center">
                            <h2 class="text-4xl font-bold mb-4">Aci Berkualitas, Rasa Juara</h2>
                            <p class="text-lg mb-6">Olahan aci terbaik dari bahan terbaik.</p>
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
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                @foreach ($produk as $item)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden group flex flex-col h-full">
                    <!-- Gambar Produk -->
                    <div class="relative overflow-hidden aspect-w-1 aspect-h-1">
                        <a href="{{ route('produk.detail', $item->id) }}">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="w-full h-48 sm:h-56 object-cover transition-transform duration-300 group-hover:scale-105">
                        </a>
                        @if ($item->promo)
                        <span class="absolute top-2 left-2 bg-red-500 text-white text-[10px] sm:text-xs font-bold px-2 py-1 rounded">Diskon 20%</span>
                        @endif
                        <button class="absolute top-2 right-2 bg-white/80 text-red-600 p-1.5 sm:p-2 rounded-full hover:bg-red-100 transition opacity-0 group-hover:opacity-100">
                            ❤️ <!-- Wishlist -->
                        </button>
                    </div>

                    <!-- Detail Produk -->
                    <div class="p-3 sm:p-4 flex flex-col flex-1">
                        <h3 class="text-sm sm:text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1 capitalize line-clamp-2 leading-tight min-h-[2.5em]"><a href="{{ route('produk.detail', $item->id) }}" class="hover:text-red-600">{{ $item->nama }}</a></h3>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-2 line-clamp-2 h-8 sm:h-10">{{ Str::limit($item->deskripsi, 50) }}</p>
                        
                        <div class="mt-auto pt-3 flex flex-wrap items-center justify-between gap-2">
                            <div class="flex-shrink-0">
                                <p class="text-sm sm:text-lg font-bold text-red-600 dark:text-red-400">Rp {{ number_format($item->harga) }}</p>
                                @if ($item->promo)
                                <p class="text-[10px] sm:text-sm text-gray-500 line-through">Rp {{ number_format($item->harga * 1.2) }}</p>
                                @endif
                            </div>
                            <div class="flex items-center gap-1 sm:gap-2 w-full sm:w-auto">
                                <!-- Tombol Keranjang (Ikon) -->
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="produk_id" value="{{ $item->id }}">
                                    <button type="submit" class="p-1.5 sm:p-2 border border-red-500 text-red-500 rounded-lg hover:bg-red-50 transition" title="Tambah ke Keranjang">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </button>
                                </form>
                                
                                <!-- Tombol Beli Sekarang -->
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-grow sm:flex-grow-0">
                                    @csrf
                                    <input type="hidden" name="produk_id" value="{{ $item->id }}">
                                    <input type="hidden" name="action" value="buy_now">
                                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-2 py-1.5 sm:px-3 sm:py-2 rounded-lg text-xs sm:text-sm font-semibold transition shadow-md hover:shadow-lg whitespace-nowrap">
                                        Beli Sekarang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
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