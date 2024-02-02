<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>

    <h1>Edit Product</h1>

    <form action="{{route('products.update', $product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
    <label for="image">Product Image:</label>
    <img src="{{ asset('storage/public/' . $product->image) }}" alt="" class="mb-2" style="max-width: 300px; max-height: 200px;">
    <input type="file" id="image" name="image">
    @error('image')
        <div>{{ $message }}</div>
    @enderror
</div>
  <p>{{$product->image}}</p>

        <div>
            <label>Product Categories:</label>
            <div>
                @foreach($allCategories as $category)
                    <div>
                        <input type="checkbox" name="categories[]" id="{{ $category->id }}" value="{{ $category->id }}"
                            {{ in_array($category->id, $productCategories) ? 'checked' : '' }}>
                        <label for="{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('categories')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Save Changes</button>
    </form>

</body>
</html>
