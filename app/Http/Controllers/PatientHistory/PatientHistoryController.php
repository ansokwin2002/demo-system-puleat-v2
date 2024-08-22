<?php

namespace App\Http\Controllers\PatientHistory;

use App\Http\Controllers\Controller;
use App\Models\PatientHistory;
use Illuminate\Http\Request;

class PatientHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function patientServiceHistory()
    // {
    //     $patientHistories = PatientHistory::all(); 
    //     return view('backend.patient.patient_service_history', compact('patientHistories'));
    // }    
    public function patientServiceHistory()
    {
        // Retrieve patient histories with related doctor, cashier, and patient
        $patientHistories = PatientHistory::with(['doctor', 'cashier', 'patient'])->get();
        // dd($patientHistories);
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
