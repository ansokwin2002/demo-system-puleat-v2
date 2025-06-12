<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempServiceData extends Model
{
    use HasFactory;
    protected $table = 'temp_service_data';

    protected $fillable = [
        'temp_service_json_data', 
    ];
    protected $casts = [
        'temp_service_json_data' => 'array',
    ];
}
