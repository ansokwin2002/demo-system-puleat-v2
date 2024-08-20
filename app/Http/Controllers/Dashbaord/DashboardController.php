<?php

namespace App\Http\Controllers\Dashbaord;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function dashboard()
    // {
    //     return view('backend.dashboard');
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function dashboard()
    {
        $currentYear = date('Y'); // Get the current year
    
        // Query to count the number of patients per month for the current year
        $monthlyPatientCounts = Patient::select(DB::raw('LPAD(MONTH(date), 2, "0") as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('date', $currentYear)
            ->groupBy(DB::raw('month'))
            ->orderBy(DB::raw('month'))
            ->pluck('count', 'month')
            ->toArray();
    
        // Map month numbers to names using strings as keys
        $months = [
            '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
            '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
            '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
        ];
    
        // Initialize an empty array to hold the final ordered patient counts
        $orderedPatientCounts = [];
    
        // Loop through the months and assign counts from the query, or 0 if no data exists
        foreach ($months as $key => $monthName) {
            $orderedPatientCounts[$monthName] = $monthlyPatientCounts[$key] ?? 0;
        }
    
        // Output the final array for debugging purposes
        // dd($orderedPatientCounts);
    
        return view('backend.dashboard', [
            'monthlyPatientCounts' => $orderedPatientCounts
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
