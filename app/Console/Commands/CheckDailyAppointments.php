<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\notification;
use App\Models\PatientHistory;


class CheckDailyAppointments extends Command
{
    protected $signature = 'appointments:check-daily';
    protected $description = 'Check daily appointments and create alerts';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today()->toDateString(); // Get today's date as a string

        // Fetch only today's appointments
        $appointments = Appointment::whereDate('appointment_date', $today)->get();

        foreach ($appointments as $appointment) {
            $patient = $appointment->patient;

            // Fetch the latest patient history for this patient
            $latestHistory = PatientHistory::where('patient_id', $patient->id)
                                           ->latest('created_at')
                                           ->first();

            $doctor = $latestHistory->patient_payment['doctor'] ?? 'Unknown';
            $serviceDate = $latestHistory->patient_payment['date'] ?? 'Unknown';

            // Create or update a notification for today's appointments only
            notification::updateOrCreate(
                [
                    'patient_id' => $patient->id,
                    'notification_date' => $today, // Ensure this is today's date
                ],
                [
                    'message' => "Patient {$patient->name} (Telephone: {$patient->telephone}) has an appointment scheduled on {$appointment->appointment_date}. The patient was previously seen by Dr. {$doctor} on {$serviceDate}.",
                    'notification_date' => $today
                ]
            );
        }

        $this->info('Daily appointment checks completed.');
    }
}
