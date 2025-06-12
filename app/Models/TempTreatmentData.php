<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempTreatmentData extends Model
{
    protected $table = 'temp_treatment_data';

    protected $fillable = ['json_data'];

    protected $casts = [
        'json_data' => 'array',
    ];
}