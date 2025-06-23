<?php

namespace App\Http\Controllers;

use App\Exports\DoctorMonthlyRevenueExport;
use App\Models\DoctorReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class DoctorReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // [Page_title----------------------------------]
            $pageTitle = 'Doctor Report | Laor-Prornit-Clinic-Dental';
        // [Page_title----------------------------------]
        return view('backend.reports.doctor.index',compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */

public function exportDoctorMonthly(Request $request)
{
    $doctorId = $request->query('doctor_id');
    $startDate = $request->query('start_date');
    $endDate = $request->query('end_date');

    if (!$startDate || !$endDate) {
        return response()->json(['error' => 'Missing date range'], 400);
    }

    try {
        return Excel::download(
            new DoctorMonthlyRevenueExport($doctorId, \Carbon\Carbon::parse($startDate), \Carbon\Carbon::parse($endDate)),
            'doctor_monthly_revenue_report.xlsx'
        );
    } catch (\Exception $e) {
        Log::error('Export Failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json(['error' => 'Export failed'], 500);
    }
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
    public function show(DoctorReport $doctorReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorReport $doctorReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DoctorReport $doctorReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorReport $doctorReport)
    {
        //
    }
}
