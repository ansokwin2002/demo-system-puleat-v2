<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedTreatmentData extends Model
{
    protected $table = 'completed_treatment_data';

    protected $fillable = ['json_data'];

    protected $casts = [
        'json_data' => 'array',
    ];
}