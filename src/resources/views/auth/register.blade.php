<x-guest-layout>
    <!-- Banner Header -->
    <div class="flex justify-center mb-8">
        <div class="bg-red-900 text-white px-8 py-2 rounded-xl font-bold uppercase shadow-lg text-sm sm:text-base">
            Selamat Datang Kembali
        </div>
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
            <input id="email" name="email" type="email" required autocomplete="username" autocapitalize="none"
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500"
                placeholder="Email" value="{{ old('email') }}">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4 relative" x-data="{ show: false }">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3 1.343 3 3v1H9v-1c0-1.657 1.343-3 3-3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13v4a2 2 0 002 2h10a2 2 0 002-2v-4" />
                </svg>
            </span>
            <input id="password" name="password" :type="show ? 'text' : 'password'" required autocomplete="new-password"
                class="pl-10 pr-10 py-2 w-full rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500"
                placeholder="Password">
            <button type="button" @click="show = !show" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 focus:outline-none">
                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                </svg>
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4 relative" x-data="{ show: false }">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3 1.343 3 3v1H9v-1c0-1.657 1.343-3 3-3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13v4a2 2 0 002 2h10a2 2 0 002-2v-4" />
                </svg>
            </span>
            <input id="password_confirmation" name="password_confirmation" :type="show ? 'text' : 'password'" required autocomplete="new-password"
                class="pl-10 pr-10 py-2 w-full rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500"
                placeholder="Konfirmasi Password">
            <button type="button" @click="show = !show" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 focus:outline-none">
                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                </svg>
            </button>
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