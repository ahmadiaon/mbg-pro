<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\EmployeeDeduction;
use App\Models\Safety\AtributSize;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class EmployeeDeductionController extends Controller
{
    public function index()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-deduction'
        ];
        return view('employee_deduction.index', [
            'title'         => 'Pengurang Pendapatan',
            'layout'    => $layout,
        ]);
    }
    public function store(Request $request)
    {
        $validateData = $request->all();
        if (empty($validateData['uuid'])) {
            $validateData['uuid'] = $validateData['date_employee_deduction'] . '-' . $validateData['group_deduction_uuid'] . '-' . $validateData['employee_uuid'];
        }
        $storeData = EmployeeDeduction::updateOrCreate(['uuid' =>  $validateData['uuid']], $validateData);
        return ResponseFormatter::toJson(['request' => $validateData, 'storeData' => $storeData], 'store ahmadi');
    }
    public function anyData(Request $request)
    {
        $validateData = $request->all();
        $validateData['filter']['is_combined']   = false;
        $data_database = session('data_database');
        $data_employees = $data_database['data_employees'];

        if (empty($validateData['filter']['arr_filter'])) {
            $validateData['filter']['arr_filter'] = $validateData['filter']['value_checkbox'];
        } else {
            if (empty($validateData['filter']['arr_filter']['company'])) {
                $validateData['filter']['arr_filter']['company'] = $validateData['filter']['value_checkbox']['company'];
            }
            if (empty($validateData['filter']['arr_filter']['group_deduction_uuid'])) {
                $validateData['filter']['arr_filter']['group_deduction_uuid'] = $validateData['filter']['value_checkbox']['group_deduction_uuid'];
            }
            if (empty($validateData['filter']['arr_filter']['site_uuid'])) {
                $validateData['filter']['arr_filter']['site_uuid'] = $validateData['filter']['value_checkbox']['site_uuid'];
            }
        }


        $arr_data_tonase = [];
        $data_table = [];

        $data_basic = EmployeeDeduction::join('atribut_sizes', 'atribut_sizes.uuid', 'employee_deductions.group_deduction_uuid')
            ->join('employees', 'employees.nik_employee', 'employee_deductions.employee_uuid')
            ->whereNull('employees.date_end')
            ->where('employee_deductions.date_employee_deduction', '>=', $validateData['filter']['date_filter']['date_start_filter_range'])
            ->where('employee_deductions.date_employee_deduction', '<=', $validateData['filter']['date_filter']['date_end_filter_range'])
            ->get([
                'employees.nik_employee',
                'employees.site_uuid',
                'employees.company_uuid',
                'atribut_sizes.*',
                'employee_deductions.*'
            ]);
        $data_uuid = [];
        foreach ($data_basic as $item_data_basic) {
            $data_uuid[$item_data_basic->uuid] = $item_data_basic;
        }

        $data_datatable = [];
        $datatable = [];
        if (!empty($validateData['filter']['arr_filter'])) {
            foreach ($validateData['filter']['arr_filter']['company'] as $item_company) {
                foreach ($validateData['filter']['arr_filter']['site_uuid'] as $item_site_uuid) {
                    if ($validateData['filter']['is_combined']  == 'true') {
                        $data_table[$item_company . '-' . $item_site_uuid] = ['detail'];
                    } else {
                        foreach ($validateData['filter']['arr_filter']['group_deduction_uuid'] as $item_group_deduction_uuid) {
                            $data_table[$item_company . '-' . $item_site_uuid . '-' . $item_group_deduction_uuid] = ['detail'];
                        }
                    }
                }
            }

            foreach ($data_basic as $i_db) {
                if (!empty($data_table[$i_db->company_uuid . '-' . $i_db->site_uuid . '-' . $i_db->group_deduction_uuid])) {
                    $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['data'][] = $i_db;
                    if (empty($datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['employee_uuid'])) {
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_payment'] = 0;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_payment'] = 0;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['employee_uuid'] = $i_db->employee_uuid;
                    }
                    $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_payment'] = $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_payment'] + 1;
                    $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_payment'] = $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_payment'] + $i_db->value_employee_deduction;
                }
            }

            foreach ($datatable as $i_dt) {
                if (count($i_dt) > 0) {
                    foreach ($i_dt as $index_i_dt => $value_i_dt) {
                        $data_datatable[] = $value_i_dt;
                    }
                }
            }

            $data = [
                'request'    => $validateData,
                'data_basic'  => $data_basic,
                'data_table'  => $data_table,
                'datatable' => $datatable,
                'data_datatable' => $data_datatable,
                'data_uuid' => $data_uuid
            ];

            return ResponseFormatter::toJson($data, 'anyData employee payment');
        }
    }

    public function delete(Request $request)
    { //used
        $store = EmployeeDeduction::where('uuid', $request->uuid)->delete();

        return ResponseFormatter::toJson($store, 'Data deleted');
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
        $createSheet->setCellValue('C1', 'Template Pengurang Lainnya');

        $createSheet->setCellValue('B1', 'Excel');
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);
        $createSheet->setCellValue('A5', 'No');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');
        $createSheet->setCellValue('E5', 'Tanggal');
        $createSheet->setCellValue('F5', 'Besar');
        $createSheet->setCellValue('G5', 'Jenis');
        $createSheet->setCellValue('H5', 'Keterangan');
        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/file-pengurang-lainnya-' . $year_month . '-' . rand(99, 9999) . 'file.xls';
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

                $date_deduction = ResponseFormatter::excelToDate($sheet->getCell('E' . $no_employee)->getValue());
                if (empty($date_deduction)) {
                    $date_deduction = $default_date;
                }

                $payment_other = $sheet->getCell('G' . $no_employee)->getValue();
                $payment_other_uuid = ResponseFormatter::toUUID($payment_other);


                $value_deduction = $sheet->getCell('F' . $no_employee)->getValue();
                $value_deduction = (int)$value_deduction;

                $arr_data_payment_other = [
                    'uuid' => $payment_other_uuid,
                    'name_atribut' => $payment_other,
                    'size' => 'group_deduction_uuid',
                    'value_atribut' => 'value',
                ];
                // dd($arr_data_payment_other);
                AtributSize::updateOrCreate(['uuid' => $arr_data_payment_other['uuid']], $arr_data_payment_other);

                $employee_deduction = [
                    'uuid' => $employee_uuid . '-' . $date_deduction . '-' . ResponseFormatter::toUUID($sheet->getCell('H' . $no_employee)->getValue()),
                    'employee_uuid' => $employee_uuid,
                    'date_employee_deduction' =>  $date_deduction,
                    'group_deduction_uuid' => $payment_other_uuid,
                    'value_employee_deduction' => $value_deduction,
                    'description_deduction_uuid' => $sheet->getCell('H' . $no_employee)->getValue(),
                ];
                $store_employee_deduction = EmployeeDeduction::updateOrCreate(['uuid'  => $employee_deduction['uuid']], $employee_deduction);
                $no_employee++;
                // dd($store_employee_deduction);
            }
            return back();
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }
}
