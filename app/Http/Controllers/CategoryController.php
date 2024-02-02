<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'parent_category' => 'nullable|exists:categories,id',
        ]);

        Category::create([
            'name' => $request->input('category_name'),
            'parent_id' => $request->input('parent_category'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }


    public function destroy(string $id)
    {
       
            $category = Category::findOrFail($id);
            Category::where('parent_id', $category->id)->update(['parent_id' => null]);

            // Delete the category
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }


    public function edit(string $id)
    {
        
        $category = Category::findorFail($id);
        $categories = Category::all();
        return view('editcategory', compact('category', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'parent_category' => 'nullable|exists:categories,id',
        ]);

        $category = Category::findorFail($id);
        $category->update([
            'name' => $request->input('category_name'),
            'parent_id' => $request->input('parent_category'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }
}
