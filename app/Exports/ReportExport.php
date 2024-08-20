<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\PatientHistory;

class ReportExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    protected $year;
    protected $month;

    public function __construct($year, $month = null)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function collection()
    {
        // Define the date range
        $startDate = $this->year . '-' . ($this->month ?? '01') . '-01';
        $endDate = $this->year . '-' . ($this->month ?? '12') . '-31';

        // Fetch data from the PatientHistory model within the date range
        $patientHistories = PatientHistory::whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Initialize data storage for doctors
        $doctors = ['sokleat' => 0, 'seyha' => 0];
        $reportData = [];

        // Iterate over each patient history record
        foreach ($patientHistories as $history) {
            // Check if patient_payment is already an array, if not decode it
            $paymentData = is_array($history->patient_payment) 
                ? $history->patient_payment 
                : json_decode($history->patient_payment, true);

            // Check if the doctor field exists and matches either 'sokleat' or 'seyha'
            if (isset($paymentData['doctor']) && array_key_exists($paymentData['doctor'], $doctors)) {
                // Add the grand total to the respective doctor
                $doctors[$paymentData['doctor']] += floatval($paymentData['grand_total']);
            }
        }

        // Prepare the data for the report
        foreach ($doctors as $doctor => $total) {
            $reportData[] = [$doctor, $total];
        }

        // Add total earnings to the report
        $totalEarnings = array_sum($doctors);
        $reportData[] = ['Total', $totalEarnings];

        // Return the data as a collection
        return collect($reportData);
    }

    public function headings(): array
    {
        return ['Doctor', 'Amount Earned'];
    }

    public function styles(Worksheet $sheet)
    {
        // Apply styles to the header row
        $sheet->getStyle('A1:B1')->applyFromArray([
            'font' => [
                'bold' => true
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => 'FFCCCCCC']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ]
        ]);

        // Apply styles to the data rows
        $sheet->getStyle('A2:B' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => 'FFFFFFFF']
            ]
        ]);

        // Apply alternating row colors
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($row % 2 == 0) {
                $sheet->getStyle('A' . $row . ':B' . $row)->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FFEEEEEE']
                    ]
                ]);
            }
        }

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(20);
    }

    public function title(): string
    {
        return 'Doctor Earnings Report';
    }
}
