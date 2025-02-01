<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insurance; // Import the Insurance model
use Illuminate\Support\Facades\Validator;

class InsuranceController extends Controller
{
    /**
     * Display a listing of insurance companies.
     */
    public function index()
    {
        $insuranceCompanies = Insurance::all();
        return view('insurance.index', compact('insuranceCompanies'));
    }

    /**
     * Show the form for creating a new insurance company.
     */
    public function create()
    {
        return view('dashboard.insurance.insurance-company');
    }

    /**
     * Store a newly created insurance company in the database.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|unique:insurances,company_email',
            'contact_person.*' => 'required|string|max:255',
            'contact_person_email.*' => 'required|email',
            'contact_person_mobile.*' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create a new insurance company
        $insurance = Insurance::create([
            'company_name' => $request->company_name,
            'company_email' => $request->company_email
        ]);

        // Save contact persons
        foreach ($request->contact_person as $key => $person) {
            $insurance->contacts()->create([
                'name' => $person,
                'email' => $request->contact_person_email[$key],
                'mobile' => $request->contact_person_mobile[$key]
            ]);
        }

        return response()->json([
            'message' => 'Insurance company added successfully!'
        ], 201);
    }

    /**
     * Show the details of a specific insurance company.
     */
    public function show($id)
    {
        $insurance = Insurance::with('contacts')->findOrFail($id);
        return view('insurance.show', compact('insurance'));
    }

    /**
     * Show the form for editing an existing insurance company.
     */
    public function edit($id)
    {
        $insurance = Insurance::findOrFail($id);
        return view('insurance.edit', compact('insurance'));
    }

    /**
     * Update an existing insurance company in the database.
     */
    public function update(Request $request, $id)
    {
        $insurance = Insurance::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|unique:insurances,company_email,' . $id,
            'contact_person.*' => 'required|string|max:255',
            'contact_person_email.*' => 'required|email',
            'contact_person_mobile.*' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $insurance->update([
            'company_name' => $request->company_name,
            'company_email' => $request->company_email
        ]);

        // Update contacts (Simplified - remove old and add new)
        $insurance->contacts()->delete();
        foreach ($request->contact_person as $key => $person) {
            $insurance->contacts()->create([
                'name' => $person,
                'email' => $request->contact_person_email[$key],
                'mobile' => $request->contact_person_mobile[$key]
            ]);
        }

        return response()->json([
            'message' => 'Insurance company updated successfully!'
        ]);
    }

    /**
     * Delete an insurance company.
     */
    public function destroy($id)
    {
        $insurance = Insurance::findOrFail($id);
        $insurance->contacts()->delete();
        $insurance->delete();

        return response()->json([
            'message' => 'Insurance company deleted successfully!'
        ]);
    }
}
