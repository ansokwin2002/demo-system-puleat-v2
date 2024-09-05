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
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

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
            'Dis. Dollar',
            'Dis. Percent',
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
        // Map the data to the columns
        return [
            $row['id'], // Assuming 'id' is a key in your export data
            $row['date'],
            $row['customer'], // Patient Name
            $row['doctor_name'] ?? 'N/A', // Doctor Name
            $row['cashier_name'] ?? 'N/A', // Cashier Name
            $row['service_name'], 
            $row['subtotal'] ?? 0,
            $row['service_unit'] ?? 0,
            $row['service_price'] ?? 0,
            $row['discount_dollar'] ?? 0,
            $row['discount_percent'] ?? 0,
            $row['amount_paid'],
            $row['grand_total'],
            $row['amount_unpaid'],
            $row['type_service'],
            strip_tags($row['patient_noted'] ?? 'N/A'),
            $row['next_appointment_date'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // $logoPath = public_path('backend/assets/img/invoice/logo.png');
        // $drawing = new Drawing();
        // $drawing->setName('Logo');
        // $drawing->setDescription('Logo');
        // $drawing->setPath($logoPath);
        // $drawing->setHeight(100); 
        // $drawing->setCoordinates('A1');
        // $drawing->setOffsetX(10);
        // $drawing->setOffsetY(10); 
        // $drawing->setWorksheet($sheet);

        // $logoRowHeight = 120; 
        // $sheet->getRowDimension(1)->setRowHeight($logoRowHeight); 

        $headerStyle = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '42cef5'], 
            ],
            'font' => [
                'color' => ['rgb' => '000000'],
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            // 'borders' => [
            // 'allBorders' => [
            //     'borderStyle' => Border::BORDER_THIN,
            //     'color' => ['rgb' => '000000'], 
            // ],
            // ],
        ];

        $sheet->getStyle('A1:Q1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(40);

        $columnWidths = [
            'A' => 10,
            'B' => 20,
            'C' => 35,
            'D' => 20,
            'E' => 20,
            'F' => 40,
            'G' => 20,
            'H' => 10,
            'I' => 15,
            'J' => 15,
            'K' => 20,
            'L' => 15,
            'M' => 20,
            'N' => 20,
            'O' => 30,
            'P' => 30,
            'Q' => 30,
        ];

        foreach ($columnWidths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }

        $sheet->getStyle('P')->getAlignment()->setWrapText(true);
        $sheet->getStyle('F')->getAlignment()->setWrapText(true);

        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(35);

            $fillColor = ($row % 2 == 0) ? 'F2F2F2' : 'FFFFFF';
            $sheet->getStyle('A' . $row . ':Q' . $row)->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => $fillColor],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);
        }
        $sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

}