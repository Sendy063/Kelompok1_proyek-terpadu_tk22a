<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Berhasil - Acimart</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans antialiased min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg text-center">
        <div class="text-green-500 text-6xl mb-4">✓</div>
        <h1 class="text-2xl font-bold text-green-600 mb-4">Pesanan Berhasil!</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Terima kasih telah berbelanja di Acimart. Pesanan Anda telah diterima dan sedang diproses.</p>
        <div class="space-y-4">
            <p class="text-sm text-gray-500">Nomor Pesanan: <strong>#{{ $order->id ?? 'N/A' }}</strong></p>
            <a href="/" class="inline-block bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold transition">Kembali ke Beranda</a>
        </div>
    </div>
</body>

</html>