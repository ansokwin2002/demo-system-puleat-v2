<?php

namespace App\Http\Controllers;

use App\Models\CompletedTreatmentData;
use App\Models\TempServiceData;
use App\Models\TempTreatmentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TempServiceDataController extends Controller
{
   
    // public function store(Request $request)
    // {
    //     // Extract services, patient_id, grand_total, amount_paid, and amount_unpaid
    //     $services = $request->input('services');
    //     $patientId = $request->input('patient_id');
    //     $grandTotal = $request->input('grand_total');
    //     $amountPaid = $request->input('amount_paid');
    //     $amountUnpaid = $request->input('amount_unpaid');
    //     $update_customer_info = $request->input('update_customer_info');
    //     $invoice_id = rand(000000,999999);

    //     // Initialize status to false
    //     $status = false;

    //     try {
    //         // Check if a record with the same patient_id exists in the temp_service_json_data
    //         $existingServiceRecord = TempServiceData::whereJsonContains('temp_service_json_data->patient_id', $patientId)->first();

    //         if ($existingServiceRecord) {
    //             // If a record exists for this patient, delete it
    //             $existingServiceRecord->delete();
    //         }

    //         $existingServiceRecord = TempTreatmentData::whereJsonContains('json_data->patient_id', $patientId)->first();

    //         if ($existingServiceRecord) {
    //             // If a record exists for this patient, delete it
    //             $existingServiceRecord->delete();
    //         }

    //         $data = [
    //             'patient_id' => $patientId,
    //             'grand_total' => $grandTotal,
    //             'amount_paid' => $amountPaid,
    //             'amount_unpaid' => $amountUnpaid,
    //             'services' => $services,
    //             'update_customer_info' => $update_customer_info,
    //             'invoice_id' => $invoice_id
    //         ];

    //         // Save to TempServiceData
    //         TempServiceData::create([
    //             'temp_service_json_data' => $data
    //         ]);

    //         // Save to TempTreatmentData
    //         TempTreatmentData::create([
    //             'json_data' => $data
    //         ]);


    //         // Set status to true if the data was successfully created
    //         $status = true;

    //         // Return success response with status true
    //         return response()->json([
    //             'success' => $status,  // Return the status value
    //             'message' => 'Temp services saved successfully',
    //             'status' => $status
    //         ]);
            
    //     } catch (\Exception $e) {
    //         // Catch any exceptions and return a failure response
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'There was an error saving the treatment plan: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    
    // public function store(Request $request)
    // {
    //     // Extract data from request
    //     $services = $request->input('services');
    //     $patientId = $request->input('patient_id');
    //     $grandTotal = $request->input('grand_total');
    //     $amountPaid = $request->input('amount_paid');
    //     $amountUnpaid = $request->input('amount_unpaid');
    //     $update_customer_info = $request->input('update_customer_info');
    //     $invoice_id = rand(100000, 999999); // Ensure at least 6 digits

    //     $status = false;

    //     try {
    //         // Delete existing records for this patient
    //         TempServiceData::whereJsonContains('temp_service_json_data->patient_id', $patientId)->delete();
    //         TempTreatmentData::whereJsonContains('json_data->patient_id', $patientId)->delete();

    //         // Store base data
    //         $data = [
    //             'patient_id' => $patientId,
    //             'grand_total' => $grandTotal,
    //             'amount_paid' => $amountPaid,
    //             'amount_unpaid' => $amountUnpaid,
    //             'services' => $services,
    //             'update_customer_info' => $update_customer_info,
    //             'invoice_id' => $invoice_id
    //         ];

    //         // Save to TempServiceData
    //         TempServiceData::create([
    //             'temp_service_json_data' => $data
    //         ]);

    //         // Save to TempTreatmentData
    //         TempTreatmentData::create([
    //             'json_data' => $data
    //         ]);

    //         // Update TempTreatmentData with service_completed status
    //         $treatmentRecord = TempTreatmentData::whereJsonContains('json_data->patient_id', $patientId)->first();

    //         if ($treatmentRecord) {
    //             $jsonData = $treatmentRecord->json_data;

    //             // Load completed services for this patient
    //             $completedRecord = CompletedTreatmentData::whereJsonContains('json_data->patient_id', $patientId)->first();

    //             if ($completedRecord) {
    //                 $completedServices = $completedRecord->json_data['services'] ?? [];

    //                 // Get list of completed service names
    //                 $completedNames = array_map(function ($s) {
    //                     return $s['name'];
    //                 }, $completedServices);

    //                 // Add service_completed key to each service
    //                 $jsonData['services'] = array_map(function ($service) use ($completedNames) {
    //                     $service['service_completed'] = in_array($service['name'], $completedNames);
    //                     return $service;
    //                 }, $jsonData['services']);

    //                 // Save the updated data
    //                 $treatmentRecord->update(['json_data' => $jsonData]);
    //             }
    //         }

    //         // Return success response
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Temp services saved successfully',
    //             'status' => true
    //         ]);
    //     } catch (\Exception $e) {
            

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'There was an error saving the treatment plan: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

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
    

    // public function getTreatment($patientId)
    // {
    //     // Fetch the record where JSON contains matching patient_id
    //     $patientData = TempTreatmentData::where('json_data->patient_id', $patientId)->first();

    //     // If no record found, return an empty response
    //     if (!$patientData) {
    //         return response()->json(['acceptedServices' => []]);
    //     }

    //     // Decode the JSON field
    //     $tempData = $patientData->json_data;

    //     // Log::info($tempData);

    //     // Filter services where status is true AND service_completed is NOT true
    //     $acceptedServices = collect($tempData['services'] ?? [])
    //         ->filter(function ($service) {
    //             $statusIsTrue = isset($service['status']) && ($service['status'] === true || $service['status'] === 'true');
    //             $notCompleted = !isset($service['service_completed']) || $service['service_completed'] !== true;
    //             return $statusIsTrue && $notCompleted;
    //         })
    //         ->values()
    //         ->all();

    //     // Return the filtered services in JSON format
    //     return response()->json(['acceptedServices' => $acceptedServices]);
    // }
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

            Log::info($acceptedServices);
        return response()->json(['acceptedServices' => $acceptedServices]);
    }

// public function getTreatment($patientId)
// {
//     // Get the latest treatment record (newest by id)
//     $latestData = TempTreatmentData::where('json_data->patient_id', $patientId)
//         ->orderByDesc('id')
//         ->first();

//     if (!$latestData) {
//         return response()->json(['acceptedServices' => []]);
//     }

//     $tempData = $latestData->json_data;

//     // Current visit start_date
//     $currentStartDate = $tempData['update_customer_info'][0]['start_date'] ?? null;

//     // Get the previous treatment record (before current)
//     $previousData = TempTreatmentData::where('json_data->patient_id', $patientId)
//         ->where('id', '<', $latestData->id)
//         ->orderByDesc('id')
//         ->first();

//     $previousStartDate = $previousData->json_data['update_customer_info'][0]['start_date'] ?? null;
//     $previousServices = $previousData ? ($previousData->json_data['services'] ?? []) : [];

//     // Check if this is a new visit (new start_date)
//     $isNewVisit = false;
//     if ($currentStartDate && (!$previousStartDate || $currentStartDate > $previousStartDate)) {
//         $isNewVisit = true;

//         // Reset all service_completed flags for new visit
//         foreach ($tempData['services'] as &$service) {
//             $service['service_completed'] = false;
//         }
//     }

//     // Filter accepted services for current visit
//     $acceptedServices = collect($tempData['services'] ?? [])
//         ->filter(function ($service) use ($isNewVisit, $previousServices) {
//             $statusIsTrue = isset($service['status']) && ($service['status'] === true || $service['status'] === 'true');
//             $notCompleted = !isset($service['service_completed']) || $service['service_completed'] !== true;

//             if (!$statusIsTrue || !$notCompleted) {
//                 return false;
//             }

//             // If this is NOT a new visit,
//             // exclude services that were completed in previous visits (if service name matches)
//             // to avoid showing already completed services again.
//             if (!$isNewVisit) {
//                 $serviceName = $service['name'] ?? null;
//                 if ($serviceName) {
//                     foreach ($previousServices as $prevService) {
//                         $prevName = $prevService['name'] ?? null;
//                         $prevCompleted = $prevService['service_completed'] ?? false;

//                         // If service was completed previously with same name, exclude from display
//                         if ($prevName === $serviceName && $prevCompleted === true) {
//                             return false;
//                         }
//                     }
//                 }
//             }

//             return true;
//         })
//         ->values()
//         ->all();

//     return response()->json(['acceptedServices' => $acceptedServices]);
// }


    
    public function save_completed_treatment_planning($invoice_id) {
        
    }


}
