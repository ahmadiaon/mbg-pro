<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeHourMeterBonus;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\HourMeterPrice;
use App\Models\Privilege\Privilege;
use App\Models\Safety\AtributSize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class EmployeeHourMeterDayController extends Controller
{
    // used index
    public function moreAnyData(Request $request)
    {
        $validateData = $request->all();

        $data_database = session('data_database');
        $data_employees = $data_database['data_employees'];
        if (empty($validateData['filter']['arr_filter'])) {
            $validateData['filter']['arr_filter'] = $validateData['filter']['value_checkbox'];
        } else {
            if (empty($validateData['filter']['arr_filter']['company'])) {
                $validateData['filter']['arr_filter']['company'] = $validateData['filter']['value_checkbox']['company'];
            }
            if (empty($validateData['filter']['arr_filter']['hour_meter_price'])) {
                $validateData['filter']['arr_filter']['hour_meter_price'] = $validateData['filter']['value_checkbox']['hour_meter_price'];
            }
            if (empty($validateData['filter']['arr_filter']['site_uuid'])) {
                $validateData['filter']['arr_filter']['site_uuid'] = $validateData['filter']['value_checkbox']['site_uuid'];
            }
        }

        $filter_array = [];
        foreach ($validateData['filter']['arr_filter']['company'] as $item_company) {
            foreach ($validateData['filter']['arr_filter']['site_uuid'] as $item_site_uuid) {
                foreach ($validateData['filter']['arr_filter']['hour_meter_price'] as $item_hour_meter_price) {
                    $filter_array[$item_company . '-' . $item_site_uuid . '-' . $item_hour_meter_price] = ['detail'];
                }
            }
        }

        $data_basic = EmployeeHourMeterDay::join('employees', 'employees.nik_employee', 'employee_hour_meter_days.employee_uuid')
            ->where('employee_hour_meter_days.date', '>=', $validateData['filter']['date_filter']['date_start_filter_hm'])
            ->where('employee_hour_meter_days.date', '<=', $validateData['filter']['date_filter']['date_end_filter_hm'])
            ->whereNull('employees.date_end')
            ->get([
                'employees.nik_employee',
                'employees.site_uuid',
                'employees.company_uuid',
                'employee_hour_meter_days.*'
            ]);

        $data_table = [];

        $data_table_uuid = [];
        $data_datatable = [];

        $data_formula_bonus_hm = EmployeeHourMeterBonus::orderBy('min_hm', 'asc')->get();
        //berdasarkan bulan yg diambil

        foreach ($data_basic as $item_data_basic) {
            if (!empty($filter_array[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid])) {
                if ($item_data_basic->is_bonus == 'on') {
                    foreach ($data_formula_bonus_hm as $item_bonus_hm) {
                        if ($item_data_basic->value >= $item_bonus_hm->min_hm) {
                            $item_data_basic->full_value = $item_data_basic['value'] + ($item_data_basic['value'] * $item_bonus_hm->percent_hm / 100);
                        }
                    }
                } else {
                    $item_data_basic->full_value = $item_data_basic['value'];
                }
                if (empty($data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid])) {
                    $data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid]['count_slip_hm'] = 0;
                    $data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid]['employee_uuid'] = $item_data_basic->employee_uuid;
                    $data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid]['sum_hm'] = 0;
                    $data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid]['sum_hm_bonus'] = 0;
                    $data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid]['hour_meter_price_uuid'] =  $item_data_basic->hour_meter_price_uuid;
                }
                $data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid]['count_slip_hm']++;
                $data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid]['sum_hm'] = $data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid]['sum_hm'] + $item_data_basic->value;
                $data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid]['sum_hm_bonus'] = $data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid]['sum_hm_bonus'] + $item_data_basic->full_value;

                $data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid]['date'][$item_data_basic->date][] = $item_data_basic;
                $data_datatable[$item_data_basic->employee_uuid . '-' . $item_data_basic->hour_meter_price_uuid]  =  $data_table[$item_data_basic->company_uuid . '-' . $item_data_basic->site_uuid . '-' . $item_data_basic->hour_meter_price_uuid][$item_data_basic->employee_uuid];
                $data_table_uuid[$item_data_basic->uuid] = $item_data_basic;
            }
        }

        $validateData['data_table_uuid'] = $data_table_uuid;
        $validateData['data_datatable'] = $data_datatable;
        $validateData['data_table'] = $data_table;
        $validateData['filter_array'] = $filter_array;
        $validateData['data_basic'] = $data_basic;
        return ResponseFormatter::toJson($validateData, $data_formula_bonus_hm);
    }


    // used to store 
    public function store(Request $request)
    {
        $validateData = $request->all();

        if (empty($validateData['uuid'])) {
            $validateData['uuid']  = $validateData['date'] . '-' . $validateData['employee_uuid'] . '-' . rand(99, 9999);
        }

        if (empty($validateData['is_bonus'])) {
            $validateData['is_bonus'] = null;
        }
        if (!empty($validateData['value'])) {
            $store = EmployeeHourMeterDay::updateOrCreate(['uuid' => $validateData['uuid']], $validateData);
        }
        if ($validateData['value'] < 1) {
            $store =  EmployeeHourMeterDay::where('uuid', $validateData['uuid'])->delete();
        }

        return ResponseFormatter::toJson($store, 'Data Stored');
    } //used



    public function index()
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-hour-meter'
        ];

        return view('employee_hour_meter_day.create', [
            'title'         => 'Hour Meter Day',
            'layout'    => $layout
        ]);
    }

    // done
    public function export(Request $request)
    {
        $year_month_arr = session('year_month');
        $data_database = session('data_database');

        $validatedData = $request->all();
        $validatedData['data_export'] = json_decode($request->data_export);
        $months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];


        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];


        $createSheet->setCellValue('A19', 'NO.');
        $createSheet->setCellValue('B19', 'NAMA');
        $createSheet->setCellValue('C19', 'NIK');
        $createSheet->setCellValue('D19', 'POSISI');
        $createSheet->setCellValue('E19', 'DEPARTEMEN');
        $createSheet->setCellValue('F19', 'SITE');
        $createSheet->setCellValue('G19', 'PERUSAHAAN');
        $createSheet->setCellValue('H19', 'HARGA HM');
        $data_formula_bonus_hm = EmployeeHourMeterBonus::orderBy('min_hm', 'asc')->get();


        $arr_date_start = explode('-', $validatedData['filter']['date_filter']['date_start_filter_hm']);
        $arr_date_end = explode('-', $validatedData['filter']['date_filter']['date_end_filter_hm']);
        $date_day_start = $arr_date_start[2];
        $date_day_end = $arr_date_end[2];

        $year_month = $arr_date_start[0] . '-' . $arr_date_start[1];

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

        $createSheet->setCellValue('B6', 'Status Bonus');
        $createSheet->setCellValue('C6', 'OFF');
        $createSheet->setCellValue('B7', 'Kondisi Data');
        $createSheet->setCellValue('C7', 'CLEAR');


        $row_ex = 8;
        $index_col_date = [];
        for ($i = (int)$date_day_start; $i <= (int)$date_day_end; $i++) {
            $createSheet->setCellValue($abjads[$row_ex] . '20', $i);
            $createSheet->getColumnDimension($abjads[$row_ex])->setWidth(4);
            $index_col_date[ResponseFormatter::excelToDate($year_month . '-' . $i)] = $abjads[$row_ex];
            $row_ex++;
        }
        $createSheet->setCellValue('I19', $date_day_start . ' - ' . $date_day_end . ' ' . strtoupper(ResponseFormatter::getMonthName((int)$arr_date_start[1])) . ' ' . $arr_date_start[0]);
        $createSheet->mergeCells('I19:' . $abjads[$row_ex - 1] . '19');
        $createSheet->getStyle('I19')->getAlignment()->setHorizontal('center');

        $createSheet->mergeCells('A19:A20');
        $createSheet->mergeCells('B19:B20');
        $createSheet->mergeCells('C19:C20');
        $createSheet->mergeCells('D19:D20');
        $createSheet->mergeCells('E19:E20');
        $createSheet->mergeCells('F19:F20');
        $createSheet->mergeCells('G19:G20');
        $createSheet->mergeCells('H19:H20');


        $row_employees = 21;
        $add_column_value = 0;
        $max_add_column_value = 0;
        foreach ($validatedData['data_export'] as $item_data_export) {
            
            $max_add_column_value = 0;

            if (!empty($item_data_export->date)) {
                foreach ($item_data_export->date as $index_dt => $item_hm) {
                    $add_column_value = 0;

                    foreach ($item_hm as $item_on_arry_data_hm) {
                        $item_on_arry_data_hm = (array)$item_on_arry_data_hm;
                        $item_on_arry_data_hm['full_value'] = $item_on_arry_data_hm['value'];

                        if ($item_on_arry_data_hm['is_bonus'] == 'on') {
                            foreach ($data_formula_bonus_hm as $item_bonus_hm) {
                                if ($item_on_arry_data_hm['value'] >= $item_bonus_hm->min_hm) {
                                    $item_on_arry_data_hm['full_value'] = $item_on_arry_data_hm['value'] + ($item_on_arry_data_hm['value'] * $item_bonus_hm->percent_hm / 100);
                                }
                            }
                        } 

                        $createSheet->setCellValue($index_col_date[$index_dt] . ($row_employees+$add_column_value), $item_on_arry_data_hm['full_value']);
                                                
                        if($max_add_column_value < $add_column_value ){
                            $max_add_column_value = $add_column_value;
                        }
                        $add_column_value++;
                    }
                }
            }

            for($loop_i = 0;$loop_i <= $max_add_column_value;$loop_i++  ){
                $createSheet->setCellValue('B' . ($row_employees + $loop_i), $data_database['data_employees'][$item_data_export->employee_uuid]['name']);
                $createSheet->setCellValue('C' . ($row_employees + $loop_i), $data_database['data_employees'][$item_data_export->employee_uuid]['nik_employee_with_space']);
                $createSheet->setCellValue('D' . ($row_employees + $loop_i), $data_database['data_employees'][$item_data_export->employee_uuid]['position']);
                $createSheet->setCellValue('E' . ($row_employees + $loop_i), $data_database['data_employees'][$item_data_export->employee_uuid]['department_uuid']);
                $createSheet->setCellValue('F' . ($row_employees + $loop_i), $data_database['data_employees'][$item_data_export->employee_uuid]['site_uuid']);
                $createSheet->setCellValue('G' . ($row_employees + $loop_i), $data_database['data_employees'][$item_data_export->employee_uuid]['company_uuid']);
                $createSheet->setCellValue('H' . ($row_employees + $loop_i), ResponseFormatter::toValueRupiah($item_data_export->hour_meter_price_uuid));    
            }
            
            $row_employees++;
            $row_employees  = $row_employees + $max_add_column_value;
        }

        for($loop_row = 0; $loop_row <= $row_ex;$loop_row++ ){
            $createSheet->getColumnDimension($abjads[$loop_row])->setAutoSize(true);
        }
       


        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return ResponseFormatter::toJson($name, $validatedData);
    }

    public function template()
    {
        $year_month_arr = session('year_month');

        $latest_day_this_month = ResponseFormatter::getEndDay($year_month_arr['year'] . '-' . $year_month_arr['month']);

        $validatedData = [
            'date_start_filter_hm' => $year_month_arr['year'] . '-' . $year_month_arr['month'].'-01',
            'date_end_filter_hm' => $year_month_arr['year'] . '-' . $year_month_arr['month'].'-'.$latest_day_this_month,
        ];

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

        $createSheet->setCellValue('B4', 'TAHUN');
        $createSheet->setCellValue('B3', 'BULAN');

        $createSheet->setCellValue('C3', $year_month_arr['month']);
        $createSheet->setCellValue('C4',  $year_month_arr['year']);

        $createSheet->setCellValue('B6', 'Status Bonus');
        $createSheet->setCellValue('C6', 'ON');
        $createSheet->setCellValue('B7', 'Kondisi Data');
        $createSheet->setCellValue('C7', 'CLEAR');

        $createSheet->setCellValue('A19', 'NO.');
        $createSheet->setCellValue('B19', 'NAMA');
        $createSheet->setCellValue('C19', 'NIK');
        $createSheet->setCellValue('D19', 'POSISI');
        $createSheet->setCellValue('E19', 'DEPARTEMEN');
        $createSheet->setCellValue('F19', 'SITE');
        $createSheet->setCellValue('G19', 'PERUSAHAAN');
        $createSheet->setCellValue('H19', 'HARGA HM');


        $arr_date_start = explode('-', $validatedData['date_start_filter_hm']);
        $arr_date_end = explode('-', $validatedData['date_end_filter_hm']);
        $date_day_start = $arr_date_start[2];
        $date_day_end = $arr_date_end[2];

        $year_month = $arr_date_start[0] . '-' . $arr_date_start[1];

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


        $row_ex = 8;
        $index_col_date = [];
        for ($i = (int)$date_day_start; $i <= (int)$date_day_end; $i++) {
            $createSheet->setCellValue($abjads[$row_ex] . '20', $i);
            $createSheet->getColumnDimension($abjads[$row_ex])->setWidth(4);
            $index_col_date[ResponseFormatter::excelToDate($year_month . '-' . $i)] = $abjads[$row_ex];
            $row_ex++;
        }
        $createSheet->setCellValue('I19', $date_day_start . ' - ' . $date_day_end . ' ' . strtoupper(ResponseFormatter::getMonthName((int)$arr_date_start[1])) . ' ' . $arr_date_start[0]);
        $createSheet->mergeCells('I19:' . $abjads[$row_ex - 1] . '19');
        $createSheet->getStyle('I19')->getAlignment()->setHorizontal('center');

        $createSheet->mergeCells('A19:A20');
        $createSheet->mergeCells('B19:B20');
        $createSheet->mergeCells('C19:C20');
        $createSheet->mergeCells('D19:D20');
        $createSheet->mergeCells('E19:E20');
        $createSheet->mergeCells('F19:F20');
        $createSheet->mergeCells('G19:G20');
        $createSheet->mergeCells('H19:H20');       

        for($loop_row = 0; $loop_row <= $row_ex;$loop_row++ ){
            $createSheet->getColumnDimension($abjads[$loop_row])->setAutoSize(true);
        }
       
        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return response()->download($name);
    }


    static function  countBonus($hm_value)
    {
        $arr_bonus = [
            [
                'min_hm'    => 16,
                'percent'   => 50,
            ],
            [
                'min_hm'    => 14,
                'percent'   => 30,
            ],
            [
                'min_hm'    => 10,
                'percent'   => 15,
            ],

        ];
        foreach ($arr_bonus as $item_bonus) {
            if ($hm_value >= $item_bonus['min_hm']) {
                return $hm_value_full = $hm_value * $item_bonus['percent'] / 100 + $hm_value;
            }
        }
    }

    public function import(Request $request)
    {
        $the_file = $request->file('uploaded_file');
        $data_database = session('data_database');
        $data_session_dataUser = session('dataUser');

        $company_and_site_privilege = [];
        foreach($data_database['data_companies'] as $item_company){
            if(!empty($data_session_dataUser['user_privileges']['company_privilege_'.$item_company['uuid']])){
                $company_and_site_privilege['company_privilege_'.$item_company['uuid']] = $item_company['uuid'];
            }
        }
        foreach($data_database['data_atribut_sizes']['site_uuid'] as $item_site){
            if(!empty($data_session_dataUser['user_privileges']['site_privilege_'.$item_site['uuid']])){
                $company_and_site_privilege['site_privilege_'.$item_site['uuid']] = $item_site['uuid'];
            }
        }

        // dd($company_and_site_privilege);
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();


        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

            // DESCRIPTION

            $status_bonus = ResponseFormatter::toUUID($sheet->getCell('C6')->getValue());
            $condition = ResponseFormatter::toUUID($sheet->getCell('C7')->getValue());
            $is_bonus = null;
            if ($status_bonus == 'ON') {
                $is_bonus = 'on';
            }else{
                $is_bonus = null;
            }
            // dd($status_bonus);
            $month_hm =  $sheet->getCell('C3')->getValue();
            $year_hm = $sheet->getCell('C4')->getValue();

            // dd($month_hm);
            $year_month = $year_hm . '-' . $month_hm;
            $day_month = ResponseFormatter::getEndDay($year_month);

            switch ($condition) {
                case 'CLEAR':
                    foreach($data_database['data_atribut_sizes']['site_uuid'] as $item_site){
                        if(!empty($data_session_dataUser['user_privileges']['site_privilege_'.$item_site['uuid']])){
                            $arr_data_employee_hour_meter_day = EmployeeHourMeterDay::leftJoin('employees','employees.nik_employee', 'employee_hour_meter_days.employee_uuid')
                            ->whereYear('date', $year_hm)
                            ->whereMonth('date', $month_hm)
                            ->whereNull('employees.date_end')
                            ->where('employees.site_uuid', $item_site['uuid'])
                            ->delete();
                        }
                    }

                    $no_employee = 21;
                    $all_row_data = [];
                    $arr_nik_employee = [];

                    while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                        $nik_employee = ResponseFormatter::toUUID($sheet->getCell('C' . $no_employee)->getValue()); //EMPLOYEE_UUID
                        $arr_nik_employee[] = $nik_employee;
                        $date_row = 7;
                        $hour_meter_price_uuid = ResponseFormatter::toNumber($sheet->getCell('H' . $no_employee)->getValue());
                        for ($day = 1; $day <= $day_month; $day++) {
                            $hm_value = $sheet->getCell($abjads[$date_row + $day] . $no_employee)->getValue();
                           
                            if (!empty($hm_value)) {
                                $date_row_data = ResponseFormatter::excelToDate($year_month . '-' . $day);
                                $row_data = [
                                    'uuid' => $date_row_data . '-' . $nik_employee . '-' . $sheet->getCell('A' . $no_employee)->getValue(),
                                    'date' => $date_row_data,
                                    'value' => $hm_value,
                                    'employee_uuid' => $nik_employee,
                                    'hour_meter_price_uuid' => $hour_meter_price_uuid,
                                    'is_bonus' => $is_bonus,
                                ];
                                
                                $all_row_data[] = $row_data;
                            }
                        }
                        $no_employee++;
                    }
                    $xy = EmployeeHourMeterDay::insert(
                        $all_row_data
                    );

                    return back();
                    break;
                default:
                    return back();
            }
            $arr_data_employee_hour_meter_day = EmployeeHourMeterDay::whereYear('date', $year_hm)
                ->whereMonth('date', $month_hm)
                // ->where('employee_hour_meter_days.employee_uuid', 'MBLE-0422003')
                ->get();
            dd($arr_data_employee_hour_meter_day);
           

            return back();
        } catch (Exception $e) {
            // dd($e);
            $error_code = $e;
            return back()->with('messageErr', 'file eror!');
        }
    }


    public function indexForEmployee($nik_employee)
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-hour-meter'
        ];
        return view('employee_hour_meter_day.index', [
            'title'         => 'Hour Meter',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'nik_employee' => $nik_employee
        ]);
    }

    public function delete(Request $request)
    {
        $store = EmployeeHourMeterDay::where('uuid', $request->uuid)->delete();

        return response()->json(['code' => 200, 'message' => 'Data Deleted', 'data' => $store], 200);
    }
}
