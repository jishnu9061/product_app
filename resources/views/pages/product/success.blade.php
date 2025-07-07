<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 rounded-2xl shadow-xl text-center max-w-md">
        <div class="text-green-600 text-5xl mb-4">
            ✅
        </div>
        <h1 class="text-2xl font-bold mb-2">Payment Successful!</h1>
        <p class="text-gray-700 mb-4">
            Thank you for your purchase. Your payment has been received and processed successfully.
        </p>
        <a href="{{ route('products.index') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition">
            Back to Products
        </a>
    </div>
</body>
</html>
