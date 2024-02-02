<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product CRUD - Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
@if (Session::has('success'))
    <<div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-4" class="bg-green-500 text-white p-4 mb-4 rounded">
    {{ Session::get('success') }}
    <button @click="show = false" class="text-white">Close</button>
</div>
@endif

@if (Session::has('error'))
    <div class="bg-red-500 text-white p-4 mb-4 rounded">
        {{ Session::get('error') }}
    </div>
@endif

<div class="mb-8 p-8 bg-white rounded shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Add Product</h2>
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Product Name:</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">Product Image:</label>
            <input type="file" name="image" id="image" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Select Categories:</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($allCategories as $category)
                    <div class="flex items-center">
                        <input type="checkbox" name="categories[]" id="{{ $category->id }}" value="{{ $category->id }}" class="mr-2">
                        <label for="{{ $category->id }}" class="text-gray-800">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex items-center">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Product</button>
        </div>
    </form>
</div>


<div class="container mx-auto my-8">
    <h1 class="text-3xl font-semibold mb-4">Product List</h1>
</div>
    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-semibold mb-4">Product List</h1>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-green-800">
                <thead>
                    <tr class="bg-green-500 text-white">
                        <th class="py-2">#</th>
                        <th class="py-2">Image</th>
                        <th class="py-2">Product Name</th>
                        <th class="py-2">Categories</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                 @foreach($products as $product)
                    <tr class="transition duration-300 ease-in-out hover:bg-gray-200 transform hover:-translate-y-1">
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">
    <img src="{{ $product->image }}" alt="Product Image" class="rounded-full w-12 h-12">
</td>
                        <td class="border px-4 py-2">{{ $product->name }}</td>
                        <td class="border px-4 py-2">
                            @forelse($product->categories as $category)
                {{ $category->name }},
            @empty
                No categories
            @endforelse
                        </td>
                        <td class="border px-4 py-2">
                            
                            <a href="{{ route('products.edit', $product->id) }}"><button class="bg-blue-500 text-white px-4 py-2 rounded-full mr-2">Update</button>
                            </a>
                           <a href= '{{ route('products.destroy', $product->id) }}'> <button class="bg-red-500 text-white px-4 py-2 rounded-full">Delete</button> </a>
                        </td>
                    </tr>
                                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

</body>
</html>
