<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ModelSalary;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RecapSalary extends BaseController
{
    protected $modelSalary;

    public function __construct()
    {
        $this->modelSalary = new ModelSalary();
    }

    public function index()
    {
        helper('form');

        $salary = $this->modelSalary->getSalary();

        $data = [
            'title' => 'Rekap Gaji | PT Four Best Synergy',
            'salary' => $salary
        ];

        return view('pages/admin/recap_salary/index', $data);
    }

    public function downloadByMonth()
    {
        $monthYear = $this->request->getVar('month');

        if (empty($monthYear)) {
            return redirect()->back()->withInput()->with('error', 'Bulan dan tahun harus diisi.');
        }

        $dateTime = DateTime::createFromFormat('Y-m', $monthYear);
        $startTime = $dateTime->format('Y-m-01 00:00:00');
        $endTime = $dateTime->format('Y-m-t 23:59:59');

        $salary = $this->modelSalary->getSalaryByMonth($startTime, $endTime);
        if (!$salary) {
            return redirect()->back()->withInput()->with('error', 'Tidak ada gaji pada bulan yang dipilih.');
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIK');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Posisi');
        $sheet->setCellValue('E1', 'Gaji Awal');
        $sheet->setCellValue('F1', 'Potongan');
        $sheet->setCellValue('G1', 'Hasil Gaji Setelah Potongan');

        $column = 2;
        foreach ($salary as $key => $value) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $value['nik']);
            $sheet->setCellValue('C' . $column, $value['name']);
            $sheet->setCellValue('D' . $column, $value['position']);
            $sheet->setCellValue('E' . $column, $value['salary']);
            $sheet->setCellValue('F' . $column, $value['charge']);

            $totalSalary = $value['salary'] - $value['charge'];
            $sheet->setCellValue('G' . $column, $totalSalary);

            $column++;
        }

        $verticalCenterStyle = $sheet->getStyle('A:G')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $headerFontStyle = $sheet->getStyle('A1:G1')
            ->getFont()
            ->setBold(true);

        $headerFillStyle = $sheet->getStyle('A1:G1')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\FILL::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');

        $borderStyleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $sheet->getStyle('A1:G' . ($column - 1))
            ->applyFromArray($borderStyleArray);

        $columnsToAutoSize = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        foreach ($columnsToAutoSize as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $columnsToCenter = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        foreach ($columnsToCenter as $column) {
            $sheet->getStyle($column)
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }

        $filename = "Rekap_Gaji_$monthYear.xlsx";
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();

    }
}
