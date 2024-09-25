<?php

namespace App\Http\Controllers\PatientHistory;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PatientHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PatientHistoryController extends Controller
{
    
    public function patientServiceHistory()
    {
        // [Page_title----------------------------------]
            $pageTitle = 'Patient-History | Laor-Prornit-Clinic-Dental';
        // [Page_title----------------------------------]

        $patientHistories = PatientHistory::with(['doctor', 'cashier', 'patient'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('backend.patient.patient_service_history', compact('patientHistories','pageTitle'));
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
            $invoiceId = rand(100000, 999999);
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

        toastr()->success('Added Patient\'s History Successfully !');
        return response()->json(['invoice_id' => $invoiceId]);
    }

    public function showInvoice($invoiceId)
    {
        // Fetch the patient history with related models
        $patientHistory = PatientHistory::where('invoice_id', $invoiceId)
                                        ->with(['patient', 'doctor', 'cashier'])
                                        ->firstOrFail();
        $patient = $patientHistory->patient;
        return view('backend.invoice.index', [
            'data' => $patientHistory,
            'patient_payment' => $patientHistory->patient_payment,
            'patient_info' => $patient
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function getPatientDetails($id) {
        $patientHistory = PatientHistory::findOrFail($id);
        $paymentData = $patientHistory->patient_payment; 

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

    public function editHistoryPatient($invoice_id)
    {
        $patientHistory = PatientHistory::where('invoice_id', $invoice_id)->first();
    
        if (!$patientHistory) {
            return redirect()->back()->withErrors(['error' => 'Patient history not found.']);
        }
       
        if (is_string($patientHistory->patient_payment)) {
            $patientPaymentData = json_decode($patientHistory->patient_payment, true);
        } else {
            $patientPaymentData = $patientHistory->patient_payment;
        }
    
        $doctors = Doctor::all();
        $patients = Patient::all();
        $cashiers = Cashier::all();
    
        return view('backend.patient.edit_patient_service_history', [
            'patientHistory' => $patientHistory,
            'patientPaymentData' => $patientPaymentData,
            'doctors' => $doctors,
            'patients' => $patients,
            'cashiers' => $cashiers,
            'invoice_id' => $invoice_id,
        ]);
    }
    
    public function updateHistoryPatient(Request $request, $invoice_id)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'cashier_id' => 'required|exists:cashiers,id',
            'patient_payment.date' => 'required|date',
            'patient_payment.services.*.service_name' => 'required|string',
            'patient_payment.services.*.service_unit' => 'required|numeric',
            'patient_payment.services.*.service_price' => 'required|numeric',
            'patient_payment.services.*.subtotal' => 'required|numeric',
            'patient_payment.grand_total' => 'required|numeric',
            'patient_payment.amount_paid' => 'required|numeric',
            'patient_payment.amount_unpaid' => 'required|numeric',
            'patient_payment.next_appointment_date' => 'nullable|date',
            'patient_payment.type_service' => 'required|string',
            'patient_payment.patient_noted' => 'nullable|string',
            'patient_payment.customer' => 'required|string', 
            'patient_payment.patientId' => 'required|string'
        ]);
    
        $patientHistory = PatientHistory::where('invoice_id', $invoice_id)->firstOrFail();
        $patientPaymentData = [
            'date' => $request->patient_payment['date'],
            'customer' => $request->patient_payment['customer'],
            'services' => $request->patient_payment['services'],
            'patientId' => $request->patient_payment['patientId'],
            'amount_paid' => $request->patient_payment['amount_paid'],
            'grand_total' => $request->patient_payment['grand_total'],
            'type_service' => $request->patient_payment['type_service'],
            'amount_unpaid' => $request->patient_payment['amount_unpaid'],
            'patient_noted' => $request->patient_payment['patient_noted'],
            'next_appointment_date' => $request->patient_payment['next_appointment_date']
        ];
        $patientHistory->update([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'cashier_id' => $request->cashier_id,
            'patient_payment' => $patientPaymentData
        ]);
    
        toastr()->success('Updated Patient\'s History Successfully !');
        return response()->json(['invoice_id' => $invoice_id, 'message' => 'Patient history updated successfully']);
    }
}
