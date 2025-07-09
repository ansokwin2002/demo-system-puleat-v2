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


}
