<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    protected $fillable = ['company_name', 'company_email'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
