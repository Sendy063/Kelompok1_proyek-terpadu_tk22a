<header class="sticky top-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 shadow-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            <!-- Logo & Brand -->
            <div class="flex-shrink-0 flex items-center gap-3 cursor-pointer" onclick="window.location.href='/'">
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
                <div class="hidden sm:flex items-center gap-3">
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-red-600 transition-colors">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <!-- Dropdown -->
                            <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-xl py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right border border-gray-100 dark:border-gray-700 z-50">
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-red-600">Pesanan Saya</a>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-red-600">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-red-600 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm transition-all shadow-red-500/30 hover:shadow-red-500/40">Daftar</a>
                    @endauth
                </div>
                
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
                     <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800">Profil Saya</a>
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
