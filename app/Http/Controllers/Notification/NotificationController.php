<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    public function index()
    {
        // Get today's date
        $today = Carbon::today();

        // Fetch patients with next_appointment matching today's date
        $appointmentsToday = Patient::whereDate('next_appointment', $today->format('Y-m-d'))
            ->with(['doctor', 'histories']) // Load doctor and histories relationships
            ->get();

        // Prepare data for the view
        $appointmentNotifications = $appointmentsToday->map(function ($patient) {
            $nextAppointmentDate = Carbon::parse($patient->next_appointment);

            // Extract service data from patient histories
            $services = $patient->histories->flatMap(function ($history) {
                // Decode the patient_payment JSON column
                $data = $history->patient_payment;
                return $data['services'] ?? [];
            });

            return [
                'patient_id' => $patient->id,
                'patient_name' => $patient->name,
                'patient_phone' => $patient->telephone,
                'doctor_name' => $patient->doctor->name ?? 'No Doctor Assigned',
                'register_date' => $patient->created_at->format('Y-m-d'),
                'next_appointment' => $nextAppointmentDate->format('Y-m-d'),
                'services' => $services
            ];
        });

        return view('backend.notifications.index', [
            'appointmentNotifications' => $appointmentNotifications,
        ]);
    }
}
