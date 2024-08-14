<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    use HasFactory;
    
    protected $fillable = ['patient_id', 'patient_payment'];

    protected $casts = [
        'patient_payment' => 'array',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
