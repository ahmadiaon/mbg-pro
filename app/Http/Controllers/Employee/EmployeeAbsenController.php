<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Aktivity\Aktivity;
use App\Models\DatabaseData;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeOut;
use App\Models\StatusAbsen;
use App\Models\Support\DatabaseDataKehadiran;
use App\Models\Support\DatabaseDataPersetujuan;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EmployeeAbsenController extends Controller
{
    public function index()
    {
        // $date_start_absen_arr = ResponseFormatter::excelToDateArray('2022-1-1');
        // dd($date_start_absen_arr);
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'list-employees-absensi'
        ];
        $data_emp = Employee::join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->leftJoin('employee_salaries', 'employee_salaries.employee_uuid', '=', 'employees.uuid')
            ->leftJoin('companies', 'companies.uuid', 'employees.company_uuid')
            ->leftJoin('positions', 'positions.uuid', '=', 'employees.position_uuid')
            ->leftJoin('departments', 'departments.uuid', '=', 'employees.department_uuid')
            ->leftJoin('user_addresses', 'user_addresses.user_detail_uuid', '=', 'employees.user_detail_uuid')
            ->whereNull('employees.date_end')
            ->whereNull('user_details.date_end')
            ->whereNull('user_addresses.date_end')
            ->whereNull('employee_salaries.date_end')
            ->where('employees.employee_status', '!=', 'talent')
            ->get([
                'user_details.name',
                // 'user_details.photo_path',
                // 'companies.company',
                'positions.position',
                // 'employee_salaries.hour_meter_price_uuid',
                // 'user_addresses.*',
                'employees.*'
            ]);
        $employees = [];
        $company = ['MBLE', 'MB', 'BK', 'MBET', 'ISS'];



        $found_it = [];
        foreach ($data_emp as $aa) {
            if (array_search($aa->company_uuid, $company, false) == false) {
                $found_it['200'][$aa->company_uuid][$aa->nik_employee] = array_search($aa->company_uuid, $company, false);
            } else {
                $found_it['404'][$aa->company_uuid][$aa->nik_employee] = array_search($aa->company_uuid, $company, false);
            }
            $employees[] = $aa->nik_employee;
        }
        $here_iam = $data_emp->where('position', 'DT DRIVER PRODUCTION');

        // var_dump($found_it);die;

        $data_employee_absen_detail = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
            ->where('employee_absens.date', '>=',  '2023-09-01')
            ->where('employee_absens.date', '<=',  '2023-09-30')
            // ->where('employee_absens.employee_uuid', 'MBLE-0422003')
            ->get([
                'status_absens.*',
                'employee_absens.*',
                'employee_absens.uuid as uuid',
            ]);

        $company = ['MBLE', 'MB', 'BK', 'MBET', 'ISS'];
        $found_it = [];
        foreach ($data_employee_absen_detail as $item) {
            if (!empty($item)) {
                if (array_search($item->employee_uuid, $employees, true) == true) {
                    $found_it['found'][$item->employee_uuid] = $item->employee_uuid;
                }
            } else {
                $found_it['404'][$item->employee_uuid] = $item->employee_uuid;
            }
        }



        return view('employee.absensi.index_', [
            'title'         => 'Absensi Karyawan',
            'layout'    => $layout
        ]);
    }


    public function export($year_month)
    {
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $month = (int)$month;
        $datetime = Carbon::createFromFormat('Y-m', $year . '-' . $month);
        $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');
        $employees = Employee::data_employee();
        $months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR'];
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A2', 'Absensi Bulan' . $months[(int)$month] . '-' . $year);
        $createSheet->setCellValue('A4', 'Nama');
        $createSheet->setCellValue('B4', 'NIK');
        $createSheet->setCellValue('C4', 'JABATAN');
        $createSheet
            ->getStyle('C4')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('ffffff');
        for ($i = 1; $i <= $day_month; $i++) {
            $createSheet->setCellValue($abjads[$i + 3] . '4', $year_month . '-' . $i);
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $year_month . '-' . rand(99, 9999) . 'file.xlsx';
        $cell = 5;
        foreach ($employees as $employee) {
            $absens = EmployeeAbsen::where('employee_uuid', $employee->machine_id)
                ->whereYear('employee_absens.date', $year)
                ->whereMonth('employee_absens.date', $month)
                ->orderBy('employee_absens.date', 'asc')
                ->get();
            $employee->absen = $absens;
            $createSheet->setCellValue('A' . $cell, $employee->name);
            $createSheet->setCellValue('B' . $cell, $employee->nik_employee);
            $createSheet->setCellValue('C' . $cell, $employee->position);
            $cell_absen = 1;
            foreach ($absens as $item) {
                // if($employee->machine_id == "ItaNorrahmahMedic" ){
                //     dd($absens);die;
                // }
                $createSheet->setCellValue($abjads[$cell_absen + 3] . $cell, $item->status_absen_uuid);
                $cell_absen++;
            }
            $cell++;
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $year_month . '-' . rand(99, 9999) . 'file.xlsx';
        // return $name;
        $crateWriter->save($name);

        return response()->download($name);
    }

    public function dialyReportWeb(Request $request)
    {

        $validateData = $request->all();
        $date = $validateData['date_dialy'];
        $prevDate = date('Y-m-d', strtotime($date . ' -1 day'));  // Mengurangi satu hari
        $Q_DATA_ABSENSI_TANGGAL_SEBELUM = EmployeeAbsen::where('employee_absens.date', $prevDate)->get();
        $Q_DATA_ABSENSI_TANGGAL_HARI_INI = EmployeeAbsen::where('employee_absens.date', $validateData['date_dialy'])->get();


        $D_ABSENSI_TANGGAL_HARI_INI = [];
        if ($Q_DATA_ABSENSI_TANGGAL_HARI_INI) {
            foreach ($Q_DATA_ABSENSI_TANGGAL_HARI_INI as $I_DATA_ABSENSI_TANGGAL_HARI_INI)
                $D_ABSENSI_TANGGAL_HARI_INI[$I_DATA_ABSENSI_TANGGAL_HARI_INI->employee_uuid] = $I_DATA_ABSENSI_TANGGAL_HARI_INI;
        }

        $validateData['db'] = session('db_local_storage');
        $karyawan_public = $validateData['db']['public']['public_value']['KARYAWAN'];




        $abjads = ResponseFormatter::abjads();
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
        $row = 9;

        $createSheet->getPageMargins()->setTop(0.5);      // Top margin of 0.5 inches
        $createSheet->getPageMargins()->setBottom(0.5);   // Bottom margin of 0.5 inches
        $createSheet->getPageMargins()->setLeft(0.7);    // Left margin of 0.75 inches
        $createSheet->getPageMargins()->setRight(0.1);


        $styleArray_header = [
            'font' => [
                'bold' => true,      // Set to false to remove bold; change to true if you want bold text
                'size' => 7,         // Set the font size
                'name' => 'Calibri',    // Set the font name
                'color' => ['rgb' => '000000'] // Set font color (black in this example)
            ],
            'alignment' => [
                'wrapText' => true,  // Enable text wrapping
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,  // Center horizontally
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,      // Center vertically
            ],

            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,  // Set border style (e.g., thin)
                    'color' => ['rgb' => '000000'],  // Border color (black in this example)
                ],
            ],
        ];
        $styleArray_TITLE = [
            'font' => [
                'bold' => true,      // Set to false to remove bold; change to true if you want bold text
                'size' => 24,         // Set the font size
                'name' => 'Calibri',    // Set the font name
                'color' => ['rgb' => '000000'] // Set font color (black in this example)
            ],
            'alignment' => [
                'wrapText' => true,  // Enable text wrapping
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,  // Center horizontally
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,      // Center vertically
            ],

        ];

        $createSheet->setCellValue('A1', 'LAPORAN HARIAN ABSENSI');
        $createSheet->setCellValue('A2', $validateData['date_dialy']);
        $createSheet->mergeCells('A1:Q1');
        $createSheet->mergeCells('A2:Q2');
        $createSheet->getStyle('A1:Q1')->applyFromArray($styleArray_TITLE);
        $createSheet->getStyle('A2:Q2')->applyFromArray($styleArray_TITLE);

        $col = 0;
        $createSheet->setCellValue($abjads[$col] . $row, 'No.');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(3);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'NRP');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(15);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'NAMA');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(14);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'POSISI');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(12);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'DIVISI');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(12);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'DEPARTEMEN');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(12);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'TANGGAL');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(9);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'SHIFT');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(4);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'IN');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(4);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'MID');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(4);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'OUT');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(4);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'Total Late');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(4);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'Total Work');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(4);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'Point Late');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(4);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'Tidak Dibayar');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(10);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'Status ABSEN');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(5);
        $col++;
        $createSheet->setCellValue($abjads[$col] . $row, 'KETERANGAN');
        $createSheet->getColumnDimension($abjads[$col])->setWidth(15);

        $createSheet->getStyle('A9:' . $abjads[$col] . '9')->applyFromArray($styleArray_header);

        $styleArray_header['font']['bold'] = false;
        foreach ($validateData['default_filter_absensi']['KARYAWAN'] as $NRP) {
            $row++;
            $createSheet->setCellValue('B' . $row, $karyawan_public[$NRP]['NRP']);
            $createSheet->setCellValue('C' . $row, $karyawan_public[$NRP]['NAMA-KARYAWAN']);
            $createSheet->setCellValue('D' . $row, $karyawan_public[$NRP]['JABATAN']);
            $createSheet->setCellValue('E' . $row, $karyawan_public[$NRP]['DIVISI']);
            $createSheet->setCellValue('F' . $row, $karyawan_public[$NRP]['DEPARTEMEN']);
            $createSheet->setCellValue('G' . $row, $validateData['date_dialy']);
            if (!empty($D_ABSENSI_TANGGAL_HARI_INI[$NRP])) {
                $createSheet->setCellValue('H' . $row, $D_ABSENSI_TANGGAL_HARI_INI[$NRP]['shift']);
                $createSheet->setCellValue('I' . $row, $D_ABSENSI_TANGGAL_HARI_INI[$NRP]['entry']);
                $createSheet->setCellValue('J' . $row, $D_ABSENSI_TANGGAL_HARI_INI[$NRP]['mid']);
                $createSheet->setCellValue('K' . $row, $D_ABSENSI_TANGGAL_HARI_INI[$NRP]['exit']);
                $createSheet->setCellValue('L' . $row, $D_ABSENSI_TANGGAL_HARI_INI[$NRP]['late_minutes']);
                $createSheet->setCellValue('M' . $row, $D_ABSENSI_TANGGAL_HARI_INI[$NRP]['working_hours']);
                $createSheet->setCellValue('N' . $row, $D_ABSENSI_TANGGAL_HARI_INI[$NRP]['late_points']);
                $createSheet->setCellValue('O' . $row, '=12500*M' . $row);
                $createSheet->setCellValue('P' . $row, $D_ABSENSI_TANGGAL_HARI_INI[$NRP]['status_absen_uuid']);
                $createSheet->setCellValue('Q' . $row, $D_ABSENSI_TANGGAL_HARI_INI[$NRP]['absen_description']);
            }
        }
        $createSheet->getStyle('A9:' . $abjads[$col] . $row)->applyFromArray($styleArray_header);

        // Set the print layout options
        $createSheet->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE) // Set orientation
            ->setFitToPage(true) // Fit to page
            ->setFitToWidth(1) // Fit to width of one page
            ->setFitToHeight(0);

        // $crateWriter = new Xls($createSpreadsheet);
        $crateWriter = new Xlsx($createSpreadsheet);
        $name = 'file/absensi/' .  'DAILY REPORT -' . rand(99, 9999) . 'file.xlsx';
        $crateWriter->save($name);

        return ResponseFormatter::toJson($name, $D_ABSENSI_TANGGAL_HARI_INI);
    }

    public function exportTemplate($year_month)
    {
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $month = (int)$month;
        $months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $datetime = Carbon::createFromFormat('Y-m', $year . '-' . $month);
        $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');
        $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];


        $status_absens = StatusAbsen::orderBy('math', 'desc')->get();
        $array_status_absens = [];
        foreach ($status_absens as $item_status_absens) {
            $array_status_absens[$item_status_absens->uuid] = $item_status_absens;
        }
        $status_absen_pay = StatusAbsen::where('math', 'pay')->get()->count();
        // return view('datatableshow', [ 'data'         => $status_absens]);

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Absen Excel');

        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B2', 'Perusahaan');
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');
        $xxxx = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '9b189b'),
                ),
            ),
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
        );


        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', 'year');

        $createSheet->setCellValue('A19', 'No.');
        $createSheet->setCellValue('B19', 'Nama');
        $createSheet->setCellValue('C19', 'NIK');
        $createSheet->setCellValue('D19', 'Jabatan');

        $status_absens_col = 1;
        $date_row = 4;
        // header table tanggal
        for ($i = 1; $i <= $day_month; $i++) {
            $createSheet->setCellValue($abjads[$i + 3] . '20', $i);
            $createSheet->getColumnDimension($abjads[$i + 3])->setWidth(4);
            $status_absens_col = 1;
            foreach ($status_absens as $item) {
                $createSheet->setCellValue($abjads[$date_row] . $status_absens_col,  $item->status_absen_code);
                $status_absens_col++;
            }

            $date_row++;
        }

        $createSheet->setCellValue('E19', ResponseFormatter::getMonthName((int)$month));
        $createSheet->mergeCells('E19:' . $abjads[$date_row - 1] . '19');
        $createSheet->mergeCells('A19:A20');
        $createSheet->mergeCells('B19:B20');
        $createSheet->mergeCells('C19:C20');
        $createSheet->mergeCells('D19:D20');

        $pay = [];
        $unpay = [];

        $employees = Employee::data_employee();

        // dd($employees->where('employees.site_uuid', 'PL')->get());
        $employee_row = 21;
        $status_absens_col_employee = $date_row;
        $arr_status_absens = [];

        foreach ($status_absens as $item) {
            $createSheet->setCellValue($abjads[$date_row] . '19',  $item->status_absen_code);
            if ($item->math == 'pay') {
                $pay[] = $abjads[$date_row];
            } else {
                $unpay[] = $abjads[$date_row];
            }
            $createSheet->mergeCells($abjads[$date_row] . '19:' . $abjads[$date_row] . '20');

            $arr_status_absens[$item->status_absen_code] = $date_row;
            $date_row++;
        }

        $createSheet->setCellValue($abjads[$date_row] . '19',  'Dibayar');
        $createSheet->setCellValue($abjads[$date_row + 1] . '19',  'Potongan');
        $createSheet->mergeCells($abjads[$date_row] . '19:' . $abjads[$date_row] . '20');
        $createSheet->mergeCells($abjads[$date_row + 1] . '19:' . $abjads[$date_row + 1] . '20');

        $styleArray = array(
            'font' => [
                'bold' => true,
            ],
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
                'inside' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '4c4ce9'
                ]
            ],
        );

        $createSheet->getStyle('A19:' . $abjads[$date_row + 1] . '20')->applyFromArray($styleArray);

        $styleArray_value = array(
            'font' => [
                'bold' => false,
            ],
            'borders' => array(
                'horizontal' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'ffffff'
                ]
            ],
        );

        $createSheet->getStyle('E21:' . $abjads[$date_row + 1] . (count($employees) + 20))->applyFromArray($styleArray_value);


        $styleArray_employee = array(
            'font' => [
                'bold' => true,
            ],
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'ffffff'
                ]
            ],
        );

        $createSheet->getStyle('A21:D' . (count($employees) + 20))->applyFromArray($styleArray_employee);

        $styleArray_value = array(
            'font' => [
                'bold' => false,
            ],
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '8b8bf3'
                ]
            ],
        );

        foreach ($employees as $employee) {

            $createSheet->setCellValue('B' . $employee_row,  $employee->name);
            $createSheet->setCellValue('C' . $employee_row,  $employee->nik_employee);
            $createSheet->setCellValue('D' . $employee_row,  $employee->position);
            // data absen
            $data_absens_employee = EmployeeAbsen::where('employee_uuid', $employee->machine_id)
                ->whereYear('employee_absens.date', $year)
                ->whereMonth('employee_absens.date', $month)
                ->orderBy('employee_absens.date', 'asc')
                ->get([

                    'employee_absens.*'
                ]);

            foreach ($data_absens_employee as $item) {
                $date_explode = explode('-', $item->date);
                // dd($item);
                $item_date = $date_explode[2] + 3;
                $createSheet->setCellValue($abjads[$item_date] . $employee_row,  $item->status_absen_uuid);
                $styleArray_value['fill']['startColor']['rgb'] = $array_status_absens[$item->status_absen_uuid]['color'];
                $createSheet->getStyle($abjads[$item_date] . $employee_row . ':' . $abjads[$item_date] . $employee_row)->applyFromArray($styleArray_value);
            }


            foreach ($arr_status_absens as $item => $value) {
                $column_start_date = 4;
                $column_end_date = $day_month + 3;

                $formula = '=COUNTIF(' . $abjads[$column_start_date] . $employee_row . ':' . $abjads[$column_end_date] . $employee_row . ',"' . $item . '")';
                $createSheet->setCellValue($abjads[$value] . $employee_row,  $formula);
            }
            // simpulan dibayar
            $formula_pay = '=SUM(';
            foreach ($pay as $p) {
                $formula_pay = $formula_pay . $p . $employee_row . ',';
            }
            $formula_pay  = rtrim($formula_pay, ",");
            $formula_pay = $formula_pay . ')';
            $formula_unpay = '=SUM(';
            foreach ($unpay as $p) {
                $formula_unpay = $formula_unpay . $p . $employee_row . ',';
            }
            $formula_unpay  = rtrim($formula_unpay, ",");
            $formula_unpay = $formula_unpay . ')';
            // dd($formula_unpay);
            $createSheet->setCellValue($abjads[$date_row] . $employee_row,  $formula_pay);
            // simpulan potongan
            $createSheet->setCellValue($abjads[$date_row + 1] . $employee_row,  $formula_unpay);
            $employee_row++;
        }

        // return view('datatableshow', [ 'data'         => $employees]);


        $createSheet->getColumnDimension('A')->setWidth(5);
        // $createSheet->getColumnDimension('B')->setWidth(38);
        $createSheet->getColumnDimension('C')->setWidth(20);
        $createSheet->getColumnDimension('D')->setWidth(40);
        $createSheet->getRowDimension('2')->setRowHeight(70);
        $createSheet->getColumnDimension('B')->setAutoSize(true);
        $createSheet->getStyle('E:AV')->getAlignment()->setHorizontal('center');



        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return response()->download($name);
    }

    public function exportAbsensiX(Request $request)
    {
        $validateData = [];
        $validateData['arr_status_absensi'] = ['OFF'];
        foreach ($validateData['arr_status_absensi'] as $item_arr_status_absensi) {
            $validateData['status_absensi'][$item_arr_status_absensi] = 'xx';
        }
        $validateData['filter']['date_filter']['date_start_filter_absen'] = '2023-05-03';
        $validateData['filter']['date_filter']['date_end_filter_absen'] = '2023-05-10';

        $data_employee_absen_detail = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
            ->where('employee_absens.date', '>=',  $validateData['filter']['date_filter']['date_start_filter_absen'])
            ->where('employee_absens.date', '<=',  $validateData['filter']['date_filter']['date_end_filter_absen']);

        $data_employee_absen_detail = $data_employee_absen_detail->get([
            'status_absens.*',
            'employee_absens.*',
            'employee_absens.uuid as uuid',
        ]);

        $data_for_table = [];

        foreach ($data_employee_absen_detail as $item_data_employee_absen_detail) {
            //     $item_data_employee_absen_detail
            $data_for_table[] = [];
        }

        return ResponseFormatter::toJson($data_employee_absen_detail, $validateData);
    }

    public function reportUnAbsen(Request $request)
    {

        $validatedData = $request->all();
        $validatedData['filteredData'] = json_decode($request->filteredData);
        $validatedData['filteredData'] = json_decode(json_encode($validatedData['filteredData']), true);
        $data_database = session('data_database');
        // return ResponseFormatter::toJson($validatedData, '$data_for_web');
        $db = session('db_local_storage');
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $row_Excel = 20;

        $styleArray_header = array(
            'font' => [
                'bold' => true,
            ],
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
                'inside' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '4c4ce9'
                ]
            ],
            'alignment' => [
                'wrapText' => true,  // Enable text wrapping
            ],
        );

        $createSheet->setCellValue('C2', 'DARI-LIST');
        $createSheet->setCellValue('A' . $row_Excel, 'NO');
        $createSheet->setCellValue('B' . $row_Excel, 'NRP');
        $createSheet->setCellValue('C' . $row_Excel, 'NAMA');
        $createSheet->setCellValue('D' . $row_Excel, 'JABATAN');
        $createSheet->setCellValue('E' . $row_Excel, 'DIVISI');
        $createSheet->setCellValue('F' . $row_Excel, 'DEPARTEMEN');
        $createSheet->setCellValue('G' . $row_Excel, 'PROJECT');
        $createSheet->setCellValue('H' . $row_Excel, 'TANGGAL MULAI');
        $createSheet->setCellValue('I' . $row_Excel, 'LAMA');
        $createSheet->setCellValue('J' . $row_Excel, 'TANGGAL AKHIR');
        $createSheet->setCellValue('K' . $row_Excel, 'STATUS ABSEN');
        $createSheet->setCellValue('L' . $row_Excel, 'KETERANGAN');

        $createSheet->getStyle('A' . $row_Excel . ':L20')->applyFromArray($styleArray_header);
        $data_list = [];
        $long_range_date = ResponseFormatter::countDayLongWork($validatedData['filter_absensi']['date_start'], $validatedData['filter_absensi']['date_end']);
        $dates = ResponseFormatter::getDatesBetween($validatedData['filter_absensi']['date_start'], $validatedData['filter_absensi']['date_end']);

        $colomn_date = 7;
        $range_add = 4;


        $all_data = [];
        $data_for_web = [];
        foreach ($validatedData['filteredData'] as $NRP => $item_data_employee) {
            foreach ($dates as $date) {
                $item_data_employee = json_decode(json_encode($item_data_employee), true);
                // return ResponseFormatter::toJson($item_data_employee, '$data_for_web');
                if (empty($item_data_employee[$date])) {
                    $validatedData['filteredData'][$NRP][$date] = [
                        "date" => $date,
                        "status_absen_uuid" => "-",
                        "absen_description" => null,
                    ];
                }
            }
        }
        foreach ($validatedData['status_absen_filter'] as $status_absen_filter) {

            foreach ($validatedData['filteredData'] as $NRP => $item_data_employee) {
                $data_list[] = $NRP;
                $this_data_employee = [];
                $item_data_employee = json_decode(json_encode($item_data_employee), true);
                // return ResponseFormatter::toJson($item_data_employee, '$data_for_web');
                $prev_date = '';
                foreach ($dates as $date) {
                    if (!empty($item_data_employee[$date])) {
                        if ($item_data_employee[$date]['status_absen_uuid'] == $status_absen_filter) {

                            $data_for_table = [
                                'nik_employee' => $NRP,
                                'date_start' =>  $date,
                                'date_end' => $date,
                                'long_day' =>  1,
                                'status_absen_uuid' => $item_data_employee[$date]['status_absen_uuid'],
                                'absen_description' => $item_data_employee[$date]['absen_description']
                            ];

                            if (!empty($this_data_employee)) {
                                $latest_array = end($this_data_employee);

                                if ($latest_array['date_end'] == $prev_date) {

                                    $data_for_table = $latest_array;
                                    array_pop($this_data_employee);
                                    $data_for_table['long_day'] =  $data_for_table['long_day'] + 1;
                                    $data_for_table['date_end'] =  $date;
                                }
                            }
                            $this_data_employee[] = $data_for_table;
                        }
                    }
                    $prev_date = $date;
                }
                if (!empty($this_data_employee)) {

                    $all_data[] =   $this_data_employee;
                }
            }
        }

        // return ResponseFormatter::toJson('$name', $all_data);
        $row_Excel = 21;
        foreach ($all_data as $item_employee) {
            foreach ($item_employee as $item_absen) {
                $data_for_web[] = $item_absen;
                $db_employee = $db['public']['public_value']['KARYAWAN'][$item_absen['nik_employee']];
                $createSheet->setCellValue('B' . $row_Excel, $db_employee['NRP']);
                $createSheet->setCellValue('C' . $row_Excel, $db_employee['NAMA-KARYAWAN']);
                $createSheet->setCellValue('D' . $row_Excel, $db_employee['JABATAN']);
                $createSheet->setCellValue('E' . $row_Excel, $db_employee['DIVISI']);
                $createSheet->setCellValue('F' . $row_Excel, $db_employee['DEPARTEMEN']);
                $createSheet->setCellValue('G' . $row_Excel, $db_employee['PROJECT']);
                $createSheet->setCellValue('H' . $row_Excel, $item_absen['date_start']);
                $createSheet->setCellValue('I' . $row_Excel, $item_absen['long_day']);
                $createSheet->setCellValue('J' . $row_Excel, $item_absen['date_end']);
                $createSheet->setCellValue('K' . $row_Excel, $item_absen['status_absen_uuid']);
                $createSheet->setCellValue('L' . $row_Excel, $item_absen['absen_description']);
                $row_Excel++;
            }
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/Laporan_Ketidakhadiran_' . rand(99, 9999) . '_file.xls';
        $crateWriter->save($name);

        return ResponseFormatter::toJson($name, $data_for_web);


        $validatedData['filteredData'] = json_decode($request->filteredData);
        $validatedData['data_export'] = (array)$validatedData['data_export'];

        $validatedData['filter_status_absen'] = $validatedData['filter']['status_absen_filter'];

        $arr_date_start = explode('-', $validatedData['filter']['date_filter']['date_start_filter_absen']);
        $arr_date_end = explode('-', $validatedData['filter']['date_filter']['date_end_filter_absen']);
        $date_day_start = $arr_date_start[2];
        $date_day_end = $arr_date_end[2];


        $data_unabsen = [];
        $data_unabsen_x = [];



        foreach ($validatedData['data_export'] as $item_data) {
            $count_day_filtered = 0;
            $absensi = $item_data->absensi;

            foreach ($validatedData['filter_status_absen']  as $item_filter_status_absen) {
                $name_col = 'count_' . $item_filter_status_absen;
                $count_day_filtered = $count_day_filtered + $absensi->$name_col;
            }

            if ($count_day_filtered > 0) {
                $item_data_date = (array)$item_data->data;
                for ($i = (int)$date_day_start; $i <= (int)$date_day_end; $i++) {
                    $x = ResponseFormatter::to2Digit($i);
                    $x_prev = ResponseFormatter::to2Digit($i - 1);
                    $xx = $arr_date_start[0] . '-' . $arr_date_start[1] . '-' . $x;
                    $xx_prev = $arr_date_start[0] . '-' . $arr_date_start[1] . '-' . $x_prev;

                    if (empty($item_data_date[$xx])) {
                        $dd = [
                            'status_absen_uuid' => 'unknown_absen',
                            'status_absen_code' => 'unknown_absen',
                            'date' => $xx,
                        ];
                        $item_data_date[$xx] = $dd;
                    }

                    if (!empty($item_data_date[$xx])) {

                        $item_data_absen = (array)$item_data_date[$xx];
                        if (in_array($item_data_absen['status_absen_code'], $validatedData['filter_status_absen'])) {
                            $data_for_table = [
                                'nik_employee' => $item_data->nik_employee,
                                'date_start' =>  $item_data_absen['date'],
                                'date_end' => $item_data_absen['date'],
                                'long_day' =>  1,
                                'status_absen_uuid' => $item_data_absen['status_absen_uuid'],
                                'absen_description' => ''
                            ];
                            $data_unabsen[$item_data->nik_employee][$xx] = $data_for_table;
                            if (!empty($data_unabsen[$item_data->nik_employee][$xx_prev])) {
                                $data_prev = $data_unabsen[$item_data->nik_employee][$xx_prev];
                                if ($data_prev['status_absen_uuid'] == $item_data_absen['status_absen_uuid']) {
                                    $data_prev['date_end'] = $item_data_absen['date'];
                                    $data_prev['long_day'] = $data_prev['long_day'] + 1;
                                }
                                $data_unabsen[$item_data->nik_employee][$xx] = $data_prev;
                                unset($data_unabsen[$item_data->nik_employee][$xx_prev]);
                            }
                        }
                    }
                    $data_unabsen_x[$item_data->nik_employee][] = $xx;
                }
            }
        }
        $row_Excel = 21;
        foreach ($data_unabsen as $item_employee) {
            foreach ($item_employee as $item_absen) {
                $createSheet->setCellValue('B' . $row_Excel, $data_database['data_employees'][$item_absen['nik_employee']]['nik_employee_with_space']);
                $createSheet->setCellValue('C' . $row_Excel, $data_database['data_employees'][$item_absen['nik_employee']]['name']);
                $createSheet->setCellValue('D' . $row_Excel, $data_database['data_employees'][$item_absen['nik_employee']]['position']);
                $createSheet->setCellValue('E' . $row_Excel, $data_database['data_employees'][$item_absen['nik_employee']]['department_uuid']);
                $createSheet->setCellValue('F' . $row_Excel, $data_database['data_employees'][$item_absen['nik_employee']]['company']);
                $createSheet->setCellValue('G' . $row_Excel, $data_database['data_employees'][$item_absen['nik_employee']]['site_uuid']);
                $createSheet->setCellValue('H' . $row_Excel, $item_absen['date_start']);
                $createSheet->setCellValue('I' . $row_Excel, $item_absen['long_day']);
                $createSheet->setCellValue('J' . $row_Excel, $item_absen['date_end']);
                $createSheet->setCellValue('K' . $row_Excel, $item_absen['status_absen_uuid']);
                $createSheet->setCellValue('L' . $row_Excel, $item_absen['absen_description']);
                $row_Excel++;
            }
        }

        $styleArray_header['fill']['startColor']['rgb'] = 'ffffff';
        $styleArray_header['font']['bold'] = false;
        $createSheet->getStyle('A21:L' . ($row_Excel - 1))->applyFromArray($styleArray_header);
        $createSheet->getColumnDimension('B')->setAutoSize(true);
        $createSheet->getColumnDimension('C')->setAutoSize(true);
        $createSheet->getColumnDimension('D')->setAutoSize(true);
        $createSheet->getColumnDimension('E')->setAutoSize(true);
        $createSheet->getColumnDimension('F')->setAutoSize(true);
        $createSheet->getColumnDimension('G')->setAutoSize(true);
        $createSheet->getColumnDimension('H')->setAutoSize(true);
        $createSheet->getColumnDimension('I')->setAutoSize(true);
        $createSheet->getColumnDimension('J')->setAutoSize(true);
        $createSheet->getColumnDimension('K')->setAutoSize(true);
        $createSheet->getColumnDimension('L')->setAutoSize(true);

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/Laporan_Ketidakhadiran_' . rand(99, 9999) . '_file.xls';
        $crateWriter->save($name);


        return ResponseFormatter::toJson($name, $data_unabsen_x);
    }
    public function exportWithData(Request $request)
    {
        $validatedData = $request->all();
        $db = session('db_local_storage');
        $abjads = ResponseFormatter::abjads();
        $months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $arr_date_absen = explode("-", $validatedData['filter_absensi']['date_start']);

        $status_absens_col = 2;
        $styleArray_employee = array(
            'font' => [
                'bold' => true,
            ],
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'ffffff'
                ]
            ],
        );

        $style_text_center = array(
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        );

        $validatedData['data_absensi'] = json_decode($request->data_absensi);

        // return ResponseFormatter::toJson('export data absen', $validatedData);
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        $createSheet->setCellValue('A2', 'Excel');
        $createSheet->setCellValue('A20', 'NO.');
        $createSheet->setCellValue('C20', 'NAMA');
        $createSheet->setCellValue('B20', 'NIK');
        $createSheet->setCellValue('D20', 'POSISI');
        $createSheet->setCellValue('E20', 'DIVISI');
        $createSheet->setCellValue('F20', 'DEPARTEMEN');
        $createSheet->setCellValue('G20', 'PROJECT');

        $status_absens = $db['public']['public_value']['DATABASE-ABSENSI'];
        // keterangan absensi
        foreach ($status_absens as $item) {
            $createSheet->setCellValue($abjads[1] . $status_absens_col,  $item['KODE-ABSEN']);
            $createSheet->setCellValue($abjads[1 + 1] . $status_absens_col,  $item['KETERANGAN-ABSEN']);
            $styleArray_employee['fill']['startColor']['rgb'] = str_replace('#', '', $item['WARNA-ABSENSI']);
            $createSheet->getStyle($abjads[1] . $status_absens_col)->applyFromArray($styleArray_employee);
            $status_absens_col++;
        }
        // keterangan absensi

        // tanggal absensi
        $dates = ResponseFormatter::getDatesBetween($validatedData['filter_absensi']['date_start'], $validatedData['filter_absensi']['date_end']);
        $long_range_date = ResponseFormatter::countDayLongWork($validatedData['filter_absensi']['date_start'], $validatedData['filter_absensi']['date_end']);
        $colomn_date = 7;
        $range_add = 4;
        foreach ($dates as $date) {
            $createSheet->setCellValue($abjads[$colomn_date] . '20',  Carbon::parse($date)->format('d'));
            $createSheet->setCellValue($abjads[$colomn_date + $long_range_date + $range_add - 2] . '19',  Carbon::parse($date)->format('d'));
            $createSheet->mergeCells($abjads[$colomn_date + $long_range_date + $range_add - 2] . '19:' . $abjads[$colomn_date + $long_range_date + $range_add] . '19');

            $createSheet->setCellValue($abjads[$colomn_date + $long_range_date + $range_add - 2] . '20', "Pertama");
            $createSheet->setCellValue($abjads[$colomn_date + $long_range_date + $range_add - 1] . '20', "Kedua");
            $createSheet->setCellValue($abjads[$colomn_date + $long_range_date + $range_add] . '20', "Status");

            $colomn_date++;
            $range_add = $range_add + 2;
        }
        // tanggal absensi


        $createSheet->setCellValue('H19', 'ABSENSI BULAN ' . $months[(int)$arr_date_absen[1]] . ' Tahun ' . $arr_date_absen[0]);
        $createSheet->mergeCells('H19:' . $abjads[$long_range_date + 6] . '19');
        $createSheet->getStyle('H19:' . $abjads[$long_range_date + 6] . '19')->applyFromArray($style_text_center);

        $row_data_employee = 21;
        foreach ($validatedData['data_absensi'] as $NRP => $data_absensi) {

            $data_employee = $db['public']['public_value']['KARYAWAN'][$NRP];
            $data_absensi =  json_decode(json_encode($data_absensi), true);
            $createSheet->setCellValue($abjads[1] . $row_data_employee, (!empty($data_employee['NRP'])) ? $db['db']['database_data']['KARYAWAN'][$NRP]['NRP']['value_data'] : "");
            $createSheet->setCellValue($abjads[1 + 1] . $row_data_employee, (!empty($data_employee['NAMA-KARYAWAN'])) ? $data_employee['NAMA-KARYAWAN'] : "");
            $createSheet->setCellValue($abjads[1 + 2] . $row_data_employee, (!empty($data_employee['JABATAN'])) ? $data_employee['JABATAN'] : "");
            $createSheet->setCellValue($abjads[1 + 3] . $row_data_employee, (!empty($data_employee['DIVISI'])) ? $data_employee['DIVISI'] : "");
            $createSheet->setCellValue($abjads[1 + 4] . $row_data_employee, (!empty($data_employee['DEPARTEMEN'])) ? $data_employee['DEPARTEMEN'] : "");
            $createSheet->setCellValue($abjads[1 + 5] . $row_data_employee, (!empty($data_employee['PROJECT'])) ? $data_employee['PROJECT'] : "");
            $colomn_date = 7;
            $range_add = 2;
            foreach ($dates as $date) {
                if (!empty($data_absensi[$date])) {
                    if ($data_absensi[$date]['status_absen_uuid'] != '-' && !empty($data_absensi[$date]['status_absen_uuid'])) {
                        $styleArray_employee['fill']['startColor']['rgb'] = str_replace('#', '', $status_absens[$data_absensi[$date]['status_absen_uuid']]['WARNA-ABSENSI']);
                        $createSheet->setCellValue($abjads[$colomn_date] . $row_data_employee,  $data_absensi[$date]['status_absen_uuid']);
                        $createSheet->setCellValue($abjads[$colomn_date + $long_range_date + $range_add + 2] . $row_data_employee,  $data_absensi[$date]['status_absen_uuid']);
                        if (!empty($data_absensi[$date]['entry'])) {
                            $createSheet->setCellValue($abjads[$colomn_date + $long_range_date + $range_add] . $row_data_employee,  $data_absensi[$date]['entry']);
                        }
                        if (!empty($data_absensi[$date]['exit'])) {
                            $createSheet->setCellValue($abjads[$colomn_date + $long_range_date + $range_add + 1] . $row_data_employee,  $data_absensi[$date]['exit']);
                        }
                        $createSheet->getStyle($abjads[$colomn_date + $long_range_date + $range_add + 2] . $row_data_employee)->applyFromArray($styleArray_employee);
                        $createSheet->getStyle($abjads[$colomn_date] . $row_data_employee)->applyFromArray($styleArray_employee);
                    }

                    $range_add = $range_add + 2;
                }else{
                    $createSheet->setCellValue($abjads[$colomn_date + $long_range_date + $range_add + 2] . $row_data_employee,  "zz");
                }
                $colomn_date++;
            }

            $row_data_employee++;
        }
        $styleArray_employee['fill']['startColor']['rgb'] = null;
        $createSheet->getStyle('A19:' . $abjads[$long_range_date + 6] . $row_data_employee)->applyFromArray($styleArray_employee);
        $createSheet->getStyle($abjads[$long_range_date + 6 + 3] . '19:' . $abjads[$long_range_date + 1 + 6 + ($long_range_date * 3)] . $row_data_employee)->applyFromArray($styleArray_employee);

        for ($i = 0; $i <= (4 * $long_range_date) + 12; $i++) {
            $createSheet->getColumnDimension($abjads[$i])->setAutoSize(true);
        }


        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $validatedData['filter_absensi']['date_start'] . '-' . $validatedData['filter_absensi']['date_start'] . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return ResponseFormatter::toJson($name, $validatedData['data_absensi']);




        // return 'aaa';
        return response()->download($name);
    }

    public function exportAfterImport(Request $request)
    {
        $year_month = '2023-01';
        $validatedData = $request->all();
        $data_database = session('data_database');
        $data_employees = $data_database['data_employees'];
        $validatedData['data_ex'] = json_decode($request->data_ex);


        $data_ex_no_employees = (array)$validatedData['data_ex'];
        $null_employees = $data_ex_no_employees['null_employees'];

        // return ResponseFormatter::toJson($null_employees, 'hai i am from skl');

        $date = explode("-", $year_month);
        $month = $date[1];
        $month = (int)$month;

        $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];


        $status_absens = StatusAbsen::orderBy('math', 'desc')->get();

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        $createSheet->setCellValue('A19', 'NO.');
        $createSheet->setCellValue('B19', 'NAMA');
        $createSheet->setCellValue('C19', 'NIK');
        $createSheet->setCellValue('D19', 'POSISI');
        $createSheet->setCellValue('E19', 'DEPARTEMEN');
        $createSheet->setCellValue('F19', 'SITE');
        $createSheet->setCellValue('G19', 'PERUSAHAAN');
        $createSheet->setCellValue('H19', 'NAMA FINGGER');

        $data_ex = (array)$validatedData['data_ex'];
        $have_employees = $data_ex['have_employees'];
        // $data_have_employees = $have_employees['data'];  
        $row_employees = 20;

        foreach ($have_employees->data as $item_data_export) {
            $createSheet->setCellValue('B' . $row_employees, $data_database['data_employees'][ResponseFormatter::toUUID($item_data_export->nik_employee)]['name']);
            $createSheet->setCellValue('C' . $row_employees, $data_employees[$item_data_export->nik_employee]['nik_employee_with_space']);
            $createSheet->setCellValue('D' . $row_employees, $data_database['data_employees'][ResponseFormatter::toUUID($item_data_export->nik_employee)]['position']);
            $createSheet->setCellValue('E' . $row_employees, $data_database['data_employees'][ResponseFormatter::toUUID($item_data_export->nik_employee)]['department_uuid']);
            $createSheet->setCellValue('F' . $row_employees, $data_database['data_employees'][ResponseFormatter::toUUID($item_data_export->nik_employee)]['site_uuid']);
            $createSheet->setCellValue('G' . $row_employees, $data_database['data_employees'][ResponseFormatter::toUUID($item_data_export->nik_employee)]['company_uuid']);
            $createSheet->setCellValue('H' . $row_employees, $item_data_export->employee_uuid);
            $row_employees++;
        }


        $row_employees = $row_employees + 4;

        $createSheet->setCellValue('A' . $row_employees, 'NO.');
        $createSheet->setCellValue('B' . $row_employees, 'NAMA');
        $createSheet->setCellValue('C' . $row_employees, 'NIK');
        $createSheet->setCellValue('D' . $row_employees, 'NAMA FINGGER');


        $row_employees++;
        foreach ($null_employees as $item_data_export) {
            $createSheet->setCellValue('B' . $row_employees, '');
            $createSheet->setCellValue('C' . $row_employees, '');
            $createSheet->setCellValue('D' . $row_employees, $item_data_export->employee_uuid);
            $row_employees++;
        }


        $createSheet->getColumnDimension('B')->setAutoSize(true);
        $createSheet->getColumnDimension('C')->setAutoSize(true);
        $createSheet->getColumnDimension('D')->setAutoSize(true);
        $createSheet->getColumnDimension('E')->setAutoSize(true);
        $createSheet->getColumnDimension('F')->setAutoSize(true);
        $createSheet->getColumnDimension('G')->setAutoSize(true);

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return ResponseFormatter::toJson($name, $validatedData['data_ex']);

        $status_absens_col = 1;
        $date_row = 4;
        $arr_date_start = explode('-', $validatedData['filter']['date_filter']['date_start_filter_absen']);
        $arr_date_end = explode('-', $validatedData['filter']['date_filter']['date_end_filter_absen']);
        $date_day_start = $arr_date_start[2];
        $date_day_end = $arr_date_end[2];
        // header table tanggal

        $styleArray_employee = array(
            'font' => [
                'bold' => true,
            ],
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'ffffff'
                ]
            ],
        );


        $row_ex = 7;
        for ($i = (int)$date_day_start; $i <= (int)$date_day_end; $i++) {
            $createSheet->setCellValue($abjads[$row_ex] . '20', $i);
            $createSheet->getColumnDimension($abjads[$row_ex])->setWidth(4);

            $row_ex++;
            $date_row++;
        }


        foreach ($status_absens as $item) {
            $createSheet->setCellValue($abjads[2] . $status_absens_col,  $item->status_absen_code);
            $createSheet->setCellValue($abjads[2 + 1] . $status_absens_col,  $item->status_absen_description);
            $styleArray_employee['fill']['startColor']['rgb'] = $item->color;
            $createSheet->getStyle($abjads[2] . $status_absens_col)->applyFromArray($styleArray_employee);
            $status_absens_col++;
        }


        $createSheet->setCellValue('H19', ResponseFormatter::getMonthName((int)$month));
        $createSheet->mergeCells('H19:' . $abjads[$row_ex - 1] . '19');
        $createSheet->mergeCells('A19:A20');
        $createSheet->mergeCells('B19:B20');
        $createSheet->mergeCells('C19:C20');
        $createSheet->mergeCells('D19:D20');
        $createSheet->mergeCells('E19:E20');
        $createSheet->mergeCells('F19:F20');
        $createSheet->mergeCells('G19:G20');

        $validatedData['data_export'] = (array)$validatedData['data_export'];

        $styleArray_header = array(
            'font' => [
                'bold' => true,
            ],
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
                'inside' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '4c4ce9'
                ]
            ],
        );
        //header
        $createSheet->getStyle('A19:' . $abjads[$row_ex - 1] . '20')->applyFromArray($styleArray_header);

        $styleArray_values = array(
            'font' => [
                'bold' => false,
            ],
            'borders' => array(
                'horizontal' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'ffffff'
                ]
            ],
        );
        $styleArray_employee['fill']['startColor']['rgb'] = 'ffffff';
        $createSheet->getStyle('H21:' . $abjads[$row_ex - 1] . (count($validatedData['data_export']) + 20))->applyFromArray($styleArray_values);
        $createSheet->getStyle('A21:G' . (count($validatedData['data_export']) + 20))->applyFromArray($styleArray_employee);

        $styleArray_value = array(
            'font' => [
                'bold' => false,
            ],
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '4c4ce9'
                ]
            ],
        );

        $row_employees = 21;

        // foreach ($validatedData['data_export'] as $item_data_export) {
        //     $createSheet->setCellValue('B' . $row_employees, $item_data_export->name);
        //     $createSheet->setCellValue('C' . $row_employees, $item_data_export->nik_employee_with_space);
        //     $createSheet->setCellValue('D' . $row_employees, $item_data_export->position);
        //     $createSheet->setCellValue('E' . $row_employees, $item_data_export->department_uuid);
        //     $createSheet->setCellValue('F' . $row_employees, $item_data_export->site_uuid);
        //     $createSheet->setCellValue('G' . $row_employees, $item_data_export->company_uuid);

        //     $row_ex = 7;
        //     for ($i = (int)$date_day_start; $i <= (int)$date_day_end; $i++) {
        //         if(!empty($item_data_export->data)){
        //             $x = $arr_date_start[0];                     
        //             $item_data = (array)$item_data_export->data;
        //             $x = ResponseFormatter::to2Digit($i);
        //             $xx = $arr_date_start[0].'-'.$arr_date_start[1].'-'.$x;                    
        //             $x = '';
        //             if(!empty($item_data[$xx])){
        //                 $xy = (array)$item_data[$xx];
        //                 $x = $xy['status_absen_code'];
        //                 $styleArray_value['fill']['startColor']['rgb'] = $xy['color'];
        //             }
        //             $createSheet->setCellValue($abjads[$row_ex] . $row_employees, $x);
        //             $createSheet->getStyle($abjads[$row_ex] . $row_employees )->applyFromArray($styleArray_value);
        //         }
        //         $row_ex++;
        //         $date_row++;
        //         $styleArray_value['fill']['startColor']['rgb'] = 'ffffff';
        //     }
        //     $row_employees++;
        // }      


        $createSheet->getColumnDimension('B')->setAutoSize(true);
        $createSheet->getColumnDimension('C')->setAutoSize(true);
        $createSheet->getColumnDimension('D')->setAutoSize(true);
        $createSheet->getColumnDimension('E')->setAutoSize(true);
        $createSheet->getColumnDimension('F')->setAutoSize(true);
        $createSheet->getColumnDimension('G')->setAutoSize(true);



        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return ResponseFormatter::toJson($name, $validatedData);
    }

    public function dialyReport(Request $request)
    {
        $year_month = '2023-01';
        $validatedData = $request->all();

        $data_database = session('data_database');
        $data_database['data_status_absens'][""] = $data_database['data_status_absens']["X"];
        $data_database['data_status_absens'][""]['status_absen_description'] = 'Tanpa Keterangan';
        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

        // $validatedData['company_uuid'] = 'MBLE';
        $validatedData['site_uuid'] = $validatedData['site_uuid_dialy'];
        $validatedData['date'] = $validatedData['date_dialy'];

        $arr_date = explode('-', $validatedData['date']);

        $first_date_this_month = $arr_date[0] . '-' . $arr_date[1] . '-' . '01';

        $data_dialy_absen_detail = [];
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        $createSheet->setCellValue('C22', 'KETERANGAN ABSEN');
        $createSheet->setCellValue('D22', 'JUMLAH');
        $styleArray_header = array(
            'font' => [
                'bold' => true,
            ],
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
                'inside' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '4E3AFF'
                ]
            ],
        );

        $createSheet->setCellValue('C21', 'RINGKASAN KEHADIRAN SITE ' . $validatedData['site_uuid']);
        $createSheet->mergeCells('C21:D21');
        $createSheet->getStyle('C21')->applyFromArray($styleArray_header);
        $styleArray_header['fill']['startColor']['rgb'] = '8994FF';
        $createSheet->getStyle('C22:D22')->applyFromArray($styleArray_header);

        // MBLE-220656
        $createSheet->setCellValue('F23', 'DEPARTEMEN');

        $employee_ = Employee::where('date_end', null)
            ->where('site_uuid', $validatedData['site_uuid'])
            ->get();


        $arr_absensi = [];
        $data_employee = [];
        $data_employee_machine_id = [];
        foreach ($employee_ as $item_employee_) {
            if (!empty($data_database['data_employee_out'][$item_employee_->nik_employee])) {
                if (($validatedData['date'] < $data_database['data_employee_out'][$item_employee_->nik_employee]['date_out'])  && ($first_date_this_month > $data_database['data_employee_out'][$item_employee_->nik_employee]['date_out'])) {
                    $data_employee[$item_employee_->nik_employee] = $item_employee_;
                    $data_employee_machine_id[$item_employee_->machine_id] = $item_employee_->nik_employee;
                }
            } elseif ($validatedData['date'] > $data_database['data_employees'][$item_employee_->nik_employee]['date_document_contract']) {
                $data_employee[$item_employee_->nik_employee] = $item_employee_;
                $data_employee_machine_id[$item_employee_->machine_id] = $item_employee_->nik_employee;
            }
        }


        $employee_absen_arr = EmployeeAbsen::join('employees', 'employees.machine_id', 'employee_absens.employee_uuid')
            ->where('employees.date_end', null)
            ->where('employee_absens.date', $validatedData['date'])
            ->where('employees.site_uuid', $validatedData['site_uuid'])
            ->get();

        $employee_absen = [];
        foreach ($employee_absen_arr as $item_employee_absen_arr) {
            $employee_absen[$item_employee_absen_arr->nik_employee] = $item_employee_absen_arr;
        }





        foreach ($employee_ as $item_employees_this_site) {
            if (empty($employee_absen[$item_employees_this_site->nik_employee])) {
                $item_employees_this_site->date = $validatedData['date'];
                $item_employees_this_site->status_absen_uuid = 'X';
                $item_employees_this_site->cek_log = null;
                $item_employees_this_site->employee_uuid = $item_employees_this_site->machine_id;
                $employee_absen[$item_employees_this_site->nik_employee] = $item_employees_this_site;
            }
        }

        $data_absen_each_employee = [];
        $haves = [];
        foreach ($employee_absen as $item_employee_absen) {

            if (!empty($data_employee_machine_id[$item_employee_absen->employee_uuid])) {
                $haves['not_emp'][] = $item_employee_absen;
                if (empty($data_absen_each_employee[$data_employee_machine_id[$item_employee_absen->employee_uuid]][$item_employee_absen->date])) {
                    $data_absen_each_employee[$data_employee_machine_id[$item_employee_absen->employee_uuid]][$item_employee_absen->date] = $item_employee_absen;
                    if (!empty($arr_absensi['each_status_absen'][$item_employee_absen->status_absen_uuid])) {
                        $arr_absensi['each_status_absen'][$item_employee_absen->status_absen_uuid]++;
                    } else {
                        $arr_absensi['each_status_absen'][$item_employee_absen->status_absen_uuid] = 1;
                    }

                    if (empty($arr_absensi['each_department'][$item_employee_absen->department_uuid][$item_employee_absen->status_absen_uuid])) {
                        $arr_absensi['each_department'][$item_employee_absen->department_uuid][$item_employee_absen->status_absen_uuid] = 1;
                        $arr_absensi['each_department_employee'][$item_employee_absen->status_absen_uuid][$item_employee_absen->department_uuid][$item_employee_absen->position_uuid][$data_employee_machine_id[$item_employee_absen->employee_uuid]] =  $item_employee_absen;
                    } else {
                        $arr_absensi['each_department'][$item_employee_absen->department_uuid][$item_employee_absen->status_absen_uuid]++;
                        $arr_absensi['each_department_employee'][$item_employee_absen->status_absen_uuid][$item_employee_absen->department_uuid][$item_employee_absen->position_uuid][$data_employee_machine_id[$item_employee_absen->employee_uuid]] =  $item_employee_absen;
                    }
                }
            } else {
                $haves['_emp'][] = $item_employee_absen;
            }
        }

        $row_arr_absensi = 23;
        $col_arr_each_department = 6;

        $col_arr_each_department_abjad = [];
        foreach ($arr_absensi['each_status_absen'] as $index => $item_arr_absensi) {
            $createSheet->setCellValue('C' . $row_arr_absensi, $data_database['data_status_absens'][$index]['status_absen_description']);

            $createSheet->setCellValue('D' . $row_arr_absensi, $item_arr_absensi);
            $createSheet->setCellValue($rows[$col_arr_each_department] . '23', $data_database['data_status_absens'][$index]['status_absen_description']);

            $col_arr_each_department_abjad[$index] = $rows[$col_arr_each_department];

            $col_arr_each_department++;
            $row_arr_absensi++;
        }

        // style ringkasan kehadiran
        $styleArray_header['fill']['startColor']['rgb'] = 'FFFFFF';
        $createSheet->getStyle('C23:D' . ($row_arr_absensi - 1))->applyFromArray($styleArray_header);


        $row_arr_absensi = 24;
        foreach ($arr_absensi['each_department'] as $index_sa => $arr_absensi_each_department) {
            $createSheet->setCellValue('F' . $row_arr_absensi, $index_sa);
            foreach ($arr_absensi_each_department as $index_sa_dep => $item_arr_absensi_each_department) {
                $createSheet->setCellValue($col_arr_each_department_abjad[$index_sa_dep] . $row_arr_absensi, $item_arr_absensi_each_department);
            }
            $row_arr_absensi++;
        }

        // style ringkasan kehadiran
        $createSheet->setCellValue('F21', 'RINGKASAN KEHADIRAN SITE ' . $validatedData['site_uuid'] . ' PERDEPARTEMEN');
        $createSheet->mergeCells('F21:' . $rows[($col_arr_each_department - 1)] . '21');

        $styleArray_header['fill']['startColor']['rgb'] = '4E3AFF';
        $styleArray_header['alignment'] =  [
            'horizontal' => Alignment::HORIZONTAL_CENTER
        ];

        $createSheet->getStyle('F21:' . $rows[($col_arr_each_department - 1)] . '21')->applyFromArray($styleArray_header);
        $styleArray_header['alignment'] = null;
        $styleArray_header['fill']['startColor']['rgb'] = '8994FF';
        $createSheet->getStyle('F23:' . $rows[($col_arr_each_department - 1)] . '23')->applyFromArray($styleArray_header);
        $styleArray_header['fill']['startColor']['rgb'] = 'ABB2F6';
        $createSheet->getStyle('F24:F' . ($row_arr_absensi - 1))->applyFromArray($styleArray_header);
        //style isi each department
        $styleArray_header['fill']['startColor']['rgb'] = 'FFFFFF';
        $createSheet->getStyle('G24:' . $rows[($col_arr_each_department - 1)] . ($row_arr_absensi - 1))->applyFromArray($styleArray_header);


        $row_description_absensi = 22;
        $col_arr_each_department++;
        foreach ($arr_absensi['each_department_employee'] as $index_status_absen_dep_emp => $item_arr_status_absen) {
            $createSheet->setCellValue($rows[$col_arr_each_department + 1] . $row_description_absensi, $data_database['data_status_absens'][$index_status_absen_dep_emp]['status_absen_description']);
            $createSheet->mergeCells($rows[$col_arr_each_department + 1] . $row_description_absensi . ':' . $rows[$col_arr_each_department + 5] . $row_description_absensi);
            $styleArray_header['fill']['startColor']['rgb'] = 'ABB2F6';
            $createSheet->getStyle($rows[$col_arr_each_department + 1] . $row_description_absensi . ':' . $rows[$col_arr_each_department + 5] . $row_description_absensi)->applyFromArray($styleArray_header);

            $row_description_absensi++;

            foreach ($item_arr_status_absen as $index_dep_emp => $item_arr_dep_emp) {
                $createSheet->setCellValue($rows[$col_arr_each_department + 1] . $row_description_absensi, $index_dep_emp);
                $row_department = $row_description_absensi;
                foreach ($item_arr_dep_emp as $index_pos_emp => $item_arr_pos_emp) {
                    $createSheet->setCellValue($rows[$col_arr_each_department + 2] . $row_description_absensi, $index_pos_emp);
                    $createSheet->setCellValue($rows[$col_arr_each_department + 3] . $row_description_absensi, count($item_arr_pos_emp));
                    $row_POS = $row_description_absensi;
                    foreach ($item_arr_pos_emp as $nik_emp => $arr_emp) {
                        $createSheet->setCellValue($rows[$col_arr_each_department + 4] . $row_description_absensi, $nik_emp);
                        $createSheet->setCellValue($rows[$col_arr_each_department + 5] . $row_description_absensi, $data_database['data_employees'][$nik_emp]['name']);
                        $row_description_absensi++;
                    }
                    $createSheet->mergeCells($rows[$col_arr_each_department + 2] . $row_POS . ':' . $rows[$col_arr_each_department + 2] . ($row_description_absensi - 1));
                    $createSheet->mergeCells($rows[$col_arr_each_department + 3] . $row_POS . ':' . $rows[$col_arr_each_department + 3] . ($row_description_absensi - 1));
                    $styleArray_header['alignment'] =  [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ];
                    $styleArray_header['fill']['startColor']['rgb'] = 'ABB2F6';
                    $createSheet->getStyle($rows[$col_arr_each_department + 2] . $row_POS . ':' . $rows[$col_arr_each_department + 2] . ($row_description_absensi - 1))->applyFromArray($styleArray_header);
                    $createSheet->getStyle($rows[$col_arr_each_department + 3] . $row_POS . ':' . $rows[$col_arr_each_department + 3] . ($row_description_absensi - 1))->applyFromArray($styleArray_header);
                    $styleArray_header['alignment'] = null;
                    $styleArray_header['fill']['startColor']['rgb'] = 'FFFFFF';
                    $createSheet->getStyle($rows[$col_arr_each_department + 4] . $row_POS . ':' . $rows[$col_arr_each_department + 5] . ($row_description_absensi - 1))->applyFromArray($styleArray_header);

                    // $row_description_absensi++;  
                }
                $createSheet->mergeCells($rows[$col_arr_each_department + 1] . $row_department . ':' . $rows[$col_arr_each_department + 1] . ($row_description_absensi - 1));
                $styleArray_header['fill']['startColor']['rgb'] = 'ABB2F6';
                $styleArray_header['alignment'] =  [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ];

                $createSheet->getStyle($rows[$col_arr_each_department + 1] . $row_department . ':' . $rows[$col_arr_each_department + 1] . ($row_description_absensi - 1))->applyFromArray($styleArray_header);
                // $row_description_absensi++;         
            }
            $row_description_absensi++;
        }

        // dd($arr_absensi);

        for ($col_all = 1; $col_all <= $col_arr_each_department + 5; $col_all++) {
            $createSheet->getColumnDimension($rows[$col_all])->setAutoSize(true);
        }



        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);




        return ResponseFormatter::toJson($name, $arr_absensi);




        $data_session = session('data_database');
        $data_employee_out = $data_session['data_employee_out'];
        $validatedData['date_start_filter_absen'] = '2023-05-17';

        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $month = (int)$month;
        $months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $date_start_absen_arr = ResponseFormatter::excelToDateArray($validatedData['date_start_filter_absen']);
        $date_end_absen_arr = ResponseFormatter::excelToDateArray($validatedData['date_start_filter_absen']);
        $validatedData['date_start_absen_arr'] = $date_start_absen_arr;

        $datetime = Carbon::createFromFormat('Y-m', $year . '-' . $month);
        $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');
        $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];


        $status_absens = StatusAbsen::orderBy('math', 'desc')->get();
        $status_absen_pay = StatusAbsen::where('math', 'pay')->get()->count();

        $row_status_absen = 8;
        $row_status_absen_abjads = [];

        // return view('datatableshow', [ 'data'         => $row_status_absen_abjads]);

        $data_dialy_absen_detail = [];
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Absen Excel');

        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B2', 'Perusahaan');
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');
        $xxxx = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '9b189b'),
                ),
            ),
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
        );


        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', 'year');

        $createSheet->setCellValue('A19', 'No.');
        $createSheet->setCellValue('B19', 'Nama');
        $createSheet->setCellValue('C19', 'NIK');
        $createSheet->setCellValue('D19', 'Jabatan');

        $status_absens_col = 1;
        $date_row = 4;
        $arr_date_start = explode('-', $validatedData['filter']['date_filter']['date_start_filter_absen']);
        $arr_date_end = explode('-', $validatedData['filter']['date_filter']['date_end_filter_absen']);
        $date_day_start = $arr_date_start[2];
        $date_day_end = $arr_date_end[2];
        // header table tanggal

        $styleArray_employee = array(
            'font' => [
                'bold' => true,
            ],
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'ffffff'
                ]
            ],
        );


        $row_ex = 4;
        for ($i = (int)$date_day_start; $i <= (int)$date_day_end; $i++) {
            $createSheet->setCellValue($abjads[$row_ex] . '20', $i);
            $createSheet->getColumnDimension($abjads[$row_ex])->setWidth(6);

            $row_ex++;
            $date_row++;
        }


        // foreach ($status_absens as $item) {
        //     $createSheet->setCellValue($abjads[5] . $status_absens_col,  $item->status_absen_code);
        //     $createSheet->setCellValue($abjads[5+1] . $status_absens_col,  $item->status_absen_description);                
        //     $styleArray_value['fill']['startColor']['rgb'] = $item->color;
        //     $createSheet->getStyle($abjads[5] . $status_absens_col )->applyFromArray($styleArray_value);
        //     $status_absens_col++;
        // }


        $createSheet->setCellValue('E19', ResponseFormatter::getMonthName((int)$month));
        $createSheet->mergeCells('E19:' . $abjads[$date_row - 1] . '19');
        $createSheet->mergeCells('A19:A20');
        $createSheet->mergeCells('B19:B20');
        $createSheet->mergeCells('C19:C20');
        $createSheet->mergeCells('D19:D20');

        $pay = [];
        $unpay = [];

        $employees = Employee::data_employee();
        $employee_row = 21;
        $status_absens_col_employee = $date_row;
        $arr_status_absens = [];
        $validatedData['data_export'] = (array)$validatedData['data_export'];

        $styleArray = array(
            'font' => [
                'bold' => true,
            ],
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
                'inside' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '4c4ce9'
                ]
            ],
        );

        $createSheet->getStyle('A19:' . $abjads[$date_row - 1] . '20')->applyFromArray($styleArray);

        $styleArray_values = array(
            'font' => [
                'bold' => false,
            ],
            'borders' => array(
                'horizontal' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'ffffff'
                ]
            ],
        );

        $createSheet->getStyle('E21:' . $abjads[$date_row - 1] . (count($validatedData['data_export']) + 20))->applyFromArray($styleArray_values);


        $createSheet->getStyle('A21:D' . (count($validatedData['data_export']) + 20))->applyFromArray($styleArray_employee);

        $row_employees = 21;



        foreach ($validatedData['data_export'] as $item_data_export) {
            $data_company = [];
            if (empty($data_employee_out[$item_data_export->nik_employee])) {
                if (($item_data_export->company_uuid == $validatedData['company_uuid']) &&  ($item_data_export->site_uuid == $validatedData['site_uuid'])) {
                    if (empty($data_dialy_absen[$item_data_export->department_uuid]['detail'])) {
                        foreach ($item_data_export->absensi as $index_absensi => $absensi) {
                            $data_dialy_absen[$item_data_export->department_uuid]['detail'][$index_absensi] = 0;
                        }
                    }
                    foreach ($item_data_export->absensi as $index_absensi => $absensi) {
                        if (!empty($data_dialy_absen_detail[$index_absensi]['name'])) {
                            $data_dialy_absen_detail[$index_absensi]['count'] = $data_dialy_absen_detail[$index_absensi]['count'] +  $absensi;
                        }
                        $data_dialy_absen[$item_data_export->department_uuid]['detail'][$index_absensi] = $data_dialy_absen[$item_data_export->department_uuid]['detail'][$index_absensi] + $absensi;
                    }
                }
            }
        }

        $createSheet->setCellValue('C22', 'KETERANGAN ABSEN');
        $createSheet->setCellValue('D22', 'JUMLAH');

        $row_item_dialy_detail_start = $row_item_dialy_detail = 23;
        $row_status_absen = 8;
        foreach ($data_dialy_absen_detail as $index_name_absen => $item_data_dialy_absen_detail) {
            if (!empty($item_data_dialy_absen_detail['count'])) {
                $createSheet->setCellValue('C' . $row_item_dialy_detail, $item_data_dialy_absen_detail['name']);
                $createSheet->setCellValue('D' . $row_item_dialy_detail, $item_data_dialy_absen_detail['count']);

                $row_status_absen_abjads[$index_name_absen] = $abjads[$row_status_absen];
                $createSheet->setCellValue($abjads[$row_status_absen] . '22',  $item_data_dialy_absen_detail['name']);
                $row_status_absen++;

                $row_item_dialy_detail++;
            }
        }
        $createSheet->setCellValue('C' . $row_item_dialy_detail, 'TOTAL');
        $createSheet->setCellValue('D' . $row_item_dialy_detail, '=SUM(D' . ($row_item_dialy_detail_start) . ':D' . ($row_item_dialy_detail - 1) . ')');


        $createSheet->setCellValue('H22', 'DEPARTEMEN');

        $row_dialy_absen_first = $row_dialy_absen = 23;
        foreach ($data_dialy_absen as $department_uuid => $item_dialy_absen) {
            $createSheet->setCellValue('H' . $row_dialy_absen, $department_uuid);
            foreach ($row_status_absen_abjads as $name_count => $row_abjad) {
                $createSheet->setCellValue($row_abjad . $row_dialy_absen, $item_dialy_absen['detail'][$name_count]);
            }
            $row_dialy_absen++;
        }
        $createSheet->setCellValue('H' . $row_dialy_absen, 'TOTAL');
        foreach ($row_status_absen_abjads as $name_count => $row_abjad) {
            $createSheet->setCellValue($row_abjad . $row_dialy_absen, '=SUM(' . $row_abjad . ($row_dialy_absen_first) . ':' . $row_abjad . ($row_dialy_absen - 1) . ')');
        }

        /*
        {
            'MBLE' => [
                => 'GBM' => [
                    'HAULING' => [
                        'data' => [
                            'DS' => [
                                'MBLE-0422003'
                            ]
                        ]
                        'detail' => [
                            'DS' = > [
                                'count => 1,
                            ]
                        ]
                    ],
                    'PRODUCTION' => [
                        'detail' => [
                            'DS' = > [
                                'count => 1,
                            ]
                        ]
                    ],
                ]
            ]

        }

        */








        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);
        $validatedData['data_dialy_absen_detail'] = $data_dialy_absen_detail;
        $validatedData['data_dialy_absen_detail'] = $data_dialy_absen_detail;
        $validatedData['row_status_absen_abjads'] = $row_status_absen_abjads;
        $validatedData['data_dialy_absen'] = $data_dialy_absen;

        return ResponseFormatter::toJson($name, $validatedData);


        $createSheet->setCellValue('B16', 'ABSENSI BULAN  ' . $months[$month] . ' Tahun ' . $year);
        $createSheet->setCellValue('A20', 'No.');
        $createSheet->setCellValue('B20', 'ID EMP');
        $createSheet->setCellValue('C20', 'NAMA');
        $createSheet->setCellValue('D20', 'JABATAN');

        $status_absens_col = 1;
        $date_row = 4;
        $i_date = [];

        $startDate = new \DateTime($validatedData['filter']['date_filter']['date_start_filter_absen']);
        $endDate = new \DateTime($validatedData['filter']['date_filter']['date_end_filter_absen']);
        $i = 4;
        for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
            $i_date[$date->format('Y-m-d')] = $abjads[$i];
            $createSheet->setCellValue($abjads[$i] . '20', $date->format('d'));
            $i++;
        }

        $no_emp = 1;
        foreach ($validatedData['data_export'] as $item_data_export) {
            $no_emp_col = $no_emp + 20;
            $createSheet->setCellValue('A' . $no_emp_col, $no_emp);
            $createSheet->setCellValue('B' . $no_emp_col, $item_data_export->nik_employee);
            $createSheet->setCellValue('C' . $no_emp_col, $item_data_export->name);
            $createSheet->setCellValue('D' . $no_emp_col, $item_data_export->position);

            if (!empty($item_data_export->data)) {
                foreach ($item_data_export->data as $index => $item_item_data_export) {
                    $createSheet->setCellValue($i_date[$index] . $no_emp_col, $item_item_data_export->status_absen_uuid);
                }
            }
            $no_emp++;
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return ResponseFormatter::toJson($name, $validatedData);
    }

    function ekstrackAbsen($absensi, $old_cek_log = null)
    {
        $timeA = false; //from 00 to 6
        $timeB = false; //from 06 to 12
        $timeC = false; //from 12 to 17
        $timeD = false; //from 17 to 24
        // $statusAbsen;
        $cek_log = null;
        $arr_cek_log = [];
        $absens = str_split($absensi, 5); //to each excmpl time 07:00
        $merge_arr_absen = $absens;
        // $old_cek_log_ = [];
        if ($old_cek_log != null) {
            $merge_arr_absen = array_unique(array_merge(json_decode($old_cek_log), $merge_arr_absen), SORT_REGULAR);
        }

        $get_type_merge_arr_absen = gettype($merge_arr_absen);


        $count_time_zone = 0;

        foreach ($merge_arr_absen as $absen) {
            $hour = str_split($absen, 2);
            $hourInt    =  (int)$hour[0];
            if (($hourInt >= 00) && ($hourInt <= 5)) {
                if ($timeA == false) {
                    $count_time_zone++;
                }
                $timeA = true;
            }
            if (($hourInt >= 6) && ($hourInt <= 12)) {
                if ($timeB == false) {
                    $count_time_zone++;
                }
                $timeB = true;
            }
            if (($hourInt >= 12) && ($hourInt <= 17)) {
                if ($timeC == false) {
                    $count_time_zone++;
                }
                $timeC = true;
            }
            if (($hourInt >= 17) && ($hourInt <= 23)) {
                if ($timeD == false) {
                    $count_time_zone++;
                }
                $timeD = true;
            }

            if ($cek_log) {
                $cek_log = $cek_log . ".'" . $absen . "'";
            } else {
                $cek_log = "'" . $absen . "'";
            }
            $arr_cek_log[] = $absen;
        }
        if ($count_time_zone > 1) {
            $statusAbsen = 'DS';
        } else if ($count_time_zone == 1) {
            $statusAbsen = 'TA';
        } else if ($count_time_zone < 1) {
            $statusAbsen = 'TC';
        } else {
            $statusAbsen = "unknown";
        }


        $json_merge_arr_absen = json_encode($merge_arr_absen);
        $data = [
            'cek_log' => $cek_log,
            'status_absen' => $statusAbsen,
            'count_zone'    => $count_time_zone,
            'merge_arr_absen'    => $merge_arr_absen,
            'cek_log_now'    => $absensi,
            'old_cek_log'    => $old_cek_log,
            'arr_cek_log'   => $arr_cek_log,
            'json_arr_cek_log' => json_encode($arr_cek_log),
            'old_cek_log_type'    => gettype($old_cek_log),
            'merge_arr_absen' => $merge_arr_absen,
            'get_type_merge_arr_absen' => $get_type_merge_arr_absen,
            'json_merge_arr_absen' => $json_merge_arr_absen,
            'json_merge_arr_absen_type' => gettype($json_merge_arr_absen)
        ];
        return  $data;
    }

    static function processFingerTimes($finggerTimes, $timeConfig, $isFriday = false)
    {
        $timezone = 'Asia/Jakarta';
        $F = [];
        // Mengonversi string waktu menjadi objek Carbon
        $times = array_map(function ($time) use ($timezone) {
            $F[] = $time;
            return Carbon::createFromFormat('H:i', $time, $timezone);
        }, $finggerTimes);

        // Mengurutkan waktu dari yang paling awal
        usort($times, function ($a, $b) {
            return $a->lt($b) ? -1 : 1;
        });

        // Mengatur waktu konfigurasi
        $entryStart = Carbon::createFromFormat('H:i', $timeConfig['entryStart'], $timezone);
        $lateToleranceMinutes = $timeConfig['lateToleranceMinutes'];
        $exitLimit = Carbon::createFromFormat('H:i', $timeConfig['exitLimit'], $timezone);
        $restStart = Carbon::createFromFormat('H:i', $timeConfig['restStart'], $timezone)->setTimezone($timezone);
        $restEnd = $isFriday ? Carbon::createFromFormat('H:i', $timeConfig['restEndFriday'], $timezone) : Carbon::createFromFormat('H:i', $timeConfig['restEnd'], $timezone);

        $restEnd = Carbon::parse($restEnd)->setTimezone($timezone);
        $entry = null;
        $mid = null;
        $exit = null;
        $latePoints = 0;

        // 1. Tentukan entry (ambil waktu terkecil sebelum jam istirahat dimulai)
        foreach ($times as $key => $time) {
            if ($time->lt($restStart)) {
                $entry = $time;  // Simpan waktu terkecil sebelum batas waktu istirahat
                unset($times[$key]); // Hapus dari array setelah digunakan
                // Hitung poin keterlambatan jika entry melewati batas toleransi
                if ($time->gt($entryStart->copy()->addMinutes($lateToleranceMinutes))) {
                    $minutesLate = $time->diffInMinutes($entryStart);
                    // Hitung poin keterlambatan
                    $latePoints += max(0, floor(($minutesLate - $lateToleranceMinutes) / 60) + 1); // Hitung poin keterlambatan
                }
                break;
            }
        }

        // 2. Tentukan mid (antara restStart dan restEnd)
        foreach ($times as $key => $time) {
            if ($time->between($restStart, $restEnd)) {
                $mid = $time;
                unset($times[$key]); // Hapus dari array setelah digunakan
                break;
            }
        }



        // 3. Tentukan exit (ambil waktu terbesar setelah restEnd)
        foreach (array_reverse($times) as $key => $time) {
            if ($time->gt($restEnd)) {
                // Bandingkan jarak exit ke restEnd dan exitLimit
                $diffToRestEnd = $time->diffInMinutes($restEnd);
                $diffToExitLimit = $time->diffInMinutes($exitLimit);

                if ($diffToRestEnd < $diffToExitLimit) {
                    // Jika lebih dekat ke restEnd dan mid kosong, anggap sebagai mid
                    if (!$mid) {
                        $mid = $time;
                    }
                } else {
                    // Jika lebih dekat ke exitLimit, gunakan sebagai exit
                    $exit = $time;
                }

                $times = array_filter($times, function ($item) use ($time) {
                    return $item !== $time;
                });
                break;
            }
        }
        // return $mid;

        // return $times;

        // 4. Jika tidak ada entry, hitung jam yang hilang
        if (!$entry) {
            $hoursMissed = $entryStart->diffInHours($restStart);
            $latePoints += min($hoursMissed, 10);
        }




        // 5. Jika mid kosong, ambil nilai yang lebih besar dari entry setelah restEnd
        if (!$mid) {
            $closestMid = null;
            $minDifference = null;

            foreach ($times as $key => $time) {
                // Cek apakah waktu tersebut lebih besar dari restEnd, dan bukan entry atau exit
                if ($time->gt($restEnd) && (!$entry || $time->format('H:i') !== $entry) && (!$exit || $time->format('H:i') !== $exit)) {
                    $diffToRestEnd = $time->diffInMinutes($restEnd);
                    $diffToExitLimit = $time->diffInMinutes($exitLimit);

                    if ($diffToRestEnd < $diffToExitLimit) {
                        // Jika lebih dekat ke restEnd dan mid kosong, anggap sebagai mid
                        $mid = $time;
                        // Hitung selisih waktu dengan restEnd
                        $difference = $time->diffInMinutes($restEnd);

                        // Tentukan waktu yang paling mendekati restEnd
                        if ($minDifference === null || $difference < $minDifference) {
                            $closestMid = $time;
                            $minDifference = $difference;
                        }
                    }
                }
            }
            $mid = $closestMid;
        }

        // 5. Cek keterlambatan mid
        // if ($mid) {
        //     $midLateLimit = $restEnd->copy()->addMinutes($lateToleranceMinutes); // batas akhir mid
        //     if ($mid->gt($midLateLimit)) {
        //         $minutesLate = $midLateLimit->diffInMinutes($mid);
        //         if ($minutesLate > 0) {
        //             $latePoints += 1; // Tambah 1 poin jika terlambat lebih dari toleransi
        //             $latePoints += floor($minutesLate / 60); // Tambah poin tambahan per 60 menit
        //         }
        //     }
        // }


        // 6. Cek jika exit sebelum jam 17:00
        if ($exit && $exit->lt($exitLimit)) {
            $earlyLeaveMinutes = $exitLimit->diffInMinutes($exit);
            $latePoints += min(floor($earlyLeaveMinutes / 60), 10);
        }

        // 7. Jika exit kosong dan mid ada, tambahkan 2 poin keterlambatan
        if (!$exit && $mid) {
            $latePoints += 2; // Tambah poin karena tidak ada exit
        }

        // 8. Jika mid dan exit kosong, tambahkan 5 poin keterlambatan
        if (!$mid && !$exit) {
            $latePoints += 5; // Tambah poin karena tidak ada mid dan exit
        }

        // 9. Hitung waktu bekerja
        $workingHours = 0;

        if ($entry) {
            if ($entry->lt($entryStart)) {
                $w_entry = $entryStart;
            } else {
                $w_entry = $entry;
            }
            $workingHours = $restStart->diffInMinutes($w_entry);
        }

        if ($mid && $exit) {
            $w_mid = null;
            $w_exit = null;
            if ($mid->lt($restEnd)) {
                $w_mid = $restEnd;
            } else {
                $w_mid = $mid;
            }

            if ($exit->gt($exitLimit)) {
                $w_exit = $exitLimit;
            } else {
                $w_exit = $exit;
            }

            $workingHours += $w_mid->diffInMinutes($w_exit);
        } else if ($mid) {
            if ($mid->lt($restEnd)) {
                $workingHours += $restEnd->diffInMinutes($exitLimit);
            } else {
                $workingHours += $mid->diffInMinutes($exitLimit);
            }
        } else if ($exit) {
            if ($exit->gt($exitLimit)) {
                $workingHours += $restEnd->diffInMinutes($exitLimit);
            } else {
                $workingHours += $restEnd->diffInMinutes($exit);
            }
        }

        return [
            'status_absen' => $latePoints ? "TA" : 'DS',
            'entry' => $entry ? $entry->format('H:i') : null,
            'mid' => $mid ? $mid->format('H:i') : null,
            'cek_log' => $F,
            'exit' => $exit ? $exit->format('H:i') : null,
            'latePoints' => $latePoints,
            'workingHours' => $workingHours / 60, // Waktu bekerja dalam jam
            'lateMinutes' => (600 - $workingHours) > 0 ? (600 - $workingHours) : 0,
        ];
    }

    public function storeFingger(Request $request)
    {

        $validatedData = $request->all();
        $uuids = Str::uuid();

        $data_insert = [
            'code_table_data' => 'DATABASE-KODE-TABEL-ID-FINGGER',
            'code_field_data' => 'KODE-TABEL-ID-FINGGER',
            'value_data' => ResponseFormatter::toUUID($request['nik_employee'] . '-' . $request['employee_uuid']),
            'code_data' => ResponseFormatter::toUUID($request['nik_employee'] . '-' . $request['employee_uuid']),
            'uuid_data' => $uuids,
        ];

        $Q_store_data = DatabaseData::updateOrCreate(
            [
                'code_table_data' => $data_insert['code_table_data'], //table data source
                'code_field_data' => $data_insert['code_field_data'],
                'code_data' => $data_insert['code_data'], //value primary key
                'uuid_data' => $uuids,
            ],
            [
                'value_data' => $data_insert['value_data'],
                'date_start' => Carbon::now()->format('Y-m-d'),
                'date_end' => null,
            ]
        );

        $data_insert = [
            'code_table_data' => 'DATABASE-KODE-TABEL-ID-FINGGER',
            'code_field_data' => 'NRP',
            'value_data' => ResponseFormatter::toUUID($request['nik_employee']),
            'code_data' => ResponseFormatter::toUUID($request['nik_employee'] . '-' . $request['employee_uuid']),
            'uuid_data' => $uuids,
        ];

        $Q_store_data = DatabaseData::updateOrCreate(
            [
                'code_table_data' => $data_insert['code_table_data'], //table data source
                'code_field_data' => $data_insert['code_field_data'],
                'code_data' => $data_insert['code_data'], //value primary key
                'uuid_data' => $uuids,
            ],
            [
                'value_data' => $data_insert['value_data'],
                'date_start' => Carbon::now()->format('Y-m-d'),
                'date_end' => null,
            ]
        );

        $data_insert = [
            'code_table_data' => 'DATABASE-KODE-TABEL-ID-FINGGER',
            'code_field_data' => 'ID-FINGGER',
            'value_data' => $request['employee_uuid'],
            'code_data' => ResponseFormatter::toUUID($request['nik_employee'] . '-' . $request['employee_uuid']),
            'uuid_data' => $uuids,
        ];

        $Q_store_data = DatabaseData::updateOrCreate(
            [
                'code_table_data' => $data_insert['code_table_data'], //table data source
                'code_field_data' => $data_insert['code_field_data'],
                'code_data' => $data_insert['code_data'], //value primary key
                'uuid_data' => $uuids,
            ],
            [
                'value_data' => $data_insert['value_data'],
                'date_start' => Carbon::now()->format('Y-m-d'),
                'date_end' => null,
            ]
        );

        $StoreAbsen = EmployeeAbsen::where('employee_uuid', $validatedData['employee_uuid'])
            ->update([
                'employee_uuid' => $validatedData['nik_employee'],
            ]);

        return ResponseFormatter::toJson($request->all(), 'Absensi stored');
    }

    static public function findClosestShift($dateToFind, $shiftData)
    {
        // Ubah tanggal yang akan dicari ke format DateTime agar mudah untuk dibandingkan
        $dateToFind = new DateTime($dateToFind);
        $closestDate = null;
        $closestShift = null;

        foreach ($shiftData as $date => $shiftInfo) {
            $currentDate = new DateTime($date);

            // Pastikan hanya tanggal yang lebih kecil atau sama dengan tanggal yang dicari
            if ($currentDate <= $dateToFind) {
                // Jika belum ada closestDate, atau jika currentDate lebih mendekati ke dateToFind, update
                if (!$closestDate || $currentDate > $closestDate) {
                    $closestDate = $currentDate;
                    $closestShift = $shiftInfo;
                }
            }
        }

        return $closestShift; // Nilai shift terdekat yang ditemukan
    }

    public function import(Request $request)
    {
        $the_file = $request->file('uploaded_file');
        $data_database = session('data_database');
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $year_start = '';
        $month_start = '';
        $dataaa = [];
        $all_datas = [];
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();


            $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

            if ($sheet->getCell('A2')->getValue() == 'Excel') { //File dari Excell berbentuk tabel full bulan
                $month_absensi = $sheet->getCell('H19')->getValue();
                $arr_month_absensi = explode(' ', $month_absensi);
                // return ResponseFormatter::toJson($arr_month_absensi, 'store from excel report');
                $year =  $arr_month_absensi[4];
                $month = str_pad(ResponseFormatter::monthSort($arr_month_absensi[2]), 2, '0', STR_PAD_LEFT);
                $year_month = $year . '-' . $month;

                $last_day = ResponseFormatter::getEndDay($year . '-' . $month);

                $start_date = ResponseFormatter::getStartDayFromDate($year_month . '-01');
                $end_date = ResponseFormatter::getEndDayFromDate($year_month . '-' . $last_day);

                $data_absensi_old_ceklog = EmployeeAbsen::where('employee_absens.date', '>=', $start_date)
                    ->where('employee_absens.date', '<=', $end_date)
                    ->get();


                $array_data_old_absensi = [];
                foreach ($data_absensi_old_ceklog as $item_data_absensi_old_ceklog) {
                    $array_data_old_absensi[$item_data_absensi_old_ceklog->employee_uuid][$item_data_absensi_old_ceklog->date] = $item_data_absensi_old_ceklog;
                }


                $no_employee = 21;
                /*

                    data dimulai dari baris ke 21,
                    data bulan apa ada di cell 


                */


                while ($sheet->getCell('A' . $no_employee)->getValue() != null) {
                    $column_date = 7;
                    $nik_employee = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue());

                    for ($day = 1; $day <= $last_day; $day++) {
                        if ($sheet->getCell($rows[$column_date] . $no_employee)->getValue()) {
                            if ($sheet->getCell($rows[$column_date] . $no_employee)->getValue() != "-") {
                                // if (empty($array_data_old_absensi[$nik_employee][ResponseFormatter::excelToDate($year_month . '-' . $day)])) {
                                $store_employee_absen = EmployeeAbsen::updateOrCreate(
                                    [
                                        'employee_uuid'  => $nik_employee,
                                        'date' => ResponseFormatter::excelToDate($year_month . '-' . $day),
                                    ],
                                    [
                                        'shift' => 'S1',
                                        'uuid' => ResponseFormatter::excelToDate($year_month . '-' . $day) . '-' . $nik_employee,
                                        'status_absen_uuid'     => ResponseFormatter::toUUID($sheet->getCell($rows[$column_date] . $no_employee)->getValue()),
                                    ]
                                );
                                // }
                            }
                        }
                        $column_date++;
                    }


                    $column_date = 4 + $last_day;
                    $no_employee++;
                }
                // return ResponseFormatter::toJson($sheet->getCell('A' . $no_employee)->getValue(), 'a');
                return ResponseFormatter::toJson($no_employee, 'excel');
                return back();
            } elseif ('DARI-LIST' == ResponseFormatter::toUUID($sheet->getCell('C' . '1')->getValue())) {
                // return ResponseFormatter::toJson('list','list');
                $no_employee = 21;

                // $employees = [];
                $arr_data_list = [];
                while ($sheet->getCell('A' . $no_employee)->getValue() != null) {
                    $cel_val = $sheet->getCell('J' .  $no_employee)->getValue();
                    $firstCharacter = substr($cel_val, 0, 1);
                    $value_STATUS_ABSEN = $sheet->getCell('K' .  $no_employee)->getValue();
                    $firstCharacter_STATUS_ABSEN = substr($value_STATUS_ABSEN, 0, 1);
                    if ($firstCharacter == '=') {
                        $value = $sheet->getCell('J' .  $no_employee)->getOldCalculatedValue();
                    } elseif ($firstCharacter == '-') {
                        $value = $sheet->getCell('J' .  $no_employee)->getOldCalculatedValue();
                    } else {
                        $value = $sheet->getCell('J' .  $no_employee)->getValue();
                    }

                    if ($firstCharacter_STATUS_ABSEN == '=') {
                        $value_STATUS_ABSEN = $sheet->getCell('K' .  $no_employee)->getOldCalculatedValue();
                    } elseif ($firstCharacter_STATUS_ABSEN == '-') {
                        $value_STATUS_ABSEN = $sheet->getCell('K' .  $no_employee)->getOldCalculatedValue();
                    } else {
                        $value_STATUS_ABSEN = $sheet->getCell('K' .  $no_employee)->getValue();
                    }

                    $data_one_row = [
                        'nik_employee' => ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue()),
                        'employee_uuid' => ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue()),
                        'date_start' => ResponseFormatter::excelToDate($sheet->getCell('H' .  $no_employee)->getValue()),
                        'date_end' => ResponseFormatter::excelToDate($value),
                        'status_absen_uuid' => ResponseFormatter::toUUID($value_STATUS_ABSEN),
                        'shift' => 'S1',
                        'absen_description' => $sheet->getCell('L' .  $no_employee)->getValue(),
                    ];

                    $startDate = new \DateTime($data_one_row['date_start']);
                    $endDate = new \DateTime($data_one_row['date_end']);
                    $validatedData['edited'] = 'edited';

                    for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
                        $data_one_row['date'] =  $date->format('Y-m-d');

                        $data_one_row['uuid']  = $data_one_row['date'] . '-' . $data_one_row['employee_uuid'];
                        if($data_one_row['status_absen_uuid'] != '-'){
                            $store = EmployeeAbsen::updateOrCreate(
                                [
                                    'employee_uuid'  => $data_one_row['nik_employee'],
                                    'date' => $data_one_row['date'],
                                ],
                                $data_one_row
                            );
                            $validatedData['store'][] = $store;
                        }
                        
                    }

                    $arr_data_list[] = $data_one_row;
                    $no_employee++;
                }
                return ResponseFormatter::tojson($arr_data_list, 'from list employee absen');
            } else { //dari mesin fingger

                $sheet = $spreadsheet->getSheet(2);
                $validatedData = $request->all();
                $array_friday = [];

                $timeConfig = [
                    'entryStart' => '06:00',         // Jam mulai kerja
                    'lateToleranceMinutes' => 15,    // Toleransi keterlambatan dalam menit
                    'restStart' => '11:00',          // Jam mulai istirahat
                    'restEnd' => '12:00',            // Jam akhir istirahat (hari biasa)
                    'restEndFriday' => '13:00',      // Jam akhir istirahat (hari Jumat)
                    'exitLimit' => '17:00',           // Jam pulang kerja
                    'isFriday'  => false,
                    'shift' => null,
                ];

                // ==== GET DATE DATA ====

                $row_limit    = $sheet->getHighestDataRow();
                $tanggal = $sheet->getCell('C' . 3)->getValue();

                $splitTanggal =  str_split($tanggal, 1);

                $date_start =  $splitTanggal[8] . $splitTanggal[9];
                $date_end   =  $splitTanggal[21] . $splitTanggal[22];
                $month_start = $splitTanggal[5] . $splitTanggal[6];
                $month_end   = $splitTanggal[18] . $splitTanggal[19];
                $year_start = $splitTanggal[0] . $splitTanggal[1] . $splitTanggal[2] . $splitTanggal[3];
                $year_end  = $splitTanggal[13] . $splitTanggal[14] . $splitTanggal[15] . $splitTanggal[16];
                $year_end . "-" . $month_end . "-" . $date_end;
                $start_date = date_create($year_start . "-" . $month_start . "-" . $date_start);
                $end_date = date_create($year_end . "-" . $month_end . "-" . $date_end);
                $end_date = date_add($end_date, date_interval_create_from_date_string("1 days"));
                // ==== END GET DATE DATA ====

                // ==== VALIDATION DATE PREPROCESING =====
                $all_datas['have_employees']['configuration'] = [
                    'long_date' => $date_end,
                    'first_date'    => $start_date->format('Y-m-d'),
                    'end_date'    => $end_date->format('Y-m-d'),
                ];

                if (empty($validatedData['date_absen_start'])) {
                    $data_return = [
                        'date_absen_start' => $start_date->format('Y-m-d'),
                        'date_absen_end' => $end_date->format('Y-m-d'),
                    ];
                    return ResponseFormatter::toJson($data_return, 'data return to setup');
                }

                // 4. MENDAPATKAN SHIFT KARYAWAN
                $Q_DATA_SHIFT = DatabaseData::where('code_table_data', 'DATA-SHIFT-KARYAWAN')
                    ->whereNull('date_end')
                    ->where('code_field_data', 'NRP')
                    ->get();

                $DATA_SHIFT_KARYAWAN = [];
                foreach ($Q_DATA_SHIFT  as $I_DATA_SHIFT) {
                    $DATA_SHIFT_KARYAWAN[$I_DATA_SHIFT->code_data]['NRP'] = $I_DATA_SHIFT->value_data;
                }

                $Q_DATA_SHIFT = DatabaseData::where('code_table_data', 'DATA-SHIFT-KARYAWAN')
                    ->whereNull('date_end')
                    ->where('code_field_data', 'SHIFT')
                    ->get();

                foreach ($Q_DATA_SHIFT  as $I_DATA_SHIFT) {
                    $DATA_SHIFT_KARYAWAN[$I_DATA_SHIFT->code_data]['SHIFT'] = $I_DATA_SHIFT->value_data;
                    $DATA_SHIFT_KARYAWAN[$I_DATA_SHIFT->code_data]['DATE'] = $I_DATA_SHIFT->date_start;
                }

                $DATA_SHIFT = [];
                foreach ($DATA_SHIFT_KARYAWAN as $I_DATA_SHIFT_KARYAWAN) {
                    $DATA_SHIFT[$I_DATA_SHIFT_KARYAWAN['NRP']][$I_DATA_SHIFT_KARYAWAN['DATE']] = $I_DATA_SHIFT_KARYAWAN['SHIFT'];
                }

                // 5. MENDAPATKAN ID FINGGER KARYAWAN

                $Q_data_fingger = DatabaseData::where('code_table_data', 'DATABASE-KODE-TABEL-ID-FINGGER')->get();
                $arr_data_fingger = [];
                foreach ($Q_data_fingger as $item_data_fingger) {
                    $arr_data_fingger[$item_data_fingger->uuid_data][$item_data_fingger->code_field_data] = $item_data_fingger->value_data;
                }
                $employees_machine_ids = [];
                foreach ($arr_data_fingger as $item_fingger) {
                    $employees_machine_ids[$item_fingger['ID-FINGGER']] = $item_fingger['NRP'];
                }

                // return ResponseFormatter::toJson($employees_machine_ids,'data fingger id employees');



                // ==== END VALIDATION DATE PREPROCESING =====
                $start_date = date_create($validatedData['date_absen_start']);
                $end_date = date_create($validatedData['date_absen_end']);

                // $data_database = session('data_database');
                $data_employees = session('db_local_storage')['public']['KARYAWAN'];


                // dd($end_date);
                $result = $end_date->format('Y-m-d');

                $interval = date_diff($start_date, $end_date);
                $interval_data =  $interval->days + 1;
                $period = new DatePeriod(
                    new DateTime($year_start . "-" . $month_start . "-" . $date_start),
                    new DateInterval('P1D'),
                    new DateTime($result)
                );
                $date_data = array();
                $all_data = [];

                $data_absensi_old_ceklog = EmployeeAbsen::where('employee_absens.date', '>=', $start_date->format('Y-m-d'))
                    ->where('employee_absens.date', '<=', $end_date->format('Y-m-d'))
                    ->get();


                $array_data_old_absensi = [];
                foreach ($data_absensi_old_ceklog as $item_data_absensi_old_ceklog) {
                    $array_data_old_absensi[$item_data_absensi_old_ceklog->employee_uuid][$item_data_absensi_old_ceklog->date] = $item_data_absensi_old_ceklog;
                }


                //6. mencari array tanggal
                foreach ($period as $key => $value) {
                    if ($value->format('N') == 5) {
                        $array_friday[] = $value->format('Y-m-d');
                    }
                    $date_data[] = $value->format('Y-m-d');
                }

                $employees_count = ($row_limit - 4) / 2;
                $i = 5;
                $arr_machine_id = [];

                $un_identification = [];
                $identification = [];
                $MAC = [];

                $data_storesss = [];

                // foreach employees
                for ($j = 0; $j < $employees_count; $j++) {

                    $employee_uuid = $employeeName = $sheet->getCell('K' . $i)->getValue();
                    $ID_Fingger = $sheet->getCell('C' . $i)->getValue();

                    $absensies = [
                        'machine_id'  => $employeeName,
                        'id_fingger'  => $ID_Fingger,
                    ];


                    // 7. MENCOCOKAN ID FINGGER
                    if (!empty($employees_machine_ids[$ID_Fingger])) {
                        $employee_uuid =  $absensies['employee_uuid'] = $employees_machine_ids[$ID_Fingger];
                    } else if (!empty($employees_machine_ids[$employeeName])) {
                        $employee_uuid =   $absensies['employee_uuid'] = $employees_machine_ids[$employeeName];
                    }

                    if (!empty($absensies['employee_uuid'])) {
                        $identification[$absensies['employee_uuid']] = $absensies;
                    } else {
                        $un_identification[] = $absensies;
                    }

                    $MAC[] =  $employee_uuid;


                    $absensies = array();
                    $count_day = 0;
                    $arr_machine_id[$employeeName]['name'] = $employeeName;

                    // 7. UNTUK STORE KE DB
                    foreach ($date_data as $abjad) {
                        $cell_d = $i + 1;
                        $date_now = date_create($abjad);
                        $absensies = ['employee_uuid'  => $employee_uuid];
                        //7.0 cek apakah ini bagian dari tanggal yang mau di ambil
                        if (($date_now >= $start_date) && ($date_now <= $end_date)) {
                            $absensi = $sheet->getCell($rows[$count_day] . $cell_d)->getValue(); //data_ceklog dari absen

                            $old_cek_log = null;
                            $isEdited = null;
                            $statusAbsen = null;

                            if (!empty($absensi)) {
                                $merge_arr_absen = str_split($absensi, 5);
                                $absensies = [
                                    'uuid' => $employee_uuid . '-' . ResponseFormatter::excelToDate($abjad),
                                    'employee_uuid'  => $employee_uuid,
                                    'date' => $abjad,
                                    'status_absen_uuid'     => null,
                                    'cek_log'       =>  $merge_arr_absen,

                                    'late_points' => 0,
                                    'late_minutes' => 0,
                                    'working_hours' => 0,
                                    'entry' => null,
                                    'exit' => null,
                                    'mid' => null,
                                    'shift' => null,
                                ];

                                //7.1 ubah shift, isFriday, 
                                if (in_array($abjad, $array_friday)) {
                                    $timeConfig['isFriday'] = true;
                                } else {
                                    $timeConfig['isFriday'] = false;
                                }
                                //7.1 ubah shift
                                if (!empty($DATA_SHIFT[$employee_uuid])) {
                                    if (!$timeConfig['shift']) {
                                        $timeConfig['shift'] = $this->findClosestShift($abjad, $DATA_SHIFT[$employee_uuid]);
                                    }

                                    if (!empty($DATA_SHIFT[$employee_uuid][$abjad])) {
                                        $timeConfig['shift'] = $DATA_SHIFT[$employee_uuid][$abjad];
                                    }
                                } else {
                                    $timeConfig['shift'] = 'S1';
                                }


                                // 7.2 cek absensi lama
                                $isEqual = false;
                                try {
                                    $old_cek_log = $array_data_old_absensi[$employee_uuid][$abjad]['cek_log'];

                                    $isEdited = (!empty($array_data_old_absensi[$employee_uuid][$abjad]['edited'])) ? $array_data_old_absensi[$employee_uuid][$abjad]['edited'] : null;

                                    if ($array_data_old_absensi[$employee_uuid][$abjad]['cek_log']) {
                                        $old_cek_log = $array_data_old_absensi[$employee_uuid][$abjad]['cek_log'];

                                        if (gettype($old_cek_log) == 'string') {
                                            $old_cek_log = json_decode($old_cek_log);
                                        }

                                        $merge_arr_absen = array_unique(array_merge($old_cek_log, $merge_arr_absen), SORT_REGULAR);
                                        $merge_arr_absen = array_unique($merge_arr_absen);
                                        $isEqual = false;

                                    }
                                } catch (\Throwable $th) {
                                }

                                if (!$isEqual) {

                                    $data_fingger = [];
                                    foreach ($merge_arr_absen as $is_fingger) {
                                        $data_fingger[] = $is_fingger;
                                    }
                                    $data_fingger = array_unique($data_fingger);
                                    $data_fingger = array_values(array_unique($data_fingger));
                                    $statusAbsen = EmployeeAbsenController::processFingerTimes($data_fingger, $timeConfig, $timeConfig['isFriday']);
                                }


                                if (!empty($statusAbsen)) {
                                    $absensies['cek_log'] = json_encode($data_fingger);
                                    $absensies['entry'] = $statusAbsen['entry'];
                                    $absensies['mid'] = $statusAbsen['mid'];
                                    $absensies['exit'] = $statusAbsen['exit'];
                                    $absensies['late_points'] = $statusAbsen['latePoints'];
                                    $absensies['late_minutes'] = $statusAbsen['lateMinutes'];
                                    $absensies['working_hours'] = round($statusAbsen['workingHours'], 2);
                                    $absensies['shift'] = $timeConfig['shift'];
                                    $absensies['edited'] = $isEdited;
                                    $absensies['status_absen_uuid'] = $statusAbsen['status_absen'];

                                    if (!empty($isEdited)) {
                                        $absensies['status_absen_uuid'] = null;
                                    }
                                    $absensies = array_filter($absensies);
                                    $data_storesss[$absensies['employee_uuid']][$absensies['date']] = $absensies;
                                }
                            }
                            $all_data[$employee_uuid][] = $absensies;
                            if ((string)$employee_uuid != (string)$employeeName) {
                                if (!empty($data_employees[$employee_uuid])) {
                                    if (empty($all_datas['have_employees']['detail'][$employee_uuid])) {
                                        $all_datas['have_employees']['data'][] = [
                                            'employee_uuid' => $employee_uuid,
                                            'machine_id'    => $employeeName,
                                            'nik_employee'  => $employee_uuid
                                        ];
                                    }
                                    // dd( $all_datas['have_employees']['data']);
                                    $all_datas['have_employees']['detail'][$employee_uuid][$abjad] = $absensies;
                                }
                            } else {
                                if (empty($all_datas['null_employees'][$absensies['employee_uuid']])) {
                                    $all_datas['null_employees'][$absensies['employee_uuid']] = $absensies;
                                }
                                $all_datas['null_employees'][$absensies['employee_uuid']]['data'][$abjad] = $absensies;
                            }

                            // return ResponseFormatter::toJson($all_datas, 'data return to err');
                            $arr_machine_id[$employeeName]['date'][$abjad] = $statusAbsen;
                        }
                        $count_day++;
                    }

                    $i = $i + 2;
                }

                $all_datas['have_employees']['configuration'] = [
                    'long_date' => $date_end,
                    'first_date'    => $start_date->format('Y-m-d'),
                    'end_date'    => $end_date->format('Y-m-d'),
                ];
                $all_datas['GENERAL'] = EmployeeAbsen::storeAbsensiesGeneral($data_storesss);
                $all_datas['identification'] = $identification;
                $all_datas['un_identification'] = $un_identification;
                $all_datas['employees_machine_ids'] = $employees_machine_ids;
                session()->put('after-import', $all_datas);

                return ResponseFormatter::toJson($all_datas, 'here');
                $row = 4;
                foreach ($date_data as $abjad) {
                    $createSheet->setCellValue($rows[$row] . '5', $abjad);
                    $row++;
                    $row++;
                }
                $row = 7;
                foreach ($all_data as $index => $item) {
                    foreach ($item as $item_day) {
                        $explode_date = explode('-', $item_day['date']);
                        if ($item_day['status_absen_uuid']) {
                            $the_row = (int)$explode_date[2] * 2 + 2;
                            $createSheet->setCellValue($rows[$the_row] . $row, $item_day['status_absen_uuid']); //status
                            $the_row++;
                            $createSheet->setCellValue($rows[$the_row] . $row, $item_day['cek_log']); //ceklog
                        }
                    }
                    $createSheet->setCellValue('D' . $row, $index);
                    $row++;
                }

                $crateWriter = new Xls($createSpreadsheet);
                $name = 'file/absensi/file/ekstrak-absen-' . rand(99, 9999) . 'file.xls';
                $crateWriter->save($name);
                return ResponseFormatter::toJson($all_datas, 'here');
                dd($dataaa);
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function afterImport()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'list-employees-absensi'
        ];
        ResponseFormatter::setAllSession();
        return view('employee.absensi.afterImport', [
            'title'         => 'After Import',
            'layout'    => $layout
        ]);
    }

    public function anyDataPost_X(Request $request)
    {
        $validateData = $request->all();
        $request_all = $request->all();
        $db_kelompok_admin = Aktivity::where('table_name', 'DATABASE-KELOMPOK-ABSEN')->get();

        $array_db_kelompok_admin = [];
        foreach ($db_kelompok_admin as $item_db_kelompok_admin) {
            $array_db_kelompok_admin[$item_db_kelompok_admin->code_data][] = $item_db_kelompok_admin;
        }

        // filter by query
        // filter by looping
        $all_employee = Employee::whereNull('employees.date_end')
            ->whereNull('employees.date_end')
            ->where('employees.employee_status', '!=', 'talent')
            ->get();

        $data_employee_filtered = [];
        foreach ($all_employee as $item_employee) {
            if (!empty($validateData['filter']['arr_filter']['company'])) {
                if (array_search($item_employee->company_uuid, $validateData['filter']['arr_filter']['company'])) {
                    $data_employee_filtered[$item_employee->nik_employee] = $item_employee;
                }
            } else {
                $data_employee_filtered[$item_employee->nik_employee] = $item_employee;
            }
        }
        // return ResponseFormatter::toJson($data_employee_filtered, "success all employees");




        if (empty($validateData['filter']['arr_filter'])) {
            $validateData['filter']['arr_filter'] = $validateData['filter']['value_checkbox'];
        } else {
            if (empty($validateData['filter']['arr_filter']['company'])) {
                $validateData['filter']['arr_filter']['company'] = $validateData['filter']['value_checkbox']['company'];
            }
            if (empty($validateData['filter']['arr_filter']['math'])) {
                $validateData['filter']['arr_filter']['math'] = $validateData['filter']['value_checkbox']['math'];
            }
            if (empty($validateData['filter']['arr_filter']['site_uuid'])) {
                $validateData['filter']['arr_filter']['site_uuid'] = $validateData['filter']['value_checkbox']['site_uuid'];
            }
        }
        // return ResponseFormatter::toJson($validateData, "success all employees");
        if (!empty($validateData['filter']['arr_filter']['site_uuid'])) {
            // return ResponseFormatter::toJson($validateData, "! success all employees");
            $data_employee_filteredx = $data_employee_filtered;
            $data_employee_filtered = [];
            foreach ($data_employee_filteredx as $item_employee) {
                if (array_search($item_employee->site_uuid, $validateData['filter']['arr_filter']['site_uuid'], TRUE)) {
                    // return ResponseFormatter::toJson($item_employee->site_uuid, "success all site_uuid");
                    $data_employee_filtered[$item_employee->nik_employee] = $item_employee;
                }
            }
        }




        // return ResponseFormatter::toJson($validateData, "success all employees");







        // return ResponseFormatter::toJson($validateData, "success all employees");


        $data_all_employee =  Employee::data_employee();
        $data_emp = Employee::join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->leftJoin('employee_salaries', 'employee_salaries.employee_uuid', '=', 'employees.uuid')
            ->leftJoin('companies', 'companies.uuid', 'employees.company_uuid')
            ->leftJoin('positions', 'positions.uuid', '=', 'employees.position_uuid')
            ->leftJoin('departments', 'departments.uuid', '=', 'employees.department_uuid')
            ->leftJoin('user_addresses', 'user_addresses.user_detail_uuid', '=', 'employees.user_detail_uuid')
            ->whereNull('employees.date_end')
            ->whereNull('user_details.date_end')
            ->whereNull('user_addresses.date_end')
            ->whereNull('employee_salaries.date_end')
            ->where('employees.employee_status', '!=', 'talent');

        $companies = ['BK', 'MB', 'MBLE'];
        $sites = ['KPN'];

        foreach ($companies as $index => $company) {
            if ($index == 0) {
                $data_emp = $data_emp->where('companies.company', $company);
            } else {
                $data_emp = $data_emp->orWhere('companies.company', $company);
            }
        }
        foreach ($sites as $index => $site) {
            if ($index == 0) {
                $data_emp = $data_emp->where('site_uuid', $site);
            } else {
                $data_emp = $data_emp->orWhere('site_uuid', $site);
            }
        }
        $data_emp = $data_emp->get([
            'user_details.name',
            'user_details.photo_path',
            'companies.company',
            'positions.position',
            'employee_salaries.hour_meter_price_uuid',
            'user_addresses.*',
            'employees.*'
        ]);


        $data_response = [];

        foreach ($data_emp as $emp) {
            $data_response['data_employee'][$emp->nik_employee]['detail'] = $emp;
            $data_response['data_employee'][$emp->nik_employee]['data'] = [];
        }

        $data_all_employee =  Employee::data_employee();
        $data_nik_employee = [];
        foreach ($data_all_employee as $data_each_employee) {
            $data_nik_employee[$data_each_employee->nik_employee] = $data_each_employee;
        }



        $data_database = session('data_database');
        $data_employees = $data_database['data_employees'];
        $data_database = session('data_database');
        $data_employees_machine_id = $data_database['data_datatable_database']['database']['data-table']['ID-FINGGER-KARYAWAN'];
        $employees_machine_ids = [];
        foreach ($data_employees_machine_id as $item) {
            $employees_machine_ids[$item['ID-FINGGER']['value_field']] = $item['ID-KARYAWAN']['value_field'];
        }
        $count_date_day = ResponseFormatter::countDayLongWork($validateData['filter']['date_filter']['date_start_filter_absen'], $validateData['filter']['date_filter']['date_end_filter_absen']);


        if (empty($validateData['filter']['arr_filter'])) {
            $validateData['filter']['arr_filter'] = $validateData['filter']['value_checkbox'];
        } else {
            if (empty($validateData['filter']['arr_filter']['company'])) {
                $validateData['filter']['arr_filter']['company'] = $validateData['filter']['value_checkbox']['company'];
            }
            if (empty($validateData['filter']['arr_filter']['math'])) {
                $validateData['filter']['arr_filter']['math'] = $validateData['filter']['value_checkbox']['math'];
            }
            if (empty($validateData['filter']['arr_filter']['site_uuid'])) {
                $validateData['filter']['arr_filter']['site_uuid'] = $validateData['filter']['value_checkbox']['site_uuid'];
            }
        }

        $data_filter = [];
        $math_filter = [];
        $employee_data_uuid = [];
        $employee_data_machine_id = [];
        foreach ($validateData['filter']['arr_filter']['company'] as $item_company) {
            foreach ($validateData['filter']['arr_filter']['site_uuid'] as $item_site_uuid) {
                $data_filter[$item_company . '-' . $item_site_uuid] = ['detail'];
            }
        }
        foreach ($validateData['filter']['arr_filter']['math'] as $item_math) {
            $math_filter[$item_math] = ['detail'];
        }

        $employee_get = Employee::data_employee();

        if (!empty($validateData['filter']['nik_employee'])) {
            $employee_get = $employee_get->where('nik_employee', $validateData['filter']['nik_employee']);
        }
        $status_absens = StatusAbsen::all();

        foreach ($employee_get as $item_employee_get) {
            // if (!empty($data_filter[$item_employee_get->company_uuid . '-' . $item_employee_get->site_uuid])) {
            //     if (empty($data_database['data_employee_out'][$item_employee_get->nik_employee])) {
            $employee_data_machine_id[$item_employee_get->machine_id] = $item_employee_get->nik_employee;
            $employee_data_uuid[$item_employee_get->nik_employee] = $item_employee_get;
            $data_absen_x = [];
            foreach ($status_absens as $item_status_absens) {
                $data_absen_x['count_' . $item_status_absens->math] = 0;
                $data_absen_x['count_' . $item_status_absens->uuid] = 0;
            }
            $data_absen_x['count_unknown_absen'] = $count_date_day;
            $employee_data_uuid[$item_employee_get->nik_employee]['absensi'] = $data_absen_x;
            $employee_data_uuid[$item_employee_get->nik_employee]['data'] = [];

            // } elseif (($data_database['data_employee_out'][$item_employee_get->nik_employee]['date_out'] > $validateData['filter']['date_filter']['date_start_filter_absen']) && ($data_database['data_employee_out'][$item_employee_get->nik_employee]['date_out'] < $validateData['filter']['date_filter']['date_end_filter_absen'])) {
            //     if (!empty($data_filter[$item_employee_get->company_uuid . '-' . $item_employee_get->site_uuid])) {
            //         $employee_data_machine_id[$item_employee_get->machine_id] = $item_employee_get->nik_employee;
            //         $employee_data_uuid[$item_employee_get->nik_employee] = $item_employee_get;
            //         $data_absen_x = [];
            //         foreach ($status_absens as $item_status_absens) {
            //             $data_absen_x['count_' . $item_status_absens->math] = 0;
            //             $data_absen_x['count_' . $item_status_absens->uuid] = 0;
            //         }
            //         $data_absen_x['count_unknown_absen'] = $count_date_day;
            //         $employee_data_uuid[$item_employee_get->nik_employee]['absensi'] = $data_absen_x;
            //         $employee_data_uuid[$item_employee_get->nik_employee]['data'] = [];
            //     }
            // }
            // }
        }

        $data_employee_absen_detail_nik_employee = [];

        $data_employee_absen_detail = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
            ->where('employee_absens.date', '>=',  $validateData['filter']['date_filter']['date_start_filter_absen'])
            ->where('employee_absens.date', '<=',  $validateData['filter']['date_filter']['date_end_filter_absen']);

        if (!empty($validateData['filter']['nik_employee'])) {
            $data_employee_absen_detail = $data_employee_absen_detail->where('employee_uuid', $employee_data_uuid[$validateData['filter']['nik_employee']]['machine_id']);
        }

        $data_employee_absen_detail = $data_employee_absen_detail->get([
            'status_absens.*',
            'employee_absens.*',
            'employee_absens.uuid as uuid',
        ]);

        $Q_employee_outs = EmployeeOut::where('employee_outs.date_out', '<',  $validateData['filter']['date_filter']['date_start_filter_absen'])->get();

        $data_employee_out = [];
        foreach ($Q_employee_outs as $employee_out) {
            $data_employee_out[$employee_out->employee_uuid] = $employee_out;
        }

        $data_employee_absen = [];
        foreach ($data_employee_absen_detail as $ab) {


            $data_employee_absen[$ab->employee_uuid][] = $ab;
            if (!empty($data_response['data_employee'][$ab->employee_uuid])) {
                $data_response['data_employee'][$ab->employee_uuid][$ab->date] = $ab;
            } else {
                if (!empty($data_nik_employee[$ab->employee_uuid])) {
                } else {
                    $data_response['data_other_employee'][$ab->employee_uuid][$ab->date] = $ab;
                }
            }
        }

        // return ResponseFormatter::toJson(count($employee_data_uuid), '$data_employee_absen');

        $data_employee_absen = [];
        foreach ($data_employee_absen_detail as $item_data_employee_absen_detail) {

            if (!empty($data_database['data_employees'][$item_data_employee_absen_detail->employee_uuid])) {
                $data_employee_absen[$item_data_employee_absen_detail->employee_uuid][$item_data_employee_absen_detail->date] = $item_data_employee_absen_detail;
            }

            if (!empty($employee_data_uuid[$item_data_employee_absen_detail->employee_uuid])) {
                // if (!empty($math_filter[$item_data_employee_absen_detail->math])) {
                $arr_data = $employee_data_uuid[$item_data_employee_absen_detail->employee_uuid]['data'];
                // return ResponseFormatter::toJson('data', 'anyDataPost_X');
                $arr_data[$item_data_employee_absen_detail->date] = $item_data_employee_absen_detail;
                $employee_data_uuid[$item_data_employee_absen_detail->employee_uuid]['data'] = $arr_data;

                $arr_count_absen =  $employee_data_uuid[$item_data_employee_absen_detail->employee_uuid]['absensi'];
                $value_count = (int)$arr_count_absen['count_' . ResponseFormatter::toUUID($item_data_employee_absen_detail->status_absen_uuid)];
                $value_count = $value_count + 1;
                $arr_count_absen['count_' . $item_data_employee_absen_detail->status_absen_uuid] = $value_count;
                $arr_count_absen['count_' . $item_data_employee_absen_detail->math] = (int)$arr_count_absen['count_' . $item_data_employee_absen_detail->math] + 1;
                $arr_count_absen['count_unknown_absen']--;
                $employee_data_uuid[$item_data_employee_absen_detail->employee_uuid]['absensi'] = $arr_count_absen;
                // }
            }
        }

        $data_filter_math = [];

        foreach ($employee_data_uuid as  $item_employee_data_uuid) {
            if (empty($data_employee_out[$item_employee_data_uuid->nik_employee])) {
                if (empty($data_filter_math[$item_employee_data_uuid->nik_employee])) {
                    foreach ($math_filter as $index => $item_math_filter) {
                        if (!empty($item_employee_data_uuid['absensi']['count_' . $index])) {
                            $data_filter_math[$item_employee_data_uuid->nik_employee] = $item_employee_data_uuid;
                        }
                    }
                }
            }
        }




        $data = [
            'employee_get'  => $employee_get,
            'data_response' => $data_response,
            'data_employee_absen_detail'    => $data_employee_absen_detail,
            'data_employee_absen' => $data_employee_absen,
            'validateData'    => $validateData,
            'count_date_day'    => $count_date_day,
            'data_filter'    => $data_filter,
            'math_filter'    => $math_filter,
            'employee_data_uuid'    => $employee_data_uuid,
            'employee_data_machine_id'    => $employee_data_machine_id,
            'data_employee_out' => $data_employee_out,

            'data_employee_absen_detail_nik_employee'    => $data_employee_absen_detail_nik_employee,
            'data_filter_math' => $data_filter_math,
            'employee_data_machine_id'    => $employee_data_machine_id,
        ];

        return ResponseFormatter::toJson($data, 'anyDataPost_X');
    }


    public function storeAbsen(Request $request)
    {
        $validatedData = $request->all();

        $startDate = new \DateTime($validatedData['date_start_absen']);
        $endDate = new \DateTime($validatedData['date_end_absen']);
        $validatedData['edited'] = 'edited';
        $validatedData['date'] =  ResponseFormatter::excelToDate($validatedData['date']);


        for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
            $validatedData['date'] = $date->format('Y-m-d');
            $validatedData['uuid']  = $validatedData['date'] . '-' . $validatedData['employee_uuid'];
            if($validatedData['status_absen_uuid'] != '-'){
                $store = EmployeeAbsen::updateOrCreate(
                    [
                        'employee_uuid'  => $validatedData['employee_uuid'],
                        'date' => $validatedData['date'],
                    ],
                    $validatedData
                );
                $validatedData['store'][] = $store;
            }
            
        }

        return ResponseFormatter::toJson($validatedData, "data absen stored");
        return ResponseFormatter::toJson($store, "data stored");
    }

    public function store(Request $request)
    {
        $validatedData = $request->all();
        // return ResponseFormatter::toJson($validatedData, "data stored");
        $arr_date = explode('-', $validatedData['date']);
        $validatedData['date'] =  ResponseFormatter::excelToDate($validatedData['date']);
        $validatedData['uuid']  = $validatedData['date'] . '-' . $validatedData['employee_uuid'];
        $validatedData['edited'] = 'edited';
        if($validatedData['status_absen_uuid'] != '-' ){
            $store = EmployeeAbsen::updateOrCreate([
                'employee_uuid'  => $validatedData['employee_uuid'],
                'date' => $validatedData['date'],
            ], $validatedData);
    
            $store = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
                ->where('employee_absens.id', $store->id)
                ->get([
                    'status_absens.status_absen_code',
                    'status_absens.math',
                    'employee_absens.*'
                ])
                ->first();
        }
        

        return ResponseFormatter::toJson($store, "data stored");
    }





    public function showPayrol($year_month, $employee_uuid)
    {
        $nik_employeess = Employee::where_uuid($employee_uuid);
        $employee = Employee::where_employee_nik_employee_nullable($nik_employeess->nik_employee);
        $status_absen = StatusAbsen::all();
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'list-employees-absensi'
        ];

        // for get last date (30/31)
        $datetime = Carbon::createFromFormat('Y-m', $year . '-' . $month);
        $lastDay = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');

        for ($i = 1; $i <= $lastDay; $i++) {
            $day_date = $year . '-' . $month . '-' . $i;
            $data_absen_day = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
                ->where('employee_uuid', $employee->machine_id)
                ->where('date', $day_date)->get([
                    'status_absens.status_absen_code',
                    'status_absens.math',
                    'employee_absens.*'
                ])->first();
            // dd($data_absen_day);

            if (!$data_absen_day) {
                $data_absen_day = collect([
                    'date' => $day_date,
                    'cek_log' => '',
                    'status_absen_code' => 'NULL',
                    'math' =>  ''
                ]);
            } else {
                if ($data_absen_day['cek_log'] == '') {
                    $data_absen_day['cek_log'] = "NULL";
                }
            }
            $data_absens[] = $data_absen_day;
        }
        //  dd($data_absens);
        return view('employee.absensi.show', [
            'title'         => 'Absensi Karyawan',
            'month'     => $year . '-' . $month,
            'year_month' => $year_month,
            'year'      => $year,
            'employee'  => $employee,
            'status_absen'  => $status_absen,
            'absens'    => $data_absens,
            'is'            => 'admin',
            'months'    => $month,
            'layout'    => $layout
        ]);
    }

    public function show()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'list-employees-absensi'
        ];
        // dd(session('dataUser')['nik_employee']);
        return view('employee.absensi.detail', [
            'title'         => 'Absensi Karyawan',
            'layout'    => $layout
        ]);
    }


    public function  showEmployee($year_month, $nik_employee)
    {
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $day_end = ResponseFormatter::getEndDay($year_month);
        $employees = Employee::where('nik_employee', $nik_employee)->get();
        // dd($employee); 
        $data = Employee::join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->leftJoin('positions', 'positions.uuid', 'employees.position_uuid')
            ->whereNull('user_details.date_end')
            ->where('employees.nik_employee', $nik_employee)
            ->get([
                'user_details.photo_path',
                'employees.machine_id',
                'user_details.name',
                'employees.nik_employee',
                'positions.position',
                'employees.user_detail_uuid',
            ]);

        $employee = Employee::join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->leftJoin('positions', 'positions.uuid', 'employees.position_uuid')
            ->whereNull('user_details.date_end')
            ->whereNull('employees.date_end')
            ->where('employees.nik_employee', $nik_employee)
            ->get([
                'user_details.photo_path',
                'employees.machine_id',
                'user_details.name',
                'employees.nik_employee',
                'positions.position',
                'employees.user_detail_uuid',
            ])
            ->first();
        // dd($employee);


        $array_data_old_absensi = [];
        $status_absen = StatusAbsen::all();
        foreach ($employees as $item_employee) {
            $data_employee_absen = EmployeeAbsen::whereYear('employee_absens.date', $year)
                ->whereMonth('employee_absens.date', $month)
                ->where('employee_uuid', $item_employee->machine_id)
                ->get();

            foreach ($data_employee_absen as $data_employee_absen_) {
                $arr_date = explode('-', $data_employee_absen_->date);
                $array_data_old_absensi[(int)$arr_date[2]] = $data_employee_absen_;
            }
        }
        for ($i = 1; $i <= $day_end; $i++) {
            if (empty($array_data_old_absensi[(int)$i])) {
                $array_data_old_absensi[(int)$i]  = [
                    "date" => "2023-01-01",
                    "status_absen_uuid" => "",
                    "cek_log" => null,
                    "edited" => null,
                    "pay_uuid" => null,
                ];
            }
        }
        // dd($array_data_old_absensi);
        // return view('datatableshow', [ 'data'         => $array_data_old_absensi]);

        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'list-employees-absensi'
        ];

        $lastDay = ResponseFormatter::getEndDay($year_month);


        return view('employee.absensi.detail', [
            'title'         => 'Absensi Karyawan',
            'employee'  => $employee,
            'year_month' => $year_month,
            'nik_employee'  => $nik_employee,
            'status_absen'  => $status_absen,
            'data_absen'    => $array_data_old_absensi,
            'is'            => 'admin',
            'layout'    => $layout
        ]);
    }
















    // =========================================================== WEB ============================================
    public function getApiAbsensi(Request $request)
    {
        $Q_data_absens = EmployeeAbsen::where('employee_absens.date', '>=', $request['filter_absensi']['date_start'])
            ->where('employee_absens.date', '<=', $request['filter_absensi']['date_end'])
            ->get();
        $arr_absens = [];
        if (!empty($Q_data_absens)) {
            foreach ($Q_data_absens as $I_data_absen) {
                $arr_absens[ResponseFormatter::toUUID($I_data_absen->employee_uuid)][$I_data_absen->date] = $I_data_absen;
            }
        }
        $arr_absens_return = [];
        foreach ($request['filter_absensi']['KARYAWAN'] as $I_arr_absens) {
            if (!empty($arr_absens[$I_arr_absens])) {
                $arr_absens_return[$I_arr_absens] = $arr_absens[$I_arr_absens];
            }
        }

        $data_to_return['data_absensi'] = $arr_absens_return;
        $data_to_return['data_ketidakhadiran'] = DatabaseDataKehadiran::getData($request['filter_absensi']);
        $data_to_return['data_persetujuan'] = DatabaseDataPersetujuan::getDataPersetujuan('KEHADIRAN', null);

        return ResponseFormatter::ResponseJson($data_to_return, 'All Absensi Data', 200);
    }

    public function storeAbsensiSingle(Request $request)
    {
        $data[$request->employee_uuid][$request->date] =
            [
                'uuid' => $request->employee_uuid . '-' . $request->date,
                'employee_uuid' => $request->employee_uuid,
                'date' => $request->date,
                'status_absen_uuid' => $request->status_absen_uuid,
                'edited' => 'edited',
                'absen_description' => $request->absen_description,
            ];
        $Q_store_absen = EmployeeAbsen::storeAbsensiesGeneral($data);
        return ResponseFormatter::toJson($Q_store_absen, 'absen updated', 200);
    }
}
