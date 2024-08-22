<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.doctors.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:doctors,phone',
            'email' => 'required|email|unique:doctors,email',
        ]);
    
        try {
            $doctor = new Doctor();
            $doctor->name = $validatedData['name'];
            $doctor->specialization = $validatedData['specialization'];
            $doctor->phone = $validatedData['phone'];
            $doctor->email = $validatedData['email'];
            $doctor->save();
            toastr()->success('Doctor Added Successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error('Error occurred while adding the doctor.');
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
