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
    public function patientServiceHistory()
    {
        $patientHistories = PatientHistory::all(); 
        return view('backend.patient.patient_service_history', compact('patientHistories'));
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function savePatientHistory(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'patient_payment' => 'required|array',
        ]);

        // Generate a unique invoice ID
        do {
            $invoiceId = rand(1000, 9999);
            $exists = PatientHistory::where('invoice_id', $invoiceId)->exists();
        } while ($exists);

        $patientHistory = new PatientHistory();
        $patientHistory->patient_id = $validated['patient_id'];
        $patientHistory->patient_payment = $validated['patient_payment'];
        $patientHistory->invoice_id = $invoiceId; // Set the invoice ID
        $patientHistory->save();

        return response()->json(['invoice_id' => $invoiceId]);
    }

    public function showInvoice($invoiceId) {
        // Retrieve the patient history that matches the invoice ID
        $patientHistory = PatientHistory::where('invoice_id', $invoiceId)->firstOrFail();
        // Pass the patient history to the view
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
