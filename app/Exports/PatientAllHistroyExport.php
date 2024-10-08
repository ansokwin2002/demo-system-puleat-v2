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
        // Return the prepared collection for export
        return collect($this->exportData);
    }

    public function headings(): array
    {
        // Define the headings for your Excel sheet
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
            'Amount Paid',
            'Grand Total',
            'Amount Unpaid',
            'Type Service',
            'Patient Noted',
            'Next Appointment Date',
        ];
    }

    public function map($row): array
    {
        static $counter = 0;
        $counter++;
        $discountDollar = isset($row['discount_dollar']) && is_numeric($row['discount_dollar']) ? $row['discount_dollar'] : 0;
        $discountPercent = isset($row['discount_percent']) && is_numeric($row['discount_percent']) ? $row['discount_percent'] : 0;
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
            $discountDollar, 
            $discountPercent,
            $row['amount_paid'] ?? 0,
            $row['grand_total'] ?? 0, 
            $row['amount_unpaid'] ?? 0, 
            $row['type_service'] ?? '',
            $row['patient_noted'] ?? '', 
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
                    'color' => ['rgb' => 'CCCCCC'], // Black border color
                ],
            ],
        ];
    
        $sheet->getStyle('A1:Q1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(40);
    
        // Set column widths
        $columnWidths = [
            'A' => 10,  // ID
            'B' => 20,  // Date
            'C' => 35,  // Patient Name
            'D' => 20,  // Doctor Name
            'E' => 20,  // Cashier Name
            'F' => 40,  // Service Name
            'G' => 20,  // Subtotal
            'H' => 10,  // Unit
            'I' => 15,  // Price
            'J' => 15,  // Discount Dollar
            'K' => 20,  // Discount Percent
            'L' => 15,  // Amount Paid
            'M' => 20,  // Grand Total
            'N' => 20,  // Amount Unpaid
            'O' => 30,  // Type Service
            'P' => 90,  // Patient Noted
            'Q' => 30,  // Next Appointment Date
        ];
    
        foreach ($columnWidths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }

        $sheet->getStyle('F:F')->getAlignment()->setWrapText(true); // Service Name
        $sheet->getStyle('P:P')->getAlignment()->setWrapText(true); // Patient Noted
    
        // Manage merging based on patient ID changes
        $highestRow = $sheet->getHighestRow();
        $mergeStartRow = 2;  // Initial start row for merging
        $lastPatientID = $sheet->getCell('A2')->getValue(); // Initial Patient ID
    
        for ($rowIndex = 3; $rowIndex <= $highestRow + 1; $rowIndex++) {
            $currentPatientID = ($rowIndex <= $highestRow) ? $sheet->getCell('A' . $rowIndex)->getValue() : null;
    
            // Check if we should end merging
            if ($currentPatientID != $lastPatientID) {
                foreach (['A', 'B', 'C', 'D', 'E', 'L', 'M', 'N', 'O', 'P', 'Q'] as $column) {
                    $sheet->mergeCells($column . $mergeStartRow . ':' . $column . ($rowIndex - 1));
                }
                $mergeStartRow = $rowIndex;  // Reset merge start row to current
            }
    
            $lastPatientID = $currentPatientID; // Update the last patient ID processed
        }
    
        // Style alternating row colors and apply general styling
        for ($rowIndex = 2; $rowIndex <= $highestRow; $rowIndex++) {
            $fillColor = ($rowIndex % 2 == 0) ? 'F2F2F2' : 'FFFFFF';  // Alternating row colors
            $sheet->getStyle('A' . $rowIndex . ':Q' . $rowIndex)->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => $fillColor],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC'], // Black border color
                    ],
                ],
            ]);
    
            $sheet->getRowDimension($rowIndex)->setRowHeight(50);  // Set row height
        }
    
        // Apply number formats
        $sheet->getStyle('G:G')->getNumberFormat()->setFormatCode('$#,##0.00'); // Subtotal
        $sheet->getStyle('I:I')->getNumberFormat()->setFormatCode('$#,##0.00'); // Price
        $sheet->getStyle('J:J')->getNumberFormat()->setFormatCode('$#,##0.00'); // Discount Dollar
        $sheet->getStyle('L:L')->getNumberFormat()->setFormatCode('$#,##0.00'); // Amount Paid
        $sheet->getStyle('M:M')->getNumberFormat()->setFormatCode('$#,##0.00'); // Grand Total
        $sheet->getStyle('N:N')->getNumberFormat()->setFormatCode('$#,##0.00'); // Amount Unpaid
        $sheet->getStyle('K:K')->getNumberFormat()->setFormatCode('0.00%'); // Discount Percent
    }
    


}
