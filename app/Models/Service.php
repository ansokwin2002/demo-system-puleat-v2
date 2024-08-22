<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Use guarded to prevent mass assignment of sensitive fields
    protected $guarded = [];
    
    // Alternatively, use fillable to explicitly define assignable fields
    // protected $fillable = ['name', 'unit', 'price'];
}
