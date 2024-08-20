<?php

namespace App\Http\Controllers\Reports;

use App\Exports\ReportServiceExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportServiceController extends Controller
{
    public function Report(Request $request)
    {
        $security = $request->query('security');
        $page = $request->query('page');
        $generate_data = $request->query('generate_data');
        $method = $request->query('method');
        $year = $request->query('year') ?? date('Y');
        $month = $request->query('month') ?? date('m');

        if ($security !== 'report4220tk91jf94n840') {
            return response()->json(['status' => 'error', 'message' => 'Invalid security token!']);
        }

        if ($page === 'reports' && $generate_data === 'yes' && $method === 'Report') {
            // Normalize the month to a two-digit format
            $month = str_pad($month, 2, '0', STR_PAD_LEFT);

            // Convert the month number to the full month name (e.g., "August")
            $monthName = date('F', mktime(0, 0, 0, $month, 10)); // "10" is an arbitrary day in the month

            // Generate the file name and path using the full month name
            $fileName = "monthly_report_type_service_{$year}_{$monthName}.xlsx";
            $filePath = "backend/assets/reports/$fileName";

            try {
                // Store the Excel file in the specified directory
                Excel::store(new ReportServiceExport($year, $month), $filePath, 'public');

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
