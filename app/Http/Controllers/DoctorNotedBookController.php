<?php

namespace App\Http\Controllers;

use App\Models\DoctorNotedBook;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoctorNotedBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        // Fetch doctor notebooks filtered by patient ID
        $doctorNotebooks = DoctorNotedBook::with('doctor')
            ->where('patient_id', $id)  // Filter notebooks by the patient ID
            ->orderBy('id', 'desc')
            ->get();
    
        // Format the notebooks
        $formattedNotebooks = $doctorNotebooks->map(function ($notebook) {
            return [
                'id' => $notebook->id,
                'date' => $notebook->date,
                'doctor_name' => $notebook->doctor ? $notebook->doctor->name : 'N/A',
                'description' => $notebook->description,
            ];
        });
    
        // Return the response in JSON format
        return response()->json($formattedNotebooks);
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'date' => 'required|date',
            'doctor_id' => 'required',
            'description' => 'required|string',
        ]);
    
        $doctorNotedBook = DoctorNotedBook::create([
            'patient_id' => $request->input('patient_id'),
            'date' => $request->input('date'),
            'doctor_id' => $request->input('doctor_id'),
            'description' => $request->input('description'),
        ]);
    
        // Include doctor's name (assuming relationship is set)
        $doctorNotedBook->load('doctor');
    
        return response()->json([
            'id' => $doctorNotedBook->id,
            'date' => $doctorNotedBook->date,
            'doctor_name' => $doctorNotedBook->doctor->name,
            'description' => $doctorNotedBook->description,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming data (you can adjust the rules as needed)
        $request->validate([
            'date' => 'required|date',
            'doctor_id' => 'required|exists:doctors,id', // Ensure the doctor exists
            'description' => 'required|string', // Make sure description is present
        ]);

        // Find the doctor notebook by its ID
        $doctorNotebook = DoctorNotedBook::findOrFail($id);

        // Update the doctor notebook with new data
        $doctorNotebook->date = $request->input('date');
        $doctorNotebook->doctor_id = $request->input('doctor_id');
        $doctorNotebook->description = $request->input('description');

        // Save the changes
        $doctorNotebook->save();
        // Redirect or return a response (you can customize the redirect as needed)
        return redirect()->back()
        ->with('active_tab', 'doctor-notebook') 
        ->with('success', 'Doctor Notebook updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Try to find the DoctorNotedBook by ID
        $doctorNotedBook = DoctorNotedBook::find($id);
    
        if ($doctorNotedBook) {
            // Delete the found DoctorNotedBook
            $doctorNotedBook->delete();
    
            // Return a JSON response indicating success
            return response()->json([
                'success' => true,
                'message' => 'Doctor Notebook deleted successfully!',
            ]);
        } else {
            // If the DoctorNotedBook is not found, return an error
            return response()->json([
                'success' => false,
                'message' => 'Doctor Notebook not found!',
            ], 404);
        }
    }
    
}
