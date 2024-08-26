<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\PatientHistory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class NotificationController extends Controller
{
    public function index()
    {
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

        return view('backend.notifications.index', [
            'appointmentNotifications' => $appointmentNotifications,
        ]);
    }
}
