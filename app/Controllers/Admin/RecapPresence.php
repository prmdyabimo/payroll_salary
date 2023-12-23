<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ModelPresences;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RecapPresence extends BaseController
{
    protected $modelPresences;

    public function __construct()
    {
        $this->modelPresences = new ModelPresences();
    }

    public function index()
    {
        helper('form');

        $presences = $this->modelPresences->getAllPresences();

        $data = [
            'title' => 'Rekap Absen | PT Four Best Synergy',
            'presences' => $presences
        ];

        return view('pages/admin/recap_presence/index', $data);
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

        $presences = $this->modelPresences->getAllPresencesByMonth($startTime, $endTime);
        if (!$presences) {
            return redirect()->back()->withInput()->with('error', 'Tidak ada absen pada bulan yang dipilih.');
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIK');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Posisi');
        $sheet->setCellValue('E1', 'Gaji Awal');
        $sheet->setCellValue('F1', 'Jumlah Terlambat');
        $sheet->setCellValue('G1', 'Jumlah Hadir');

        $column = 2;
        foreach ($presences as $key => $value) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $value['nik']);
            $sheet->setCellValue('C' . $column, $value['name']);
            $sheet->setCellValue('D' . $column, $value['position']);
            $sheet->setCellValue('E' . $column, $value['salary']);


            $statusLate = $this->getStatusPresences($value['nik'], 'MASUK', 'Terlambat', $startTime, $endTime);

            $present = $this->modelPresences
                ->select('presences.*')
                ->join('employees', 'employees.id = presences.employee_id', 'left')
                ->where('employees.nik', $value['nik'])
                ->groupStart()
                ->like('presences.mode', 'PULANG')
                ->groupEnd()
                ->where('presences.created_at >=', $startTime)
                ->where('presences.created_at <=', $endTime)
                ->findAll();

            $countStatusLate = is_array($statusLate) ? array_count_values($statusLate) : [];

            $sheet->setCellValue('F' . $column, $countStatusLate["Terlambat"] ?? 0);
            $sheet->setCellValue('G' . $column, count($present) . " / " . 30);

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

        $filename = "Rekap_Absen_$monthYear.xlsx";
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();

    }

    function getStatusPresences($nik, $mode, $status, $startTime, $endTime)
    {
        return $this->modelPresences
            ->select('presences.*, employees.nik') 
            ->join('employees', 'employees.id = presences.employee_id', 'left') 
            ->where('employees.nik', $nik) 
            ->where('presences.mode', $mode) 
            ->where('presences.status', $status) 
            ->where('presences.created_at >=', $startTime)
            ->where('presences.created_at <=', $endTime)
            ->findColumn('status');
        ;
    }

}
