<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'serial_number',
        'company',
        'location',
        'branch',
        'employee_id',
        'value',
        'date',
        'description',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'serial_number', 'serial_number');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}