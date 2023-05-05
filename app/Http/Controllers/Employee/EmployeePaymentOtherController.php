<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeePaymentOther;
use App\Models\PaymentOther;
use App\Models\Safety\AtributSize;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class EmployeePaymentOtherController extends Controller
{
    public function index()
    { //used
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-other-payment'
        ];
        return view('employee_payment_other.index', [
            'title'         => 'Pembayaran Lainnya',
            'layout'    => $layout,
        ]);
    }

    public function show(Request $request)
    {
        $data = EmployeePaymentOther::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Showed');
    }

    public function delete(Request $request)
    { //used
        $store = EmployeePaymentOther::where('uuid', $request->uuid)->delete();

        return ResponseFormatter::toJson($store, 'Data deleted');
    }

    public function import(Request $request)
    { //used
        // return 'import';
        $the_file = $request->file('uploaded_file');
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

            $no_employee = 6;
            $employees = [];
            $arr_payment_other = [];
            $arr_data_employee_payment = [];

            $arr_data = [];
            $all_row_data = [];

            $arr_data_payment_other = [];
            $all_row_data_payment_other = [];

            
            $month_hm =  $sheet->getCell('C3')->getValue();
            $year_hm = $sheet->getCell('C4')->getValue();

            $arr_data_employee_hour_meter_day = EmployeePaymentOther::whereYear('payment_other_date', $year_hm)
            ->whereMonth('payment_other_date', $month_hm)
            // ->where('employee_hour_meter_days.employee_uuid', 'MBLE-0422003')
            ->delete();

            while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                $date = ResponseFormatter::excelToDate($excelDate = $sheet->getCell('F' . $no_employee)->getValue());
                // dd($date);
                $payment_other = $sheet->getCell('H' . $no_employee)->getValue();
                $payment_other_uuid = ResponseFormatter::toUUID($payment_other);
                $employee_uuid = ResponseFormatter::toUUID($sheet->getCell('C' . $no_employee)->getValue());
                $arr_payment_other[] = $payment_other_uuid;

                $arr_data_payment_other = [
                    'uuid' => $payment_other_uuid,
                    'name_atribut' => $payment_other,
                    'size' => 'payment_other_uuid',
                    'value_atribut' => 'value',
                ];
                AtributSize::updateOrCreate(['uuid'=>$arr_data_payment_other['uuid']],$arr_data_payment_other);

                $all_row_data_payment_other[] = $arr_data_payment_other;

                $arr_data = [
                    'uuid' => $employee_uuid . '-' . $arr_data_payment_other['uuid'] . '-' . ResponseFormatter::toUUID($sheet->getCell('K' . $no_employee)->getValue()),
                    'employee_uuid' => $employee_uuid,
                    'payment_other_uuid' => $arr_data_payment_other['uuid'],
                    'payment_other_description' => $sheet->getCell('K' . $no_employee)->getValue(),
                    'payment_other_value' => ResponseFormatter::toNumber($sheet->getCell('I' . $no_employee)->getValue()),
                    'payment_other_much' => $sheet->getCell('G' . $no_employee)->getValue(),
                    'payment_other_total' => ResponseFormatter::isFormulaExcell($sheet->getCell('J' . $no_employee)->getOldCalculatedValue(), $sheet->getCell('J' . $no_employee)->getValue()),
                    'payment_other_date' => $date,
                ];
                $all_row_data[] = $arr_data;
                $no_employee++;
            }
            $xy =EmployeePaymentOther::insert(
                $all_row_data                
            );
            return back();

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function anyDataMonth(Request $request)
    { //used

        $validateData = $request->all();
        $data_database = session('data_database');
        $data_employees = $data_database['data_employees'];

        if (empty($validateData['filter']['arr_filter'])) {
            $validateData['filter']['arr_filter'] = $validateData['filter']['value_checkbox'];
        } else {
            if (empty($validateData['filter']['arr_filter']['company'])) {
                $validateData['filter']['arr_filter']['company'] = $validateData['filter']['value_checkbox']['company'];
            }
            if (empty($validateData['filter']['arr_filter']['site_uuid'])) {
                $validateData['filter']['arr_filter']['site_uuid'] = $validateData['filter']['value_checkbox']['site_uuid'];
            }
        }

        $datax = EmployeePaymentOther::join('employees', 'employees.nik_employee', 'employee_payment_others.employee_uuid')
            ->join('atribut_sizes', 'atribut_sizes.uuid', 'employee_payment_others.payment_other_uuid')
            ->where('employee_payment_others.payment_other_date', '>=', $validateData['filter']['date_filter']['date_start_filter_range'])
            ->where('employee_payment_others.payment_other_date', '<=', $validateData['filter']['date_filter']['date_end_filter_range'])
            ->get([
                'employees.site_uuid',
                'employees.company_uuid',
                'atribut_sizes.name_atribut',
                'employee_payment_others.*',
            ]);
        foreach ($validateData['filter']['arr_filter']['company'] as $item_company) {
            foreach ($validateData['filter']['arr_filter']['site_uuid'] as $item_site_uuid) {
                $data_table[$item_company . '-' . $item_site_uuid] = ['detail'];
            }
        }
        $datatable = [];
        foreach ($datax as $i_db) {
            if (!empty($data_table[$i_db->company_uuid . '-' . $i_db->site_uuid])) {
                $datatable[] =  $i_db;
            }
        }

        $data = [
            'request' => $validateData,
            'data' => $datax,
            'data_datatable' => $datatable,
        ];

        return ResponseFormatter::toJson($data, 'validateData');
    }

    public function export()
    { //used
        $data_databases = (session('data_database'));
        $data_employees = $data_databases['data_employees'];
        $arr_date_today = (session('year_month'));
        $year_month = $arr_date_today['year'] . '-' . $arr_date_today['month'];
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $month = (int)$month;
        $months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Pembayaran Lainnya');

        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $months[$month]);
        $createSheet->setCellValue('C4', $year);

        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'Periode');
        $createSheet->setCellValue('C5', 'NIK');
        $createSheet->setCellValue('D5', 'Nama');
        $createSheet->setCellValue('E5', 'Jabatan');
        $createSheet->setCellValue('F5', 'TANGGAL');
        $createSheet->setCellValue('G5', 'Jumlah');
        $createSheet->setCellValue('H5', 'Satuan');
        $createSheet->setCellValue('I5', 'Tarif');
        $createSheet->setCellValue('J5', 'Total (Rp.)');
        $createSheet->setCellValue('K5', 'Keterangan (Rp.)');


        $payments = EmployeePaymentOther::join('atribut_sizes', 'atribut_sizes.uuid', 'employee_payment_others.payment_other_uuid')
            ->whereYear('employee_payment_others.payment_other_date', $year)
            ->whereMonth('employee_payment_others.payment_other_date', $month)
            ->get(
                [
                    'atribut_sizes.*',
                    'employee_payment_others.*',
                ]
            );


        // dd($payments);
        $employee_row = 6;

        foreach ($payments as $payment) {

            $createSheet->setCellValue('A' . $employee_row,  $employee_row - 5);
            $createSheet->setCellValue('B' . $employee_row,  $months[$month] . '-' . $year);
            $createSheet->setCellValue('C' . $employee_row,  $payment->employee_uuid);
            $createSheet->setCellValue('D' . $employee_row,  $data_employees[$payment->employee_uuid]['name']);
            $createSheet->setCellValue('E' . $employee_row,  $data_employees[$payment->employee_uuid]['position']);
            $createSheet->setCellValue('F' . $employee_row,  $payment->payment_other_date);
            $createSheet->setCellValue('G' . $employee_row,  $payment->payment_other_much);
            $createSheet->setCellValue('H' . $employee_row,  $payment->name_atribut);
            $createSheet->setCellValue('I' . $employee_row,  $payment->payment_other_value);
            $createSheet->setCellValue('J' . $employee_row,  $payment->payment_other_total);
            $createSheet->setCellValue('K' . $employee_row,  $payment->payment_other_description);

            $employee_row++;
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/Pembayaran Lainnya-' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return response()->download($name);

        return $year_month;
    }

    public function store(Request $request)
    { //used
        $validatedData = $request->all();
        $date = $request->payment_other_date;
        $employee_uuid = $request->employee_uuid;

        if (empty($validatedData['uuid'])) {
            $validatedData['uuid'] = 'OP-' . $validatedData['payment_other_date'] . '-' . $employee_uuid;
        }

        $validatedData['payment_other_total'] = $validatedData['payment_other_much'] * $validatedData['payment_other_value'];
        $strore = EmployeePaymentOther::updateOrCreate(['uuid' =>  $validatedData['uuid']], $validatedData);

        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

    public function forDetail($year_month)
    {
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $EmployeePaymentOther = EmployeePaymentOther::join('employees', 'employees.uuid', 'employee_payment_others.employee_uuid')
            ->join('positions', 'positions.uuid', 'employees.position_uuid')
            ->join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->whereYear('employee_payment_others.payment_other_date', $year)
            ->whereMonth('employee_payment_others.payment_other_date', $month)
            ->groupBy(
                'user_details.name',
                'positions.position',
                'employees.nik_employee',
                'employee_payment_others.employee_uuid',
            )
            ->select(
                'user_details.name',
                'positions.position',
                'employees.nik_employee',
                'employee_payment_others.employee_uuid',
                DB::raw("SUM(employee_payment_others.payment_other_total) as payment_other_total")
            )
            ->get();

        $data = $EmployeePaymentOther->keyBy(function ($item) {
            return strval($item->employee_uuid);
        });


        foreach ($data  as $i) {
            $i->payment_other_description = '';
            $i->payment_other_uuid = '';
        }

        $EmployeePaymentOthers = EmployeePaymentOther::whereYear('employee_payment_others.payment_other_date', $year)
            ->whereMonth('employee_payment_others.payment_other_date', $month)
            ->get();

        foreach ($EmployeePaymentOthers as $item) {
            $data[$item->employee_uuid]->payment_other_description = $data[$item->employee_uuid]->payment_other_description . ', ' . $item->payment_other_description;
            $data[$item->employee_uuid]->payment_other_uuid = $data[$item->employee_uuid]->payment_other_uuid . ', ' . $item->payment_other_uuid;
        }
        foreach ($data  as $i) {
            $i->payment_other_description =  ltrim($i->payment_other_description, ', ');
            $i->payment_other_uuid =  ltrim($i->payment_other_uuid, ', ');
        }

        // dd($data);
        return view('datatableshow', ['data'         => $data]);

        return Datatables::of($data)
            ->make(true);
    }
}
