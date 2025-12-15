<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pesanan #{{ $order->id }} - Acimart</title>
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
                <a href="/cart" class="text-gray-700 dark:text-gray-300 hover:text-red-600 transition">Keranjang</a>
                <a href="{{ route('orders.index') }}" class="text-red-600 font-semibold border-b-2 border-red-600 pb-1">Pesanan Saya</a>
                @auth
                <div class="hidden md:flex items-center gap-3 ml-4 border-l pl-4 border-gray-300">
                    <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-red-600">Logout</button>
                    </form>
                </div>
                @endauth
            </nav>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="mb-8">
            <a href="{{ route('orders.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-red-600 transition-colors mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Riwayat Pesanan
            </a>
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Detail Pesanan</h1>
                    <p class="text-gray-500 mt-1">Order #{{ $order->id }} • {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}</p>
                </div>
                @php
                    $statusColors = [
                        'baru' => 'bg-red-100 text-red-800 border-red-200',
                        'pending_payment' => 'bg-orange-100 text-orange-800 border-orange-200',
                        'diproses' => 'bg-blue-100 text-blue-800 border-blue-200',
                        'dikirim' => 'bg-purple-100 text-purple-800 border-purple-200',
                        'selesai' => 'bg-green-100 text-green-800 border-green-200',
                    ];
                    $colorClass = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                @endphp
                <span class="px-4 py-2 text-sm font-bold rounded-full border {{ $colorClass }}">
                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Order Items -->
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                        <h3 class="font-bold text-gray-900 dark:text-white">Daftar Produk</h3>
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach (json_decode($order->items) as $item)
                            <div class="p-6 flex justify-between items-center hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <div class="flex-1 min-w-0 pr-4">
                                    <h4 class="font-semibold text-gray-900 dark:text-white truncate">{{ $item->nama }}</h4>
                                    <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->harga) }}</p>
                                </div>
                                <span class="font-medium text-gray-900 dark:text-white whitespace-nowrap">Rp {{ number_format($item->subtotal) }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="p-6 bg-gray-50 dark:bg-gray-700 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center">
                        <span class="font-bold text-gray-700 dark:text-gray-300">Total Pembayaran</span>
                        <span class="text-xl font-bold text-red-600">Rp {{ number_format($order->total) }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer & Shipping Info -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                     <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                        <h3 class="font-bold text-gray-900 dark:text-white">Info Pengiriman</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Penerima</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $order->customer }}</p>
                            <p class="text-sm text-gray-500">{{ $order->email }}</p>
                            <p class="text-sm text-gray-500">{{ $order->telepon }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Alamat</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">{{ $order->alamat }}</p>
                        </div>
                         <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Pembayaran</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1 uppercase">{{ $order->payment_method }}</p>
                        </div>
                    </div>
                </div>
                
                @if($order->status == 'pending_payment' && $order->payment_token)
                 <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <button id="pay-button" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition">
                        Bayar Sekarang
                    </button>
                    <!-- Midtrans Snap Script -->
                     <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
                     <script>
                        document.getElementById('pay-button').onclick = function(){
                          snap.pay('{{ $order->payment_token }}');
                        };
                      </script>
                 </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>