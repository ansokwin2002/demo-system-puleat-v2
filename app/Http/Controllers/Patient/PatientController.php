<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add_Patient()
    {
        return view('backend.patient.add_patient');
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
        ]);

        $patient = Patient::create([
            'name'          => $validatedData['name'],
            'age'           => $validatedData['age'],
            'sex'           => $validatedData['sex'],
            'address'       => $validatedData['address'],
            'telephone'     => $validatedData['telephone'],
            'date'          => $validatedData['date'],
            'type_patient'  => $validatedData['type_patient'],
        ]);
        toastr()->success('Add Patient Successfully!');
        return redirect()->route('view_Payment', ['selected_patient' => $patient->id]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function view_Patient()
    {
        return view('backend.patient.view_patient');
    }

    /**
     * Display the specified resource.
     */
    public function getPatientNoted(Request $request)
    {
        $patient = Patient::find($request->id);

        if ($patient) {
            return response()->json(['patient_noted' => $patient->patient_noted]);
        } else {
            return response()->json(['patient_noted' => 'No notes found.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
