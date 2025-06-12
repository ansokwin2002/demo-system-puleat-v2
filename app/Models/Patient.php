<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function histories()
    {
        return $this->hasMany(PatientHistory::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function doctorNotedBooks()
    {
        return $this->hasMany(DoctorNotedBook::class);
    }

    public function doctorNotebooks()
    {
        return $this->hasMany(DoctorNotedBook::class, 'patient_id');
    }

}
