<?php

namespace App\Http\Controllers\Reports;

use App\Exports\ReportExport;
use App\Exports\ReportServiceExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller
{
    public function Report(Request $request)
    {
        $security = $request->query('security');
        $page = $request->query('page');
        $generate_data = $request->query('generate_data');
        $method = $request->query('method');
        $year = $request->query('year') ?: date('Y');
        $month = $request->query('month') ?: date('m'); 
        $day = $request->query('day') ?: date('d'); 

        // Normalize the month to a two-digit format
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);

        // Convert the month number to the full month name (e.g., "August")
        $monthName = date('F', mktime(0, 0, 0, $month, 10)); // "10" is an arbitrary day in the month

        if ($security !== 'report4220tk91jf94n840') {
            return response()->json(['status' => 'error', 'message' => 'Invalid security token!']);
        }

        if ($page === 'reports' && $generate_data === 'yes') {
            try {
                // Determine which export class to use based on the method parameter
                if ($method === 'Report') {
                    $export = new ReportExport($year, $month, $day);
                } elseif ($method === 'ServiceReport') {
                    $export = new ReportServiceExport(); // Ensure ReportServiceExport doesn't need parameters
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Invalid method parameter!']);
                }

                // Generate the file name and path with month name
                $fileName = "{$method}_report_{$year}_{$monthName}_{$day}.xlsx";
                $filePath = "backend/assets/reports/$fileName";  // Path relative to `storage/app/public`

                // Store the Excel file in the specified directory
                Excel::store($export, $filePath, 'public');

                // Generate a dynamic download URL
                $downloadUrl = url("storage/$filePath");

                return response()->json([
                    'status' => 'success',
                    'message' => 'Excel report generated successfully!',
                    'download_url' => $downloadUrl
                ]);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request parameters!']);
    }
}
