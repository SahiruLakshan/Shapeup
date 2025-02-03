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
        $categories = Category::with([
            'subcategories' => function ($query) {
                $query->where('status', 1); // Only fetch active subcategories
            }
        ])->get();
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
    
        // Return data as JSON for AJAX request
        return response()->json([
            'success' => true,
            'subcategory' => $subcategory,
            'categories' => $categories
        ]);
    }
    


    // public function update(Request $request, $id)
    // {
    //     // Validate the incoming request data
    //     $request->validate([
    //         'category_id' => 'required|exists:categories,id',
    //         'sub_category' => 'required|string|max:255',
    //     ]);

    //     try {
    //         // Find the subcategory by ID
    //         $subcategory = SubCategory::findOrFail($id);

    //         // Update subcategory data
    //         $subcategory->update([
    //             'category_id' => $request->category_id,
    //             'sub_category' => $request->sub_category,
    //         ]);

    //         // Redirect back with success message
    //         return redirect()->route('subcategories.show')->with('success', 'Sub Category updated successfully!');
    //     } catch (\Exception $e) {
    //         // Handle any errors and redirect back with error message
    //         return redirect()->back()->withErrors(['error' => 'Something went wrong. Please try again.']);
    //     }
    // }
    public function update(Request $request, $id)
{
    try {
        $subcategory = SubCategory::findOrFail($id);
        
        // Validate the incoming request data
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category' => 'required|string|max:255',
        ]);

        // Update the subcategory
        $subcategory->update($validated);

        // Return a response as JSON
        return response()->json([
            'success' => true,
            'message' => 'Subcategory updated successfully!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong. Please try again.',
        ], 500);
    }
}

    


    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update(['status' => 0]);

        // Redirect back with a success message
        return redirect()->route('subcategories.show')->with('success', 'Subcategory status updated successfully!');
    }

}
