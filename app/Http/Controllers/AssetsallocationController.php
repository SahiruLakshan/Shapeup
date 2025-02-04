<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Employee;
use App\Models\SubCategory;
use App\Models\AssetAllocation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Add this for validation rules

class AssetsallocationController extends Controller
{



    public function index()
    {
        // Fetch asset allocations with status = 1
        $assetAllocations = AssetAllocation::where('status', 1)->get();

        return view('dashboard.asset_manage.show_assets_allocation', compact('assetAllocations'));
    }
    public function create()
    {
        // Get only active categories (status = 1)
        $categories = Category::where('status', 1)->get();
        $employees = Employee::all();
        return view('dashboard.asset_manage.allocate_asserts', compact('categories', 'employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Select_category' => 'required',
            'sub_category' => 'required',
            'serial_number' => 'required',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'employee_id' => 'required|exists:employees,id',
            'value' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        AssetAllocation::create([
            'category_id' => $validated['Select_category'],
            'sub_category_id' => $validated['sub_category'],
            'serial_number' => $validated['serial_number'],
            'company' => $validated['company'],
            'location' => $validated['location'],
            'branch' => $validated['branch'],
            'employee_id' => $validated['employee_id'],
            'value' => $validated['value'],
            'date' => $validated['date'],
            'description' => $validated['description']
        ]);

        return redirect()->back()->with('success', 'Asset allocated successfully!');
    }
    // Fetch all categories
    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Fetch all employees
    public function getEmployees()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }
    // AJAX Methods
    public function getSubCategories(Category $category)
    {
        // Get active subcategories for the category
        return response()->json(
            $category->subcategories()->where('status', 1)->get()
        );
    }

    public function getAssets(Category $category, SubCategory $subcategory)
    {
        // Get active assets for the category and subcategory
        $assets = Asset::where('category_id', $category->id)
            ->where('sub_category_id', $subcategory->id)
            ->where('status', 1)
            ->get();
        return response()->json($assets);
    }

    public function getAssetValue($serialNumber)
    {

        $asset = Asset::where('serial_number', $serialNumber)->first();

        if ($asset) {
            return response()->json(['value' => $asset->asset_value]);
        } else {
            return response()->json(['error' => 'Asset not found'], 404);
        }
    }

    public function edit($id)
    {
        // Fetch the asset allocation
        $assetAllocation = AssetAllocation::findOrFail($id);

        // Fetch categories, subcategories, assets, and employees
        $categories = Category::where('status', 1)->get();
        $subcategories = SubCategory::where('category_id', $assetAllocation->category_id)->where('status', 1)->get();
        $assets = Asset::where('category_id', $assetAllocation->category_id)
            ->where('sub_category_id', $assetAllocation->sub_category_id)
            ->where('status', 1)
            ->get();
        $employees = Employee::all();

        return view('dashboard.asset_manage.update.update_assets_allocation', compact('assetAllocation', 'categories', 'subcategories', 'assets', 'employees'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'Select_category' => 'required|exists:categories,id',
            'sub_category' => 'required|exists:sub_categories,id',
            'serial_number' => 'required|exists:assets,serial_number',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'employee_id' => 'required|exists:employees,id',
            'value' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        // Find the asset allocation
        $assetAllocation = AssetAllocation::findOrFail($id);

        // Update the asset allocation
        $assetAllocation->update([
            'category_id' => $validated['Select_category'],
            'sub_category_id' => $validated['sub_category'],
            'serial_number' => $validated['serial_number'],
            'company' => $validated['company'],
            'location' => $validated['location'],
            'branch' => $validated['branch'],
            'employee_id' => $validated['employee_id'],
            'value' => $validated['value'],
            'date' => $validated['date'],
            'description' => $validated['description']
        ]);

        return redirect()->route('asset-allocations.index')->with('success', 'Asset allocation updated successfully!');
    }


    // public function destroy( $id)
    // {
    //     $assetAllocation = AssetAllocation::findOrFail($id);
    //     $assetAllocation->update(['status' => 0]);
    //     return redirect()->back()->with('success', 'Allocation deleted!');
    // }
    public function destroy($id)
    {
        \Log::info('Delete request data:', ['request' => request()->all()]);

        $assetAllocation = AssetAllocation::findOrFail($id);
        $assetAllocation->update(['status' => 0]);

        return redirect()->back()->with('success', 'Allocation deleted!');
    }
}