<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::where('status', 1)->get();
        return view('dashboard.asset_manage.show_catogery', compact('categories'));
    }
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Save category to database
        Category::create([
            'category_name' => $request->input('category_name'),
        ]);

        // Redirect or respond
        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.asset_manage.update.update_catogery', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update(['category_name' => $request->input('category_name')]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['status' => 0]);

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }


}
