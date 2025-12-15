<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ACIMART') }}</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-cover bg-center" style="background-image: url('/image/bg1.png')">
    <div class="min-h-screen flex items-center justify-center bg-black/40">
        <div class="w-full max-w-md bg-[#fdf8f3] rounded-xl shadow-lg p-6">
            {{ $slot }}
        </div>
    </div>
</body>
</html>