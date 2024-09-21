<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientHistory;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add_Patient()
    {
        // [Page_title----------------------------------]
            $pageTitle = 'Add Patient | Laor-Prornit-Clinic-Dental';
        // [Page_title----------------------------------]
        return view('backend.patient.add_patient',compact('pageTitle'));
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
        // [Page_title----------------------------------]
            $pageTitle = 'List Patient | Laor-Prornit-Clinic-Dental';
        // [Page_title----------------------------------]
        return view('backend.patient.view_patient',compact('pageTitle'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'age'          => 'required|numeric|min:0',
            'sex'          => 'required|string|max:10',
            'address'      => 'required|string|max:255',
            'telephone'    => 'required|string|max:20',
            'type_patient' => 'required|string|max:255',
        ]);

        $patient = Patient::find($id);

        if (!$patient) {
            toastr()->error('Patient not found!');
            return redirect()->back();
        }

        $patient->name         = $validatedData['name'];
        $patient->age          = $validatedData['age'];
        $patient->sex          = $validatedData['sex'];
        $patient->address      = $validatedData['address'];
        $patient->telephone    = $validatedData['telephone'];
        $patient->type_patient = $validatedData['type_patient'];
        $patient->save();

        toastr()->success('Patient updated successfully!');
        return redirect()->back();
    }

}
