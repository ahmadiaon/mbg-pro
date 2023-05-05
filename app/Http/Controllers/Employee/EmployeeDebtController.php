<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeDebt;
use App\Models\Employee\EmployeePaymentDebt;
use App\Models\PaymentOther;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class EmployeeDebtController extends Controller
{
    public function index()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-debt'
        ];
        $payment_others = PaymentOther::all();
        $employees = Employee::data_employee();
        return view('employee_debt.index', [
            'title'         => 'Hutang',
            'layout'    => $layout,
            'employees' => $employees,
            'payment_others'    => $payment_others,
            'year_month'        => Carbon::today()->isoFormat('Y-M')
        ]);
    }

    public function store(Request $request)
    { //used
        $validatedData = $request->all();

        if (empty($validatedData['uuid'])) {
            $validatedData['uuid'] = $validatedData['employee_uuid'] . '-' .  $validatedData['date_debt'];
        }
        $storeData = EmployeeDebt::updateOrCreate(['uuid' =>  $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($storeData, 'Data Stored');
    }

    public function export()
    {
        $data_databases = (session('data_database'));
        $data_employees = $data_databases['data_employees'];        
        $arr_date_today = (session('year_month'));
        
        $year_month = $arr_date_today['year'] . '-' . $arr_date_today['month'];
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('C1', 'Template Penambahan Hutang');

        $createSheet->setCellValue('B1', 'Excel');
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);
        $createSheet->setCellValue('A5', 'No');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');
        $createSheet->setCellValue('E5', 'Tanggal Pinjaman');
        $createSheet->setCellValue('F5', 'Besar Pinjaman');
        $createSheet->setCellValue('G5', 'Besar Sisa Pinjaman');
        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/file-pinjaman-' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        // return 'aaa';
        return response()->download($name);
    }

    public function import(Request $request)
    {
        $the_file = $request->file('uploaded_file');
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        // BELUM DIHAPUS DATA YANG LAMA
        // hapus perbulan
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];
            $year = $sheet->getCell('C4')->getValue();
            $month = $sheet->getCell('C3')->getValue();
            $year_month = $year . '-' . $month;
            $day_month = ResponseFormatter::getEndDay($year_month);

            $dates = $year . '-' . $month . '-' . '1';
            $default_date = $year_month . '-' . $day_month;

            $no_employee = 6;
            $employees = [];

            while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                $employee_uuid = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue());
                $date_debt = ResponseFormatter::excelToDate($sheet->getCell('E' . $no_employee)->getValue());
                if (empty($date_debt)) {
                    $date_debt = $default_date;
                }

                $value_debt = $sheet->getCell('F' . $no_employee)->getValue();
                $value_debt = (int)$value_debt;
               


                $employee_debt = [
                    'uuid' => $employee_uuid . '-' . $date_debt,
                    'employee_uuid' => $employee_uuid,
                    'date_debt' =>  $date_debt,
                    'value_debt' => $value_debt,
                    'min_payment_debt' => 0,
                    'max_payment_debt' => $value_debt,
                ];
                $store_employee_debt = EmployeeDebt::updateOrCreate(['uuid'  => $employee_debt['uuid']], $employee_debt);
                EmployeeDebt::where('employee_uuid', $employee_uuid)->delete();
                EmployeePaymentDebt::where('employee_uuid', $employee_uuid)->delete();
                if(!empty($sheet->getCell('G' . $no_employee)->getValue())){
                    $currentDateTime =  new Carbon($date_debt);
                    $currentDateTime->subMonths(1);
                    $employee_debt = [
                        'uuid' => $employee_uuid . '-' . $date_debt,
                        'employee_uuid' =>  $employee_uuid,
                        'date_payment_debt' =>$currentDateTime->isoFormat('Y-MM-DD'),
                        'value_payment_debt' => $value_debt - (float)$sheet->getCell('G' . $no_employee)->getValue(),
                    ];
                    $store_employee_payment_debt = EmployeePaymentDebt::updateOrCreate(['uuid'  => $employee_debt['uuid']], $employee_debt);
                    
                }
                $no_employee++;
            }
            return back();
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function anyData(Request $request)
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
            if (empty($validateData['filter']['arr_filter']['status_debt'])) {
                $validateData['filter']['arr_filter']['status_debt'] = $validateData['filter']['value_checkbox']['status_debt'];
            }
            if (empty($validateData['filter']['arr_filter']['site_uuid'])) {
                $validateData['filter']['arr_filter']['site_uuid'] = $validateData['filter']['value_checkbox']['site_uuid'];
            }
        }
        $data_basic = EmployeeDebt::join('employees', 'employees.nik_employee', 'employee_debts.employee_uuid')
            ->whereNull('employees.date_end')
            ->get([
                'employees.nik_employee',
                'employees.site_uuid',
                'employees.company_uuid',
                'employee_debts.*'
            ]);
        $data_datatable = [];
        $employee_have_debt = [];
        $datatable = [];
        $data_debt_uuid = [];
        $data_payment_debt_uuid = [];
        $data_datatable_uuid = [];
        if (!empty($validateData['filter']['arr_filter'])) {
            foreach ($validateData['filter']['arr_filter']['company'] as $item_company) {
                foreach ($validateData['filter']['arr_filter']['site_uuid'] as $item_site_uuid) {
                    $data_table[$item_company . '-' . $item_site_uuid] = ['detail'];
                }
            }

            foreach ($data_basic as $i_db) {
                if (!empty($data_table[$i_db->company_uuid . '-' . $i_db->site_uuid])) {
                    $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['data_debt'][$i_db->uuid] = $i_db;
                    $data_debt_uuid[$i_db->uuid] = $i_db;
                    if (empty($datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['employee_uuid'])) {
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_debt'] = 0;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_payment_debt'] = 0;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_payment_debt'] = 0;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_debt'] = 0;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['employee_uuid'] = $i_db->employee_uuid;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['max_payment_debt'] = $i_db->max_payment_debt;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['date_debt'] = $i_db->date_debt;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['data_payment_debt'] = [];
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['status_debt'] = 'Belum Lunas';
                    }
                    if ($datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['date_debt'] < $i_db->date_debt) {
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['max_payment_debt'] = $i_db->max_payment_debt;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['date_debt'] = $i_db->date_debt;
                    }
                    $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_debt'] = $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_debt'] + 1;
                    $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_debt'] = $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_debt'] + $i_db->value_debt;
                    $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['remaining'] = $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_debt'];

                    $data_datatable_uuid[$i_db->employee_uuid] = $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid];
                }
            }

            $data_basic_payment_debt = EmployeePaymentDebt::get();

            foreach ($data_basic_payment_debt as $item_data_basic_payment_debt) {
                if (!empty($data_datatable_uuid[$item_data_basic_payment_debt->employee_uuid])) {
                    $data_datatable_uuid[$item_data_basic_payment_debt->employee_uuid]['data_payment_debt'][$item_data_basic_payment_debt->uuid] = $item_data_basic_payment_debt;
                    $data_datatable_uuid[$item_data_basic_payment_debt->employee_uuid]['remaining'] = $data_datatable_uuid[$item_data_basic_payment_debt->employee_uuid]['remaining'] - $item_data_basic_payment_debt->value_payment_debt;
                    $data_datatable_uuid[$item_data_basic_payment_debt->employee_uuid]['count_payment_debt'] =  $data_datatable_uuid[$item_data_basic_payment_debt->employee_uuid]['count_payment_debt'] + 1;
                    $data_datatable_uuid[$item_data_basic_payment_debt->employee_uuid]['sum_payment_debt'] =  $data_datatable_uuid[$item_data_basic_payment_debt->employee_uuid]['sum_payment_debt'] + $item_data_basic_payment_debt->value_payment_debt;
                    $data_payment_debt_uuid[$item_data_basic_payment_debt->uuid] = $item_data_basic_payment_debt;
                }
            }

            foreach ($data_datatable_uuid as $i_dt) {
                $data_datatable[] = $i_dt;
                if ($i_dt['remaining'] > 0) {
                    $employee_have_debt[] = $i_dt['employee_uuid'];
                }
            }


            // foreach ($datatable as $i_dt) {
            //     if (count($i_dt) > 0) {
            //         foreach ($i_dt as $index_i_dt => $value_i_dt) {
            //             $data_datatable[] = $value_i_dt;
            //             if($value_i_dt['remaining'] > 0){
            //                 $employee_have_debt[] = $value_i_dt['employee_uuid'];
            //             }
            //         }
            //     }
            // }




            $data = [
                'request'    => $validateData,
                'data_basic'  => $data_basic,
                'data_debt_uuid'  => $data_debt_uuid,
                'data_table'  => $data_table,
                'datatable' => $datatable,
                'data_datatable' => $data_datatable,
                'data_datatable_uuid' => $data_datatable_uuid,
                'data_basic_payment_debt' => $data_basic_payment_debt,
                'employee_have_debt' => $employee_have_debt,
                'data_payment_debt_uuid' => $data_payment_debt_uuid
            ];

            return ResponseFormatter::toJson($data, 'anyData employee payment');
        }
        $data = [
            'request'    => $validateData,
            'data_basic'  => $data_basic,
            // 'data_table'  => $data_table,
            // 'datatable' => $datatable,
            // 'data_datatable' => $data_datatable,
            // 'data_uuid' => $data_uuid
        ];
        return ResponseFormatter::toJson($data, 'data datatable debt');
    }

    public function delete(Request $request)
    { //used
        $validatedData = $request->all();
        $storeData = EmployeeDebt::where('uuid', $validatedData['uuid'])->delete();
        return ResponseFormatter::toJson($storeData, 'Data Stored');
    }
}
