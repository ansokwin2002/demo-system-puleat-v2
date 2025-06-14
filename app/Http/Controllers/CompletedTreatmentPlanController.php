<?php

namespace App\Http\Controllers;

use App\Models\CompletedTreatmentPlan;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\TempServiceData;
use App\Models\TempTreatmentData;
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

   public function updateAmount(Request $request)
    {
        $amountPaid = $request->input('amount_paid'); 
        $amountUnpaid = $request->input('amount_unpaid');  
        $patientId = $request->input('patient_id');  

        $temp = TempTreatmentData::all()
            ->first(function ($item) use ($patientId) {
                $json = $item->json_data;
                return $json && $json['patient_id'] == $patientId;
            });

        if ($temp) {
            $json = $temp->json_data;
            $json['amount_paid'] = (string) $amountPaid;
            $json['amount_unpaid'] = (string) $amountUnpaid;

            $temp->json_data = $json;
            $temp->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }
    }



}