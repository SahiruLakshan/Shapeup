<?php

namespace App\Http\Controllers;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        return response()->json([
            'categories' => $categories,
        ]);
    }

    public function show()
    {
        $categories = Category::where('status', 1) // Only active categories
        ->with([
            'subcategories' => function ($query) {
                $query->where('status', 1); // Only active subcategories
            }
        ])
        ->get();
        return view('dashboard.asset_manage.show_sub_catogery', compact('categories'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category' => 'required|string|max:255',
        ]);

        // Create the subcategory
        SubCategory::create($request->all());

        // Return a JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Sub Category added successfully.',
        ]);
    }

    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id); // Fetch subcategory by ID
        $categories = Category::where('status', 1)->get(); // Fetch active categories
    
        return response()->json([
            'success' => true,
            'subcategory' => $subcategory,
            'categories' => $categories,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category' => 'required|string|max:255',
        ]);
    
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update([
            'category_id' => $request->category_id,
            'sub_category' => $request->sub_category,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Subcategory updated successfully!',
        ]);
    }

    
    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update(['status' => 0]);

        // Redirect back with a success message
        return redirect()->route('subcategories.show')->with('success', 'Subcategory status updated successfully!');
    }

}
