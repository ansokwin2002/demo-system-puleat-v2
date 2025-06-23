<?php

namespace App\Exports;

use App\Models\CompletedTreatmentData;
use App\Models\Doctor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    FromArray,
    WithHeadings,
    WithStyles,
    ShouldAutoSize
};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class DoctorMonthlyRevenueExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $doctorId;
    protected $startDate;
    protected $endDate;

    protected $days;
    protected $totals;
    protected $totalSum;

    public function __construct($doctorId, $startDate, $endDate)
    {
        $this->doctorId = $doctorId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function array(): array
    {
        $doctor = Doctor::find($this->doctorId);
        $start = new \DateTime($this->startDate);
        $end = new \DateTime($this->endDate);
        $interval = new \DateInterval('P1D');
        $period = new \DatePeriod($start, $interval, $end->modify('+1 day'));

        $this->days = [];
        $this->totals = [];

        foreach ($period as $date) {
            $day = $date->format('Y-m-d');
            $this->days[] = $day;
            $this->totals[$day] = 0;
        }

        $records = CompletedTreatmentData::all();

        foreach ($records as $record) {
            $json = is_string($record->json_data)
                ? json_decode($record->json_data, true)
                : $record->json_data;

            if (!isset($json['update_customer_info'][0])) continue;

            $info = $json['update_customer_info'][0];
            if ($info['doctor'] != $this->doctorId) continue;

            $date = $info['start_date'];
            if (isset($this->totals[$date])) {
                $this->totals[$date] += floatval($json['grand_total'] ?? 0);
            }
        }
        $row = [$doctor->name ?? 'Unknown Doctor'];
        $sum = 0;
        foreach ($this->days as $day) {
            $amount = $this->totals[$day];
            $row[] = '$' . number_format($amount, 2);
            $sum += $amount;
        }
        $row[] = '$' . number_format($sum, 2);

        $this->totalSum = $sum;

        return [$row];
    }

    public function headings(): array
    {
        if (empty($this->days)) {
            $start = new \DateTime($this->startDate);
            $end = new \DateTime($this->endDate);
            $interval = new \DateInterval('P1D');
            $period = new \DatePeriod($start, $interval, $end->modify('+1 day'));

            $this->days = [];
            foreach ($period as $date) {
                $this->days[] = $date->format('Y-m-d');
            }
        }

        $headings = ['Doctor'];
        foreach ($this->days as $date) {
            $headings[] = date('d', strtotime($date)); // Only day (e.g., "21")
        }
        $headings[] = 'Total';
        return $headings;
    }

    public function styles(Worksheet $sheet)
    {
        $columnCount = count($this->days) + 2; // +2 for Doctor + Total
        $lastColumnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount);

        // Header style (row 1)
        $sheet->getStyle("A1:{$lastColumnLetter}1")->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '87CEEB'] // Sky Blue
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
        ]);

        // Data row style (row 2)
        $sheet->getStyle("A2:{$lastColumnLetter}2")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D3D3D3'] // Light gray
            ],
        ]);

        // Total cell (last column in row 2)
        $sheet->getStyle("{$lastColumnLetter}2")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FF6347'] // Tomato Red
            ],
            'font' => ['bold' => true]
        ]);
    }
}
