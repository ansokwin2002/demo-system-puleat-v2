<?php

namespace App\Http\Controllers\PatientHistory;

use App\Http\Controllers\Controller;
use App\Models\PatientHistory;
use Illuminate\Http\Request;

class PatientHistoryController extends Controller
{
    
    public function patientServiceHistory()
    {
        $patientHistories = PatientHistory::with(['doctor', 'cashier', 'patient'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('backend.patient.patient_service_history', compact('patientHistories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function savePatientHistory(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|integer|exists:doctors,id',
            'cashier_id' => 'required|exists:cashiers,id',
            'patient_payment' => 'required|array',
        ]);

        do {
            $invoiceId = rand(1000, 9999);
            $exists = PatientHistory::where('invoice_id', $invoiceId)->exists();
        } while ($exists);

        $patientHistory = new PatientHistory();
        $patientHistory->patient_id = $validated['patient_id'];
        $patientHistory->doctor_id = $validated['doctor_id'];
        $patientHistory->cashier_id = $validated['cashier_id'];
        
        // Directly assign the array; Laravel will handle JSON encoding
        $patientHistory->patient_payment = $validated['patient_payment'];
        
        $patientHistory->invoice_id = $invoiceId;
        $patientHistory->save();

        return response()->json(['invoice_id' => $invoiceId]);
    }


    public function showInvoice($invoiceId)
    {
        $patientHistory = PatientHistory::where('invoice_id', $invoiceId)
                                        ->with(['patient', 'doctor', 'cashier'])
                                        ->firstOrFail();
        return view('backend.invoice.index', ['data' => $patientHistory]);
    }
    

    /**
     * Display the specified resource.
     */
    public function getPatientDetails($id) {
        $patientHistory = PatientHistory::findOrFail($id);
        $paymentData = $patientHistory->patient_payment; // Assume it's an array

        return response()->json([
            'patient_payment' => $paymentData
        ]);
    }

    public function getPatientNoted(Request $request)
    {
        $patient = PatientHistory::find($request->id);
        if ($patient) {
            $patientPayment = $patient->patient_payment ?? [];
            $patientNoted = $patientPayment['patient_noted'] ?? 'No notes found.';
            return response()->json(['patient_noted' => $patientNoted]);
        } else {
            return response()->json(['patient_noted' => 'No notes found.']);
        }
    }
}
