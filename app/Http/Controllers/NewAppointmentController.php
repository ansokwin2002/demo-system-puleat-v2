<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Carbon\Carbon;

class NewAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor'])->get();

        // Fetch all patients and doctors for the dropdowns
        $patients = Patient::all(['id', 'name'])->sortBy('name');
        $doctors = Doctor::all(['id', 'name'])->sortBy('name');

        // Count today's appointments
        $today_appointments_count = Appointment::whereDate('appointment_date', Carbon::today())->count();

        return view('backend.new_appointment.index', compact('appointments', 'patients', 'doctors', 'today_appointments_count'));
    }
}
