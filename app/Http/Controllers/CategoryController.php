<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Category;


class CategoryController extends Controller
{
    public function addCategory(){
        $categories = Category::all();
        return view('admin.category.add_category', compact('categories'));
    }

    public function postAddCategory(Request $request){
        // Validate the request
        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug', // unique slug
            'parent_id' => 'nullable|exists:categories,id',
        ], [
            'slug.unique' => 'This slug already exists. Please choose another.', // custom error message
        ]);

        // Create the category
        Category::create([
            'category_name' => $request->category_name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('category_message', 'Category added successfully!');

    }
    public function viewCategory(){
        $categories = Category::with('parent')->get();
    return view('admin.category.view_category', compact('categories'));
    }

    public function updateCategory($id){
        $category = Category::findOrFail($id);
        // exclude itself from parent dropdown
        $categories = Category::where('id', '!=', $id)->get();
        return view('admin.category.update_category', compact('category', 'categories'));
    }
    public function postUpdateCategory(Request $request, $id){
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($category->id),
            ],
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                Rule::notIn([$category->id]),
            ],
        ], [
            'slug.unique' => 'This slug already exists. Please choose another one.',
            'parent_id.not_in' => 'A category cannot be its own parent.',
        ]);

        $category->update([
            'category_name' => $request->category_name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id ?: null,
        ]);

        return redirect()->back()->with('category_message', 'Category updated successfully!');

    }
    public function deleteCategory($id){
        $category = Category::findOrFail($id);

        $category->delete();
        return redirect()->back()->with('category_message', 'Category is deleted!');
    }
}
