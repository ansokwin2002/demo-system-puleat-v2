<?php

namespace App\Http\Controllers;

use App\Models\CompletedTreatmentPlan;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\TempServiceData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompletedTreatmentPlanController extends Controller
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

        // Combine all data into a single JSON structure
        $jsonData = [
            'grand_total' => $request->grand_total,
            'services' => $request->services,
            'customer_info' => $request->update_customer_info,
            'completed' => true,
        ];

        // Save to database
        CompletedTreatmentPlan::create([
            'json_data' => $jsonData,
        ]);

        // Delete TempServiceData records by patient_id
        TempServiceData::where('temp_service_json_data->patient_id', $request->patient_id)->delete();


        return response()->json([
            'status' => true,
            'message' => 'Treatment plan saved as completed.',
        ]);
    }

    public function view_invoice()
    {
        $invoice_id = $_GET['invoice_id'];
        $patient_id = $_GET['patient_id'];

        $services = [];
        $patient_info = [];

        $tempServiceData = TempServiceData::all();

        foreach ($tempServiceData as $data) {
            $json = $data->temp_service_json_data;

            if (!$json) continue;

            if (
                isset($json['update_customer_info'][0]['patient']) &&
                (string)$json['update_customer_info'][0]['patient'] === (string)$patient_id
            ) {
                $services = $json['services'] ?? [];
                $patient_info = $json['update_customer_info'][0] ?? [];
                break;
            }
        }

        $patient = Patient::find($patient_id);
        $doctor_id = $patient_info['doctor'] ?? null;
        $doctor = Doctor::find($doctor_id);


        return view('backend.invoice.index', compact('services', 'patient_info', 'patient','doctor', 'invoice_id'));
    }

}