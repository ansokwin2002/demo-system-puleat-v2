<?php

namespace App\Http\Controllers\Report;

use App\Exports\PatientAllHistroyExport;
use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\Doctor;
use App\Models\PatientHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

use function Laravel\Prompts\alert;

class ReportPatientsController extends Controller
{
    public function index()
    {
        return view('backend.reports.index');
    }
    
    // public function exportPatientHistory(Request $request)
    // {
    //     // Validate input fields
    //     $request->validate([
    //         'patient_id' => 'nullable|integer|exists:patients,id', // Make patient_id optional
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date',
    //     ]);
    
    //     $patientId = $request->input('patient_id');
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    
    //     if ($patientId) {
    //         // Fetch all patient history records for the specified patient
    //         $patientHistories = PatientHistory::where('patient_id', $patientId)
    //             ->get();
    //     } else {
    //         // Fetch all patient history records
    //         $patientHistories = PatientHistory::all();
    //     }
    
    //     // Filter records based on the 'date' field in the 'patient_payment' JSON
    //     $filteredHistories = $patientHistories->filter(function($history) use ($startDate, $endDate) {
    //         $patientPayment = $history->patient_payment;
    //         $recordDate = $patientPayment['date'] ?? null;
    
    //         return $recordDate && $recordDate >= $startDate && $recordDate <= $endDate;
    //     });
    
    //     // Return JSON response with error message if no records found
    //     if ($filteredHistories->isEmpty()) {
    //         return response()->json(['error' => 'No patient history found for the selected date range.'], 404);
    //     }
    
    //     // Process the records to extract the data for export
    //     $exportData = $filteredHistories->map(function($history) {
    //         $patientPayment = $history->patient_payment; // JSON field
    
    //         // Flatten the services array
    //         $service_name = collect($patientPayment['services'] ?? [])->map(function($service) {
    //             return $service['service_name'];
    //         })->implode('; ');
    
    //         $service_subtotal = collect($patientPayment['services'] ?? [])->map(function($service) {
    //             return $service['subtotal'];
    //         })->implode('; ');
    
    //         $service_unit = collect($patientPayment['services'] ?? [])->map(function($service) {
    //             return $service['service_unit'];
    //         })->implode('; ');
    
    //         $service_price = collect($patientPayment['services'] ?? [])->map(function($service) {
    //             return $service['service_price'];
    //         })->implode('; ');
    
    //         $service_discount_percent = collect($patientPayment['services'] ?? [])->map(function($service) {
    //             return $service['discount_percent'];
    //         })->implode('; ');
    
    //         $service_discount_dollar = collect($patientPayment['services'] ?? [])->map(function($service) {
    //             return  $service['discount_dollar'];
    //         })->implode('; ');
    
    //         // Fetch related names if required
    //         $doctorName = Doctor::find($history->doctor_id)->name ?? 'N/A';
    //         $cashierName = Cashier::find($history->cashier_id)->name ?? 'N/A';
    
    //         return [
    //             'id' => $history->id,
    //             'date' => $patientPayment['date'] ?? 'N/A',
    //             'customer' => $patientPayment['customer'] ?? 'N/A',
    //             'doctor_name' => $doctorName,
    //             'cashier_name' => $cashierName,
    //             'services' => $service_name,
    //             'subtotal' => $service_subtotal,
    //             'service_unit' => $service_unit,
    //             'service_price' => $service_price,
    //             'discount_dollar' => $service_discount_dollar,
    //             'discount_percent' => $service_discount_percent,
    //             'amount_paid' => $patientPayment['amount_paid'] ?? 0,
    //             'grand_total' => $patientPayment['grand_total'] ?? 0,
    //             'type_service' => $patientPayment['type_service'] ?? 'N/A',
    //             'amount_unpaid' => $patientPayment['amount_unpaid'] ?? 0,
    //             'patient_noted' => strip_tags($patientPayment['patient_noted'] ?? 'N/A'),
    //             'next_appointment_date' => $patientPayment['next_appointment_date'] ?? 'N/A',
    //         ];
    //     });
    
    //     // Use this data to generate the Excel file
    //     return Excel::download(new PatientAllHistroyExport($exportData->toArray()), 'patient_history.xlsx');
    // }
    public function exportPatientHistory(Request $request)
    {
        try {
            // Validate input fields
            $request->validate([
                'patient_id' => 'nullable|integer|exists:patients,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);
    
            $patientId = $request->input('patient_id');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
    
            $patientHistories = $patientId 
                ? PatientHistory::where('patient_id', $patientId)->get()
                : PatientHistory::all();
    
            $filteredHistories = $patientHistories->filter(function($history) use ($startDate, $endDate) {
                $patientPayment = $history->patient_payment;
                $recordDate = $patientPayment['date'] ?? null;
    
                return $recordDate && $recordDate >= $startDate && $recordDate <= $endDate;
            });
    
            if ($filteredHistories->isEmpty()) {
                return response()->json(['error' => 'No patient history found for the selected date range.'], 404);
            }
    
            $exportData = $filteredHistories->flatMap(function($history) {
                $patientPayment = $history->patient_payment;
    
                return collect($patientPayment['services'] ?? [])->map(function($service) use ($history, $patientPayment) {
                    return [
                        'id' => $history->id,
                        'date' => $patientPayment['date'] ?? 'N/A',
                        'customer' => $patientPayment['customer'] ?? 'N/A',
                        'doctor_name' => Doctor::find($history->doctor_id)->name ?? 'N/A',
                        'cashier_name' => Cashier::find($history->cashier_id)->name ?? 'N/A',
                        'service_name' => $service['service_name'] ?? '',
                        'subtotal' => $service['subtotal'] ?? 0,
                        'service_unit' => $service['service_unit'] ?? 0,
                        'service_price' => $service['service_price'] ?? 0,
                        'discount_dollar' => $service['discount_dollar'] ?? 0,
                        'discount_percent' => $service['discount_percent'] ?? 0,
                        'amount_paid' => $patientPayment['amount_paid'] ?? 0,
                        'grand_total' => $patientPayment['grand_total'] ?? 0,
                        'type_service' => $patientPayment['type_service'] ?? 'N/A',
                        'amount_unpaid' => $patientPayment['amount_unpaid'] ?? 0,
                        'patient_noted' => strip_tags($patientPayment['patient_noted'] ?? 'N/A'),
                        'next_appointment_date' => $patientPayment['next_appointment_date'] ?? 'N/A',
                    ];
                });
            });
            return Excel::download(new PatientAllHistroyExport($exportData->toArray()), 'patient_history.xlsx');
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while exporting patient history.'], 500);
        }
    }
    
    

    

    
    
    
    

}
