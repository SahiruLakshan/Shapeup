<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetPlan extends Model
{
    use HasFactory;
    protected $table = 'budget';
    protected $fillable = ['start_date', 'end_date', 'department', 'job_title', 'no_of_employee', 'basic_salary', 'allowance'];
}
