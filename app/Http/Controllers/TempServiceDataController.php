<?php

namespace App\Http\Controllers;

use App\Models\CompletedTreatmentData;
use App\Models\TempServiceData;
use App\Models\TempTreatmentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TempServiceDataController extends Controller
{

    public function store(Request $request)
    {
        // Extract data from request
        $services = $request->input('services');
        $patientId = $request->input('patient_id');
        $grandTotal = $request->input('grand_total');
        $amountPaid = $request->input('amount_paid');
        $amountUnpaid = $request->input('amount_unpaid');
        $update_customer_info = $request->input('update_customer_info');
        $invoice_id = rand(100000, 999999); // Ensure at least 6 digits

        try {
            // Delete existing records for this patient
            TempServiceData::whereJsonContains('temp_service_json_data->patient_id', $patientId)->delete();
            TempTreatmentData::whereJsonContains('json_data->patient_id', $patientId)->delete();

            // Extract start_date from customer info
            $startDate = $update_customer_info[0]['start_date'] ?? null;

            // Prepare data structure
            $data = [
                'patient_id' => $patientId,
                'grand_total' => $grandTotal,
                'amount_paid' => $amountPaid,
                'amount_unpaid' => $amountUnpaid,
                'services' => $services,
                'update_customer_info' => $update_customer_info,
                'invoice_id' => $invoice_id
            ];

            // Always save to TempServiceData
            TempServiceData::create([
                'temp_service_json_data' => $data
            ]);

            // ✅ Get all completed treatment records for this patient with matching start_date
            $completedRecords = CompletedTreatmentData::whereJsonContains('json_data->patient_id', $patientId)
                ->get()
                ->filter(function ($record) use ($startDate) {
                    return $record->json_data['completed'] === true &&
                        isset($record->json_data['update_customer_info'][0]['start_date']) &&
                        $record->json_data['update_customer_info'][0]['start_date'] === $startDate;
                });

            // ✅ Collect all completed service names
            $completedNames = [];
            foreach ($completedRecords as $record) {
                $completedServices = $record->json_data['services'] ?? [];
                foreach ($completedServices as $s) {
                    $completedNames[] = $s['name']; // 🔁 Change to $s['id'] if needed
                }
            }

            $completedNames = array_unique($completedNames);

            // ✅ Filter out services that are already completed
            $data['services'] = array_filter($data['services'], function ($service) use ($completedNames) {
                return !in_array($service['name'], $completedNames); // 🔁 Change to $service['id'] if needed
            });

            $data['services'] = array_values($data['services']); // Re-index

            // ✅ Save to TempTreatmentData only if remaining services exist
            if (!empty($data['services'])) {
                TempTreatmentData::create([
                    'json_data' => $data
                ]);

                // Update service_completed flags
                $treatmentRecord = TempTreatmentData::whereJsonContains('json_data->patient_id', $patientId)->first();

                if ($treatmentRecord) {
                    $jsonData = $treatmentRecord->json_data;

                    // ✅ Reload all completed services again
                    $completedRecords = CompletedTreatmentData::whereJsonContains('json_data->patient_id', $patientId)
                        ->get()
                        ->filter(function ($record) use ($startDate) {
                            return $record->json_data['completed'] === true &&
                                isset($record->json_data['update_customer_info'][0]['start_date']) &&
                                $record->json_data['update_customer_info'][0]['start_date'] === $startDate;
                        });

                    $completedNames = [];
                    foreach ($completedRecords as $record) {
                        $completedServices = $record->json_data['services'] ?? [];
                        foreach ($completedServices as $s) {
                            $completedNames[] = $s['name']; // 🔁 Change to $s['id'] if needed
                        }
                    }
                    $completedNames = array_unique($completedNames);

                    $jsonData['services'] = array_map(function ($service) use ($completedNames) {
                        $service['service_completed'] = in_array($service['name'], $completedNames); // 🔁 Change to $service['id']
                        return $service;
                    }, $jsonData['services']);

                    $treatmentRecord->update(['json_data' => $jsonData]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Temp services saved successfully',
                'status' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'There was an error saving the treatment plan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getServices($id)
    {
        // Query the TempServiceData table where the patient_id is inside the temp_service_json_data JSON field
        $patientData = TempServiceData::where('temp_service_json_data->patient_id', $id)->first();
    
        // Check if data exists
        if (!$patientData) {
            return response()->json(['error' => 'No data found'], 404);
        }
    
        // Return the services in JSON format
        return response()->json(['data' => $patientData->temp_service_json_data]);
    }
    
    public function getTreatment($patientId)
    {
        // Get the latest treatment record
        $latestData = TempTreatmentData::where('json_data->patient_id', $patientId)
            ->orderByDesc('id') // Assuming higher ID = newer
            ->first();

        if (!$latestData) {
            return response()->json(['acceptedServices' => []]);
        }

        $tempData = $latestData->json_data;

        // Extract current start_date
        $currentStartDate = $tempData['update_customer_info'][0]['start_date'] ?? null;

        // Optional: get the previous record for comparison
        $previousData = TempTreatmentData::where('json_data->patient_id', $patientId)
            ->where('id', '<', $latestData->id)
            ->orderByDesc('id')
            ->first();

        $previousStartDate = $previousData->json_data['update_customer_info'][0]['start_date'] ?? null;

        // If current start_date is newer, reset service_completed to false
        if ($currentStartDate && (!$previousStartDate || $currentStartDate > $previousStartDate)) {
            foreach ($tempData['services'] as &$service) {
                // This assumes a new visit means all services are "not completed" yet
                $service['service_completed'] = false;
            }
        }

        // Filter services
        $acceptedServices = collect($tempData['services'] ?? [])
            ->filter(function ($service) {
                $statusIsTrue = isset($service['status']) && ($service['status'] === true || $service['status'] === 'true');
                $notCompleted = !isset($service['service_completed']) || $service['service_completed'] !== true;
                return $statusIsTrue && $notCompleted;
            })
            ->values()
            ->all();

       return response()->json([
            'acceptedServices' => $acceptedServices,
            'amount_paid' => $tempData['amount_paid'],
            'amount_unpaid' => $tempData['amount_unpaid'],
        ]);

    }
}
