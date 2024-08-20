<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithFormatting;
use App\Models\Patient;
use App\Models\PatientHistory;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ReportServiceExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * Fetch and sum data related to 'General', 'Implant', and 'Ortho' services.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Initialize arrays to store totals by service type and month
        $serviceTotals = [
            'General' => [],
            'Implant' => [],
            'Ortho' => []
        ];

        // Fetch patients with the specified type_service
        $patients = Patient::whereIn('type_service', ['General', 'Implant', 'Ortho'])->get();

        foreach ($patients as $patient) {
            // Get the related patient histories
            $patientHistories = PatientHistory::where('patient_id', $patient->id)->get();

            foreach ($patientHistories as $history) {
                $paymentData = is_array($history->patient_payment)
                    ? $history->patient_payment
                    : json_decode($history->patient_payment, true);

                // Extract date and format it
                $date = \Carbon\Carbon::parse($paymentData['date']);
                $month = $date->format('F Y'); // Full month name and year

                // Initialize the month array if it doesn't exist
                if (!isset($serviceTotals[$patient->type_service][$month])) {
                    $serviceTotals[$patient->type_service][$month] = 0;
                }

                // Add the amount paid to the service totals
                $serviceTotals[$patient->type_service][$month] += floatval($paymentData['grand_total']);
            }
        }

        // Prepare the data for export
        $reportData = [];
        foreach ($serviceTotals as $serviceType => $months) {
            foreach ($months as $month => $total) {
                $reportData[] = [
                    'Service Type' => $serviceType,
                    'Month' => $month,
                    'Total Amount' => number_format($total, 2)
                ];
            }
        }

        // Convert the data to a collection for Excel export
        return collect([
            ['Service Type', 'Month', 'Total Amount']
        ])->merge($reportData);
    }

    /**
     * Set the headings for the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return ['Service Type', 'Month', 'Total Amount'];
    }

    /**
     * Apply styles to the Excel sheet.
     *
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
     * @return void
     */
    public function styles($sheet)
    {
        // Apply a header style
        $sheet->getStyle('A1:C1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4F81BD'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        // Apply alternate row color
        $sheet->getStyle('A2:C' . ($sheet->getHighestRow()))->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFF2F2F2'],
            ],
        ])->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(30);
    }
}
