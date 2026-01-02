<x-guest-layout>

    {{-- FLOATING TITLE (HARUS DI DALAM auth-card) --}}
    <div class="absolute -top-6 left-1/2 -translate-x-1/2 z-30">
        <div class="bg-red-900 text-white px-6 py-2 rounded-xl font-bold shadow-lg text-sm sm:text-base">
            SELAMAT DATANG 
        </div>
    </div>

    {{-- SUBTITLE --}}
    <p class="text-center text-sm text-gray-700 mb-6">
        Login ke akunmu
    </p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- EMAIL --}}
        <div class="mb-4 relative">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5.121 17.804A4 4 0 017 16h10a4 4 0 011.879.479M15 11a3 3 0 10-6 0 3 3 0 006 0z"/>
                </svg>
            </span>
            <input
                id="email"
                name="email"
                type="email"
                required
                autofocus
                value="{{ old('email') }}"
                placeholder="Email"
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300
                       focus:ring-red-500 focus:border-red-500"
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- PASSWORD --}}
        <div class="mb-4 relative" x-data="{ show: false }">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 11c1.657 0 3 1.343 3 3v1H9v-1c0-1.657 1.343-3 3-3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 13v4a2 2 0 002 2h10a2 2 0 002-2v-4"/>
                </svg>
            </span>

            <input
                id="password"
                name="password"
                :type="show ? 'text' : 'password'"
                required
                placeholder="Password"
                class="pl-10 pr-10 py-2 w-full rounded-lg border border-gray-300
                       focus:ring-red-500 focus:border-red-500"
            >

            <button type="button"
                    @click="show = !show"
                    class="absolute right-3 top-2.5 text-gray-400">
                👁
            </button>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- LINKS --}}
        <div class="flex justify-between text-sm text-gray-600 mb-6">
            <a href="{{ route('password.request') }}" class="hover:underline">
                Lupa Password?
            </a>
            <span>
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-red-600 font-semibold">
                    Daftar
                </a>
            </span>
        </div>

        {{-- LOGIN BUTTON --}}
        <button type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-lg shadow">
            Masuk
        </button>

        {{-- SOCIAL --}}
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600 mb-3">Login dengan sosial media</p>
            <div class="flex justify-center gap-4">
                <button class="bg-white p-2 rounded-full shadow">f</button>
                <button class="bg-white p-2 rounded-full shadow">G</button>
                <button class="bg-white p-2 rounded-full shadow"></button>
            </div>
        </div>

    </form>

</x-guest-layout>
