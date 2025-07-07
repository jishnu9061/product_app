<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto py-10 px-4 bg-white shadow rounded mt-10">
        <h2 class="text-2xl font-semibold mb-6 text-center">Create New Product</h2>

        <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block font-medium text-gray-700">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full mt-1 border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="price" class="block font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01"
                    class="w-full mt-1 border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror">
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="brand_id" class="block font-medium text-gray-700">Brand</label>
                <select name="brand_id" id="brand_id"
                    class="w-full mt-1 border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('brand_id') border-red-500 @enderror">
                    <option value="">Select a Brand</option>
                    @foreach ($brands as $id => $name)
                        <option value="{{ $id }}" {{ old('brand_id') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('brand_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded">
                    Create Product
                </button>
            </div>
        </form>
    </div>
</body>
</html>
