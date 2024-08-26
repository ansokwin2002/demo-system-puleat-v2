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
        $patientHistories = PatientHistory::with(['doctor', 'cashier', 'patient'])->get();
        foreach ($patientHistories as $patientHistory) {
            if (is_string($patientHistory->patient_payment)) {
                $patientHistory->patient_payment = json_decode($patientHistory->patient_payment, true);
            }
        }
        return view('backend.appointments.form', compact('patientHistories'));
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
        return redirect()->route('appointments.form');
    }



}
