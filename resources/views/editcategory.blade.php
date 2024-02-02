
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
       
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <div class="container mx-auto">
        <h1 class="text-3xl font-semibold mb-4">Edit Category</h1>

        
        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('categories.update', $category->id) }}" method="post" class="category-form">
            @csrf
            @method('PUT')

            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" id="category_name" value="{{ old('category_name', $category->name) }}">

            <label for="parent_category">Parent Category:</label>
            <select name="parent_category" id="parent_category">
                <option value="">Select Parent Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <button type="submit">Save Changes</button>
        </form>
    </div>

</body>
</html>
