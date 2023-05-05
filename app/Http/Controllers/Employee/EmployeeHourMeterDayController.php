<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeHourMeterBonus;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\HourMeterPrice;
use App\Models\Safety\AtributSize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

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
    public function export($year_month)
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



        $arr_hour_meter_price = HourMeterPrice::all();

        $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $day_month = ResponseFormatter::getEndDay($year_month);

        $arr_employee = Employee::noGet_employeeAll_detail()->orderBy('employee_salaries.hour_meter_price_uuid')->get();
        // return view('datatableshow', [ 'data'         => $arr_employee]);

        $employee['nik_employee']['date']['hm-20000'] = [
            'value' => 10,
            'value_bonus'   => 11.5,
        ];

        foreach ($arr_hour_meter_price as $item_hour_meter_price) {
            // $data = EmployeeHourMeterDay::where('hour_meter_price_uuid', $item_hour_meter_price->uuid)->get();
            // return view('datatableshow', [ 'data'         => $data]);
        }

        $arr_hour_meter_data = EmployeeHourMeterDay::whereYear('date', $year)->whereMonth('date', $month)
            // ->where('employee_hour_meter_days.employee_uuid', 'MBLE-0422003')
            ->get();

        foreach ($arr_hour_meter_data as $item_hour_meter_data) {
            $arr_employee_hour_meter[$item_hour_meter_data->employee_uuid][$item_hour_meter_data->hour_meter_price_uuid][$item_hour_meter_data->date][] = [
                'value' => $item_hour_meter_data->value,
                'full_value' => $item_hour_meter_data->full_value
            ];
        }

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template HM');

        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B2', 'Perusahaan');
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);
        $createSheet->setCellValue('A5', 'No');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');

        $createSheet->setCellValue('F4', 'HM dislip tanpa Bonus');

        $createSheet->setCellValue('E5', 'Harga HM');

        for ($i = 1; $i <= $day_month; $i++) {
            $createSheet->setCellValue($abjads[$i + 4] . '5', $i);
            $createSheet->setCellValue($abjads[$i + 4 + $day_month + 2] . '5', $i);
            $createSheet->setCellValue($abjads[$i + 4 + $day_month + 2 + $day_month + 2] . '5', $i);
        }
        $createSheet->setCellValue($abjads[5 + $day_month] . '5', "Total");
        $createSheet->setCellValue($abjads[5 + $day_month + $day_month + 2] . '5', "Total");
        $createSheet->setCellValue($abjads[5 + $day_month + $day_month + $day_month + 4] . '5', "Total");



        $employee_row = 6;
        $no = 1;
        // each employee
        foreach ($arr_employee as $item) {
            //    if employee have hm

            $employee_row_old = $employee_row;
            $much_column_data_employee = [];
            if (!empty($arr_employee_hour_meter[$item->employee_uuid])) {
                // dd($arr_employee_hour_meter[$item->employee_uuid]);
                $arr_column_employee = [];
                // each hm uuid 
                foreach ($arr_employee_hour_meter[$item->employee_uuid] as $index => $employee_hour_meter) {
                    $max_arr_each_day = 1;
                    //eac day
                    foreach ($employee_hour_meter as $day => $arr_each_day) {
                        $the_date = explode('-', $day);
                        $much_arr_each_day = 0;
                        $old = '';
                        foreach ($arr_each_day as $each_day) {
                            $thecoll = $employee_row + $much_arr_each_day;
                            if ($each_day['value'] >= $arr_bonus[2]['min_hm']) {
                                if ($each_day['value'] == $each_day['full_value']) {
                                    if ($old == 'bonus') {
                                        $much_arr_each_day++;
                                        $thecoll = $employee_row + $much_arr_each_day;
                                    }
                                    $createSheet->setCellValue($abjads[4 + (int)$the_date[2] + $day_month + $day_month + 4] . $thecoll, $each_day['value']);
                                    $old = 'bonus';
                                } else {
                                    if ($old == 'reguler') {
                                        $much_arr_each_day++;
                                        $thecoll = $employee_row + $much_arr_each_day;
                                    }
                                    $old = 'reguler';
                                    $createSheet->setCellValue($abjads[4 + (int)$the_date[2]] . $thecoll, $each_day['value']);
                                }
                            } else {
                                if ($old == 'reguler') {
                                    $much_arr_each_day++;
                                    $thecoll = $employee_row + $much_arr_each_day;
                                }
                                $old = 'reguler';
                                $createSheet->setCellValue($abjads[4 + (int)$the_date[2]] . $thecoll, $each_day['value']);
                            }
                            if ($much_arr_each_day + 1 > $max_arr_each_day) {
                                $max_arr_each_day = $much_arr_each_day + 1;
                            }
                        }
                    }
                    $employee_row++;
                    $arr_column_employee[] = [
                        'hour_meter_price_uuid' => $index,
                        'much'  => $max_arr_each_day
                    ];
                }
                // dd($arr_column_employee);
                $employee_row = $employee_row_old;

                foreach ($arr_column_employee as $item_column_employee) {
                    // dd( $item->nik_employee);
                    for ($i = 0; $i < $item_column_employee['much']; $i++) {
                        $createSheet->setCellValue($abjads[0] . $employee_row, $no);
                        $createSheet->setCellValue($abjads[1] . $employee_row, $item->nik_employee);
                        $createSheet->setCellValue($abjads[2] . $employee_row, $item->name);
                        $createSheet->setCellValue($abjads[3] . $employee_row, $item->position);
                        $createSheet->setCellValue($abjads[4] . $employee_row, $item_column_employee['hour_meter_price_uuid']);
                        for ($j = 1; $j <= $day_month; $j++) {
                            $name_row = $abjads[$j + 4] . $employee_row;
                            $string_end = '';
                            $the_closer = ')';
                            $formula_add = '';

                            foreach ($arr_bonus as $item_bonus) {
                                $formula_add = $formula_add . ",IF(" . $name_row . ">=" . $item_bonus['min_hm'] . "," . $name_row . "*" . $item_bonus['percent'] . "%+" . $name_row;
                                $string_end = $string_end . $the_closer;
                            }
                            $str = ltrim($formula_add, ',');
                            $the_formula = "=" . $str . "," . $name_row . $string_end;
                            $createSheet->setCellValue($abjads[$j + 4 + $day_month + 2] . $employee_row, $the_formula);
                        }
                        $employee_row++;
                    }
                }
            } else {
                $createSheet->setCellValue($abjads[0] . $employee_row, $no);
                $createSheet->setCellValue($abjads[1] . $employee_row, $item->nik_employee);
                $createSheet->setCellValue($abjads[2] . $employee_row, $item->name);
                $createSheet->setCellValue($abjads[3] . $employee_row, $item->position);
                $createSheet->setCellValue($abjads[4] . $employee_row, $item->hour_meter_price_uuid);
                for ($k = 1; $k <= $day_month; $k++) {
                    $name_row = $abjads[$k + 4] . $employee_row;
                    $string_end = '';
                    $the_closer = ')';
                    $formula_add = '';
                    foreach ($arr_bonus as $item_bonus) {
                        $formula_add = $formula_add . ",IF(" . $name_row . ">=" . $item_bonus['min_hm'] . "," . $name_row . "*" . $item_bonus['percent'] . "%+" . $name_row;
                        $string_end = $string_end . $the_closer;
                    }
                    $str = ltrim($formula_add, ',');
                    $the_formula = "=" . $str . "," . $name_row . $string_end;
                    // dd($formula_add);
                    $createSheet->setCellValue($abjads[$k + 4 + $day_month + 2] . $employee_row, $the_formula);
                }
                $employee_row++;
            }
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/file-hm-bulan-' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        // return 'aaa';
        return response()->download($name);
    }

    public function template()
    {
        $arr_date_today = (session('year_month'));
        $latest_day_this_month = ResponseFormatter::getEndDay($arr_date_today['year'] . '-' . $arr_date_today['month']);
        $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];


        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template HM');

        $hour_meter_price = AtributSize::where('size', 'hour_meter_price')->get();

        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B2', 'Perusahaan');
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $arr_date_today['month']);
        $createSheet->setCellValue('C4',  $arr_date_today['year']);
        $createSheet->setCellValue('A20', 'No');
        $createSheet->setCellValue('B20', 'NIK');
        $createSheet->setCellValue('C20', 'Nama');
        $createSheet->setCellValue('D20', 'Jabatan');
        $createSheet->setCellValue('E20', 'Harga HM');

        $createSheet->setCellValue('B6', 'Status Bonus');
        $createSheet->setCellValue('C6', 'ON');
        $createSheet->setCellValue('B7', 'Kondisi Data');
        $createSheet->setCellValue('C7', 'CLEAR');
        $col_hm_price = 2;
        foreach ($hour_meter_price as $item_hour_meter_price) {
            $createSheet->setCellValue('E' . $col_hm_price, $item_hour_meter_price->name_atribut);
            $col_hm_price++;
        }
        $row_date = 5;
        for ($i = 1; $i <= $latest_day_this_month; $i++) {
            $createSheet->setCellValue($abjads[$row_date] . '20', ResponseFormatter::excelToDate($arr_date_today['year'] . '-' . $arr_date_today['month'] . '-' . $i));
            $createSheet->getStyle($abjads[$row_date] . '20')->getAlignment()->setTextRotation(-90);
            $row_date++;
        }
        $createSheet->setCellValue($abjads[$row_date] . '20', 'Total');


        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/file-hm-bulan-' . $arr_date_today['year'] . '-' . $arr_date_today['month'] . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return response()->download($name);
    }

    public function importFromTemplate(Request $request)
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
        // return 'ahmadi';
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();



            $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

            // DESCRIPTION
            $month_hm =  $sheet->getCell('C3')->getValue();
            dd($month_hm);
            $year_hm = $sheet->getCell('C4')->getValue();

            $year_month = $year_hm . '-' . $month_hm;
            $day_month = ResponseFormatter::getEndDay($year_month);
            $arr_data_employee_hour_meter_day = EmployeeHourMeterDay::whereYear('date', $year_hm)
                ->whereMonth('date', $month_hm)
                // ->where('employee_hour_meter_days.employee_uuid', 'MBLE-0422003')
                ->get();

            $arr_data_employee_hour_meter_day = $arr_data_employee_hour_meter_day->keyBy(function ($item) {
                return strval($item->employee_uuid);
            });


            $no_employee = 6;
            $employees = [];
            /*
            1. loop all employee
            2.
            EmployeeHourMeterDay::
            */
            $arr_data = [];
            while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                $nik_employee = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue()); //EMPLOYEE_UUID
                $hm_uuid = ResponseFormatter::toUuidLower($sheet->getCell('E' . $no_employee)->getValue());
                $date_row = 4;
                for ($day = 1; $day <= $day_month; $day++) {
                    //reguler
                    $hm_value = $sheet->getCell($abjads[$date_row + $day] . $no_employee)->getValue();
                    if (!empty($hm_value)) {
                        if ($hm_value >= $arr_bonus[2]['min_hm']) {
                            $hm_value_full =  EmployeeHourMeterDayController::countBonus($hm_value);
                        } else {
                            $hm_value_full = $hm_value;
                        }
                        $arr_data[$nik_employee][$hm_uuid][$day][] = [
                            'value' => $hm_value,
                            'full_value'    => round($hm_value_full, 2)
                        ];
                    }
                    //bonus
                    $hm_value_bonus = $sheet->getCell($abjads[$date_row + $day + $day_month + 2 + $day_month + 2] . $no_employee)->getValue();
                    if (!empty($hm_value_bonus)) {
                        $hm_value_full = $hm_value_bonus;
                        $arr_data[$nik_employee][$hm_uuid][$day][] = [
                            'value' => $hm_value_bonus,
                            'full_value'    => round($hm_value_full, 2),
                            'is_bonus'  => 'bonus',
                            'row'   => $abjads[$date_row + $day + $day_month + 2 + $day_month + 2] . $no_employee
                        ];
                    }
                }
                $no_employee++;
            }
            foreach ($arr_data as $employee_uuid => $arr_hm_uuid) {

                foreach ($arr_hm_uuid as $hm_uuid => $arr_day) {

                    foreach ($arr_day as $day => $arr_each_data) {
                        $date_each_data = $year_month . '-' . $day;
                        if (!empty($arr_data_employee_hour_meter_day[$employee_uuid])) {
                            $delete = EmployeeHourMeterDay::whereYear('date', $year_hm)
                                ->whereMonth('date', $month_hm)
                                ->whereDay('date', $day)
                                ->where('employee_uuid', $employee_uuid)->delete();
                        }
                        foreach ($arr_each_data as $index => $each_data) {
                            $each_data['uuid']  = $date_each_data . '-' . $employee_uuid . '-' . $index;
                            $each_data['employee_uuid']  = $employee_uuid;
                            $each_data['date']  = $date_each_data;
                            $each_data['hour_meter_price_uuid']  = $hm_uuid;
                            $store = EmployeeHourMeterDay::create($each_data);
                            // dd($store);
                        }
                    }
                }
            }

            // var_dump($arr_data);die;



            return back();
        } catch (Exception $e) {
            // dd($e);
            $error_code = $e;
            return back()->with('messageErr', 'file eror!');
        }
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
        // return 'ahmadi';
        $the_file = $request->file('uploaded_file');

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
            }
            // dd($status_bonus);
            $month_hm =  $sheet->getCell('C3')->getValue();
            $year_hm = $sheet->getCell('C4')->getValue();


            $year_month = $year_hm . '-' . $month_hm;
            $day_month = ResponseFormatter::getEndDay($year_month);
            switch ($condition) {
                case 'CLEAR':
                    $arr_data_employee_hour_meter_day = EmployeeHourMeterDay::whereYear('date', $year_hm)
                        ->whereMonth('date', $month_hm)
                        // ->where('employee_hour_meter_days.employee_uuid', 'MBLE-0422003')
                        ->delete();
                    $no_employee = 21;
                    $employees = [];
                    $arr_data = [];
                    $all_row_data = [];
                    $arr_nik_employee = [];
                    while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                        $nik_employee = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue()); //EMPLOYEE_UUID
                        $arr_nik_employee[] = $nik_employee;
                        $date_row = 4;
                        $hour_meter_price_uuid = ResponseFormatter::toNumber($sheet->getCell('E' . $no_employee)->getValue());
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
                    $xy =EmployeeHourMeterDay::insert(
                        $all_row_data
                        
                    );
                    // dd( $arr_nik_employee);
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
            $arr_data_employee_hour_meter_day = $arr_data_employee_hour_meter_day->keyBy(function ($item) {
                return strval($item->employee_uuid);
            });


            $no_employee = 21;
            $employees = [];
            /*
            1. loop all employee
            2.
            EmployeeHourMeterDay::
            */
            $arr_data = [];
            $arr_nik_employee = [];
            while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                $nik_employee = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue()); //EMPLOYEE_UUID
                $arr_nik_employee[] = $nik_employee;

                // $hm_uuid = ResponseFormatter::toUuidLower($sheet->getCell('E' . $no_employee)->getValue());
                // $date_row = 4;
                // for ($day = 1; $day <= $day_month; $day++) {
                //     //reguler
                //     $hm_value = $sheet->getCell($abjads[$date_row + $day] . $no_employee)->getValue();
                //     if (!empty($hm_value)) {
                //         if ($hm_value >= $arr_bonus[2]['min_hm']) {
                //             $hm_value_full =  EmployeeHourMeterDayController::countBonus($hm_value);
                //         } else {
                //             $hm_value_full = $hm_value;
                //         }
                //         $arr_data[$nik_employee][$hm_uuid][$day][] = [
                //             'value' => $hm_value,
                //             'full_value'    => round($hm_value_full, 2)
                //         ];
                //     }
                //     //bonus
                //     $hm_value_bonus = $sheet->getCell($abjads[$date_row + $day + $day_month + 2 + $day_month + 2] . $no_employee)->getValue();
                //     if (!empty($hm_value_bonus)) {
                //         $hm_value_full = $hm_value_bonus;
                //         $arr_data[$nik_employee][$hm_uuid][$day][] = [
                //             'value' => $hm_value_bonus,
                //             'full_value'    => round($hm_value_full, 2),
                //             'is_bonus'  => 'bonus',
                //             'row'   => $abjads[$date_row + $day + $day_month + 2 + $day_month + 2] . $no_employee
                //         ];
                //     }
                // }
                $no_employee++;
            }
            dd($arr_nik_employee);
            foreach ($arr_data as $employee_uuid => $arr_hm_uuid) {

                foreach ($arr_hm_uuid as $hm_uuid => $arr_day) {

                    foreach ($arr_day as $day => $arr_each_data) {
                        $date_each_data = $year_month . '-' . $day;
                        if (!empty($arr_data_employee_hour_meter_day[$employee_uuid])) {
                            $delete = EmployeeHourMeterDay::whereYear('date', $year_hm)
                                ->whereMonth('date', $month_hm)
                                ->whereDay('date', $day)
                                ->where('employee_uuid', $employee_uuid)->delete();
                        }
                        foreach ($arr_each_data as $index => $each_data) {
                            $each_data['uuid']  = $date_each_data . '-' . $employee_uuid . '-' . $index;
                            $each_data['employee_uuid']  = $employee_uuid;
                            $each_data['date']  = $date_each_data;
                            $each_data['hour_meter_price_uuid']  = $hm_uuid;
                            $store = EmployeeHourMeterDay::create($each_data);
                            // dd($store);
                        }
                    }
                }
            }

            // var_dump($arr_data);die;



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
