<?php


namespace App\Http\Controllers;
use App\Models\SubCategory;
use App\Models\Asset;
use App\Models\Category;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    // Show asset creation form
    public function create()
    {

        // Fetch all categories
        $categories = Category::where('status', 1)->get();
        return view('dashboard.asset_manage.add_new_assert', compact('categories'));

    }
    public function getCategories()
    {
        try {
            $categories = Category::where('status', 1)
                ->orderBy('category_name', 'ASC')
                ->get(['id', 'category_name']); // Fetch only required fields

            return response()->json($categories, 200);
        } catch (\Exception $e) {
            \Log::error("Error fetching categories: " . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch categories'], 500);
        }
    }

    public function getSubcategories(Request $request)
    {
        $categoryId = $request->category_id;

        // Validate category_id
        if (!$categoryId) {
            return response()->json(['error' => 'Category ID is required'], 400);
        }

        try {
            // Fetch active subcategories
            $subcategories = Subcategory::where('category_id', $categoryId)
                ->where('status', 1)
                ->orderBy('sub_category', 'ASC')
                ->get(['id', 'sub_category']); // Return only required fields

            if ($subcategories->isEmpty()) {
                return response()->json(['message' => 'No subcategories found'], 204);
            }

            return response()->json($subcategories, 200);
        } catch (\Exception $e) {
            \Log::error("Error fetching subcategories: " . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch subcategories'], 500);
        }
    }



    // Store new asset
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:assets',
            'code' => 'required|string|max:255|unique:assets',
            'asset_value' => 'required|numeric',
        ]);

        Asset::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'brand' => $request->brand,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'code' => $request->code,
            'asset_value' => $request->asset_value,
        ]);

        return redirect()->back()->with('success', 'Asset added successfully!');
    }

    // View all assets
    public function index()
    {
        $assets = Asset::with('category', 'subCategory')
            ->where('status', 1)
            ->get();
        return view('dashboard.asset_manage.show_assets', compact('assets'));
    }

    public function edit($id)
{
    $asset = Asset::findOrFail($id);
    $categories = Category::where('status', 1)->get();
    $subCategories = SubCategory::where('status', 1)->get();
    
    // Return the data as JSON to be used by AJAX
    return response()->json([
        'asset' => $asset,
        'categories' => $categories,
        'subCategories' => $subCategories
    ]);
}



    // Update asset
    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|exists:categories,id',
            'sub_category' => 'required|exists:sub_categories,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:assets,serial_number,' . $id,
            'code' => 'required|string|max:255|unique:assets,code,' . $id,
            'asset_value' => 'required|numeric',
        ]);

        $asset = Asset::findOrFail($id);
        $asset->update([
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'brand' => $request->brand,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'code' => $request->code,
            'asset_value' => $request->asset_value,
        ]);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully!');
    }

    // Delete asset (soft delete by updating status)
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->update(['status' => 0]);

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully!');
    }
}
