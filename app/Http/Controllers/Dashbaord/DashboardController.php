<?php

namespace App\Http\Controllers\Dashbaord;

use App\Http\Controllers\Controller;
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
            $currentYear = date('Y'); // Get the current year
            
            // Query to count the number of patients per month for the current year
            $monthlyPatientCounts = Patient::select(DB::raw('LPAD(MONTH(date), 2, "0") as month'), DB::raw('COUNT(*) as count'))
                ->whereYear('date', $currentYear)
                ->groupBy(DB::raw('month'))
                ->orderBy(DB::raw('month'))
                ->pluck('count', 'month')
                ->toArray();
            
            // Map month numbers to names using strings as keys
            $months = [
                '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
            ];
            
            // Initialize an empty array to hold the final ordered patient counts
            $orderedPatientCounts = [];
            
            // Loop through the months and assign counts from the query, or 0 if no data exists
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
            // Initialize the sumServiceData array to store the total of all services for each month
            $sumServiceData = array_fill_keys(array_values($months), 0);

            $patientHistories = PatientHistory::whereYear('created_at', $currentYear)
                ->with('patient') 
                ->get();
            foreach ($patientHistories as $history) {
                $patient = $history->patient;

                if ($patient) {
                    // Decode patient_payment JSON data
                    $paymentData = is_array($history->patient_payment)
                        ? $history->patient_payment
                        : json_decode($history->patient_payment, true);

                    if (isset($paymentData['type_service']) && in_array($paymentData['type_service'], ['General', 'Implant', 'Ortho'])) {
                        if (isset($paymentData['date']) && isset($paymentData['grand_total'])) {
                            $date = \Carbon\Carbon::parse($paymentData['date']);
                            $monthKey = $date->format('m');
                            $monthName = $months[$monthKey]; 
                            // Increment the total for the appropriate service type and month
                            $serviceTotals[$paymentData['type_service']][$monthName] += floatval($paymentData['grand_total']);
                            // Add to the sumServiceData for the corresponding month
                            $sumServiceData[$monthName] += floatval($paymentData['grand_total']);
                        }
                    }
                }
            }
            // Prepare the data for frontend by mapping the month names directly
            $generalData = $serviceTotals['General'];
            $implantData = $serviceTotals['Implant'];
            $orthoData = $serviceTotals['Ortho'];
            // sumServiceData now contains the total of all three services for each month
            $sumData = $sumServiceData;
        // [Service-----------------------------------------------------]

        // [Doctor-----------------------------------------------------]
            $doctors = Doctor::all()->pluck('name', 'id')->toArray();

            $doctorTotals = array_map(fn() => array_fill_keys(array_values($months), 0), $doctors);
            $doctorTotals['Combined'] = array_fill_keys(array_values($months), 0);

            $patientHistories = PatientHistory::whereYear('created_at', $currentYear)->get();

            foreach ($patientHistories as $history) {
                $paymentData = is_array($history->patient_payment)
                    ? $history->patient_payment
                    : json_decode($history->patient_payment, true);

                // Get doctor information using the relationship
                $doctor = $history->doctor; // Retrieve doctor model from the relationship

                if ($doctor) {
                    $doctorName = $doctor->name; // Use doctor's name from the relationship
                    $date = \Carbon\Carbon::parse($paymentData['date']);
                    $monthKey = $date->format('n'); 
                    $monthName = $months[str_pad($monthKey, 2, '0', STR_PAD_LEFT)]; 

                    if (array_key_exists($doctorName, $doctorTotals)) {

                        $doctorTotals[$doctorName][$monthName] += floatval($paymentData['grand_total']);
                    } else {
                        $doctorTotals[$doctorName] = array_fill_keys(array_values($months), 0);
                        $doctorTotals[$doctorName][$monthName] = floatval($paymentData['grand_total']);
                    }

                    $doctorTotals['Combined'][$monthName] += floatval($paymentData['grand_total']);
                }
            }

            $doctorTotals = array_filter($doctorTotals, function ($key) {
                return $key === 'Combined' || !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);

            $dataForView = $doctorTotals;




            // Get today's date
            $today = Carbon::today()->format('Y-m-d');
            
            // Retrieve patient histories with related doctor and patient
            $patientHistories = PatientHistory::with(['doctor', 'patient'])
                ->whereRaw('JSON_EXTRACT(patient_payment, "$.next_appointment_date") = ?', [$today])
                ->get();
            
            // Prepare data for the view
            $appointmentNotifications = $patientHistories->map(function ($history) {
                // Access related models
                $doctorName = $history->doctor ? $history->doctor->name : 'No Doctor Assigned';
                $patientName = $history->patient ? $history->patient->name : 'Unknown Patient';
                $patientPhone = $history->patient ? $history->patient->telephone : 'N/A';

                // Access next appointment date from patient_payment JSON
                $nextAppointmentDate = isset($history->patient_payment['next_appointment_date']) 
                    ? Carbon::parse($history->patient_payment['next_appointment_date']) 
                    : null;

                // Convert services to a collection for further operations
                $services = collect($history->patient_payment['services'] ?? []);

                return [
                    'patient_id' => $history->patient_id,
                    'patient_name' => $patientName,
                    'patient_phone' => $patientPhone,
                    'doctor_name' => $doctorName,
                    'register_date' => $history->created_at->format('Y-m-d'),
                    'next_appointment' => $nextAppointmentDate ? $nextAppointmentDate->format('Y-m-d') : 'N/A',
                    'services' => $services
                ];
            });

            // Count of today's appointments
            $appointmentCount = $appointmentNotifications->count();


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
        // [Doctor-----------------------------------------------------]
    }
  
}
