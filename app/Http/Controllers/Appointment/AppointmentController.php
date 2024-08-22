<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\PatientHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AppointmentController extends Controller
{
    public function showForm()
    {
        // Fetch all patient histories with patient_payment records
        $histories = PatientHistory::whereNotNull('patient_payment')->get();

        // Map to get unique patients from histories
        $patients = $histories->map(function ($history) {
            return Patient::find($history->patient_id);
        })->filter()->unique('id');

        return view('backend.appointments.form', compact('patients'));
    }


    public function setAppointment(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date'
        ]);

        // Store the appointment data
        $appointment = Appointment::create([
            'patient_id' => $request->patient_id,
            'appointment_date' => $request->appointment_date
        ]);

        // Notify about the new appointment
        $this->createNotification($appointment);

        toastr()->success('Create Appointment Successfully!');
        return redirect()->route('appointments.form');
    }
    protected function createNotification(Appointment $appointment)
    {
        // Retrieve patient details
        $patient = Patient::find($appointment->patient_id);

        // Get the latest patient history for the patient
        $latestHistory = PatientHistory::where('patient_id', $patient->id)
                                       ->latest('created_at')
                                       ->first();

        // Extract doctor from patient history
        $doctor = $latestHistory->patient_payment['doctor'] ?? 'Unknown';

        // Create a notification entry (Assuming you have a notifications table)
        DB::table('notifications')->insert([
            'patient_id' => $patient->id,
            'message' => "Patient {$patient->name} (Telephone: {$patient->telephone}) has an appointment scheduled on {$appointment->appointment_date}. The patient was previously seen by Dr. {$doctor}.",
            'notification_date' => now()->toDateString(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
