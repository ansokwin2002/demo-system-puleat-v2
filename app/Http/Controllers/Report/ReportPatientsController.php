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
        // [Page_title----------------------------------]
            $pageTitle = 'Report-Patient | Laor-Prornit-Clinic-Dental';
        // [Page_title----------------------------------]
        return view('backend.reports.index',compact('pageTitle'));
    }
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
    
            // Fetch patient histories based on the filters
            $patientHistories = $patientId 
                ? PatientHistory::where('patient_id', $patientId)->get()
                : PatientHistory::all();
    
            // Filter records by date range
            $filteredHistories = $patientHistories->filter(function($history) use ($startDate, $endDate) {
                $patientPayment = $history->patient_payment;
                $recordDate = $patientPayment['date'] ?? null;
    
                return $recordDate && $recordDate >= $startDate && $recordDate <= $endDate;
            });
    
            if ($filteredHistories->isEmpty()) {
                return response()->json(['error' => 'No patient history found for the selected date range.'], 404);
            }
    
            $exportData = [];
            foreach ($filteredHistories as $history) {
                $patientPayment = $history->patient_payment;
                $services = $patientPayment['services'] ?? [];
    
                foreach ($services as $index => $service) {
                    $row = [
                        'id' => $index === 0 ? $history->id : '',  // Show ID only for the first service
                        'date' => $index === 0 ? ($patientPayment['date'] ?? '') : '',  // Show Date only for the first service
                        'customer' => $index === 0 ? ($patientPayment['customer'] ?? '') : '',  // Show Customer only for the first service
                        'doctor_name' => $index === 0 ? (Doctor::find($history->doctor_id)->name ?? '') : '',  // Show Doctor Name only for the first service
                        'cashier_name' => $index === 0 ? (Cashier::find($history->cashier_id)->name ?? '') : '',  // Show Cashier Name only for the first service
                        'service_name' => $service['service_name'] ?? '',
                        'subtotal' => $service['subtotal'] ?? 0,
                        'service_unit' => $service['service_unit'] ?? 0,
                        'service_price' => $service['service_price'] ?? 0,
                        'discount_dollar' => $service['discount_dollar'] ?? 0,
                        'discount_percent' => $service['discount_percent'] ?? 0,
                        'amount_paid' => $index === 0 ? ($patientPayment['amount_paid'] ?? 0) : '',  // Show Amount Paid only for the first service
                        'grand_total' => $index === 0 ? ($patientPayment['grand_total'] ?? 0) : '',  // Show Grand Total only for the first service
                        'amount_unpaid' => $index === 0 ? ($patientPayment['amount_unpaid'] ?? 0) : '',  // Show Amount Unpaid only for the first service
                        'type_service' => $index === 0 ? ($patientPayment['type_service'] ?? '') : '',  // Show Type Service only for the first service
                        'patient_noted' => $index === 0 ? strip_tags($patientPayment['patient_noted'] ?? '') : '',  // Show Patient Noted only for the first service
                        'next_appointment_date' => $index === 0 ? ($patientPayment['next_appointment_date'] ?? '') : '',  // Show Next Appointment Date only for the first service
                    ];
                    $exportData[] = $row;
                }
            }
    
            // Return the Excel file download
            return Excel::download(new PatientAllHistroyExport($exportData), 'patient_history.xlsx');
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while exporting patient history.'], 500);
        }
    }

    public function searchPatientHistory(Request $request)
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

            // Fetch patient histories based on the filters
            $patientHistories = $patientId 
                ? PatientHistory::where('patient_id', $patientId)->get()
                : PatientHistory::all();

            // Filter records by date range
            $filteredHistories = $patientHistories->filter(function($history) use ($startDate, $endDate) {
                $patientPayment = $history->patient_payment;
                $recordDate = $patientPayment['date'] ?? null;

                return $recordDate && $recordDate >= $startDate && $recordDate <= $endDate;
            });

            if ($filteredHistories->isEmpty()) {
                return response()->json(['error' => 'No patient history found for the selected date range.'], 404);
            }

            // Prepare the data for the view with grouped services under each patient
            $exportData = [];
            foreach ($filteredHistories as $history) {
                $patientPayment = $history->patient_payment;
                $services = $patientPayment['services'] ?? [];

                if (!array_key_exists($history->id, $exportData)) {
                    $exportData[$history->id] = [
                        'id' => $history->id,
                        'date' => $patientPayment['date'] ?? '',
                        'customer' => $patientPayment['customer'] ?? '',
                        'doctor_name' => Doctor::find($history->doctor_id)->name ?? '',
                        'cashier_name' => Cashier::find($history->cashier_id)->name ?? '',
                        'services' => [],
                        'grand_total' => $patientPayment['grand_total'] ?? 0,
                        'amount_paid' => $patientPayment['amount_paid'] ?? 0,
                        'amount_unpaid' => $patientPayment['amount_unpaid'] ?? 0,
                        'patient_noted' => strip_tags($patientPayment['patient_noted'] ?? ''),
                        'next_appointment_date' => $patientPayment['next_appointment_date'] ?? '',
                        'type_service' => $patientPayment['type_service'] ?? '',
                    ];
                }

                foreach ($services as $service) {
                    $exportData[$history->id]['services'][] = [
                        'service_name' => $service['service_name'] ?? '',
                        'subtotal' => $service['subtotal'] ?? 0,
                        'service_unit' => $service['service_unit'] ?? 0,
                        'service_price' => $service['service_price'] ?? 0,
                        'discount_dollar' => $service['discount_dollar'] ?? 0,
                        'discount_percent' => $service['discount_percent'] ?? 0,
                    ];
                }
            }

            return response()->json(['data' => array_values($exportData)], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while exporting patient history.'], 500);
        }
    }

    

}
