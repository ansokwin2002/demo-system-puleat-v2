<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class Api_PatientController extends Controller
{
    public function index()
    {
        try {
            $patients = Patient::all();

            if ($patients->isEmpty()) {
                return response()->json([
                    'status' => true,
                    'message' => 'No patients found',
                    'data' => [],
                ], 200);
            }

            return response()->json([
                'status' => true,
                'message' => 'Patients retrieved successfully',
                'data' => $patients,
                'count' => $patients->count(),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve patients',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'age' => 'required|integer',
                'sex' => 'required|string',
                'address' => 'nullable|string',
                'telephone' => 'nullable|string|max:20',
                'date' => 'required|date',
                'type_patient' => 'nullable|string',
                'type_payment' => 'required|string|max:255', 
            ]);

            $patient = Patient::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Patient created successfully',
                'data' => $patient,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong while creating the patient',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $patient = Patient::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'age' => 'required|integer',
                'sex' => 'required|string|in:male,female',
                'address' => 'nullable|string|max:255',
                'telephone' => 'nullable|string|max:20',
                'date' => 'required|date',
                'type_patient' => 'nullable|string|max:255',
                'type_payment' => 'required|string|max:255', 
            ]);

            $patient->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Patient updated successfully',
                'data' => $patient,
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Patient not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $patient = Patient::findOrFail($id);
            $patient->delete();

            return response()->json([
                'status' => true,
                'message' => 'Patient deleted successfully',
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Patient not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $patient = Patient::findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Patient retrieved successfully',
                'data' => $patient,
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Patient not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}
