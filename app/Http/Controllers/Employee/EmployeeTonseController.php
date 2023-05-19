<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\CoalFrom;
use App\Models\Company;

use Yajra\Datatables\Datatables;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeTonase;
use App\Models\Identity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use File;

class EmployeeTonseController extends Controller
{
    public function index()
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-tonase'
        ];
        return view('employee_tonase.index', [
            'title'         => 'Tonase',
            'layout'    => $layout,
            'nik_employee' => ''
        ]);
    }

    public function template($year_month)
    {
        $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $day_month = ResponseFormatter::getEndDay($year_month);

        $arr_coal_from = CoalFrom::join('companies', 'companies.uuid', 'coal_froms.company_uuid')->get([
            'companies.*',
            'coal_froms.*',
            'coal_froms.uuid as coal_from_uuid'
        ]);

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Tonase');

        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B2', 'Perusahaan');
        $createSheet->setCellValue('B8', 'Harga');

        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);
        $createSheet->setCellValue('A20', 'No');
        $createSheet->setCellValue('B20', 'NIK');
        $createSheet->setCellValue('C20', 'Nama');
        $createSheet->setCellValue('D20', 'Jabatan');        
        $createSheet->setCellValue('E19', 'Total Ritase');

        for ($i = 1; $i <= $day_month; $i++) {
            $first = $i + 3;
            $second = $first + 1 + $day_month;
            $third = $second + 1 + $day_month;
            $createSheet->setCellValue($abjads[$first] . '20', $i);
            $createSheet->setCellValue($abjads[$second] . '20', $i);
            $createSheet->setCellValue($abjads[$third] . '20', $i);
        }

        $zip = new ZipArchive;
        $fileName = 'file/absensi/Tonase ' . $year_month . '-' . rand(99, 9999) . 'file.zip';
        if ($zip->open($fileName, ZipArchive::CREATE) === TRUE) {


            foreach ($arr_coal_from as $coal_from) {
                $createSheet->setCellValue('C8', $coal_from->hauling_price);
                $createSheet->setCellValue('C2', $coal_from->company_uuid);
                $createSheet->setCellValue('B6', 'Asal Batu');
                $createSheet->setCellValue('C6', $coal_from->coal_from);
                $createSheet->setCellValue('B7', 'Kode Asal Batu');
                $createSheet->setCellValue('C7', $coal_from->coal_from_uuid);

                $crateWriter = new Xls($createSpreadsheet);
                $name = 'file/absensi/Tonase -' . $coal_from->company_uuid . '-' . $coal_from->coal_from . '-' . $year_month . '-' . rand(99, 9999) . 'file.xls';
                $crateWriter->save($name);
                $zip->addFile($name, $coal_from->company_uuid . '-' . $coal_from->coal_from . '-' . $year_month . '-' . rand(99, 9999) . '.xls.');
            }
        }
        $zip->close();
        return response()->download(public_path($fileName));
    }


    // butuh export untuk data
    public function export($year_month)
    {
        $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $datetime = Carbon::createFromFormat('Y-m', $year . '-' . $month);
        $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');


        $companies = Company::join('coal_froms', 'coal_froms.uuid', 'companies.uuid')
            ->get([
                'coal_froms.*'
            ]);

        $arr_coal_from = CoalFrom::join('companies', 'companies.uuid', 'coal_froms.company_uuid')->get([
            'companies.*',
            'coal_froms.*',
            'coal_froms.uuid as coal_from_uuid'
        ]);

        // dd($arr_coal_from);

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Tonase');

        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B2', 'Perusahaan');
        $createSheet->setCellValue('D2', 'Harga');

        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);
        $createSheet->setCellValue('A5', 'No');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');

        $employees = Employee::noGet_employeeAll_detail()
            ->get();

        $arr_employee = Employee::noGet_employeeAll_detail()
            ->get();


        for ($i = 1; $i <= $day_month; $i++) {
            $first = $i * 3 - 2;
            $second = $first + 1;
            $third = $second + 1;
            $createSheet->setCellValue($abjads[$first + 3] . '5', $i);
            $createSheet->setCellValue($abjads[$first + 3] . '4', 'rit');
            $createSheet->setCellValue($abjads[$second + 3] . '5', $i);
            $createSheet->setCellValue($abjads[$second + 3] . '4', 'ton');
            $createSheet->setCellValue($abjads[$third + 3] . '5', $i);
            $createSheet->setCellValue($abjads[$third + 3] . '4', 'full');
        }

        $employee_row = 6;
        $no = 1;




        $zip = new ZipArchive;
        $fileName = 'file/absensi/Tonase ' . $year_month . '-' . rand(99, 9999) . 'file.zip';
        $arr_tonase_employee = Employee::noGet_employeeAll_detail()->join('employee_tonases', 'employee_tonases.employee_uuid', 'employees.uuid')
            ->whereYear('employee_tonases.date', $year)
            ->whereMonth('employee_tonases.date', $month)
            ->groupBy(
                'employee_tonases.employee_uuid',
                'employee_tonases.coal_from_uuid',
                'employee_tonases.date',
            )
            ->select(
                'employee_tonases.coal_from_uuid',
                'employee_tonases.date',
                'employee_tonases.employee_uuid',
                DB::raw("count(employee_tonases.tonase_value) as tonase_count"),
                DB::raw("sum(employee_tonases.tonase_value) as tonase_value"),
                DB::raw("sum(employee_tonases.tonase_full_value) as tonase_full_value"),
            )
            ->get();

        $arr_data = [];

        foreach ($arr_tonase_employee as $tonase_employee) {
            $arr_data[$tonase_employee->coal_from_uuid][$tonase_employee->employee_uuid][$tonase_employee->date] = [
                'ritase'    => $tonase_employee->tonase_count,
                'tonase_value'  => round($tonase_employee->tonase_value, 2),
                'tonase_full_value' => round($tonase_employee->tonase_full_value, 2)
            ];
        }


        if ($zip->open($fileName, ZipArchive::CREATE) === TRUE) {
            for ($i = 1; $i <= $day_month; $i++) {
                $first = $i * 3 - 2;
                $second = $first + 1;
                $third = $second + 1;
                $createSheet->setCellValue($abjads[$first + 3] . '5', $i);
                $createSheet->setCellValue($abjads[$second + 3] . '5', $i);
                $createSheet->setCellValue($abjads[$third + 3] . '5', $i);
            }

            foreach ($arr_coal_from as $coal_from) {
                $createSheet->setCellValue('D3', $coal_from->hauling_price);
                $createSheet->setCellValue('C2', $coal_from->company_uuid);
                $createSheet->setCellValue('E2', 'Asal Batu');
                $createSheet->setCellValue('E3', $coal_from->coal_from);
                $createSheet->setCellValue('F2', 'Kode Asal Batu');
                $createSheet->setCellValue('F3', $coal_from->coal_from_uuid);

                $crateWriter = new Xls($createSpreadsheet);
                $name = 'file/absensi/Tonase -' . $coal_from->company_uuid . '-' . $coal_from->coal_from . '-' . $year_month . '-' . rand(99, 9999) . 'file.xls';
                // ob_end_clean();

                $crateWriter->save($name);
                $zip->addFile($name, $coal_from->company_uuid . '-' . $coal_from->coal_from . '-' . $year_month . '-' . rand(99, 9999) . '.xls.');
            }


            // foreach($companies as $company){ 
            //     for($i = 1; $i <= $day_month; $i++){  
            //         $first = $i * 3 - 2;
            //         $second = $first+1;
            //         $third = $second + 1;
            //         $createSheet->setCellValue($abjads[$first+3].'5', $i);
            //         $createSheet->setCellValue($abjads[$second+3].'5', $i);
            //         $createSheet->setCellValue($abjads[$third+3].'5', $i);
            //     }
            //     $employee_row = 6;
            //     $no = 1;



            //     foreach($employees as $item){
            //         $createSheet->setCellValue( $abjads[0].$employee_row, $no);
            //         $createSheet->setCellValue( $abjads[1].$employee_row, $item->nik_employee);
            //         $createSheet->setCellValue( $abjads[2].$employee_row, $item->name);
            //         $createSheet->setCellValue( $abjads[3].$employee_row, $item->position);

            //         $data_tonase_employee = Employee::leftJoin('employee_tonases','employee_tonases.employee_uuid', 'employees.uuid')
            //         ->where('employee_tonases.employee_uuid', $item->employee_uuid)

            //         ->where('employee_tonases.coal_from_uuid', $company->uuid)
            //         ->whereYear('employee_tonases.date', $year)->whereMonth('employee_tonases.date', $month)
            //         ->orderBy('employee_tonases.date', 'asc')
            //         ->groupBy(
            //             'employee_tonases.employee_uuid',
            //             'employee_tonases.date',
            //         )
            //         ->select( 
            //             'employee_tonases.date', 
            //             'employee_tonases.employee_uuid',
            //             DB::raw("count(employee_tonases.tonase_value) as tonase_count"),
            //             DB::raw("sum(employee_tonases.tonase_value) as tonase_value"),
            //         )
            //         ->get();

            //         $item->data_tonase_employee = $data_tonase_employee;                


            //         for($i = 1; $i <= $day_month; $i++){  
            //             $first = $i * 3 - 2;
            //             $second = $first+1;
            //             $third = $second + 1;
            //             $cel_for = $abjads[$second+3].$employee_row;
            //             $formula = '=IF('.$abjads[$first+3].$employee_row.'>4,'.$cel_for.'*0.15+'.$cel_for.','.$cel_for.')';
            //             $createSheet->setCellValue($abjads[$first+3].$employee_row, '0');
            //             $createSheet->setCellValue($abjads[$second+3].$employee_row, '0');
            //             $createSheet->setCellValue($abjads[$third+3].$employee_row, $formula);
            //         }

            //         foreach($data_tonase_employee as $tonase){
            //             $date = $tonase->date;
            //             $date = explode('-', $date);
            //             $date_day = (int)$date[2];
            //             $first = $date_day * 3 - 2;
            //             $second = $first+1;
            //             $third = $second + 1;

            //             if(!empty($tonase->tonase_count)){
            //                 $count = $tonase->tonase_count;
            //                 $value = $tonase->tonase_value;
            //             }else{
            //                 $count = 0;
            //                 $value = 0;
            //             }
            //             $createSheet->setCellValue($abjads[$first+3].$employee_row, $count);
            //             $createSheet->setCellValue($abjads[$second+3].$employee_row, $value);
            //         }
            //         $employee_row++;
            //         $no++;    

            //     }
            //     // dd($company);
            //     $createSheet->setCellValue('D3', $company->hauling_price);
            //     $createSheet->setCellValue('C2', $company->uuid);

            //     $crateWriter = new Xls($createSpreadsheet);
            //     $name = 'file/absensi/Tonase Perusahaan '.$company->uuid.'-'.$year_month.'-'.rand(99,9999).'file.xls';
            //     // ob_end_clean();

            //     $crateWriter->save($name);
            //     $zip->addFile($name, $company->uuid.'.xls.');
            // }
        }
        $zip->close();
        return response()->download(public_path($fileName));
    }

    //used good
    public static function funcStore($validatedData)
    {
        $percent_bonus = 15;
        $ritase_bonus = 5;

        if ($validatedData['ritase']) {
            $tonase_each_ritase = $validatedData['tonase_value'] / $validatedData['ritase'];
            $tonase_each_ritase = round($tonase_each_ritase, 3);
            $sisa = round($validatedData['tonase_value']  - ($tonase_each_ritase * $validatedData['ritase']), 3);

            if ($validatedData['ritase'] >= $ritase_bonus) {
                $tonase_full_bonus = $validatedData['tonase_full_value'];
                $each_tonase_full_bonus = round($validatedData['tonase_full_value'] / $validatedData['ritase'], 3);
                $sisa_bonus = round($tonase_full_bonus - (round($each_tonase_full_bonus * $validatedData['ritase'], 3)));
            } else {
                $tonase_full_bonus = $tonase_each_ritase;
                $sisa_bonus  = 0;
            }


            $validatedData['employee_uuid'] =  $validatedData['nik_employee'];
            $validatedData['coal_from_uuid'] =  $validatedData['coal_from_uuid'];
            $validatedData['uuid'] = $validatedData['date'] . '-' . $validatedData['company_uuid'] . '-' . $validatedData['nik_employee'];
            $dd = [];

            for ($i = 0; $i < $validatedData['ritase']; $i++) {
                if ($validatedData['ritase'] >= $ritase_bonus) {
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                    $validatedData['tonase_full_value'] = $tonase_each_ritase + $tonase_each_ritase * $percent_bonus / 100;
                    $validatedData['tonase_full_value'] = round($validatedData['tonase_full_value'], 3);
                } else {
                    $validatedData['tonase_full_value'] = $tonase_each_ritase;
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                }

                if ($i == $validatedData['ritase'] - 1) {
                    if ($validatedData['ritase'] >= $ritase_bonus) {

                        $validatedData['tonase_value'] = $tonase_each_ritase + $sisa;
                        $validatedData['tonase_full_value_real'] = $validatedData['tonase_full_value'] = round($tonase_each_ritase + $tonase_each_ritase * $percent_bonus / 100, 3);
                        $validatedData['tonase_full_value'] = round($validatedData['tonase_full_value'], 3) + $sisa_bonus;
                    } else {
                        $validatedData['tonase_full_value'] = $tonase_each_ritase + $sisa;
                        $validatedData['tonase_value'] = $tonase_each_ritase + $sisa;
                    }
                }

                $store = EmployeeTonase::create($validatedData);
                $dd[] = $validatedData;
            }
        }
    }

    // used good
    public function import(Request $request)
    {
        // sistem update belum
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

            // DESCRIPTION
            $month_hm =  $sheet->getCell('C3')->getValue();
            $year_hm = $sheet->getCell('C4')->getValue();
            $datetime = Carbon::createFromFormat('Y-m', $year_hm . '-' . $month_hm);
            $day_month = ResponseFormatter::getEndDay($year_hm . '-' . $month_hm);

            $price_code = $sheet->getCell('C8')->getValue();
            $company_uuid = $sheet->getCell('C2')->getValue();
            // dd( $company_uuid );
            $coal_from_uuid = $sheet->getCell('C7')->getValue();
            $all_row_data = [];
            $no_employee = 21;
            $employees = [];
            if ($sheet->getCell('E' . '20')->getValue() == $sheet->getCell('F' . '20')->getValue()) {

                while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                    $date_row = 3;
                    $nik_employee = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue());

                    for ($day = 1; $day <= $day_month; $day++) { //hm biasa

                        $first = $day * 3 - 2;
                        $second = $first + 1;
                        $third = $second + 1;

                        $cell_ritase = $abjads[$first + 3] . $no_employee;
                        $cell_tonase = $abjads[$second + 3] . $no_employee;

                        if ($sheet->getCell($cell_ritase)->getValue() != null) {
                            $data_each_day = [
                                'nik_employee'  => $nik_employee,
                                'date'  => $year_hm . '-' . $month_hm . '-' . $day,
                                'ritase'       => $sheet->getCell($cell_ritase)->getValue(),
                                'tonase_value' => $sheet->getCell($cell_tonase)->getValue(),
                                'coal_from_uuid'  => $coal_from_uuid,
                                'price_code'  => $price_code,
                                'company_uuid'  => $company_uuid,
                            ];


                            EmployeeTonseController::funcStore($data_each_day);
                            $employees[$day] = $data_each_day;
                        }
                    }
                    dd($employees);
                    $no_employee++;
                }
            } else {
                // dd($day_month);
                while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                    $arr_data_employee_hour_meter_day = EmployeeTonase::whereYear('date', $year_hm)
                        ->whereMonth('date', $month_hm)
                        ->where('coal_from_uuid', $coal_from_uuid)
                        ->delete();
                    $date_row = 3;
                    $nik_employee = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue());

                    for ($day = 1; $day <= $day_month; $day++) { //hm biasa
                        
                        $cell_ritase = $abjads[($date_row + $day)] . $no_employee;
                        $cell_tonase = $abjads[($date_row + (int)$day_month + $day + 1)] . $no_employee;
                        
                        if ($sheet->getCell($cell_ritase)->getValue() != null) {
                            $validatedData = [
                                'uuid' =>  $company_uuid.'-'.$nik_employee.'-'.ResponseFormatter::excelToDate( $year_hm . '-' . $month_hm . '-' . $day).'-'.$sheet->getCell('A' . $no_employee)->getValue(),
                                'employee_uuid' => $nik_employee,
                                'coal_from_uuid' => $coal_from_uuid,
                                'tonase_value' => $sheet->getCell($cell_tonase)->getValue(),
                                'date' => ResponseFormatter::excelToDate( $year_hm . '-' . $month_hm . '-' . $day),
                                'company_uuid' => $company_uuid,
                                'ritase' => $sheet->getCell($cell_ritase)->getValue()
                            ];
                          

                            $validatedData['each_ritase'] = round($validatedData['tonase_value'] / $validatedData['ritase'], 2);
                            $validatedData['over'] = $validatedData['tonase_value'] - $validatedData['each_ritase'] * $validatedData['ritase'];
                            $validatedData['tonase_value'] = $validatedData['each_ritase'];

                            for ($i = 1; $i < $validatedData['ritase']; $i++) {
                                $validatedData['uuid'] = $validatedData['employee_uuid'] . '-' . $validatedData['date'] . '-' . rand(99, 9999);
                                
                                $row_data = [
                                    'uuid' => $company_uuid.'-'.$nik_employee.'-'.ResponseFormatter::excelToDate( $year_hm . '-' . $month_hm . '-' . $day).'-'.$sheet->getCell('A' . $no_employee)->getValue().$i,
                                    'employee_uuid' => $nik_employee,
                                    'coal_from_uuid' => $coal_from_uuid,
                                    'tonase_value' =>$validatedData['tonase_value'],
                                    'date' => ResponseFormatter::excelToDate( $year_hm . '-' . $month_hm . '-' . $day),
                                    'company_uuid' => $company_uuid,
                                ];
                                $all_row_data[] = $row_data;
                                
                            }
                            
                            $validatedData['uuid'] = null;
                            $validatedData['tonase_value'] = $validatedData['each_ritase'] + $validatedData['over'];
                           
                            $row_data = [
                                'uuid' => $company_uuid.'-'.$nik_employee.'-'.ResponseFormatter::excelToDate( $year_hm . '-' . $month_hm . '-' . $day).'-'.$sheet->getCell('A' . $no_employee)->getValue(),
                                'employee_uuid' => $nik_employee,
                                'coal_from_uuid' => $coal_from_uuid,
                                'tonase_value' => $validatedData['tonase_value'],
                                'date' => ResponseFormatter::excelToDate( $year_hm . '-' . $month_hm . '-' . $day),
                                'company_uuid' => $company_uuid,
                            ];
                            
                            $all_row_data[] = $row_data;
                        }
                    }                   
                    $no_employee++;
                }
                // dd( $all_row_data);
                $xy =EmployeeTonase::insert(
                    $all_row_data
                );
            }

            return back();
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function indexForEmployee($nik_employee)
    {
        $employee = Employee::where('nik_employee', $nik_employee)->get()->first();
 
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'tonase-employee-me'
        ];
        return view('employee_tonase.employee.index', [
            'title'         => 'Tonase',
            'layout'    => $layout,
            'nik_employee' => $nik_employee
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->all();
        if ($validatedData['ritase'] > 1) {
            $validatedData['each_ritase'] = round($validatedData['tonase_value'] / $validatedData['ritase'], 2);
            $validatedData['over'] = $validatedData['tonase_value'] - $validatedData['each_ritase'] * $validatedData['ritase'];
            $validatedData['tonase_value'] = $validatedData['each_ritase'];
            for ($i = 1; $i < $validatedData['ritase']; $i++) {
                $validatedData['uuid'] = $validatedData['employee_uuid'] . '-' . $validatedData['date'] . '-' . rand(99, 9999);
                $store = EmployeeTonase::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
            }
            $validatedData['uuid'] = null;
            $validatedData['tonase_value'] = $validatedData['each_ritase'] + $validatedData['over'];
        }

        if (empty($validatedData['uuid'])) {
            $validatedData['uuid'] = $validatedData['employee_uuid'] . '-' . $validatedData['date'] . '-' . rand(99, 9999);
        }

        $store = EmployeeTonase::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, 'store emp tonase');
     
    }
    //used on index
    public function anyDataMonthFilter(Request $request)
    {
        $validateData = $request->all();
        $data_database = session('data_database');
        $data_employees = $data_database['data_employees'];
        
        // if(empty($validateData['filter']['arr_filter']['company'])){
        //     $validateData['kosong'];
        // }
        if (empty($validateData['filter']['arr_filter'])) {
            $validateData['filter']['arr_filter'] = $validateData['filter']['value_checkbox'];
        } else {
            if (empty($validateData['filter']['arr_filter']['company'])) {
                $validateData['filter']['arr_filter']['company'] = $validateData['filter']['value_checkbox']['company'];
            }
            if (empty($validateData['filter']['arr_filter']['coal-from'])) {
                $validateData['filter']['arr_filter']['coal-from'] = $validateData['filter']['value_checkbox']['coal-from'];
            }
            if (empty($validateData['filter']['arr_filter']['site_uuid'])) {
                $validateData['filter']['arr_filter']['site_uuid'] = $validateData['filter']['value_checkbox']['site_uuid'];
            }
        }


        

        $arr_data_tonase = [];

        $data_table = [];
        $data_total = [
            'ritase' => 0,
            'tonase'=> 0
        ];
        if (!empty($validateData['filter']['arr_filter'])) {
            foreach ($validateData['filter']['arr_filter']['company'] as $item_company) {
                foreach ($validateData['filter']['arr_filter']['site_uuid'] as $item_site_uuid) {
                    $data_table[$item_company . '-' . $item_site_uuid] = [];
                }
            }
            foreach ($validateData['filter']['arr_filter']['coal-from'] as $item_coal_from) {
                $data_tonase = EmployeeTonase::join('employees', 'employees.nik_employee', 'employee_tonases.employee_uuid')
                    ->where('employee_tonases.date', '>=', $validateData['filter']['date_filter']['date_start_filter_tonase'])
                    ->where('employee_tonases.date', '<=', $validateData['filter']['date_filter']['date_end_filter_tonase'])
                    ->where('employee_tonases.coal_from_uuid', $item_coal_from)
                    ->get([
                        'employees.site_uuid',
                        'employee_tonases.*',
                        'employees.company_uuid',                        
                        'employee_tonases.company_uuid as company_coal',
                    ]);
               

                foreach ($data_tonase as $item_data_tonase) {
                    $arr_data_tonase[$item_data_tonase->uuid] = $item_data_tonase;
                    $employee_tonase_uuid = '';
                    
                    if ($validateData['filter']['is_combined'] == 'false') {
                        $employee_tonase_uuid = '-' . $item_data_tonase->coal_from_uuid;
                    }
                    if (empty($data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid])) {
                        $data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['detail'] = $data_employees[$item_data_tonase->employee_uuid];
                        $data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['employee_uuid'] = $item_data_tonase->employee_uuid;
                        $data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['sum_tonase'] = 0;
                        $data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['count_tonase'] = 0;
                    }
                    

                    // if(empty($data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['data'][$item_data_tonase->date])){
                    //     $data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['data'][$item_data_tonase->date]
                    // }

                    $data_total['ritase'] = $data_total['ritase']+ 1;
                    $data_total['tonase'] = $data_total['tonase'] + $item_data_tonase->tonase_value;
                    $data_total['tonase'] = round($data_total['tonase'], 2);


                    $data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['company_coal'] = $item_data_tonase->company_coal; 
                    $data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['data'][$item_data_tonase->date][] = $item_data_tonase;
                    $data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['sum_tonase'] = $data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['sum_tonase'] + $item_data_tonase->tonase_value;
                    $data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['sum_tonase'] = round($data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['sum_tonase'] ,3);
                    $data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['count_tonase'] = $data_table[$item_data_tonase->company_uuid . '-' . $item_data_tonase->site_uuid][$item_data_tonase->employee_uuid . $employee_tonase_uuid]['count_tonase'] +1;
                
                }
              
        
            }
            //   return ResponseFormatter::toJson($validateData, 'response from data');
            
        } else {
            $data_tonase = EmployeeTonase::where('employee_tonases.date', '>=', $validateData['filter']['date_filter']['date_start_filter_tonase'])
                ->where('employee_tonases.date', '<=', $validateData['filter']['date_filter']['date_end_filter_tonase'])
                ->get();
        }
        // return ResponseFormatter::toJson($validateData, 'response from data');
        
        $datatable = [] ;

        foreach($data_table as $item_dd_tbl){
            if(count($item_dd_tbl)>0){
                foreach($item_dd_tbl as $item_employees){
                    $datatable[] = $item_employees;
                }                
            }
        }

        $data = [
            'data_total' => $data_total,
            'request'    => $validateData,
            'data_table'  => $data_table,
            'data_tonase'=> $arr_data_tonase,
            'datatable' => $datatable
        ];

        return ResponseFormatter::toJson($data, 'response from data');
        $arr_data = [];
        $arr_data_send = [];
        $filter_arr_coal_from = [];
        $validateData = $request->all();


        $arr_coal_from = CoalFrom::all();

        if (empty($request->filter['arr_coal_from'])) {
            foreach ($arr_coal_from as $coal_from) {
                $filter_arr_coal_from[] = $coal_from->uuid;
            }
        } else {
            $filter_arr_coal_from = $request->filter['arr_coal_from'];
        }
        $validateData['filter']['arr_coal_from'] = $filter_arr_coal_from;

        if (!empty($validateData['filter']['arr_coal_from'])) {
            foreach ($validateData['filter']['arr_coal_from'] as $coal_from) {
                $data = EmployeeTonase::join('employees', 'employees.uuid', 'employee_tonases.employee_uuid')
                    ->join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
                    ->leftJoin('positions', 'positions.uuid', 'employees.position_uuid')
                    ->join('coal_froms', 'coal_froms.uuid', 'employee_tonases.coal_from_uuid')
                    ->whereNull('employees.date_end')
                    ->whereNull('user_details.date_end')
                    ->whereYear('employee_tonases.date', $request->year)
                    ->whereMonth('employee_tonases.date', $request->month);

                if (!empty($request->day)) {
                    $data = $data->whereDay('employee_tonases.date', $request->day);
                }
                $data = $data->where('employee_tonases.coal_from_uuid', $coal_from)
                    ->groupBy(
                        'employee_tonases.coal_from_uuid',
                        'user_details.photo_path',
                        'employees.nik_employee',
                        'positions.position',
                        'user_details.name',
                        'employees.user_detail_uuid',
                        'employee_tonases.employee_uuid',
                    )
                    ->select(
                        'employee_tonases.coal_from_uuid',
                        'employee_tonases.employee_uuid',
                        'employees.user_detail_uuid',
                        'employees.nik_employee',
                        'user_details.photo_path',
                        'user_details.name',
                        'positions.position',
                        DB::raw("count(tonase_value) as ritase"),
                        DB::raw("SUM(tonase_value) as sum_tonase_value"),
                        DB::raw("SUM(tonase_full_value) as sum_tonase_full_value"),
                    )
                    ->get();

                if (!empty($data)) {
                    foreach ($data as $item) {
                        $arr_data[$coal_from][$item->employee_uuid] = $item;
                    }
                }
            }

            if ($request->filter['is_combined'] == "false") {
                foreach ($validateData['filter']['arr_coal_from'] as $coal_from_uuid) {
                    if (!empty($arr_data[$coal_from_uuid])) {
                        foreach ($arr_data[$coal_from_uuid] as $item_data) {
                            $arr_data_send[] = $item_data;
                        }
                    }
                }
            } else {
                foreach ($validateData['filter']['arr_coal_from'] as $coal_from_uuid) {
                    if (!empty($arr_data[$coal_from_uuid])) {
                        foreach ($arr_data[$coal_from_uuid] as $item_data) {
                            if (!empty($arr_data_send[$item_data->employee_uuid])) {
                                $arr_data_send[$item_data->employee_uuid]->ritase = $arr_data_send[$item_data->employee_uuid]->ritase + $item_data->ritase;
                                $arr_data_send[$item_data->employee_uuid]->sum_tonase_value = $arr_data_send[$item_data->employee_uuid]->sum_tonase_value + $item_data->sum_tonase_value;
                                $arr_data_send[$item_data->employee_uuid]->sum_tonase_full_value = $arr_data_send[$item_data->employee_uuid]->sum_tonase_full_value + $item_data->sum_tonase_full_value;
                            } else {
                                $arr_data_send[$item_data->employee_uuid] = $item_data;
                            }
                        }
                    }
                }
            }
        }
        return Datatables::of($arr_data_send)
            ->make(true);
    }
}
