<x-guest-layout>
  

    <!-- Banner Header -->
    <div class="login-banner">
        <h2 class="text-lg font-bold uppercase">Selamat Datang Kembali</h2>
    </div>

    <!-- Konten login tetap seperti yang kamu punya -->
    <p class="text-center text-sm text-gray-700 mb-6 mt-7">Login ke akun Acimart kamu</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username -->
        <div class="mb-4 relative">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <!-- ikon -->
            </span>
            <input id="email" name="email" type="email" required autofocus
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500"
                placeholder="Username" value="{{ old('email') }}">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <!-- ikon -->
            </span>
            <input id="password" name="password" type="password" required
                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500"
                placeholder="Password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Forgot Password & Sign Up -->
        <div class="flex justify-between text-sm text-gray-600 mb-4">
            <a href="{{ route('password.request') }}" class="hover:underline">Lupa Password?</a>
            <span>Belum punya akun? <a href="{{ route('register') }}" class="text-red-600 font-semibold hover:underline">Daftar</a></span>
        </div>

        <!-- Login Button -->
        <button type="submit"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-lg shadow">
            LOGIN
        </button>

        <!-- Social Login -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600 mb-2">Login dengan sosial media</p>
            <div class="flex justify-center gap-4">
                <!-- Facebook -->
<button class="bg-white p-2 rounded-full shadow hover:bg-gray-100">
  <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
    <path d="M22 12a10 10 0 10-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.2l-.4 3h-1.8v7A10 10 0 0022 12z"/>
  </svg>
</button>
                <!-- Google (via SVG path) -->
<button class="bg-white p-2 rounded-full shadow hover:bg-gray-100">
  <svg class="w-6 h-6" viewBox="0 0 24 24">
    <path fill="#EA4335" d="M12 11h8.5c.3 1 .5 2 .5 3s-.2 2-.5 3h-8.5v-6z"/>
    <path fill="#34A853" d="M12 17v6c2.5 0 4.6-.8 6.3-2.2l-6.3-3.8z"/>
    <path fill="#FBBC05" d="M12 11V5c2.5 0 4.6.8 6.3 2.2L12 11z"/>
    <path fill="#4285F4" d="M12 11L5.7 6.2C7.4 4.8 9.5 4 12 4v7z"/>
  </svg>
</button>

<!-- Apple (via SVG path) -->
<button class="bg-white p-2 rounded-full shadow hover:bg-gray-100">
  <svg class="w-6 h-6" viewBox="0 0 24 24" fill="black">
    <path d="M16.5 13.5c-.1-2.1 1.7-3.1 1.8-3.2-1-1.5-2.5-1.7-3-1.7-1.3-.1-2.5.8-3.1.8-.6 0-1.6-.8-2.6-.8-1.3 0-2.5.8-3.2 2.1-1.4 2.4-.4 6 1 8 .7 1 1.5 2.1 2.6 2.1 1 0 1.4-.7 2.6-.7s1.5.7 2.6.7c1.1 0 1.8-1 2.5-2 .8-1.2 1.1-2.4 1.1-2.5-.1 0-2.1-.8-2.1-3.8z"/>
    <path d="M14.5 4.5c.6-.7 1-1.7.9-2.7-.9.1-1.9.6-2.5 1.3-.6.7-1 1.6-.9 2.6.9.1 1.9-.5 2.5-1.2z"/>
  </svg>
</button>
            </div>
        </div>
    </form>
</x-guest-layout>