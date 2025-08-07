<?php

namespace App\Http\Controllers\Report;

use App\Exports\PatientAllHistroyExport;
use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\CompletedTreatmentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportPatientsController extends Controller
{
    public function index()
    {
        $pageTitle = 'Report-Patient | Laor-Prornit-Clinic-Dental';
        return view('backend.reports.index', compact('pageTitle'));
    }

    public function exportPatientHistory(Request $request)
    {
        try {
            $request->validate([
                'patient_id' => 'nullable|integer|exists:patients,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $patientId = $request->input('patient_id');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $query = CompletedTreatmentData::query();

            if ($patientId) {
                $query->whereJsonContains('json_data->patient_id', (string)$patientId);
            }

            $completedTreatments = $query->get();

            $filteredTreatments = $completedTreatments->filter(function ($treatment) use ($startDate, $endDate) {
                $jsonData = $treatment->json_data;
                $updateCustomerInfo = $jsonData['update_customer_info'][0] ?? [];
                $recordDate = $updateCustomerInfo['start_date'] ?? null;
                return $recordDate && $recordDate >= $startDate && $recordDate <= $endDate;
            });

            if ($filteredTreatments->isEmpty()) {
                return response()->json(['error' => 'No patient history found for the selected date range.'], 404);
            }

            $exportData = [];
            foreach ($filteredTreatments as $treatment) {
                $jsonData = $treatment->json_data;
                $services = $jsonData['services'] ?? [];
                $updateInfo = $jsonData['update_customer_info'][0] ?? [];

                foreach ($services as $index => $service) {
                    $row = [
                        'id' => $index === 0 ? $treatment->id : '',
                        'date' => $index === 0 ? ($updateInfo['start_date'] ?? '') : '',
                        'customer' => $index === 0 ? (Patient::find($jsonData['patient_id'] ?? null)->name ?? '') : '',
                        'doctor_name' => $index === 0 ? (Doctor::find($updateInfo['doctor'] ?? null)->name ?? '') : '',
                        'cashier_name' => $index === 0 ? (Cashier::find($updateInfo['cashier'] ?? null)->name ?? '') : '',
                        'service_name' => $service['name'] ?? '',
                        'subtotal' => $service['subtotal'] ?? 0,
                        'service_unit' => $service['quantity'] ?? $service['unit'] ?? 0,
                        'service_price' => $service['price'] ?? 0,
                        'discount_dollar' => ($service['discountType'] === '$') ? ($service['discountValue'] ?? 0) : 0,
                        'discount_percent' => ($service['discountType'] === '%') ? (($service['discountValue'] ?? 0) / 100) : 0,
                        'amount_paid' => $index === 0 ? ($jsonData['grand_total'] ?? 0) : '',
                        'grand_total' => $index === 0 ? ($jsonData['grand_total'] ?? 0) : '',
                        'amount_unpaid' => $index === 0 ? 0 : '',
                        'type_service' => $index === 0 ? ($updateInfo['type_service'] ?? '') : '',
                        'next_appointment_date' => $index === 0 ? ($updateInfo['next_appointment'] ?? '') : '',
                    ];
                    $exportData[] = $row;
                }
            }

            return Excel::download(new PatientAllHistroyExport($exportData), 'patient_history.xlsx');
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while exporting patient history: ' . $e->getMessage()], 500);
        }
    }

    public function searchPatientHistory(Request $request)
    {
        try {
            $request->validate([
                'patient_id' => 'nullable|integer|exists:patients,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $patientId = $request->input('patient_id');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $query = CompletedTreatmentData::query();

            if ($patientId) {
                $query->whereJsonContains('json_data->patient_id', (string)$patientId);
            }

            $completedTreatments = $query->get();

            $filteredTreatments = $completedTreatments->filter(function ($treatment) use ($startDate, $endDate) {
                $jsonData = $treatment->json_data;
                $updateCustomerInfo = $jsonData['update_customer_info'][0] ?? [];
                $recordDate = $updateCustomerInfo['start_date'] ?? null;
                return $recordDate && $recordDate >= $startDate && $recordDate <= $endDate;
            });

            if ($filteredTreatments->isEmpty()) {
                return response()->json(['error' => 'No patient history found for the selected date range.'], 404);
            }

            $exportData = [];
            foreach ($filteredTreatments as $treatment) {
                $jsonData = $treatment->json_data;
                $services = $jsonData['services'] ?? [];
                $updateInfo = $jsonData['update_customer_info'][0] ?? [];

                if (!array_key_exists($treatment->id, $exportData)) {
                    $exportData[$treatment->id] = [
                        'id' => $treatment->id,
                        'date' => $updateInfo['start_date'] ?? '',
                        'customer' => Patient::find($jsonData['patient_id'] ?? null)->name ?? '',
                        'doctor_name' => Doctor::find($updateInfo['doctor'] ?? null)->name ?? '',
                        'cashier_name' => Cashier::find($updateInfo['cashier'] ?? null)->name ?? '',
                        'services' => [],
                        'grand_total' => $jsonData['grand_total'] ?? 0,
                        'amount_paid' => $jsonData['grand_total'] ?? 0,
                        'amount_unpaid' => 0,
                        'next_appointment_date' => $updateInfo['next_appointment'] ?? '',
                        'type_service' => $updateInfo['type_service'] ?? '',
                        'invoice_id' => $jsonData['invoice_id'] ?? '',
                        'completed' => $jsonData['completed'] ?? false,
                    ];
                }

                foreach ($services as $service) {
                    $exportData[$treatment->id]['services'][] = [
                        'service_name' => $service['name'] ?? '',
                        'subtotal' => $service['subtotal'] ?? 0,
                        'service_unit' => $service['quantity'] ?? $service['unit'] ?? 0,
                        'service_price' => $service['price'] ?? 0,
                        'discount_dollar' => ($service['discountType'] === '$') ? ($service['discountValue'] ?? 0) : 0,
                        'discount_percent' => ($service['discountType'] === '%') ? (($service['discountValue'] ?? 0) / 100) : 0,
                        'service_id' => $service['id'] ?? '',
                        'service_status' => $service['status'] ?? '',
                    ];
                }
            }

            return response()->json(['data' => array_values($exportData)], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while searching patient history: ' . $e->getMessage()], 500);
        }
    }
}
