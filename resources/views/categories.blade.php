<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category CRUD - Category List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .category-card {
            transition: transform 0.3s ease-in-out;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .category-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
        }

        .category-action {
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }

        .category-action:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
@if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif


 <form action="{{ route('categories.store')}}" method="post" class="category-form">
            @csrf
            <div class="flex items-center mb-4">
                <label for="category_name" class="mr-2">Category Name:</label>
                <input type="text" name="category_name" id="category_name" class="border border-gray-400 p-2 rounded">
            </div>
            <div class="flex items-center mb-4">
                <label for="parent_category" class="mr-2">Parent Category:</label>
                <select name="parent_category" id="parent_category" class="border border-gray-400 p-2 rounded">
                    <option value="">Select Parent Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Category</button>
            </div>
        </form>


    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-semibold mb-4">Shop by Category</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($categories as $category)
                <div class="bg-white p-4 rounded-lg shadow-md category-card">
                    <h2 class="text-lg font-semibold mb-2">{{ $category->name }}</h2>
                    <div class="category-actions">
                        <a href="{{route('categories.edit', $category -> id )}}" class="category-action text-blue-500 hover:underline">Update</a>
                        <a href="{{route('categories.delete', $category -> id )}}" class="category-action text-red-500 hover:underline">Delete</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
