<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    //Load Master Page
    public function master()
    {
        return view('dashboard.budget.budgetmaster');
    }

    //Master Page Process
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Budget::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json(['message' => 'Data saved successfully!'], 200);
    }

    //Load Budget Page
    public function sub()
    {
        return view('dashboard.budget.budgetsub');
    }
}
