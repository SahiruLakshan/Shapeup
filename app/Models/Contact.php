<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['insurance_id', 'name', 'email', 'mobile'];

    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
}
