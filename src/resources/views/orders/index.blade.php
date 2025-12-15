<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pesanan - Acimart</title>
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
                <span class="text-red-600 font-semibold border-b-2 border-red-600 pb-1">Pesanan Saya</span>
                <x-auth-navigation />
            </nav>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Riwayat Pesanan</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Pantau status pesananmu di sini.</p>
            </div>
            <!-- <a href="{{ url('/') }}" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali Belanja
            </a> -->
        </div>

        @if ($orders->isEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-12 text-center">
                <div class="bg-gray-50 dark:bg-gray-700 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Belum ada pesanan</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400 max-w-sm mx-auto">Kamu belum melakukan transaksi apapun. Yuk, cari produk favoritmu!</p>
                <div class="mt-8">
                    <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-lg shadow-red-500/30 transition-all">
                        Mulai Belanja
                    </a>
                </div>
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700">
                <!-- Desktop View (Table) -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Pembayaran</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($orders as $order)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">
                                        <div class="flex flex-col">
                                            <span class="font-medium">{{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}</span>
                                            <span class="text-xs text-gray-500">#{{ $order->id }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-white">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
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
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border {{ $colorClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200 font-semibold hover:underline">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile View (Cards) -->
                <div class="block sm:hidden">
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($orders as $order)
                        <div class="p-4 bg-white dark:bg-gray-800">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <span class="text-xs text-gray-500 block">No. #{{ $order->id }}</span>
                                    <span class="text-sm font-bold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}</span>
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
                                <span class="px-2 py-1 text-xs font-semibold rounded-full border {{ $colorClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-sm font-bold text-gray-900 dark:text-white">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                <a href="{{ route('orders.show', $order->id) }}" class="text-sm text-red-600 font-semibold hover:text-red-500">Lihat Detail →</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>
</html>