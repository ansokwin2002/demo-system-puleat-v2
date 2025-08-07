<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PatientAllHistroyExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $exportData;

    public function __construct($exportData)
    {
        $this->exportData = $exportData;
    }

    public function collection()
    {
        return collect($this->exportData);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Date',
            'Patient Name',
            'Doctor Name',
            'Cashier Name',
            'Service Name',
            'Subtotal',
            'Unit',
            'Price',
            'Discount Dollar',
            'Discount Percent',
            'Grand Total',
            'Type Service',
            'Next Appointment Date',
        ];
    }

    public function map($row): array
    {
        static $counter = 0;
        $counter++;

        return [
            $counter,
            $row['date'] ?? '',
            $row['customer'] ?? '',
            $row['doctor_name'] ?? '',
            $row['cashier_name'] ?? '',
            $row['service_name'] ?? '',
            $row['subtotal'] ?? 0,
            $row['service_unit'] ?? 0,
            $row['service_price'] ?? 0,
            $row['discount_dollar'] ?? 0,
            $row['discount_percent'] ?? 0, // ✅ Keep original value (e.g. 50 for 50%)
            $row['grand_total'] ?? 0,
            $row['type_service'] ?? '',
            $row['next_appointment_date'] ?? '',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $headerStyle = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '6372E6'],
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'],
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
        ];

        $sheet->getStyle('A1:N1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(40);

        $columnWidths = [
            'A' => 10, 'B' => 20, 'C' => 35, 'D' => 20, 'E' => 20,
            'F' => 40, 'G' => 20, 'H' => 10, 'I' => 15, 'J' => 15,
            'K' => 20, 'L' => 20, 'M' => 30, 'N' => 30,
        ];

        foreach ($columnWidths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }

        $sheet->getStyle('F:F')->getAlignment()->setWrapText(true);

        $highestRow = $sheet->getHighestRow();
        $mergeStartRow = 2;
        $lastPatientID = $sheet->getCell('A2')->getValue();

        for ($rowIndex = 3; $rowIndex <= $highestRow + 1; $rowIndex++) {
            $currentPatientID = ($rowIndex <= $highestRow) ? $sheet->getCell('A' . $rowIndex)->getValue() : null;

            if ($currentPatientID != $lastPatientID) {
                foreach (['A', 'B', 'C', 'D', 'E', 'L', 'M', 'N'] as $column) {
                    $sheet->mergeCells($column . $mergeStartRow . ':' . $column . ($rowIndex - 1));
                }
                $mergeStartRow = $rowIndex;
            }

            $lastPatientID = $currentPatientID;
        }

        for ($rowIndex = 2; $rowIndex <= $highestRow; $rowIndex++) {
            $fillColor = ($rowIndex % 2 == 0) ? 'F2F2F2' : 'FFFFFF';

            $sheet->getStyle("A{$rowIndex}:N{$rowIndex}")->applyFromArray([
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $fillColor]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
            ]);

            $sheet->getRowDimension($rowIndex)->setRowHeight(50);
        }

        // ✅ Proper number formats
        $sheet->getStyle('G:G')->getNumberFormat()->setFormatCode('$#,##0.00'); // Subtotal
        $sheet->getStyle('I:I')->getNumberFormat()->setFormatCode('$#,##0.00'); // Price
        $sheet->getStyle('J:J')->getNumberFormat()->setFormatCode('$#,##0.00'); // Discount Dollar
        $sheet->getStyle('L:L')->getNumberFormat()->setFormatCode('$#,##0.00'); // Grand Total
        $sheet->getStyle('K:K')->getNumberFormat()->setFormatCode('0%'); // ✅ Format like: 50 → 50%
    }
}
