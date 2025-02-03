<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::where('status', 1)->get();
        return view('dashboard.asset_manage.show_catogery', compact('categories'));
    }
    public function store(Request $request)
    { // Validate the request
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Save the category
        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Category added successfully!',
            'category' => $category,
        ]);
    }

   // Show the category data to be updated
   public function edit($id)
   {
       $category = Category::findOrFail($id); // Get category by ID
       Log::info('Category data fetched:', ['category' => $category]);

       return response()->json($category); // Return the category data as JSON
   }

   // Handle the update request
   public function update(Request $request, $id)
{
    // Validate input data
    $request->validate([
        'category_name' => 'required|string|max:255',
    ]);

    // Find the category by ID
    $category = Category::find($id);

    if (!$category) {
        return response()->json(['error' => 'Category not found'], 404);
    }

    // Update the category
    $category->category_name = $request->category_name;
    $category->save();

    // Return response
    return response()->json(['success' => 'Category updated successfully']);
}

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['status' => 0]);

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }


}
