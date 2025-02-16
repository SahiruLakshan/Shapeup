<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_Titles extends Model
{
    use HasFactory;
    protected $table = 'job_titles';
    protected $fillable = ['title', 'occupation_group_id'];
}
