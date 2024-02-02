<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::with('categories')->get();
        $allCategories = Category::all();

        return view('home', compact('products', 'allCategories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'nullable|array',
        ]);


        try {
            $product = new Product;
            $product->name = $request->input('name');

            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;

            $product->save();
            if ($request->has('categories')) {
                $product->categories()->attach($request->input('categories'));
            }

            Session::flash('success', 'Product added successfully.');

        } catch (\Exception $e) {
            Session::flash('error', 'Error adding product.');
        }

        return redirect()->route('products.index');



    }


    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->categories()->detach();
            $product->delete();

            Session::flash('success', 'Product deleted successfully.');

        } catch (\Exception $e) {
            Session::flash('error', 'Error deleting product.');
        }

        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $allCategories = Category::all();
        $productCategories = $product->categories->pluck('id')->toArray();
        
        return view('edit', compact('product', 'allCategories', 'productCategories'));
    }


    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'categories' => 'array', 
                'categories.*' => 'exists:categories,id',
            ]);

     
            $product->update([
                'name' => $request->input('name'),
            ]);

            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $imagePath = $request->file('image')->store('products', 'public');
                $product->update(['image' => $imagePath]);
            }

            $product->categories()->sync($request->input('categories'));

            Session::flash('success', 'Product updated successfully');

        } catch (\Exception $e) {
            Session::flash('error', 'Error updating product');
        }

        return redirect()->route('products.index');
    }
}
