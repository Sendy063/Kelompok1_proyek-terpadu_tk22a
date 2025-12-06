<x-guest-layout>
     <style>
        .login-banner {
            position: absolute;
            top: 70px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #800000;
            color: white;
            padding: 10px 32px;
            border-radius: 12px;
            font-weight: bold;
            text-transform: uppercase;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            z-index: 50;
        }

        @media (max-width: 640px) {
            .login-banner {
                font-size: 14px;
                padding: 8px 20px;
            }
        }
    </style>
    

    <!-- Banner Header -->
    <div class="login-banner">
        <h2 class="text-lg font-bold uppercase">Selamat Datang Kembali</h2>
    </div>

    <p class="text-center text-sm text-gray-700 mb-6 mt-6">Buat akun Acimart kamu sekarang</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4 relative">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9.004 9.004 0 0112 15c2.21 0 4.21.805 5.879 2.121M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </span>
            <input id="name" name="name" type="text" required autofocus autocomplete="name"
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500"
                placeholder="Nama Lengkap" value="{{ old('name') }}">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mb-4 relative">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m0 0l4-4m-4 4l4 4" />
                </svg>
            </span>
            <input id="email" name="email" type="email" required autocomplete="username"
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500"
                placeholder="Email" value="{{ old('email') }}">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3 1.343 3 3v1H9v-1c0-1.657 1.343-3 3-3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13v4a2 2 0 002 2h10a2 2 0 002-2v-4" />
                </svg>
            </span>
            <input id="password" name="password" type="password" required autocomplete="new-password"
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500"
                placeholder="Password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4 relative">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3 1.343 3 3v1H9v-1c0-1.657 1.343-3 3-3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13v4a2 2 0 002 2h10a2 2 0 002-2v-4" />
                </svg>
            </span>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500"
                placeholder="Konfirmasi Password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Login Prompt -->
        <div class="flex justify-between text-sm text-gray-600 mb-4">
            <span>Sudah punya akun? <a href="{{ route('login') }}" class="text-red-600 font-semibold hover:underline">Login</a></span>
        </div>

        <!-- Register Button -->
        <button type="submit"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-lg shadow">
            SIGN UP
        </button>

        <!-- Social Login -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600 mb-2">Daftar dengan sosial media</p>
            <div class="flex justify-center gap-4">
                <button class="bg-white p-2 rounded-full shadow hover:bg-gray-100">
                    <img src="/icons/facebook.svg" class="w-6 h-6" alt="Facebook">
                </button>
                <button class="bg-white p-2 rounded-full shadow hover:bg-gray-100">
                    <img src="/icons/google.svg" class="w-6 h-6" alt="Google">
                </button>
                <button class="bg-white p-2 rounded-full shadow hover:bg-gray-100">
                    <img src="/icons/apple.svg" class="w-6 h-6" alt="Apple">
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>