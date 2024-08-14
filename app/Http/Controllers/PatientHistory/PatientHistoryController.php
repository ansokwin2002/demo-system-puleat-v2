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

        $patientHistory = new PatientHistory();
        $patientHistory->patient_id = $validated['patient_id'];
        $patientHistory->patient_payment = $validated['patient_payment'];
        $patientHistory->save();

        toastr()->success('Patient history saved successfully !');
        return redirect()->route('patient_service_history');
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
