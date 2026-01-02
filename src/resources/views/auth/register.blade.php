<x-guest-layout>

    {{-- FLOATING TITLE --}}
    <div class="absolute -top-6 left-1/2 -translate-x-1/2 z-30">
        <div class="bg-red-900 text-white px-8 py-2 rounded-xl font-bold shadow-lg text-sm sm:text-base">
            SELAMAT DATANG
        </div>
    </div>

    {{-- SUBTITLE --}}
    <p class="text-center text-sm text-gray-700 mb-6">
        Silahkan buat akun Acimart kamu
    </p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- NAME --}}
        <div class="mb-4 relative">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5.121 17.804A9.004 9.004 0 0112 15c2.21 0 4.21.805 5.879 2.121M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </span>
            <input
                id="name"
                name="name"
                type="text"
                required
                autofocus
                value="{{ old('name') }}"
                placeholder="Nama Lengkap"
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300
                       focus:ring-red-500 focus:border-red-500"
            >
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- EMAIL --}}
        <div class="mb-4 relative">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16 12H8m0 0l4-4m-4 4l4 4" />
                </svg>
            </span>
            <input
                id="email"
                name="email"
                type="email"
                required
                value="{{ old('email') }}"
                placeholder="Email"
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300
                       focus:ring-red-500 focus:border-red-500"
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- PASSWORD --}}
        <div class="mb-4 relative">
            <span class="absolute left-3 top-2.5 text-gray-400">
                🔒
            </span>
            <input
                id="password"
                name="password"
                type="password"
                required
                placeholder="Password"
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300
                       focus:ring-red-500 focus:border-red-500"
            >
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- CONFIRM PASSWORD --}}
        <div class="mb-6 relative">
            <span class="absolute left-3 top-2.5 text-gray-400">
                🔒
            </span>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                required
                placeholder="Konfirmasi Password"
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300
                       focus:ring-red-500 focus:border-red-500"
            >
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- LOGIN LINK --}}
        <p class="text-sm text-gray-600 mb-4 text-center">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-red-600 font-semibold hover:underline">
                Masuk
            </a>
        </p>

        {{-- REGISTER BUTTON --}}
        <button type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-lg shadow">
            Daftar
        </button>

        {{-- SOCIAL --}}
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600 mb-3">Daftar dengan sosial media</p>
            <div class="flex justify-center gap-4">
                <button class="bg-white p-2 rounded-full shadow">f</button>
                <button class="bg-white p-2 rounded-full shadow">G</button>
                <button class="bg-white p-2 rounded-full shadow"></button>
            </div>
        </div>

    </form>

</x-guest-layout>
