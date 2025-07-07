<?php

namespace App\Http\Controllers\Dashbaord;

use App\Http\Controllers\Controller;
use App\Models\CompletedTreatmentData;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PatientHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
   public function dashboard()
    {
        // [Page_title----------------------------------]
            $pageTitle = 'Dashboard | Laor-Prornit-Clinic-Dental';
        // [Page_title----------------------------------]

        // [Patient-----------------------------------------------------]
            $currentYear = date('Y');

            $monthlyPatientCounts = Patient::select(DB::raw('LPAD(MONTH(date), 2, "0") as month'), DB::raw('COUNT(*) as count'))
                ->whereYear('date', $currentYear)
                ->groupBy(DB::raw('month'))
                ->orderBy(DB::raw('month'))
                ->pluck('count', 'month')
                ->toArray();

            $months = [
                '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
            ];

            $orderedPatientCounts = [];
            foreach ($months as $key => $monthName) {
                $orderedPatientCounts[$monthName] = $monthlyPatientCounts[$key] ?? 0;
            }
        // [Patient-----------------------------------------------------]

        // [Service-----------------------------------------------------]
            $serviceTotals = [
                'General' => array_fill_keys(array_values($months), 0),
                'Implant' => array_fill_keys(array_values($months), 0),
                'Ortho' => array_fill_keys(array_values($months), 0)
            ];

            $sumServiceData = array_fill_keys(array_values($months), 0);

            $completedTreatments = CompletedTreatmentData::whereYear('created_at', $currentYear)->get();

            foreach ($completedTreatments as $treatment) {
                $jsonData = $treatment->json_data;

                if (isset($jsonData['update_customer_info']) && is_array($jsonData['update_customer_info'])) {
                    foreach ($jsonData['update_customer_info'] as $info) {
                        if (isset($info['type_service']) && in_array($info['type_service'], ['General', 'Implant', 'Ortho'])) {
                            $dateString = $info['start_date'] ?? $treatment->created_at->format('Y-m-d');
                            $date = \Carbon\Carbon::parse($dateString);
                            $monthKey = $date->format('m');
                            $monthName = $months[$monthKey];
                            $grandTotal = isset($jsonData['grand_total']) ? floatval($jsonData['grand_total']) : 0;

                            $serviceTotals[$info['type_service']][$monthName] += $grandTotal;
                            $sumServiceData[$monthName] += $grandTotal;
                        }
                    }
                }
            }

            $generalData = $serviceTotals['General'];
            $implantData = $serviceTotals['Implant'];
            $orthoData = $serviceTotals['Ortho'];
            $sumData = $sumServiceData;
        // [Service-----------------------------------------------------]

        // [Doctor-----------------------------------------------------]
            $doctors = Doctor::all()->pluck('name', 'id')->toArray();

            $doctorTotals = [
                'Combined' => array_fill_keys(array_values($months), 0)
            ];
            foreach ($doctors as $id => $name) {
                $doctorTotals[$name] = array_fill_keys(array_values($months), 0);
            }

            foreach ($completedTreatments as $treatment) {
                $jsonData = $treatment->json_data;

                if (isset($jsonData['update_customer_info']) && is_array($jsonData['update_customer_info'])) {
                    foreach ($jsonData['update_customer_info'] as $info) {
                        $doctorId = $info['doctor'] ?? null;
                        $doctorName = ($doctorId && isset($doctors[$doctorId])) ? $doctors[$doctorId] : 'Unknown Doctor';

                        $dateString = $info['start_date'] ?? $treatment->created_at->format('Y-m-d');
                        $date = \Carbon\Carbon::parse($dateString);
                        $monthKey = $date->format('m');
                        $monthName = $months[$monthKey];
                        $grandTotal = isset($jsonData['grand_total']) ? floatval($jsonData['grand_total']) : 0;

                        if (!isset($doctorTotals[$doctorName])) {
                            $doctorTotals[$doctorName] = array_fill_keys(array_values($months), 0);
                        }

                        $doctorTotals[$doctorName][$monthName] += $grandTotal;
                        $doctorTotals['Combined'][$monthName] += $grandTotal;
                    }
                }
            }

            $doctorTotals = array_filter($doctorTotals, function ($key) {
                return $key === 'Combined' || !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);

            $dataForView = $doctorTotals;
        // [Doctor-----------------------------------------------------]

        // [Appointments - Using CompletedTreatmentData only]
        $today = \Carbon\Carbon::today()->format('Y-m-d');

            $appointmentNotifications = collect();
            foreach ($completedTreatments as $treatment) {
                $jsonData = $treatment->json_data;

                if (isset($jsonData['update_customer_info']) && is_array($jsonData['update_customer_info'])) {
                    foreach ($jsonData['update_customer_info'] as $info) {
                        if (!empty($info['next_appointment']) && $info['next_appointment'] === $today) {
                            $doctorId = $info['doctor'] ?? null;
                            $doctorName = ($doctorId && isset($doctors[$doctorId])) ? $doctors[$doctorId] : 'Unknown Doctor';

                            $appointmentNotifications->push([
                                'patient_id' => $jsonData['patient_id'] ?? 'N/A',
                                'doctor_name' => $doctorName,
                                'next_appointment' => $info['next_appointment'],
                                'grand_total' => $jsonData['grand_total'] ?? 0,
                            ]);
                        }
                    }
                }
            }

            $appointmentCount = $appointmentNotifications->count();
        // [Appointments-----------------------------------------------------]

        return view('backend.dashboard', [
            'year' => $currentYear,
            'monthlyPatientCounts' => $orderedPatientCounts,
            'months' => $months,
            'generalData' => $generalData,
            'implantData' => $implantData,
            'orthoData' => $orthoData,
            'sumData' => $sumData,
            'doctorData' => $dataForView,
            'appointmentNotifications' => $appointmentNotifications,
            'appointmentCount' => $appointmentCount,
            'pageTitle' => $pageTitle
        ]);
    }

    
}
