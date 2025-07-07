<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - {{ $product->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-lg">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-2">
            {{ $product->name }}
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <span class="text-gray-600 font-semibold">Price:</span>
                    <span class="text-lg text-green-600 font-bold">${{ number_format($product->price, 2) }}</span>
                </div>
                <div>
                    <span class="text-gray-600 font-semibold">Category:</span>
                    <span class="text-gray-800">{{ $product->category->name ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="text-gray-600 font-semibold">Description:</span>
                    <p class="text-gray-700">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                        only five centuries, but also the leap into electronic typesetting, remaining essentially
                        unchanged.</p>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <img src="{{ asset('storage/car_00010.jpg') }}" alt="{{ $product->name }}"
                    class="w-full h-64 object-cover rounded-lg border shadow">

            </div>

        </div>

        <div class="mt-8 flex flex-col md:flex-row gap-4">
            <a href="{{ route('products.index') }}"
                class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-6 rounded shadow transition duration-300">
                ← Back to Product List
            </a>
            <button
                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded shadow transition duration-300"
                id="pay-button">
                Buy Now
            </button>
        </div>

        <form id="razorpay-form" action="{{ route('products.buy.payment') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        </form>
    </div>

</body>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function (e) {
            e.preventDefault();

            var options = {
                "key": "{{ config('razorpay.key') }}",
                "amount": {{ (int)($product->price * 100) }},
                "currency": "INR",
                "name": "Payment",
                "description": "{{ $product->name }} (ID: {{ $product->id }})",
                "image": "/your_logo.png",
                "prefill": {
                    "name": "user",
                    "email": "user@gmail.com"
                },
                "theme": {
                    "color": "#ff7529"
                },
                "handler": function (response) {
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay-form').submit();
                },
                "modal": {
                    "ondismiss": function () {
                        alert('Payment dismissed');
                    }
                }
            };

            var rzp = new Razorpay(options);
            rzp.open();
        });
    </script>

</html>
