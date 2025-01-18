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
        return view('dashboard.asset_manage.add_sub_catogery', compact('categories'));
    }

    public function show()
    {
        $categories = Category::with('subcategories')->get(); // Assuming you have a relationship defined
        return view('dashboard.asset_manage.show_sub_catogery', compact('categories'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category' => 'required|string|max:255',
        ]);

        SubCategory::create($request->all());

        return redirect()->back()->with('success', 'Sub Category added successfully.');
    }


    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id); // Fetch by ID
        $categories = Category::where('status', 1)->get();
        return view('dashboard.asset_manage.update.update_subcatogery', compact('subcategory', 'categories'));
    }



    // public function update(Request $request, SubCategory $subcategory)
    // {

    //     Log::debug('Incoming update request data:', $request->all());

    //     $validatedData = $request->validate([
    //         'category_id' => 'nullable|exists:categories,id', // Make it nullable to allow using the current value
    //         'sub_category' => 'required|string|max:255',
    //     ]);
    //     $categoryId = $request->input('category_id') ?? $subcategory->category_id;
    //     $subcategory->update([
    //         'category_id' => $categoryId,
    //         'sub_category' => $validatedData['sub_category'],
    //     ]);

    //     return redirect()->route('categories.show')->with('success', 'Subcategory updated successfully.');
    // }
   

    public function update(Request $request, SubCategory $subcategory)
    {
        // Log the incoming request data
        Log::debug('Incoming update request data:', $request->all());
    
        $validatedData = $request->validate([
            'category_id' => 'nullable|exists:categories,id', // Make it nullable to allow using the current value
            'sub_category' => 'required|string|max:255',
        ]);
    
        // Log validated data
        Log::debug('Validated data:', $validatedData);
    
        // Determine category_id to be updated
        $categoryId = $request->input('category_id') ?? $subcategory->category_id;
        Log::debug('Final category_id to update:', ['category_id' => $categoryId]);
    
        // Update the subcategory
        $subcategory->update([
            'category_id' => $categoryId,
            'sub_category' => $validatedData['sub_category'],
        ]);
    
        // Log after update
        Log::info('Subcategory updated successfully.', [
            'id' => $subcategory->id,
            'category_id' => $subcategory->category_id,
            'sub_category' => $subcategory->sub_category,
        ]);
    
        return redirect()->route('categories.show')->with('success', 'Subcategory updated successfully.');
    }
    

    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update(['status' => 0]);

        // Redirect back with a success message
        return redirect()->route('subcategories.index')->with('success', 'Subcategory status updated successfully!');
    }

}
