<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\DatabaseData;
use App\Models\Employee\EmployeeOut;
use Carbon\Carbon;

use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeDocument;
use App\Models\Safety\AtributSize;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Yajra\DataTables\Facades\DataTables;

class EmployeeOutController extends Controller
{

    public function index()
    {
        $employees = Employee::data_employee();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-out'
        ];



        $Q_data = EmployeeOut::orderBy('date_out', 'ASC')->get();
        $Q_data_database_data = DatabaseData::where('code_table_data', 'KARYAWAN')->where('code_field_data', 'NRP')->whereNull('date_end',)->get();

        $A_database_data = [];
        foreach ($Q_data_database_data as $I_data_database_data) {
            $A_database_data[$I_data_database_data->code_data] = $I_data_database_data;
        }


        // return $Q_data_database_data;

        foreach ($Q_data as $data_emp) {
            
            if (!empty($A_database_data[$data_emp->employee_uuid])) {

                //TBK
                // $data_database_store_out = [
                //     "code_table_data" => "PHK-KARYAWAN",
                //     "code_field_data" => "TANGGAL-BERAKHIR-KONTRAK--TBK-",
                //     "value_data" => $data_emp->date_out,
                //     "code_data" => $data_emp->employee_uuid,
                //     "uuid_data" => $A_database_data[$data_emp->employee_uuid]['uuid_data'],
                //     "date_start" => $A_database_data[$data_emp->employee_uuid]['date_start'],
                //     "date_end" => $A_database_data[$data_emp->employee_uuid]['date_end'],
                // ];

                // $Q_store_karyawan = DatabaseData::updateOrCreate(
                //     [
                //         "code_data" => $data_emp->employee_uuid,
                //         "uuid_data" => $A_database_data[$data_emp->employee_uuid]['uuid_data'],
                //         "code_table_data" => $data_database_store_out['code_table_data'],
                //         "code_field_data" => $data_database_store_out['code_field_data'],
                //     ],
                //     $data_database_store_out
                // );


                // //jenis phk
                // $data_database_store_out['code_field_data'] = "JENIS-PHK";
                // $data_database_store_out['value_data'] = "PHK";

                // $Q_store_karyawan = DatabaseData::updateOrCreate(
                //     [
                //         "code_data" => $data_emp->employee_uuid,
                //         "uuid_data" => $A_database_data[$data_emp->employee_uuid]['uuid_data'],
                //         "code_table_data" => $data_database_store_out['code_table_data'],
                //         "code_field_data" => $data_database_store_out['code_field_data'],
                //     ],
                //     $data_database_store_out
                // );

                // //nrp
                // $data_database_store_out['code_field_data'] = "NRP";
                // $data_database_store_out['value_data'] = $data_emp->employee_uuid;

                // $Q_store_karyawan = DatabaseData::updateOrCreate(
                //     [
                //         "code_data" => $data_emp->employee_uuid,
                //         "uuid_data" => $A_database_data[$data_emp->employee_uuid]['uuid_data'],
                //         "code_table_data" => $data_database_store_out['code_table_data'],
                //         "code_field_data" => $data_database_store_out['code_field_data'],
                //     ],
                //     $data_database_store_out
                // );


                // $data_database_store_out['code_table_data'] = 'KARYAWAN';
                // $data_database_store_out['code_field_data'] = 'STATUS-KERJA';                
                // $data_database_store_out['value_data'] = 'PHK';

                // $Q_store_karyawan = DatabaseData::updateOrCreate(
                //     [
                //         "code_data" => $data_emp->employee_uuid,
                //         "uuid_data" => $A_database_data[$data_emp->employee_uuid]['uuid_data'],
                //         "code_table_data" => $data_database_store_out['code_table_data'],
                //         "code_field_data" => $data_database_store_out['code_field_data'],
                //     ],
                //     $data_database_store_out
                // );

            }


            // $data_database_store_out = [
            //     "code_table_data" => "PHK-KARYAWAN",
            //     "code_field_data" => "TANGGAL-BERAKHIR-KONTRAK--TBK-",
            //     "value_data" => $data_emp->date_out,
            //     "code_data" => $data_emp->employee_uuid,
            //     "uuid_data" => $A_database_data[$data_emp->employee_uuid]['uuid_data'],
            //     "date_start" => $A_database_data[$data_emp->employee_uuid]['date_start'],
            //     "date_end" => $A_database_data[$data_emp->employee_uuid]['date_end'],
            // ];

            $Q_data_database_data = DatabaseData::where('code_table_data', 'KARYAWAN')->where('code_field_data', 'JABATAN')->whereNull('date_end',)->get();

            // return $Q_data_database_data;
            // foreach($Q_data_database_data as $I_data_database_data){
            //     $Q_store_karyawan = DatabaseData::updateOrCreate(
            //         [
            //             "code_data" => $data_emp->employee_uuid,
            //             "uuid_data" => $A_database_data[$data_emp->employee_uuid]['uuid_data'],
            //             "code_table_data" => $data_database_store_out['code_table_data'],
            //             "code_field_data" => $data_database_store_out['code_field_data'],
            //         ],
            //         $data_database_store_out
            //     );
            // }


        }

        // return $Q_data;
        return view('employee.out.index', [
            'title'         => 'Karyawan Keluar',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'employees' => $employees,
            'nik_employee' => ''
        ]);
    }

    public function import(Request $request)
    {
        // return 'aaa';
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $data_databases = session('data_database');
        $data_employees = $data_databases['data_employees'];
        $out_status = $data_databases['data_atribut_sizes']['status_out'];

        $Q_data = EmployeeOut::orderBy('date_out', 'ASC')->get();
        $Q_data_database_data = DatabaseData::where('code_table_data', 'KARYAWAN')->where('code_field_data', 'NRP')->whereNull('date_end',)->get();

        $A_database_data = [];
        foreach ($Q_data_database_data as $I_data_database_data) {
            $A_database_data[$I_data_database_data->code_data] = $I_data_database_data;
        }
        

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet       = $spreadsheet->getActiveSheet();

            $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

            $no_employee = 6;
            $employees = [];
            $all_data_row_employee_out = [];
            while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                $date_row = 3;
                $employee_uuid = ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue());
                $date = ResponseFormatter::excelToDate($sheet->getCell('F' . $no_employee)->getValue());
                $out_status_uuid = ResponseFormatter::toUUID($sheet->getCell('E' . $no_employee)->getValue());

                if (empty($out_status_uuid)) {
                    $out_status_uuid = 'PHK';
                }

                if (empty($out_status[$out_status_uuid])) {
                    $store_atribut_size = AtributSize::updateOrCreate(
                        ['uuid' => $out_status_uuid],
                        [
                            'uuid' => $out_status_uuid,
                            'name_atribut' => $sheet->getCell('E' . $no_employee)->getValue(),
                            'size' => 'status_out',
                            'value' => $out_status_uuid,
                        ]
                    );
                    if ($store_atribut_size) {
                        $out_status[$out_status_uuid] = $store_atribut_size;
                    }
                }

                $row_data = [
                    'employee_uuid' => ResponseFormatter::toUUID($sheet->getCell('B' . $no_employee)->getValue()),
                    'out_status' => $out_status_uuid,
                    'date_out' => $date,
                    'uuid' => $employee_uuid,
                ];

                $all_data_row_employee_out[] = $row_data;
                $arr_date = explode('-', $date);
                $endDateThisMonth = ResponseFormatter::getEndDay($arr_date[0] . '-' . $arr_date[1]);

                $startDate = new \DateTime($date);
                $endDate = new \DateTime($arr_date[0] . '-' . $arr_date[1] . '-' . $endDateThisMonth);

                $all_row_data_absen = [];
                $machine_id = $employee_uuid;

                $delete_absen = EmployeeAbsen::where('employee_uuid', $machine_id)
                    ->where('date', '>', $startDate->format('Y-m-d'))
                    ->where('date', '<=', $endDate->format('Y-m-d'))
                    ->delete();
                for ($date =  $endDate; $date > $startDate; $date->modify('-1 day')) {
                    $row_data_absen = [];
                    $row_data_absen['employee_uuid'] = $machine_id;
                    $row_data_absen['status_absen_uuid']  = 'X';
                    $row_data_absen['date'] = $date->format('Y-m-d');
                    $row_data_absen['uuid']  = $row_data_absen['date'] . '-' . $row_data_absen['employee_uuid'];

                    $all_row_data_absen[] = $row_data_absen;
                }
                $insertAbsen = EmployeeAbsen::insert(
                    $all_row_data_absen
                );


                if (!empty($A_database_data[$row_data['employee_uuid']])) {

                    //TBK
                    $data_database_store_out = [
                        "code_table_data" => "PHK-KARYAWAN",
                        "code_field_data" => "TANGGAL-BERAKHIR-KONTRAK--TBK-",
                        "value_data" => $row_data['date_out'],
                        "code_data" => $row_data['employee_uuid'],
                        "uuid_data" => $A_database_data[$row_data['employee_uuid']]['uuid_data'],
                        "date_start" => $A_database_data[$row_data['employee_uuid']]['date_start'],
                        "date_end" => $A_database_data[$row_data['employee_uuid']]['date_end'],
                    ];
    
                    $Q_store_karyawan = DatabaseData::updateOrCreate(
                        [
                            "code_data" => $row_data['employee_uuid'],
                            "uuid_data" => $A_database_data[$row_data['employee_uuid']]['uuid_data'],
                            "code_table_data" => $data_database_store_out['code_table_data'],
                            "code_field_data" => $data_database_store_out['code_field_data'],
                        ],
                        $data_database_store_out
                    );
    
    
                    //jenis phk
                    $data_database_store_out['code_field_data'] = "JENIS-PHK";
                    $data_database_store_out['value_data'] = "PHK";
    
                    $Q_store_karyawan = DatabaseData::updateOrCreate(
                        [
                            "code_data" => $row_data['employee_uuid'],
                            "uuid_data" => $A_database_data[$row_data['employee_uuid']]['uuid_data'],
                            "code_table_data" => $data_database_store_out['code_table_data'],
                            "code_field_data" => $data_database_store_out['code_field_data'],
                        ],
                        $data_database_store_out
                    );
    
                    //nrp
                    $data_database_store_out['code_field_data'] = "NRP";
                    $data_database_store_out['value_data'] = $row_data['employee_uuid'];
    
                    $Q_store_karyawan = DatabaseData::updateOrCreate(
                        [
                            "code_data" => $row_data['employee_uuid'],
                            "uuid_data" => $A_database_data[$row_data['employee_uuid']]['uuid_data'],
                            "code_table_data" => $data_database_store_out['code_table_data'],
                            "code_field_data" => $data_database_store_out['code_field_data'],
                        ],
                        $data_database_store_out
                    );
    
    
                    $data_database_store_out['code_table_data'] = 'KARYAWAN';
                    $data_database_store_out['code_field_data'] = 'STATUS-KERJA';                
                    $data_database_store_out['value_data'] = 'PHK';
    
                    $Q_store_karyawan = DatabaseData::updateOrCreate(
                        [
                            "code_data" => $row_data['employee_uuid'],
                            "uuid_data" => $A_database_data[$row_data['employee_uuid']]['uuid_data'],
                            "code_table_data" => $data_database_store_out['code_table_data'],
                            "code_field_data" => $data_database_store_out['code_field_data'],
                        ],
                        $data_database_store_out
                    );
    
                }
                $no_employee++;
            }
            $insertAbsen = EmployeeOut::insert(
                $all_data_row_employee_out
            );
        } catch (Exception $e) {
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $employee_uuid = $request->employee_uuid;
        $validatedData = $request->all();
        $data_employees = session('data_database')['data_employees'][$validatedData['employee_uuid']];


        $employee_out = [
            'employee_uuid' => $employee_uuid,
            'date_out'  => $request->date_out,
            'date_start'  => $request->date_out,
            'out_status'    => $request->out_status,
        ];
        $arr_date_out = explode('-', $request->date_out);
        $store = EmployeeOut::updateOrCreate(['uuid' => $employee_uuid], $employee_out);


        $store = Employee::updateOrCreate(['uuid' => $employee_uuid, 'date_end' => null], ['employee_status' => 'out']);
        $endDateThisMonth = ResponseFormatter::getEndDay($arr_date_out[0] . '-' . $arr_date_out[1]);



        if ($request->file('document_out')) {
            $document_name =   $employee_uuid . '-' . mt_rand(5, 99985) . '.' . $request->document_out->getClientOriginalExtension();
            $name = 'file/karyawan_keluar/' . $document_name;

            $isMoved = $request->document_out->move('file/karyawan_keluar/', $name);

            $store_employee_document = EmployeeDocument::updateOrCreate(['uuid' => 'EMPLOYEE-OUT-' . $employee_uuid], [
                'employee_uuid' => $employee_uuid,
                'document_path' => $document_name,
                'document_table_name'   => 'employee_outs'
            ]);
        }
        $startDate = new \DateTime($request->date_out);
        $endDate = new \DateTime($arr_date_out[0] . '-' . $arr_date_out[1] . '-' . $endDateThisMonth);
        $validatedData['status_absen_uuid']  = 'X';
        $validatedData['employee_uuid'] = $employee_uuid;
        $ddd = [];
        for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
            $validatedData['date'] = $date->format('Y-m-d');
            $validatedData['uuid']  = $validatedData['date'] . '-' . $validatedData['employee_uuid'];
            $store = EmployeeAbsen::updateOrCreate([
                'employee_uuid' => $validatedData['employee_uuid'],
                'date' => $validatedData['date'],
            ], $validatedData);
            $ddd[] = $store;
        }


        return ResponseFormatter::toJson($ddd, 'no file data request');
    }

    public function dataOut(Request $request)
    {
        $date = explode("-", $request->year_month);
        $year = $date[0];
        $month = $date[1];

        $employee_outs = EmployeeOut::join('employees', 'employees.uuid', 'employee_outs.employee_uuid')
            ->leftJoin('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->leftJoin('positions', 'positions.uuid', 'employees.position_uuid')
            ->whereYear('date_out', $year)
            ->whereMonth('date_out', $month)
            ->get([
                'user_details.photo_path',
                'employees.nik_employee',
                'positions.position',
                'user_details.name',
                'employee_outs.*'
            ]);

        $employee_outs = $employee_outs->keyBy(function ($item) {
            return strval($item->uuid);
        });


        foreach ($employee_outs as $emp_out) {
            $emp_out->document_path = null;
        }

        $employee_documents = EmployeeDocument::join('employee_outs', 'employee_outs.employee_uuid', 'employee_documents.employee_uuid')
            ->where('document_table_name', 'employee_outs')
            ->whereYear('employee_outs.date_out', $year)
            ->whereMonth('employee_outs.date_out', $month)
            ->get();

        foreach ($employee_documents as $item) {
            $employee_outs[$item->employee_uuid]->document_path = $item->document_path;
        }




        return DataTables::of($employee_outs)
            ->make(true);



        // return ResponseFormatter::toJson($employee_outs, 'bbb');
    }

    public function export()
    {
        $row = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Import Data Karyawan keluar');
        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');
        $createSheet->setCellValue('E5', 'Keterangan');
        $createSheet->setCellValue('F5', 'Tanggal');


        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/karyawan_keluar/Template Karyawan Keluar -' . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return response()->download($name);
    }

    public function delete(Request $request)
    {
        $store = EmployeeOut::where('uuid', $request->uuid)->delete();
        return ResponseFormatter::toJson($store, 'Data Privilege');
    }
}
