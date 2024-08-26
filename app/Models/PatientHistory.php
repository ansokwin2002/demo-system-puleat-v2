<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'patient_payment', 'invoice_id', 'doctor_id', 'cashier_id'];

    protected $casts = [
        'patient_payment' => 'array',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function cashier()
    {
        return $this->belongsTo(Cashier::class);
    }
    public function images()
    {
        return $this->hasMany(uploadMultiImage::class, 'invoice_id');
    }
}
