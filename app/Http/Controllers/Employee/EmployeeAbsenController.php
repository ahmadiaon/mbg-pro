<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\StatusAbsen;
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
use Illuminate\Support\Facades\Storage;
use File;
use Response;


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
        $createSheet->setCellValue('A2', 'Absensi Bulan ' . $months[(int)$month] . '-' . $year);
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

    

    public function exportWithData(Request $request)
    {
        $year_month = '2023-01';
        $validatedData = $request->all();
        $validatedData['company_uuid'] = 'MBLE';
        $validatedData['site_uuid'] = 'GBM';
        $validatedData['date'] = '2023-01-01';
        $data_session = session('data_database');
        $data_employee_out = $data_session['data_employee_out'];

        $validatedData['data_export'] = json_decode($request->data_export);
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $month = (int)$month;
        $months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $date_start_absen_arr = ResponseFormatter::excelToDateArray($validatedData['filter']['date_filter']['date_start_filter_absen']);
        $date_end_absen_arr = ResponseFormatter::excelToDateArray($validatedData['filter']['date_filter']['date_start_filter_absen']);
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

        $createSheet->setCellValue('A19', 'NO.');
        $createSheet->setCellValue('B19', 'NAMA');
        $createSheet->setCellValue('C19', 'NIK');
        $createSheet->setCellValue('D19', 'POSISI');
        $createSheet->setCellValue('E19', 'DEPARTEMEN');
        $createSheet->setCellValue('F19', 'SITE');
        $createSheet->setCellValue('G19', 'PERUSAHAAN');

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
            $createSheet->setCellValue($abjads[0] . $status_absens_col,  $item->status_absen_code);
            $createSheet->setCellValue($abjads[0+1] . $status_absens_col,  $item->status_absen_description);                
            $styleArray_employee['fill']['startColor']['rgb'] = $item->color;
            $createSheet->getStyle($abjads[0] . $status_absens_col )->applyFromArray($styleArray_employee);
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

        $pay = [];
        $unpay = [];

        $employees = Employee::data_employee();
        $employee_row = 21;
        $status_absens_col_employee = $date_row;
        $arr_status_absens = [];
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

        foreach ($validatedData['data_export'] as $item_data_export) {
            $createSheet->setCellValue('B' . $row_employees, $item_data_export->name);
            $createSheet->setCellValue('C' . $row_employees, $item_data_export->nik_employee_with_space);
            $createSheet->setCellValue('D' . $row_employees, $item_data_export->position);
            $createSheet->setCellValue('E' . $row_employees, $item_data_export->department_uuid);
            $createSheet->setCellValue('F' . $row_employees, $item_data_export->site_uuid);
            $createSheet->setCellValue('G' . $row_employees, $item_data_export->company_uuid);

            $row_ex = 7;
            for ($i = (int)$date_day_start; $i <= (int)$date_day_end; $i++) {
                if(!empty($item_data_export->data)){
                    $x = $arr_date_start[0];                     
                    $item_data = (array)$item_data_export->data;
                    $x = ResponseFormatter::to2Digit($i);
                    $xx = $arr_date_start[0].'-'.$arr_date_start[1].'-'.$x;                    
                    $x = '';
                    if(!empty($item_data[$xx])){
                        $xy = (array)$item_data[$xx];
                        $x = $xy['status_absen_code'];
                        $styleArray_value['fill']['startColor']['rgb'] = $xy['color'];
                    }
                    $createSheet->setCellValue($abjads[$row_ex] . $row_employees, $x);
                    $createSheet->getStyle($abjads[$row_ex] . $row_employees )->applyFromArray($styleArray_value);
                }
                $row_ex++;
                $date_row++;
                $styleArray_value['fill']['startColor']['rgb'] = 'ffffff';
            }
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

        return ResponseFormatter::toJson($name, $validatedData);
        $no_emp = 1; 
        $data_dialy_absen = [];

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
            $createSheet->setCellValue('B' . $no_emp_col, $item_data_export->nik_employee_with_space);
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

        return response()->download($name);
        // header table tanggal
        for ($i = 1; $i <= $day_month; $i++) {
            $createSheet->setCellValue($abjads[$i + 3] . '20',  $i);
            $createSheet->getColumnDimension($abjads[$i + 3])->setWidth(4);
            $status_absens_col = 1;
            foreach ($status_absens as $item) {
                $createSheet->setCellValue($abjads[$date_row] . $status_absens_col,  $item->status_absen_code);
                $status_absens_col++;
            }
            $date_row++;
        }

        // simpulan data
        $pay = [];
        $unpay = [];

        // dd($pay);
        // loop karyawan
        $employees = Employee::data_employee();
        $employee_row = 21;
        $status_absens_col_employee = $date_row;
        $arr_status_absens = [];

        foreach ($status_absens as $item) {
            $createSheet->setCellValue($abjads[$date_row] . '20',  $item->status_absen_code);
            if ($item->math == 'pay') {
                $pay[] = $abjads[$date_row];
            } else {
                $unpay[] = $abjads[$date_row];
            }
            $arr_status_absens[$item->status_absen_code] = $date_row;
            $date_row++;
        }

        // dd($pay);
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

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        // return 'aaa';
        return response()->download($name);
    }

    public function dialyReport(){
        $year_month = '2023-01';
        $validatedData = null;
        
        $data_database = session('data_database');

        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

        $validatedData['company_uuid'] = 'MBLE';
        $validatedData['site_uuid'] = 'GBM';
        $validatedData['date'] = '2023-1-01';

        $arr_date = explode('-', $validatedData['date']);

        $first_date_this_month = $arr_date[0].'-'.$arr_date[1].'-'.'01';

        $data_dialy_absen_detail = [];
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        $createSheet->setCellValue('C22', 'KETERANGAN ABSEN');
        $createSheet->setCellValue('D22', 'JUMLAH');

        // MBLE-220656
        $createSheet->setCellValue('F23', 'DEPARTEMEN');

        

        $employee_ = Employee::where('date_end', null)
        ->where('site_uuid', $validatedData['site_uuid'] )
        ->get();
        $arr_absensi = [];
        $data_employee = [];
        $data_employee_machine_id = [];
        foreach($employee_ as $item_employee_){
            if(!empty($data_database['data_employee_out'][$item_employee_->nik_employee])){
                if(($validatedData['date'] < $data_database['data_employee_out'][$item_employee_->nik_employee]['date_out'])  && ($first_date_this_month >$data_database['data_employee_out'][$item_employee_->nik_employee]['date_out'] )){
                    $data_employee[$item_employee_->nik_employee] = $item_employee_;
                    $data_employee_machine_id[$item_employee_->machine_id] = $item_employee_->nik_employee;
                }
            }else{
                $data_employee[$item_employee_->nik_employee] = $item_employee_;
                $data_employee_machine_id[$item_employee_->machine_id] = $item_employee_->nik_employee;
            }
        }


        $employee_absen = EmployeeAbsen::join('employees','employees.machine_id', 'employee_absens.employee_uuid')
        ->where('employees.date_end', null)
        ->where('employee_absens.date',$validatedData['date'] )
        ->where('employees.site_uuid', $validatedData['site_uuid'])
        ->get();

        // dd($employee_absen->first());

        $data_absen_each_employee = [];
        foreach($employee_absen as $item_employee_absen){
            if(!empty($data_employee_machine_id[$item_employee_absen->employee_uuid])){
                if(empty($data_absen_each_employee[$data_employee_machine_id[$item_employee_absen->employee_uuid]][$item_employee_absen->date])){
                    $data_absen_each_employee[$data_employee_machine_id[$item_employee_absen->employee_uuid]][$item_employee_absen->date] = $item_employee_absen;
                    if(!empty($arr_absensi['each_status_absen'][$item_employee_absen->status_absen_uuid])){
                        $arr_absensi['each_status_absen'][$item_employee_absen->status_absen_uuid]++;                        
                    }else{
                        $arr_absensi['each_status_absen'][$item_employee_absen->status_absen_uuid] = 1;
                    }
                    if(empty($arr_absensi['each_department'][$item_employee_absen->department_uuid][$item_employee_absen->status_absen_uuid])){
                        $arr_absensi['each_department'][$item_employee_absen->department_uuid][$item_employee_absen->status_absen_uuid] = 1;
                    }else{
                        $arr_absensi['each_department'][$item_employee_absen->department_uuid][$item_employee_absen->status_absen_uuid]++;
                    }
                }
            }
        }

        foreach($data_employee as $item_data_employee){

        }

        $row_arr_absensi = 23;
        $col_arr_each_department = 6;

        $col_arr_each_department_abjad = [];

        foreach($arr_absensi['each_status_absen'] as $index=>$item_arr_absensi){
            $createSheet->setCellValue('C'.$row_arr_absensi, $data_database['data_status_absens'][$index]['status_absen_description']);
            $createSheet->setCellValue('D'.$row_arr_absensi, $item_arr_absensi);
            $createSheet->setCellValue($rows[$col_arr_each_department].'23', $data_database['data_status_absens'][$index]['status_absen_description']);

            $col_arr_each_department_abjad[$index] = $rows[$col_arr_each_department];
            $col_arr_each_department++;
            $row_arr_absensi++;
        }
        $row_arr_absensi = 24;
        foreach($arr_absensi['each_department'] as $index_sa=>$arr_absensi_each_department){
            $createSheet->setCellValue('F'.$row_arr_absensi, $index_sa);
            foreach($arr_absensi_each_department as $index_sa_dep=>$item_arr_absensi_each_department){
                $createSheet->setCellValue( $col_arr_each_department_abjad[$index_sa_dep].$row_arr_absensi, $item_arr_absensi_each_department);
            }
            $row_arr_absensi++;
        }

        // dd($arr_absensi);
        

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        // dd($col_arr_each_department_abjad);
        return response()->download($name);



        return ResponseFormatter::toJson($name, $validatedData);




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
            $createSheet->getColumnDimension($abjads[$row_ex])->setWidth(4);
            
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

    public function storeFingger(Request $request)
    {

        $validatedData = $request->all();

        $get_employee = Employee::whereNull('date_end')->where('nik_employee', $validatedData['nik_employee'])->get()->first();

        $storeEmployee = Employee::updateOrCreate(
            ['nik_employee' => $validatedData['nik_employee']],
            ['machine_id' => $validatedData['employee_uuid']]
        );
        $StoreAbsen = EmployeeAbsen::where('employee_uuid', $get_employee->machine_id)
            ->update([
                'employee_uuid' => $validatedData['employee_uuid'],
                'uuid' => $validatedData['employee_uuid'],
            ]);


        return ResponseFormatter::toJson($request->all(), $StoreAbsen);
    }

    public function import(Request $request)
    {
        $the_file = $request->file('uploaded_file');
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
            $data = array();

            $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

            $tanggal = $sheet->getCell('C' . 3)->getValue();

            $much_status_absen = StatusAbsen::all()->count();

            $much_status_absen;
            $createSpreadsheet = new spreadsheet();
            $createSheet = $createSpreadsheet->getActiveSheet();
            $createSheet->setCellValue('A1', 'Database :');
            $createSheet->setCellValue('A5', 'NIK Karyawan');
            $createSheet->setCellValue('B5', 'Nama Karyawan');
            $createSheet->setCellValue('C5', 'Jabatan');
            $createSheet->setCellValue('D5', 'Nama Di Fingger');


            if ($sheet->getCell('C' . '1')->getValue() == 'Excel') { //File dari Excell
                $employees = Employee::data_employee();
                foreach ($employees as $item_employees) {
                    $data_employees[$item_employees->nik_employee] = $item_employees;
                }



                $year = $sheet->getCell('C' . 4)->getValue();
                $month = $sheet->getCell('C' . 3)->getValue();
                $month = str_pad($month, 2, '0', STR_PAD_LEFT);
                $year_month = $year . '-' . $month;
                $last_day = ResponseFormatter::getEndDay($year . '-' . $month);
                $isCount = 0;
                $row_a = 0;


                while ($isCount <= 1) {
                    if ($sheet->getCell($rows[$row_a] . '20')->getValue() == 'pay') {
                        $sheet->getCell($rows[$row_a] . '20')->getValue();
                        $isCount++;
                        $pay = $rows[$row_a];
                    }
                    if ($sheet->getCell($rows[$row_a] . '20')->getValue() == 'cut') {
                        $cut = $rows[$row_a];
                        $isCount++;
                    }
                    $row_a++;
                }



                $no_employee = 21;
                // $employees = [];
                while ($sheet->getCell('A' . $no_employee)->getValue() != null) {
                    $column_date = 4;
                    $nik_employee = ResponseFormatter::toUUID($sheet->getCell('C' . $no_employee)->getValue());

                    $status_absen['year_month'] = $year_month;
                    $status_absen['nik_employee'] = $nik_employee;


                    for ($day = 1; $day <= $last_day; $day++) {
                        $status_absen['day-' . $day] = $sheet->getCell($rows[$column_date] . $no_employee)->getValue();
                        // return ResponseFormatter::toJson(ResponseFormatter::toUUID($sheet->getCell($rows[$column_date] . $no_employee)->getValue()), 'excel');
                        $store_employee_absen = EmployeeAbsen::updateOrCreate(
                            [

                                'employee_uuid'  => $data_employees[$nik_employee]['machine_id'],
                                'date' => ResponseFormatter::excelToDate($year_month . '-' . $day),
                            ],
                            [
                                'uuid' => ResponseFormatter::excelToDate($year_month . '-' . $day) . '-' . $data_employees[$nik_employee]['machine_id'],
                                'status_absen_uuid'     => ResponseFormatter::toUUID($sheet->getCell($rows[$column_date] . $no_employee)->getValue()),
                                'cek_log'       =>  null,
                            ]
                        );
                        $column_date++;
                    }

                    $column_date = 4 + $last_day;
                    $no_employee++;
                }

                return ResponseFormatter::toJson($no_employee, 'excel');
                return back();
            } else { //dari mesin fingger
                // dd('dari mesin fingger');
                // return 'ahmadi';
                // this is from finger machine
                $data_employee_absen_have_employees = EmployeeAbsen::join('employees', 'employees.machine_id', 'employee_absens.employee_uuid')
                    ->groupBy(
                        'employee_absens.employee_uuid',
                        'employees.nik_employee',
                        'employees.machine_id'
                    )
                    ->get([
                        'employee_absens.employee_uuid',
                        'employees.nik_employee',
                        'employees.machine_id'
                    ]);
                // dd($data_employee_absen_have_employees);


                $arr_employee_absen = [];
                foreach ($data_employee_absen_have_employees as $employee_absen_have_employees) {
                    $arr_employee_absen[$employee_absen_have_employees->machine_id] = $employee_absen_have_employees;
                }



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

                $validatedData = $request->all();


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

                $start_date = date_create($validatedData['date_absen_start']);
                $end_date = date_create($validatedData['date_absen_end']);


                // return ResponseFormatter::toJson($validatedData,'here');
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

                $data_delete = EmployeeAbsen::where('employee_absens.date', '>=', $start_date->format('Y-m-d'))
                    ->where('employee_absens.date', '<=', $end_date->format('Y-m-d'))
                    ->get();
                // ->delete();
                // return true;


                $arr_data_employee_absen = [];
                foreach ($data_delete as $item_data_delete) {
                    $arr_data_employee_absen[$item_data_delete->employee_uuid][$item_data_delete->date] = $item_data_delete;
                }

                foreach ($period as $key => $value) {
                    $date_data[] = $value->format('Y-m-d');
                }

                // dd($date_data);
                $employees_count = ($row_limit - 4) / 2;
                $i = 5;
                $arr_machine_id = [];

                // foreach employees
                for ($j = 0; $j < $employees_count; $j++) {
                    $employeeName = $sheet->getCell('K' . $i)->getValue();
                    $absensies = array();
                    $count_day = 0;
                    $arr_machine_id[$employeeName]['name'] = $employeeName;





                    foreach ($date_data as $abjad) {
                        $cell_d = $i + 1;
                        $date_now = date_create($abjad);

                        if (($date_now >= $start_date) && ($date_now <= $end_date)) {
                            $absensi = $sheet->getCell($rows[$count_day] . $cell_d)->getValue(); //data_ceklog dari absen
                            $absensies = [
                                'employee_uuid'  => $employeeName,
                                'date' => $abjad,
                                'status_absen_uuid'     => '',
                                'cek_log'       =>  $absensi,
                            ];
                            $old_cek_log = null;
                            $statusAbsen = null;
                            if (!empty($absensi)) {
                                if (!empty($arr_data_employee_absen[$employeeName])) {
                                    if (!empty($arr_data_employee_absen[$employeeName][$abjad])) {
                                        if (empty($arr_data_employee_absen[$employeeName][$abjad]['edited'])) {
                                            $old_cek_log = $arr_data_employee_absen[$employeeName][$abjad]['cek_log'];
                                        }
                                    }
                                }

                                $statusAbsen = EmployeeAbsenController::ekstrackAbsen($absensi, $old_cek_log);
                                if (!empty($statusAbsen)) {
                                    $absensies = [
                                        'employee_uuid'  => $employeeName,
                                        'date' => ResponseFormatter::excelToDate($abjad),
                                        'status_absen_uuid'     => $statusAbsen['status_absen'],
                                        'count_zone'     => $statusAbsen['count_zone'],
                                        'cek_log'       =>  $statusAbsen['json_arr_cek_log'],
                                    ];
                                    $store = EmployeeAbsen::updateOrCreate(
                                        [
                                            'employee_uuid'  => $employeeName,
                                            'edited' => null,
                                            'date' => ResponseFormatter::excelToDate($abjad),
                                        ],
                                        $absensies
                                    );
                                }
                            }


                            $all_data[$employeeName][] = $absensies;
                            $dataaa[] = $absensies;

                            // terapkan jadi index
                            if (!empty($arr_employee_absen[$employeeName])) {
                                if (empty($all_datas['have_employees']['detail'][$arr_employee_absen[$employeeName]['nik_employee']])) {
                                    $all_datas['have_employees']['data'][] = $arr_employee_absen[$employeeName];
                                }
                                // dd( $all_datas['have_employees']['data']);
                                $all_datas['have_employees']['detail'][$arr_employee_absen[$employeeName]['nik_employee']][$abjad] = $absensies;
                            } else {
                                if (empty($all_datas['null_employees'][$absensies['employee_uuid']])) {
                                    $all_datas['null_employees'][$absensies['employee_uuid']] = $absensies;
                                }
                                $all_datas['null_employees'][$absensies['employee_uuid']]['data'][$abjad] = $absensies;
                            }

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
                session()->put('after-import', $all_datas);
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
                // return redirect()->to('/user/absensi/after-import');
                // return response()->download($name);

                // return response()->download($name);
                dd($dataaa);
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function afterImport()
    {
        $data_employee = Employee::join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->leftJoin('positions', 'positions.uuid', 'employees.position_uuid')
            ->whereNotNull('employees.nik_employee')
            ->whereNull('employees.date_end')
            ->whereNull('user_details.date_end')
            ->where('employees.employee_status', '!=', 'talent')
            ->groupBy(
                'employees.machine_id',
                'employees.user_detail_uuid',
                'employees.nik_employee',
                'positions.position',
                'user_details.name',
                'user_details.photo_path',
                'employees.nik_employee',
                'employees.date_start'
            )
            ->get([
                'employees.machine_id',
                'employees.nik_employee as employee_uuid',
                'employees.user_detail_uuid',
                'employees.nik_employee',
                'positions.position',
                'user_details.name',
                'user_details.photo_path',
                'employees.nik_employee',
                'employees.date_start',
            ]);


        $data = EmployeeAbsen::groupBy('employee_uuid')
            ->get([
                'employee_uuid'
            ]);
        // dd(session('after-import'));
        // return view('datatableshow', [ 'data'         => $data]);
        // dd($data);
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'list-employees-absensi'
        ];
        return view('employee.absensi.afterImport', [
            'title'         => 'After Import',
            'layout'    => $layout
        ]);
    }
    public function anyDataPost_X(Request $request)
    {
        $validateData = $request->all();
        $data_database = session('data_database');
        $data_employees = $data_database['data_employees'];
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
            if (!empty($data_filter[$item_employee_get->company_uuid . '-' . $item_employee_get->site_uuid])) {

                if (empty($data_database['data_employee_out'][$item_employee_get->nik_employee])) {
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
                } elseif (($data_database['data_employee_out'][$item_employee_get->nik_employee]['date_out'] > $validateData['filter']['date_filter']['date_start_filter_absen']) && ($data_database['data_employee_out'][$item_employee_get->nik_employee]['date_out'] < $validateData['filter']['date_filter']['date_end_filter_absen'])) {
                    if (!empty($data_filter[$item_employee_get->company_uuid . '-' . $item_employee_get->site_uuid])) {
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
                    }
                }
            }
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


        foreach ($data_employee_absen_detail as $item_data_employee_absen_detail) {
            if (!empty($employee_data_machine_id[$item_data_employee_absen_detail->employee_uuid])) {
                // if (!empty($math_filter[$item_data_employee_absen_detail->math])) {
                $arr_data = $employee_data_uuid[$employee_data_machine_id[$item_data_employee_absen_detail->employee_uuid]]['data'];
                $arr_data[$item_data_employee_absen_detail->date] = $item_data_employee_absen_detail;
                $employee_data_uuid[$employee_data_machine_id[$item_data_employee_absen_detail->employee_uuid]]['data'] = $arr_data;

                $arr_count_absen =  $employee_data_uuid[$employee_data_machine_id[$item_data_employee_absen_detail->employee_uuid]]['absensi'];
                $value_count = (int)$arr_count_absen['count_' . $item_data_employee_absen_detail->status_absen_uuid];
                $value_count = $value_count + 1;
                $arr_count_absen['count_' . $item_data_employee_absen_detail->status_absen_uuid] = $value_count;
                $arr_count_absen['count_' . $item_data_employee_absen_detail->math] = (int)$arr_count_absen['count_' . $item_data_employee_absen_detail->math] + 1;
                $arr_count_absen['count_unknown_absen']--;
                $employee_data_uuid[$employee_data_machine_id[$item_data_employee_absen_detail->employee_uuid]]['absensi'] = $arr_count_absen;
                // }
            }
        }
        $data_filter_math = [];

        foreach ($employee_data_uuid as  $item_employee_data_uuid) {
            if (empty($data_filter_math[$item_employee_data_uuid->nik_employee])) {
                foreach ($math_filter as $index => $item_math_filter) {
                    if (!empty($item_employee_data_uuid['absensi']['count_' . $index])) {
                        $data_filter_math[$item_employee_data_uuid->nik_employee] = $item_employee_data_uuid;
                    }
                }
            }
        }




        $data = [
            // 'employee_get'  => $employee_get,
            'data_employee_absen_detail'    => $data_employee_absen_detail,
            'validateData'    => $validateData,
            // 'data_filter'    => $data_filter,
            // 'math_filter'    => $math_filter,
            'employee_data_uuid'    => $employee_data_uuid,
            'employee_data_machine_id'    => $employee_data_machine_id,

            'data_employee_absen_detail_nik_employee'    => $data_employee_absen_detail_nik_employee,
            'data_filter_math'    => $data_filter_math,
            // 'employee_data_machine_id'    => $employee_data_machine_id,
        ];

        return ResponseFormatter::toJson($data, 'anyDataPost_X');
    }


    // public function anyDataPost(Request $request)
    // {
    //     $validateData = $request->all();

    //     // return ResponseFormatter::toJson($validateData, 'json any data');
    //     $year = (int)$request->year;
    //     $month = (int)$request->month;

    //     $arr_status_absens = StatusAbsen::groupBy('math')->get('math');

    //     $data_employee_absen_detail = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
    //         ->where('employee_absens.date', '>=', $request->filter['date_filter']['date_start_filter_absen'])
    //         ->where('employee_absens.date', '<=', $request->filter['date_filter']['date_end_filter_absen'])
    //         ->get([
    //             'status_absens.*',
    //             'employee_absens.*',
    //             'employee_absens.uuid as uuid',
    //         ]);

    //     $employee_get = Employee::data_employee();

    //     // $data_employees =[];


    //     if (!empty($request->filter['arr_site_uuid'])) {
    //         foreach ($request->filter['arr_site_uuid'] as $item_site_uuid) {
    //             $colection_data_employees_collection = Employee::join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
    //                 ->leftJoin('companies', 'companies.uuid', 'employees.company_uuid')
    //                 ->leftJoin('positions', 'positions.uuid', '=', 'employees.position_uuid')
    //                 ->leftJoin('departments', 'departments.uuid', '=', 'employees.department_uuid')
    //                 ->whereNull('employees.date_end')
    //                 ->whereNull('user_details.date_end')
    //                 ->where('employees.employee_status', '!=', 'talent')->where('employees.site_uuid', $item_site_uuid)
    //                 ->get([
    //                     'user_details.name',
    //                     'companies.company',
    //                     'positions.position',
    //                     'employees.*'
    //                 ]);
    //             foreach ($colection_data_employees_collection as $item_data_employees_collection) {
    //                 $data_employees[] = $item_data_employees_collection;
    //             }
    //         }
    //     } else {
    //         $data_employees =  Employee::join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
    //             ->leftJoin('companies', 'companies.uuid', 'employees.company_uuid')
    //             ->leftJoin('positions', 'positions.uuid', '=', 'employees.position_uuid')
    //             ->leftJoin('departments', 'departments.uuid', '=', 'employees.department_uuid')
    //             ->whereNull('employees.date_end')
    //             ->whereNull('user_details.date_end')
    //             ->where('employees.employee_status', '!=', 'talent')->get([
    //                 'user_details.name',
    //                 'companies.company',
    //                 'positions.position',
    //                 'employees.*'
    //             ]);
    //     }
    //     $arr_employees_machine_id = [];

    //     foreach ($data_employees as $data_employee) {
    //         $arr_employees_machine_id[$data_employee->machine_id] = $data_employee;
    //         foreach ($arr_status_absens as $data_status_absen) {
    //             $name_col = $data_status_absen->math;
    //             $arr_employees_machine_id[$data_employee->machine_id]->$name_col = null;
    //             $arr_employees_machine_id[$data_employee->machine_id]->data = null;
    //         }
    //     }




    //     $data_datatable = [];
    //     $arr_data_err = [];
    //     $data_database_with_unknown = [];
    //     $arr_date_absen = [];

    //     if (!empty($request->filter['arr_status_absen'])) {
    //         foreach ($request->filter['arr_status_absen'] as $item_arr_status_absen) {
    //             $data_employee_absen = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
    //                 ->where('employee_absens.date', '>=', $request->filter['date_filter']['date_start_filter_absen'])
    //                 ->where('employee_absens.date', '<=', $request->filter['date_filter']['date_end_filter_absen'])
    //                 ->where('status_absens.math', $item_arr_status_absen)
    //                 ->groupBy(
    //                     'employee_absens.employee_uuid',
    //                     'status_absens.math',
    //                 )
    //                 ->select(
    //                     'employee_absens.employee_uuid as machine_id',
    //                     'status_absens.math',
    //                     DB::raw("count(status_absens.math) as count_math_status_absen")
    //                 )
    //                 ->get();



    //             $data_employee_absen_detail = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
    //                 ->where('employee_absens.date', '>=', $request->filter['date_filter']['date_start_filter_absen'])
    //                 ->where('employee_absens.date', '<=', $request->filter['date_filter']['date_end_filter_absen'])
    //                 ->where('status_absens.math', $item_arr_status_absen)
    //                 ->get([
    //                     'status_absens.*',
    //                     'employee_absens.*',
    //                     'employee_absens.uuid as uuid',
    //                 ]);

    //             foreach ($data_employee_absen_detail as $item_employee_absen_detail) {
    //                 if (!empty($arr_employees_machine_id[$item_employee_absen_detail->employee_uuid])) {
    //                     $date_name = $item_employee_absen_detail->date;
    //                     $arr_date_absen[$item_employee_absen_detail->employee_uuid][$date_name] = $item_employee_absen_detail;
    //                 }
    //             }

    //             foreach ($arr_date_absen as $index => $item_date_absen) {
    //                 $arr_employees_machine_id[$index]['data'] = $item_date_absen;
    //             }


    //             foreach ($data_employee_absen as $data_employee_absen_) {
    //                 $col_name = $data_employee_absen_->math;
    //                 if (!empty($arr_employees_machine_id[$data_employee_absen_->machine_id])) {
    //                     $arr_employees_machine_id[$data_employee_absen_->machine_id]->$col_name = $data_employee_absen_->count_math_status_absen;
    //                 }
    //             }
    //         }
    //     } else {

    //         $data_employee_absen = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
    //             ->where('employee_absens.date', '>=', $request->filter['date_filter']['date_start_filter_absen'])
    //             ->where('employee_absens.date', '<=', $request->filter['date_filter']['date_end_filter_absen'])
    //             ->groupBy(
    //                 'employee_absens.employee_uuid',
    //                 'status_absens.math',
    //             )
    //             ->select(
    //                 'employee_absens.employee_uuid as machine_id',
    //                 'status_absens.math',
    //                 DB::raw("count(status_absens.math) as count_math_status_absen")
    //             )
    //             ->get();

    //         $data_employee_absen_detail = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
    //             ->where('employee_absens.date', '>=', $request->filter['date_filter']['date_start_filter_absen'])
    //             ->where('employee_absens.date', '<=', $request->filter['date_filter']['date_end_filter_absen'])
    //             ->get([
    //                 'status_absens.*',
    //                 'employee_absens.*',
    //                 'employee_absens.uuid as uuid',
    //             ]);
    //         foreach ($data_employee_absen_detail as $item_employee_absen_detail) {
    //             if (!empty($arr_employees_machine_id[$item_employee_absen_detail->employee_uuid])) {
    //                 $date_name = $item_employee_absen_detail->date;
    //                 $arr_date_absen[$item_employee_absen_detail->employee_uuid][$date_name] = $item_employee_absen_detail;
    //             }
    //         }

    //         foreach ($arr_date_absen as $index => $item_date_absen) {
    //             $arr_employees_machine_id[$index]['data'] = $item_date_absen;
    //         }

    //         foreach ($data_employee_absen as $data_employee_absen_) {
    //             $col_name = $data_employee_absen_->math;
    //             if (!empty($arr_employees_machine_id[$data_employee_absen_->machine_id])) {
    //                 $arr_employees_machine_id[$data_employee_absen_->machine_id]->$col_name = $data_employee_absen_->count_math_status_absen;
    //             }
    //         }
    //     }




    //     foreach ($arr_employees_machine_id as $item) {
    //         if (!empty($request->filter['arr_status_absen'])) {
    //             if (!empty($item->data)) {
    //                 $data_datatable[] = $item;
    //                 if ($request->filter['unknown_absen']) {
    //                     $data_database_with_unknown[] = $item;
    //                 }
    //             } else {
    //                 $data_database_with_unknown[] = $item;
    //             }
    //         } else {
    //             $data_datatable[] = $item;
    //             if ($request->filter['unknown_absen']) {
    //                 if (empty($item->data)) {
    //                     $data_database_with_unknown[] = $item;
    //                 }
    //             }
    //         }
    //     }

    //     $data = [
    //         'data' => $arr_employees_machine_id,
    //         'employee_get' => $employee_get,
    //         'data_datatable' => $data_datatable,
    //         'data_database_with_unknown' => $data_database_with_unknown,
    //         'configuration' => [
    //             'year' => $year,
    //             'month' => $month
    //         ],
    //         'request' => $request->all()
    //     ];

    //     return ResponseFormatter::toJson($data, 'Data Absen');

    //     return Datatables::of($data_employee_absen)
    //         ->make(true);
    // }

    // public function anyData($year_month)
    // {

    //     $date = explode("-", $year_month);
    //     $year = $date[0];
    //     $month = $date[1];

    //     $arr_status_absens = StatusAbsen::groupBy('math')->get('math');
    //     $data_employees = Employee::data_employee();
    //     $arr_employees_machine_id = [];

    //     foreach ($data_employees as $data_employee) {
    //         $arr_employees_machine_id[$data_employee->machine_id] = $data_employee;
    //         foreach ($arr_status_absens as $data_status_absen) {
    //             $name_col = $data_status_absen->math;
    //             $arr_employees_machine_id[$data_employee->machine_id]->$name_col = null;
    //             $arr_employees_machine_id[$data_employee->machine_id]->data = null;
    //         }
    //     }



    //     //

    //     $data_employees_1 = Employee::join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
    //         ->leftJoin('companies', 'companies.uuid', 'employees.company_uuid')
    //         ->leftJoin('positions', 'positions.uuid', '=', 'employees.position_uuid')
    //         ->leftJoin('departments', 'departments.uuid', '=', 'employees.department_uuid')
    //         ->whereNull('employees.date_end')
    //         ->whereNull('user_details.date_end')
    //         ->where('employees.employee_status', '!=', 'talent');

    //     $data_employees = StatusAbsen::where('math', 'xx')->get('math');
    //     $filter['arr_site_uuid'] = [
    //         'RJ', 'GBM'
    //     ];

    //     if (!empty($filter['arr_site_uuid'])) {
    //         // dd('filter');
    //         foreach ($filter['arr_site_uuid'] as $item_site_uuid) {
    //             $data_employees_collection = Employee::join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
    //                 ->leftJoin('companies', 'companies.uuid', 'employees.company_uuid')
    //                 ->leftJoin('positions', 'positions.uuid', '=', 'employees.position_uuid')
    //                 ->leftJoin('departments', 'departments.uuid', '=', 'employees.department_uuid')
    //                 ->whereNull('employees.date_end')
    //                 ->whereNull('user_details.date_end')
    //                 ->where('employees.employee_status', '!=', 'talent')->where('employees.site_uuid', $item_site_uuid)->get([
    //                     'user_details.name',
    //                     'companies.company',
    //                     'positions.position',
    //                     'employees.*'
    //                 ]);
    //             foreach ($data_employees_collection as $item_data_employees_collection) {
    //                 $data_employees[] = $item_data_employees_collection;
    //             }
    //         }
    //     } else {
    //         $data_employees = $data_employees_1->get([
    //             'user_details.name',
    //             'companies.company',
    //             'positions.position',
    //             'employees.*'
    //         ]);
    //     }
    //     dd($data_employees);

    //     //

    //     $data_employee_absen = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
    //         ->whereYear('employee_absens.date', $year)
    //         ->whereMonth('employee_absens.date', $month)
    //         ->groupBy(
    //             'employee_absens.employee_uuid',
    //             'status_absens.math',
    //         )
    //         ->select(
    //             'employee_absens.employee_uuid as machine_id',
    //             'status_absens.math',
    //             DB::raw("count(status_absens.math) as count_math_status_absen")
    //         )
    //         ->get();

    //     $data_employee_absen_detail = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
    //         ->whereYear('employee_absens.date', $year)
    //         ->whereMonth('employee_absens.date', $month)
    //         ->get([
    //             'status_absens.*',
    //             'employee_absens.*',
    //             'employee_absens.uuid as uuid',
    //         ]);

    //     $arr_date_absen = [];
    //     foreach ($data_employee_absen_detail as $item_employee_absen_detail) {
    //         if (!empty($arr_employees_machine_id[$item_employee_absen_detail->employee_uuid])) {
    //             $date_name = $item_employee_absen_detail->date;
    //             $arr_date_absen[$item_employee_absen_detail->employee_uuid][$date_name] = $item_employee_absen_detail;
    //         }
    //     }

    //     foreach ($arr_date_absen as $index => $item_date_absen) {
    //         $arr_employees_machine_id[$index]['data'] = $item_date_absen;
    //     }

    //     $arr_data_err = [];
    //     foreach ($data_employee_absen as $data_employee_absen_) {
    //         $col_name = $data_employee_absen_->math;
    //         if (!empty($arr_employees_machine_id[$data_employee_absen_->machine_id])) {
    //             $arr_employees_machine_id[$data_employee_absen_->machine_id]->$col_name = $data_employee_absen_->count_math_status_absen;
    //         }
    //     }
    //     return ResponseFormatter::toJson($arr_employees_machine_id, 'data absen');

    //     return Datatables::of($data_employee_absen)
    //         ->make(true);
    // }

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
            $store = EmployeeAbsen::updateOrCreate(
                [
                    'employee_uuid'  => $validatedData['employee_uuid'],
                    'date' => $validatedData['date'],
                ],
                $validatedData
            );
            $validatedData['store'][] = $store;
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

        return ResponseFormatter::toJson($store, "data stored");
    }


    // public function anyDataEmployee($year_month, $nik_employee)
    // {
    //     $date = explode("-", $year_month);
    //     $year = $date[0];
    //     $month = $date[1];
    //     $employees = Employee::where('nik_employee', $nik_employee)->get();
    //     $arr_data_employee_absen = [];
    //     $status_absen = StatusAbsen::all();

    //     $day_end = ResponseFormatter::getEndDay($year_month);

    //     foreach ($employees as $item_employee) {
    //         $data_employee_absen = EmployeeAbsen::whereYear('employee_absens.date', $year)
    //             ->whereMonth('employee_absens.date', $month)
    //             ->where('employee_uuid', $item_employee->machine_id)
    //             ->get();

    //         foreach ($data_employee_absen as $data_employee_absen_) {
    //             $arr_date = explode('-', $data_employee_absen_->date);
    //             $arr_data_employee_absen[(int)$arr_date[2]] = $data_employee_absen_;
    //         }
    //     }
    //     for ($i = 1; $i <= $day_end; $i++) {
    //         if (empty($arr_data_employee_absen[(int)$i])) {
    //             $arr_data_employee_absen[(int)$i]  = [
    //                 "date" => $year . '-' . str_pad($month, 2, 0, STR_PAD_LEFT) . '-' . str_pad($i, 2, 0, STR_PAD_LEFT),
    //                 "status_absen_uuid" => "",
    //                 "cek_log" => null,
    //                 "edited" => null,
    //                 "pay_uuid" => null,
    //             ];
    //         }
    //     }


    //     return Datatables::of($arr_data_employee_absen)
    //         ->make(true);
    // }


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


        $arr_data_employee_absen = [];
        $status_absen = StatusAbsen::all();
        foreach ($employees as $item_employee) {
            $data_employee_absen = EmployeeAbsen::whereYear('employee_absens.date', $year)
                ->whereMonth('employee_absens.date', $month)
                ->where('employee_uuid', $item_employee->machine_id)
                ->get();

            foreach ($data_employee_absen as $data_employee_absen_) {
                $arr_date = explode('-', $data_employee_absen_->date);
                $arr_data_employee_absen[(int)$arr_date[2]] = $data_employee_absen_;
            }
        }
        for ($i = 1; $i <= $day_end; $i++) {
            if (empty($arr_data_employee_absen[(int)$i])) {
                $arr_data_employee_absen[(int)$i]  = [
                    "date" => "2023-01-01",
                    "status_absen_uuid" => "",
                    "cek_log" => null,
                    "edited" => null,
                    "pay_uuid" => null,
                ];
            }
        }
        // dd($arr_data_employee_absen);
        // return view('datatableshow', [ 'data'         => $arr_data_employee_absen]);

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
            'data_absen'    => $arr_data_employee_absen,
            'is'            => 'admin',
            'layout'    => $layout
        ]);
    }
}
