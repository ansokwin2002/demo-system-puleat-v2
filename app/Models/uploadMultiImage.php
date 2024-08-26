<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uploadMultiImage extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'filename', 'path'];

    public function patientHistory()
    {
        return $this->belongsTo(PatientHistory::class, 'invoice_id');
    }
}
