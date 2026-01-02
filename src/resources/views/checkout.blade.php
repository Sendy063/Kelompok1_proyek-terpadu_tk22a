<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - Acimart</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans antialiased">
    <header class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="/" class="text-2xl font-bold text-red-600">Acimart</a>
            <nav class="space-x-6">
                <a href="/" class="hover:text-red-600">Home</a>
                <a href="/cart" class="hover:text-red-600">Keranjang</a>
            </nav>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-red-700 mb-8">Checkout</h1>
        
        @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Valiasi Gagal!</strong>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    <!-- Form Checkout (KIRI) -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-lg font-bold mb-4">Detail Pengiriman & Pembayaran</h3>

        <form id="checkout-form" action="{{ route('cart.processCheckout') }}" method="POST" class="space-y-4">
            @csrf
            @auth
            <div>
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="customer" value="{{ Auth::user()->name }}" readonly
                    class="w-full p-3 border rounded bg-gray-100 dark:bg-gray-700">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" readonly
                    class="w-full p-3 border rounded bg-gray-100 dark:bg-gray-700">
            </div>
            @else
            <div>
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="customer" required
                    class="w-full p-3 border rounded" placeholder="Masukkan nama lengkap">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" required
                    class="w-full p-3 border rounded" placeholder="Masukkan email">
            </div>
            @endauth

            <div>
                <label class="block text-sm font-medium mb-1">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" required
                    class="w-full p-3 border rounded bg-gray-50 dark:bg-gray-700">@auth{{ Auth::user()->address }}@endauth</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
                <input type="text" name="telepon" required
                    value="@auth{{ Auth::user()->phone }}@endauth"
                    class="w-full p-3 border rounded bg-gray-50 dark:bg-gray-700">
            </div>

            <input type="hidden" name="payment_method" value="midtrans">

            <p class="text-lg font-bold">
                Total: <span class="text-red-600">Rp {{ number_format($total) }}</span>
            </p>

            <button type="submit"
                class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg">
                Bayar Sekarang
            </button>
        </form>
    </div>

    <!-- Ringkasan Pesanan (KANAN) -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow h-fit sticky top-6">
        <h3 class="text-lg font-bold mb-4">Ringkasan Pesanan</h3>

        @foreach($cartItems as $item)
        <div class="flex justify-between mb-2 text-sm">
            <span>{{ $item['produk']->nama }} ({{ $item['quantity'] }}x)</span>
            <span>Rp {{ number_format($item['subtotal']) }}</span>
        </div>
        @endforeach

        <hr class="my-4">

        <div class="flex justify-between font-bold text-lg">
            <span>Total</span>
            <span class="text-red-600">Rp {{ number_format($total) }}</span>
        </div>
    </div>

</div>

    <!-- Midtrans Snap.js -->
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        const checkoutForm = document.getElementById('checkout-form');
        const payButton = checkoutForm.querySelector('button[type="submit"]');

        checkoutForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            payButton.disabled = true;
            payButton.innerText = 'Memproses...';

            // Collect form data
            const formData = new FormData(checkoutForm);
            const data = Object.fromEntries(formData.entries());

            try {
                // Send AJAX request
                const response = await fetch("{{ route('cart.processCheckout') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.error || 'Terjadi kesalahan');
                }

                // Call Snap Popup
                // Call Snap Popup
                window.snap.pay(result.snap_token, {
                    onSuccess: async function(midtransResult){
                        // Localhost Specific: Send "Payment Complete" signal to our server
                        try {
                            const params = {
                                order_id: result.order_id,
                                result_data: midtransResult
                            };
                            console.log("Sending completion for:", params); // Debug log

                            const completeResponse = await fetch("{{ route('payment.complete') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify(params)
                            });

                            if (!completeResponse.ok) {
                                const errText = await completeResponse.text();
                                alert("Gagal update status (Server Error): " + errText);
                                console.error("Server Error:", errText);
                                return; // Stop redirect so user can see error
                            }

                            const completeResult = await completeResponse.json();
                            if(completeResult.status === 'success') {
                                alert("Pembayaran selesai! Status Diperbarui.");
                                window.location.href = "{{ route('orders.index') }}";
                            } else {
                                alert("Gagal update status: " + completeResult.message);
                            }

                        } catch (err) {
                            alert("Gagal update status (Network/JS Error): " + err.message);
                            console.error("Network Error:", err);
                        }
                    },
                    onPending: function(result){
                        alert("Menunggu pembayaran!");
                        window.location.href = "{{ route('orders.index') }}";
                    },
                    onError: function(result){
                        alert("Pembayaran gagal!");
                        console.log(result);
                        payButton.disabled = false;
                        payButton.innerText = 'Bayar Sekarang';
                    },
                    onClose: function(){
                        alert('Anda menutup popup pembayaran tanpa menyelesaikan transaksi');
                        payButton.disabled = false;
                        payButton.innerText = 'Bayar Sekarang';
                    }
                });

            } catch (error) {
                alert(error.message);
                payButton.disabled = false;
                payButton.innerText = 'Bayar Sekarang';
            }
        });
    </script>
</body>

</html>