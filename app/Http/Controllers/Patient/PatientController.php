<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\CompletedTreatmentData;
use App\Models\CompletedTreatmentPlan;
use App\Models\DoctorNotedBook;
use App\Models\Patient;
use App\Models\PatientHistory;
use App\Models\TempServiceData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add_Patient()
    {
        // [Page_title----------------------------------]
            $pageTitle = 'Add Patient | Laor-Prornit-Clinic-Dental';
        // [Page_title----------------------------------]
        return view('backend.patient.add_patient',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_Patient(Request $request)
    {
        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'age'          => 'required|integer|min:0',
            'sex'          => 'required|string|max:15',
            'address'      => 'required|string|max:255',
            'telephone'    => 'required|string|max:15',
            'date'         => 'required|date',
            'type_patient' => 'required|string|max:255',
            'type_payment'  => 'required|string|in:general_implant,ortho', 
        ]);

        $patient = Patient::create([
            'name'          => $validatedData['name'],
            'age'           => $validatedData['age'],
            'sex'           => $validatedData['sex'],
            'address'       => $validatedData['address'],
            'telephone'     => $validatedData['telephone'],
            'date'          => $validatedData['date'],
            'type_patient'  => $validatedData['type_patient'],
            'type_payment'  => $validatedData['type_payment'],  
        ]);

        if ($validatedData['type_payment'] === 'general_implant') {
            toastr()->success('Patient added successfully with General / Implant payment!');
            return redirect()->route('view_Payment', ['selected_patient' => $patient->id]);
        } elseif ($validatedData['type_payment'] === 'ortho') {
            toastr()->success('Patient added successfully with Ortho payment!');
            return redirect()->route('payment.ortho.index', ['selected_patient' => $patient->id]);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function view_Patient()
    {
        // [Page_title----------------------------------]
            $pageTitle = 'List Patient | Laor-Prornit-Clinic-Dental';
        // [Page_title----------------------------------]
        return view('backend.patient.view_patient',compact('pageTitle'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'age'          => 'required|numeric|min:0',
            'sex'          => 'required|string|max:10',
            'address'      => 'required|string|max:255',
            'telephone'    => 'required|string|max:20',
            'type_patient' => 'required|string|max:255',
        ]);

        $patient = Patient::find($id);

        if (!$patient) {
            toastr()->error('Patient not found!');
            return redirect()->back();
        }

        $patient->name         = $validatedData['name'];
        $patient->age          = $validatedData['age'];
        $patient->sex          = $validatedData['sex'];
        $patient->address      = $validatedData['address'];
        $patient->telephone    = $validatedData['telephone'];
        $patient->type_patient = $validatedData['type_patient'];
        $patient->save();

        toastr()->success('Patient updated successfully!');
        return redirect()->back();
    }

  
    // public function viewPatientDetail($id) 
    // {
    //     $pageTitle = 'Detail Patient | Laor-Prornit-Clinic-Dental';

    //     $patient = Patient::findOrFail($id);
    //     $doctorNotebook = DoctorNotedBook::with('doctor')
    //         ->where('patient_id', $id)
    //         ->orderBy('id', 'desc')
    //         ->get();

    //     $updateCustomerInfo = null;
    //     $invoice_id = null;

    //     $tempServiceData = TempServiceData::all();

    //     $latestInvoiceRecord = null;

    //     foreach ($tempServiceData as $data) {
    //         $json = $data->temp_service_json_data;

    //         if (!$json) continue;

    //         // Always set updateCustomerInfo from first match
    //         if (
    //             !$updateCustomerInfo &&
    //             isset($json['update_customer_info'][0]['patient']) &&
    //             (string)$json['update_customer_info'][0]['patient'] === (string)$id
    //         ) {
    //             $updateCustomerInfo = $json['update_customer_info'];
    //         }

    //         // Find latest invoice record matching patient
    //         if (
    //             isset($json['update_customer_info'][0]['patient']) &&
    //             (string)$json['update_customer_info'][0]['patient'] === (string)$id
    //         ) {
    //             if (!$latestInvoiceRecord || $data->id > $latestInvoiceRecord->id) {
    //                 $latestInvoiceRecord = $data;
    //             }
    //         }
    //     }

    //     // Set invoice_id only from the latest matching record
    //     if ($latestInvoiceRecord) {
    //         $invoice_id = $latestInvoiceRecord->temp_service_json_data['invoice_id'] ?? null;
    //     }

    //     // Process completed treatment plans
    //     $completedCustomerInfo = []; 
    //     $completedTreatmentPlaning = CompletedTreatmentPlan::all();

    //     foreach ($completedTreatmentPlaning as $data) {
    //         $json = $data->json_data;
    //         if (!$json || !isset($json['customer_info'][0]['patient'])) continue;

    //         if ((string)$json['customer_info'][0]['patient'] === (string)$id) {
    //             $completedCustomerInfo[] = [
    //                 'id' => $data->id,
    //                 'json' => $json,
    //             ];
    //         }
    //     }

    //     // Sort and extract JSON only
    //     usort($completedCustomerInfo, fn($a, $b) => $b['id'] <=> $a['id']);
    //     $completedCustomerInfo = array_map(fn($item) => $item['json'], $completedCustomerInfo);


    //     $completedTreatmentInfo = [];
    //     $completedTreatmentData = CompletedTreatmentData::all();

    //     foreach ($completedTreatmentData as $data) {
    //         $json = $data->json_data;

    //         // Skip if patient_id is missing or doesn't match
    //         if (!isset($json['patient_id']) || (string)$json['patient_id'] !== (string)$id) {
    //             continue;
    //         }

    //         $completedTreatmentInfo[] = [
    //             'id' => $data->id,
    //             'json' => $json,
    //         ];
    //     }

    //     // Sort by latest first
    //     usort($completedTreatmentInfo, fn($a, $b) => $b['id'] <=> $a['id']);

    //     // Extract only JSON from each record
    //     $completedTreatmentInfo = array_map(fn($item) => $item['json'], $completedTreatmentInfo);

    //     // Log::info($completedTreatmentInfo);


    //     return view('backend.patient.view_patient_detail', [
    //         'pageTitle' => $pageTitle,
    //         'patient' => $patient,
    //         'doctorNotebook' => $doctorNotebook,
    //         'updateCustomerInfo' => $updateCustomerInfo,
    //         'completedCustomerInfo' => $completedCustomerInfo,
    //         'invoice_id' => $invoice_id,
    //         'completedTreatmentInfo' => $completedTreatmentInfo
    //     ]);
    // }
    public function viewPatientDetail($id)
    {
        $pageTitle = 'Detail Patient | Laor-Prornit-Clinic-Dental';

        $patient = Patient::findOrFail($id);
        $doctorNotebook = DoctorNotedBook::with('doctor')
            ->where('patient_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        $updateCustomerInfo = null;
        $invoice_id = null;

        $tempServiceData = TempServiceData::all();
        $latestInvoiceRecord = null;

        // Get all completed treatment services for this patient
        $completedTreatmentData = CompletedTreatmentData::all();
        $completedServiceNames = [];

        foreach ($completedTreatmentData as $completed) {
            $json = $completed->json_data;

            if (!isset($json['patient_id']) || (string)$json['patient_id'] !== (string)$id) {
                continue;
            }

            $services = $json['services'] ?? [];
            foreach ($services as $service) {
                if (!empty($service['name'])) {
                    $completedServiceNames[] = $service['name'];
                }
            }
        }

        $completedServiceNames = array_unique($completedServiceNames);

        // Update tempServiceData: add `service_completed` and save
        foreach ($tempServiceData as $data) {
            $json = $data->temp_service_json_data;

            if (!$json) continue;

            // Always set updateCustomerInfo from first match
            if (
                !$updateCustomerInfo &&
                isset($json['update_customer_info'][0]['patient']) &&
                (string)$json['update_customer_info'][0]['patient'] === (string)$id
            ) {
                $updateCustomerInfo = $json['update_customer_info'];
            }

            // Find latest invoice record
            if (
                isset($json['update_customer_info'][0]['patient']) &&
                (string)$json['update_customer_info'][0]['patient'] === (string)$id
            ) {
                if (!$latestInvoiceRecord || $data->id > $latestInvoiceRecord->id) {
                    $latestInvoiceRecord = $data;
                }
            }

            // Add `service_completed` to each service
            if (
                isset($json['update_customer_info'][0]['patient']) &&
                (string)$json['update_customer_info'][0]['patient'] === (string)$id &&
                isset($json['services']) && is_array($json['services'])
            ) {
                foreach ($json['services'] as &$service) {
                    if (!empty($service['name']) && in_array($service['name'], $completedServiceNames)) {
                        $service['service_completed'] = true;
                    } else {
                        $service['service_completed'] = false;
                    }
                }
                unset($service); // avoid reference bug

                $data->temp_service_json_data = $json;
                $data->save();
            }
        }

        // Set invoice_id only from the latest matching record
        if ($latestInvoiceRecord) {
            $invoice_id = $latestInvoiceRecord->temp_service_json_data['invoice_id'] ?? null;
        }

        // Process completed treatment planning info
        $completedCustomerInfo = [];
        $completedTreatmentPlaning = CompletedTreatmentPlan::all();

        foreach ($completedTreatmentPlaning as $data) {
            $json = $data->json_data;
            if (!$json || !isset($json['customer_info'][0]['patient'])) continue;

            if ((string)$json['customer_info'][0]['patient'] === (string)$id) {
                $completedCustomerInfo[] = [
                    'id' => $data->id,
                    'json' => $json,
                ];
            }
        }

        usort($completedCustomerInfo, fn($a, $b) => $b['id'] <=> $a['id']);
        $completedCustomerInfo = array_map(fn($item) => $item['json'], $completedCustomerInfo);

        // Extract completed treatment info
        $completedTreatmentInfo = [];

        foreach ($completedTreatmentData as $data) {
            $json = $data->json_data;

            if (!isset($json['patient_id']) || (string)$json['patient_id'] !== (string)$id) {
                continue;
            }

            $completedTreatmentInfo[] = [
                'id' => $data->id,
                'json' => $json,
            ];
        }

        usort($completedTreatmentInfo, fn($a, $b) => $b['id'] <=> $a['id']);
        $completedTreatmentInfo = array_map(fn($item) => $item['json'], $completedTreatmentInfo);

        return view('backend.patient.view_patient_detail', [
            'pageTitle' => $pageTitle,
            'patient' => $patient,
            'doctorNotebook' => $doctorNotebook,
            'updateCustomerInfo' => $updateCustomerInfo,
            'completedCustomerInfo' => $completedCustomerInfo,
            'invoice_id' => $invoice_id,
            'completedTreatmentInfo' => $completedTreatmentInfo
        ]);
    }




}
