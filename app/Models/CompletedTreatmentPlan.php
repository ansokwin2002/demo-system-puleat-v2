<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedTreatmentPlan extends Model
{
    use HasFactory;
    protected $table = 'completed_treatment_plan';

    protected $fillable = [
        'json_data',
    ];

    protected $casts = [
        'json_data' => 'array', 
    ];
}
