<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment - Acimart</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- @todo: check if production or sandbox -->
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans antialiased">
    <div class="max-w-3xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow text-center">
            <h1 class="text-2xl font-bold mb-4">Selesaikan Pembayaran</h1>
            <p class="mb-6">Order ID: #{{ $order->id }}</p>
            <p class="text-3xl font-bold text-red-600 mb-8">Rp {{ number_format($order->total) }}</p>
            
            <button id="pay-button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-8 rounded-lg">
                Bayar Sekarang
            </button>
        </div>
    </div>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    /* You may add your own implementation here */
                    alert("Pembayaran selesai!"); 
                    window.location.href = "{{ route('orders.index') }}";
                },
                onPending: function(result){
                    /* You may add your own implementation here */
                    alert("Menunggu pembayaran!"); 
                    window.location.href = "{{ route('orders.index') }}";
                },
                onError: function(result){
                    /* You may add your own implementation here */
                    alert("payment failed!"); console.log(result);
                },
                onClose: function(){
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
</body>
</html>
