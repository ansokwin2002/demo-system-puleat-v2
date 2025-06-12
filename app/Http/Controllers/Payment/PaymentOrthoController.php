<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PaymentOrthoController extends Controller
{
    public function index(Request $request) 
    {
        $selectedPatientId = $request->input('selected_patient');
        $patients = Patient::all();
        $pageTitle = 'Ortho Payment | Laor-Prornit-Clinic-Dental';
        
        return view('backend.payment.ortho.ortho_payment', compact('patients', 'selectedPatientId', 'pageTitle'));
    }

}
