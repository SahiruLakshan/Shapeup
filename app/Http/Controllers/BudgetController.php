<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetPlan;
use App\Models\Department;
use App\Models\Job_Titles;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    
    //dashboard page
    public function index()
    {
        return view('dashboard.dashboard');
    }

    //Master Page Process
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        try {
            Budget::create([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            return redirect()->back()->with('success', 'Date Saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('An error occurred: ' . $e->getMessage());
        }
    }

    //Budget Plan Page Process
    public function budgetplansubmit(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'department' => 'required|exists:departments,id',
            'job_title' => 'required|exists:job_titles,id',
            'no_of_employee' => 'required|integer|min:0',
            'basic_salary' => 'required|numeric|min:0',
            'allowance' => 'required|numeric|min:0',
        ]);

        try {
            BudgetPlan::create([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'department' => $request->department,
                'job_title' => $request->job_title,
                'no_of_employee' => $request->no_of_employee,
                'basic_salary' => $request->basic_salary,
                'allowance' => $request->allowance,
            ]);

            return redirect()->back()->with('success', 'Date Saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('An error occurred: ' . $e->getMessage());
        }
    }

    public function budgets(){
        $dates = Budget::select('start_date', 'end_date')->orderBy('start_date', 'asc')->get();
        $groupedDates = $dates->groupBy('start_date');
        $departments = Department::all();
        $titles = Job_Titles::all();
        return view('dashboard.budget.budgetview',compact('groupedDates', 'departments', 'titles'));
    }
}
