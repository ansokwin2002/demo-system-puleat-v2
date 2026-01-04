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
        // [Page_title----------------------------------]
            $pageTitle = 'Appointment | Laor-Prornit-Clinic-Dental';
        // [Page_title----------------------------------]

        $patientHistories = PatientHistory::with(['doctor', 'cashier', 'patient']) 
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($patientHistories as $patientHistory) {
            if (is_string($patientHistory->patient_payment)) {
                $patientHistory->patient_payment = json_decode($patientHistory->patient_payment, true);
            }
        }
        return view('backend.appointments.form', compact('patientHistories','pageTitle'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'appointment_date' => 'required|date',
        ]);

        $patientHistory = PatientHistory::findOrFail($id);

        $patientPayment = $patientHistory->patient_payment;

        if (is_string($patientPayment)) {
            $patientPayment = json_decode($patientPayment, true);
        }

        if (!is_array($patientPayment)) {
            $patientPayment = [];
        }

        $patientPayment['next_appointment_date'] = $request->input('appointment_date');
        $patientHistory->patient_payment = $patientPayment;
        $patientHistory->save();

        toastr()->success('Appointment Updated Successfully!');
        return redirect()->back();
    }

    // Get appointments for a specific patient
    public function getAppointments($patientId)
    {
        $appointments = Appointment::with('doctor')
            ->where('patient_id', $patientId)
            ->orderBy('appointment_date', 'desc')
            ->get();

        return response()->json($appointments);
    }

    // Store a new appointment
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $appointment = Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'description' => $request->description,
        ]);

        $appointment->load('doctor');

        return response()->json($appointment);
    }

    // Update an existing appointment
    public function updateAppointment(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'description' => $request->description,
        ]);

        $appointment->load('doctor');

        return response()->json($appointment);
    }

    // Delete an appointment
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return response()->json(['success' => true]);
    }
}
