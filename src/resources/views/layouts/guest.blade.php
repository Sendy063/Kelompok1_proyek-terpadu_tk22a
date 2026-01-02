<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ACIMART') }}</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center px-4 bg-cover bg-center" style="background-image: url('/image/bg1.png')">
    <!-- <div class="min-h-screen flex items-center justify-center bg-black/40">
        <div class="w-full max-w-md bg-[#fdf8f3] rounded-xl shadow-lg p-6">
            {{ $slot }}
        </div>
    </div> -->

    <div {{ $attributes->merge([
    'class' => 'relative w-full sm:max-w-md mt-12 px-8 py-10 bg-[#FBF6E8] shadow-xl overflow-visible rounded-2xl'
]) }}>
    {{ $slot }}
</div>
</body>
</html>

