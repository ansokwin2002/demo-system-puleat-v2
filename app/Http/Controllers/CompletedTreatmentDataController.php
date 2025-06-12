<?php

namespace App\Http\Controllers;

use App\Models\CompletedTreatmentData;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\TempTreatmentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompletedTreatmentDataController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'patient_id' => 'required',
            'grand_total' => 'required|numeric',
            'services' => 'required|array',
            'update_customer_info' => 'required|array',
        ]);

        // Generate random 6-digit invoice_id
        $invoice_id = rand(100000, 999999);

        // Filter services with status === "true"
        $filteredServices = collect($request->services)->filter(function ($service) {
            return isset($service['status']) && $service['status'] === 'true';
        })->values()->all();

        // Combine all data into a single JSON structure
        $jsonData = [
            'invoice_id' => $invoice_id,
            'patient_id' => $request->patient_id,
            'grand_total' => $request->grand_total,
            'services' => $filteredServices,
            'update_customer_info' => $request->update_customer_info,
            'completed' => true,
        ];

        Log::info($jsonData);

        // Save to CompletedTreatmentData table
        CompletedTreatmentData::create([
            'json_data' => $jsonData,
        ]);

        // Delete matching TempTreatmentData by patient_id
        TempTreatmentData::where('json_data->patient_id', $request->patient_id)->delete();

        // Return response
        return response()->json([
            'status' => true,
            'message' => 'Treatment saved as completed.',
            'invoice_id' => $invoice_id,
            'patient_id' => $request->patient_id
        ]);
    }


    public function view_invoice()
    {
        $invoice_id = $_GET['invoice_id'];
        $patient_id = $_GET['patient_id'];

        $services = [];
        $patient_info = [];

        $tempServiceData = TempTreatmentData::all();

        foreach ($tempServiceData as $data) {
            $json = $data->json_data;

            if (!$json) continue;

            if (
                isset($json['update_customer_info'][0]['patient']) &&
                (string)$json['update_customer_info'][0]['patient'] === (string)$patient_id
            ) {
                // Only include services with status = true
                $allServices = $json['services'] ?? [];
                $services = array_filter($allServices, function ($service) {
                    return isset($service['status']) && $service['status'] === true || $service['status'] === "true";
                });

                $patient_info = $json['update_customer_info'][0] ?? [];
                break;
            }
        }

        $patient = Patient::find($patient_id);
        $doctor_id = $patient_info['doctor'] ?? null;
        $doctor = Doctor::find($doctor_id);

        return view('backend.invoice_2.index', compact('services', 'patient_info', 'patient', 'doctor', 'invoice_id'));
    }


}
