<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Product List</h2>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="overflow-x-auto">
                <table id="productList" class="min-w-full table-auto">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Product Name</th>
                            <th class="px-4 py-2">Brand</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $index => $product)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->brand->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $product->price }}</td>
                                <td class="px-4 py-2 text-center">
                                   <a href="{{ route('products.show', $product->id) }}" class="text-dark-600 hover:text-dark-800 mr-2">View</a>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                                    <form action="{{ route('products.delete', $product->id) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('products.create') }}"
                        class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">
                        + Create New Product
                    </a>

                    <a href="{{ route('products.export') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                        + Upload New Product
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#productList').DataTable({
                "pageLength": 10,
                "order": [
                    [0, "asc"]
                ],
                "columnDefs": [{
                    "orderable": false,
                    "targets": 4
                }]
            });
        });
    </script>
</body>

</html>
