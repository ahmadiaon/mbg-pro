<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use Illuminate\Http\Request;
use App\Models\Religion;
use App\Models\Department;
use App\Models\Position;
use App\Models\Company;
use App\Models\Dictionary;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeCompany;
use App\Models\Employee\EmployeeCuti;
use App\Models\Employee\EmployeeCutiGroup;
use App\Models\Employee\EmployeeCutiSetup;
use App\Models\Employee\EmployeeDebt;
use App\Models\Employee\EmployeeDocument;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\Employee\EmployeeOut;
use App\Models\Employee\EmployeePayment;
use App\Models\Employee\EmployeePremi;
use App\Models\Employee\EmployeeRoaster;
use App\Models\Employee\EmployeeSalary;
use App\Models\Employee\EmployeeTonase;
use App\Models\HourMeterPrice;
use App\Models\Premi;
use App\Models\Privilege\UserPrivilege;
use App\Models\Roaster;
use App\Models\Safety\AtributSize;
use App\Models\TaxStatus;
use App\Models\User;
use App\Models\UserDetail\UserAddress;
use App\Models\UserDetail\UserDependent;
use App\Models\UserDetail\UserDetail;
use App\Models\UserDetail\UserEducation;
use App\Models\UserDetail\UserHealth;
use App\Models\UserDetail\UserLicense;
use App\Models\UserDetail\UserReligion;
use App\Models\Variable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function create()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'user-employee',
        ];

        return view('employee.create', [
            'title'         => 'Tambah Karyawan',
            'layout'    => $layout
        ]);
    }

    public function index()
    { //use
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index'
        ];
        ResponseFormatter::setAllSession();
        return view('employee.index', [
            'title'         => 'Daftar Karyawan',
            'layout'    => $layout
        ]);
    }

    public function deleteAll()
    {
        $data = Employee::where('employees.nik_employee', '!=', 'MBLE-0422003')->delete();
        $data = UserDetail::where('user_details.uuid', '!=', 'MBLE-0422003')->delete();
        $data = Department::where('departments.uuid', '!=', 'IT')->delete();
        $data = Position::where('positions.uuid', '!=', 'ETL-DEVELOPER')->delete();
        $data = EmployeeCompany::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeDebt::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeHourMeterDay::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeTonase::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeePayment::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeePremi::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeRoaster::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeSalary::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeCutiSetup::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeCuti::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = EmployeeOut::where('employee_uuid', '!=', 'MBLE-0422003')->delete();
        $data = UserAddress::where('user_detail_uuid', '!=', 'MBLE-0422003')->delete();
        $data = UserPrivilege::where('nik_employee', '!=', 'MBLE-0422003')->delete();
        $data = UserHealth::where('user_detail_uuid', '!=', 'MBLE-0422003')->delete();
        $data = UserLicense::where('user_detail_uuid', '!=', 'MBLE-0422003')->delete();
        $data = UserReligion::where('user_detail_uuid', '!=', 'MBLE-0422003')->delete();
        $data = UserEducation::where('user_detail_uuid', '!=', 'MBLE-0422003')->delete();
        $data = UserDependent::where('user_detail_uuid', '!=', 'MBLE-0422003')->delete();
        return redirect()->back();
        // dd($data);
        return view('datatableshow', ['data'         => $data]);
        return 'delete';
    }

    public function delete(Request $request)
    {
        $data_emp = Employee::whereNull('employees.date_end')->get()->first();
        $data = Employee::where('employees.nik_employee', $request->uuid)->delete();
        $data = UserDetail::where('user_details.uuid', $request->uuid)->delete();
        $data = Department::where('departments.uuid', $request->uuid)->delete();
        $data = Position::where('positions.uuid', $request->uuid)->delete();
        $data = EmployeeCompany::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeDebt::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeHourMeterDay::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeTonase::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeePayment::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeePremi::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeRoaster::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeSalary::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeOut::where('employee_uuid', $request->uuid)->delete();
        $data = UserAddress::where('user_detail_uuid', $request->uuid)->delete();
        $data = UserPrivilege::where('nik_employee', $request->uuid)->delete();
        $data = UserHealth::where('user_detail_uuid', $request->uuid)->delete();
        $data = UserLicense::where('user_detail_uuid', $request->uuid)->delete();
        $data = UserReligion::where('user_detail_uuid', $request->uuid)->delete();
        $data = UserEducation::where('user_detail_uuid', $request->uuid)->delete();
        $data = UserDependent::where('user_detail_uuid', $request->uuid)->delete();
        $data = EmployeeAbsen::where('employee_uuid', $data_emp->machine_id)->delete();
        $data = EmployeeCutiSetup::where('employee_uuid', $request->uuid)->delete();
        $data = EmployeeCuti::where('employee_uuid', $request->uuid)->delete();
        return redirect()->back();
        // dd($data);
        return view('datatableshow', ['data'         => $data]);
        return 'delete';
    }

    public function test()
    { //big use
        $data = Employee::get_employee_all();
        return view('datatableshow', ['data'         => $data]);
    }

    public function indexContract()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-contract'
        ];
        return view('employee.monitoring.index', [
            'title'         => 'Daftar Karyawan',
            'layout'    => $layout
        ]);

        // Employee::whereNull('nik_employee')->delete();

        $data = Employee::whereNull('date_end')->get();
        $date_now = Carbon::now()->subMonth();

        // return $date_now;
        $arr_start_contract = [];



        foreach ($data as $item) {

            $date = new Carbon($item->date_document_contract);
            $arr_start_contract[] = [
                'nik_employee'  => $item->nik_employee,
                'date_start_contract' =>  $date->format("Y-m-d"),
                'date_end_training' => $date->addMonths(3)->format("Y-m-d")
            ];



            if ($date_now > $date) { //masih tanggal lama

                while ($date_now > $date) {
                    $date_start_contract = $date;
                    $date->addMonths(12);
                }

                if (empty($item->employee_status)) {
                    Employee::updateOrCreate(['uuid' => $item->nik_employee], ['employee_status' => 'Profesional']);
                }
                if (empty($item->date_end_contract)) {
                    Employee::updateOrCreate(['uuid' => $item->nik_employee], ['date_end_contract' => $date->format("Y-m-d"), 'date_start_contract' => $date_start_contract->format("Y-m-d")]);
                }
            } else { // kena training
                if (empty($item->employee_status)) {
                    Employee::updateOrCreate(['uuid' => $item->nik_employee], ['employee_status' => 'Training']);
                }
                if (empty($item->date_end_contract)) {
                    Employee::updateOrCreate(['uuid' => $item->nik_employee], ['date_end_contract' => $date->format("Y-m-d"), 'date_start_contract' => $item->date_document_contract]);
                }
            }
        }

        // dd($data);
    }

    public function getEmployee($nik_employee)
    { //used
        $data = Employee::noGet_employeeAll_detail()
            ->where('employees.nik_employee', $nik_employee)
            ->whereNull('employees.date_end')
            ->whereNull('user_details.date_end')
            ->first();

        $arr_employee_premi = EmployeePremi::where('employee_uuid', $nik_employee)
            ->whereNull('date_end')
            ->get();

        foreach ($arr_employee_premi as $employee_premi) {
            $name_col = $employee_premi->premi_uuid;
            $data->$name_col =  $employee_premi->premi_value;
        }

        // dd($data);
        return ResponseFormatter::toJson($data, 'data employee');
        dd($data);
    }

    public function showEmployeeProfile($nik_employee)
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index'
        ];

        $premis = Premi::all();
        return view('employee.show', [
            'title'         => 'Detail Karyawan',
            'layout'    => $layout,
            'premis' => $premis,
            'nik_employee' => $nik_employee
        ]);
    }

    public function anyDataOne($uuid)
    {
        $data = Employee::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_employee');
    }

    public function indexResign()
    {
        // return Employee::getAll();
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => false,
            'active'                        => 'employees-index'
        ];
        return view('employee.resign.index', [
            'title'         => 'Daftar Karyawan Resign',
            'nik_employee' => '',
            'layout'    => $layout,

            'year_month'        => Carbon::today()->isoFormat('Y-M'),
        ]);
    }

    public function import(Request $request)
    {
        // return 'aaa';
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $date_now = Carbon::now()->subMonth();


        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];
            $no_row = 0;

            $dictionaries = Dictionary::all();
            $dictionaries = $dictionaries->keyBy(function ($item) {
                return strval($item->excel);
            });

            $arr_index = [];


            while ($sheet->getCell($rows[$no_row] . '2')->getValue() != null) {
                $arr_index[$dictionaries[$sheet->getCell($rows[$no_row] . '2')->getValue()]->database] = [
                    'index' => $rows[$no_row],
                    'database' => $dictionaries[$sheet->getCell($rows[$no_row] . '2')->getValue()]->database,
                    'excel' => $dictionaries[$sheet->getCell($rows[$no_row] . '2')->getValue()]->excel,
                    'data_type' => $dictionaries[$sheet->getCell($rows[$no_row] . '2')->getValue()]->data_type,
                ];
                $no_row++;
            }



            $no_employee = 3;
            $employees = [];

            $employee_data = Employee::whereNull('employees.date_end')->get();
            $employee_data = $employee_data->keyBy(function ($item) {
                return strval($item->uuid);
            });
            $arr_atribut_size = AtributSize::all();
            $arr_atribut_size = $arr_atribut_size->keyBy(function ($item) {
                return strval(ResponseFormatter::toUUID($item->name_atribut));
            });
            // dd($arr_atribut_size);

            $premis = Premi::all();
            $get_all_department = Department::all();
            $get_all_department = $get_all_department->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_position = Position::all();
            $get_all_position = $get_all_position->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_group_cuti = EmployeeCutiGroup::all();
            $get_all_group_cuti = $get_all_group_cuti->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_employee_premis = EmployeePremi::whereNull('date_end')->get();
            $get_all_employee_premis = $get_all_employee_premis->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_employee_salaries = EmployeeSalary::whereNull('date_end')->get();
            $get_all_employee_salaries = $get_all_employee_salaries->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_user_details = UserDetail::whereNull('date_end')->get();
            $get_all_user_details = $get_all_user_details->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_employee_companies = EmployeeCompany::whereNull('date_end')->get();
            $get_all_employee_companies = $get_all_employee_companies->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $month = $sheet->getCell('D1')->getValue();
            $year = $sheet->getCell('F1')->getValue();

            $this_date = $year . '-' . $month . '-' . '01';
            $date = Carbon::createFromFormat('Y-m-d', $this_date);
            $date_prev = Carbon::createFromFormat('Y-m-d', $this_date);
            $this_date_end_prev = $date_prev->subDays(1);

            while ((int)$sheet->getCell('A' . $no_employee)->getValue() != null) {
                ob_start();
                $date_row = 3;
                $nik_employee = $sheet->getCell('B' . $no_employee)->getValue();
                $nik_employee = ResponseFormatter::toUUID($nik_employee);
                echo $nik_employee . "-start</br>";
                $data_old = [];
                $employee_data_one = [];

                if (!empty($employee_data[$nik_employee])) {
                    $data_old =  $employee_data[$nik_employee]->toArray();
                }

                // dd($get_all_user_details);
                if (!empty($get_all_user_details[$nik_employee])) {
                    $data_old_user_detail = $get_all_user_details[$nik_employee]->toArray();
                    $data_old = array_merge($data_old, $data_old_user_detail);
                    // dd($data_old);                     
                }
                // dd($data_old); 
                if (!empty($get_all_employee_salaries[$nik_employee])) {
                    $data_old_employee_salary = $get_all_employee_salaries[$nik_employee]->toArray();
                    $data_old = array_merge($data_old, $data_old_employee_salary);
                }

                if (!empty($get_all_employee_companies[$nik_employee])) {
                    $data_old_employee_company = $get_all_employee_companies[$nik_employee]->toArray();
                    $data_old = array_merge($data_old, $data_old_employee_company);
                }

                if (!empty($data_old)) {
                    $employee_data_one = $data_old;
                }



                foreach ($arr_index as $item_index) {
                    if (!empty($sheet->getCell($item_index['index'] . $no_employee)->getValue())) {
                        switch ($item_index['data_type']) {
                            case 'uuid':
                                if (!empty($arr_atribut_size[ResponseFormatter::toUUID($sheet->getCell($item_index['index'] . $no_employee)->getValue())])) {
                                    $attr_value = $arr_atribut_size[ResponseFormatter::toUUID($sheet->getCell($item_index['index'] . $no_employee)->getValue())]->uuid;
                                    $employee_data_one[$item_index['database'] . '_uuid'] = $attr_value;
                                    $employee_data_one[$item_index['database']] =  $attr_value;
                                } else {
                                    $employee_data_one[$item_index['database'] . '_uuid'] = ResponseFormatter::toUUID($sheet->getCell($item_index['index'] . $no_employee)->getValue());
                                    $employee_data_one[$item_index['database']] =  ResponseFormatter::toUUID($sheet->getCell($item_index['index'] . $no_employee)->getValue());
                                    $employee_data_one[$item_index['database'] . '_with_space'] = str_replace('-', ' ', $employee_data_one[$item_index['database']]);
                                }
                                $employee_data_one[$item_index['database'] . '_with_space'] = str_replace('-', ' ', $employee_data_one[$item_index['database']]);
                                break;
                            case 'string':
                                // $employee_data_one[$item_index['database'].'_uuid'] = ResponseFormatter::toUUID($sheet->getCell( $item_index['index'].$no_employee)->getValue());
                                $employee_data_one[$item_index['database']] =  ResponseFormatter::isString($sheet->getCell($item_index['index'] . $no_employee)->getValue());
                                break;
                            case 'date':
                                $employee_data_one[$item_index['database']] = ResponseFormatter::excelToDate($sheet->getCell($item_index['index'] . $no_employee)->getValue());
                                break;
                            default:
                                $employee_data_one[$item_index['database']] = $sheet->getCell($item_index['index'] . $no_employee)->getValue();
                        }
                    }
                }
                // dd($data_old);
                // dd($employee_data_one);
                // if($employee_data_one['nik_employee'] == 'MB-PL-220824'){
                //     dd($employee_data_one);
                // }
                if (!empty($employee_data_one['department_uuid'])) {
                    if (empty($get_all_department[$employee_data_one['department_uuid']])) {
                        Department::updateOrCreate(['uuid' => $employee_data_one['department_uuid']], ['department' => $employee_data_one['department_with_space']]);
                    }
                }
                if (!empty($employee_data_one['position_uuid'])) {
                    if (empty($get_all_position[$employee_data_one['position_uuid']])) {
                        Position::updateOrCreate(['uuid' => $employee_data_one['position_uuid']], ['position' => $employee_data_one['position_with_space']]);
                    }
                }

                if (!empty($employee_data_one['group_cuti_uuid'])) {
                    if (empty($get_all_group_cuti[$employee_data_one['group_cuti_uuid']])) {
                        EmployeeCutiGroup::updateOrCreate(['uuid' => $employee_data_one['group_cuti_uuid']], ['name_group_cuti' => $employee_data_one['group_cuti_uuid_with_space']]);
                    }
                }



                if (!empty($employee_data_one['bpjs_ketenagakerjaan'])) {
                    $employee_data_one['is_bpjs_kesehatan'] = 'Ya';
                    $employee_data_one['is_bpjs_pensiun'] = 'Ya';
                } else {
                    $employee_data_one['is_bpjs_kesehatan'] = 'Tidak';
                    $employee_data_one['is_bpjs_pensiun'] = 'Tidak';
                }

                if (!empty($employee_data_one['bpjs_kesehatan'])) {
                    $employee_data_one['is_bpjs_ketenagakerjaan'] = 'Ya';
                } else {
                    $employee_data_one['is_bpjs_ketenagakerjaan'] = 'Tidak';
                }
                if (empty($employee_data_one['employee_status'])) {
                    if (!empty($employee_data_one['long_contract'])) {
                        if ($employee_data_one['long_contract'] > 3) {
                            $employee_data_one['employee_status'] = 'Profesional';
                        } else {
                            $employee_data_one['employee_status'] = 'Training';
                        }
                    } else {
                        $employee_data_one['employee_status'] = 'Profesional';
                    }
                }


                if (!empty($employee_data_one['last_education'])) {
                    $employee_data_one[$employee_data_one['last_education'] . '_name'] = 'default';
                    $employee_data_one[$employee_data_one['last_education'] . '_place'] = 'default';
                    $employee_data_one[$employee_data_one['last_education'] . '_year'] = 2000;
                }

                $employee_data_one['uuid'] = $employee_data_one['nik_employee'];
                $employee_data_one['employee_uuid'] = $employee_data_one['uuid'];
                $employee_data_one['citizenship'] = 'WNI';

                $employee_data_one['date_start'] = $employee_data_one['date_start_effective'];
                $employee_data_one['user_detail_uuid'] = $employee_data_one['nik_employee'];

                // dd($employee_data_one);
                if (!empty($employee_data_one['contract_number_full'])) {
                    $contract_number = explode('/', $employee_data_one['contract_number_full']);
                    $employee_data_one['contract_number'] = (int)$contract_number[0];
                }

                if (!empty($employee_data_one['hour_meter_prices'])) {
                    $employee_data_one['hour_meter_price_uuid'] = $employee_data_one['hour_meter_prices'];
                }

                // default if null
                // roaster
                if (empty($employee_data_one['roaster_uuid'])) {
                    $employee_data_one['roaster_uuid'] = '70';
                }

                // date_start_contract
                if (empty($employee_data_one['date_start_contract'])) {
                    $employee_data_one['date_start_contract'] = $employee_data_one['date_document_contract'];
                }

                // contract_status
                if (empty($employee_data_one['contract_status'])) {
                    $employee_data_one['contract_status'] = 'PKWT';
                }

                // site_uuid
                if (empty($employee_data_one['site_uuid'])) {
                    $employee_data_one['site_uuid'] = 'PL';
                }

                // company_uuid
                if (empty($employee_data_one['company_uuid'])) {
                    $employee_data_one['company_uuid'] = 'PL';
                }

                // machine_id
                if (empty($employee_data_one['machine_id'])) {
                    $employee_data_one['machine_id'] = $employee_data_one['nik_employee'];
                }

                // date_start_work
                if (empty($employee_data_one['date_start_work'])) {
                    $date_swcount = new Carbon($employee_data_one['date_document_contract']);
                    $date_swcount->addMonths(3);
                    $date_swcount->addDays(14);
                    $employee_data_one['date_start_work'] = $date_swcount->format("Y-m-d");
                }
                // dd($employee_data_one);
                // long_contract
                if (empty($employee_data_one['long_contract'])) {
                    $employee_data_one['long_contract'] = 12;
                }

                // group_cuti_uuid
                if (empty($employee_data_one['group_cuti_uuid'])) {
                    $employee_data_one['group_cuti_uuid'] = $employee_data_one['position_uuid'];
                    if (empty($get_all_group_cuti[$employee_data_one['group_cuti_uuid']])) {
                        EmployeeCutiGroup::updateOrCreate(['uuid' => $employee_data_one['position_uuid']], ['name_group_cuti' => $employee_data_one['position_with_space']]);
                    }
                }
                // date_end_contract
                if (empty($employee_data_one['date_end_contract'])) {
                    $date_start_contract_where_null = new Carbon($employee_data_one['date_start_contract']);
                    $date_start_contract_where_null->addMonths(3)->format("Y-m-d");

                    if ($date_now > $date_start_contract_where_null) {
                        while ($date_now > $date_start_contract_where_null) {
                            $date_start_contract_where_null->addMonths(12);
                            $employee_data_one['date_end_contract'] = $date_start_contract_where_null->format("Y-m-d");
                        }
                        $employee_data_one['employee_status'] = 'Profesional';
                        $employee_data_one['long_contract'] = '12';
                    } else {
                        $employee_data_one['employee_status'] = 'Training';
                        $employee_data_one['long_contract'] = '3';
                        $employee_data_one['date_end_contract'] = $date_start_contract_where_null->format("Y-m-d");
                    }
                }

                if (!empty($employee_data_one['date_end'])) {
                    dd($employee_data_one);
                }
                // dd($employee_data_one);
                echo $nik_employee . "-start employee</br>";
                if (!empty($employee_data_one['date_out'])) {
                    $employee_data_one['employee_status'] = 'Keluar';
                    $storeEmployee = EmployeeOut::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                }

                // dd($employee_data_one);
                if (!empty($data_old)) {
                    // dd($data_old);
                    if ($data_old['date_start'] > $employee_data_one['date_start']) {

                        if (empty($employee_data_one['date_end_effective'])) {
                            $employee_data_one['date_end'] = $data_old['date_start'];
                        } else {
                            if ($employee_data_one['date_end_effective'] < $data_old['date_start']) {
                                $employee_data_one['date_end'] = $employee_data_one['date_end_effective'];
                            } else {
                                $employee_data_one['date_end'] = $data_old['date_start'];
                            }
                        }
                        $storeEmployee = Employee::create($employee_data_one);
                        $storeEmployee = EmployeeSalary::create($employee_data_one);
                        $storeEmployee = UserDetail::create($employee_data_one);
                        $storeEmployee = UserAddress::create($employee_data_one);
                        $storeEmployee = UserEducation::create($employee_data_one);
                        $storeEmployee = UserDependent::create($employee_data_one);
                        $storeEmployee = EmployeeCutiSetup::create($employee_data_one);

                        // dd('a');
                    } elseif ($data_old['date_start'] == $employee_data_one['date_start']) {

                        $storeEmployee = Employee::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                        $storeEmployee = UserDetail::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                        $storeEmployee = EmployeeSalary::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                        $storeEmployee = UserAddress::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                        $storeEmployee = UserEducation::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                        $storeEmployee = UserDependent::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                        $storeEmployee = EmployeeCutiSetup::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], $employee_data_one);
                        // dd('b');
                    } else {

                        $storeEmployee = Employee::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);
                        $storeEmployee = EmployeeSalary::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);
                        $storeEmployee = UserDetail::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);
                        $storeEmployee = UserAddress::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);
                        $storeEmployee = UserEducation::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);
                        $storeEmployee = UserDependent::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);
                        $storeEmployee = EmployeeCutiSetup::updateOrCreate(['uuid' =>  $employee_data_one['nik_employee'], 'date_end' => null], ['date_end' => $employee_data_one['date_start']]);

                        $storeEmployee = Employee::create($employee_data_one);
                        $storeEmployee = EmployeeSalary::create($employee_data_one);
                        $storeEmployee = UserDetail::create($employee_data_one);
                        $storeEmployee = UserAddress::create($employee_data_one);
                        $storeEmployee = UserEducation::create($employee_data_one);
                        $storeEmployee = UserDependent::create($employee_data_one);
                        $storeEmployee = EmployeeCutiSetup::create($employee_data_one);
                        // dd('c');
                    }
                } else {
                    $storeEmployee = Employee::create($employee_data_one);
                    $storeEmployee = EmployeeSalary::create($employee_data_one);
                    $storeEmployee = UserDetail::create($employee_data_one);
                    $storeEmployee = UserAddress::create($employee_data_one);
                    $storeEmployee = UserEducation::create($employee_data_one);
                    $storeEmployee = UserDependent::create($employee_data_one);
                    $storeEmployee = EmployeeCutiSetup::create($employee_data_one);
                    // dd('d');
                }




                echo $nik_employee . "-start user detail</br>";

                $employee_data_one['role'] = 'employee';
                $employee_data_one['password'] = Hash::make('password');
                $storeUser = User::updateOrCreate(['uuid'    =>  $employee_data_one['uuid']], $employee_data_one);

                echo $nik_employee . "-start salary</br>";

                foreach ($premis as $premi) {

                    if (!empty($employee_data_one[$premi->uuid])) {
                        $employee_data_one['premi_value'] = $employee_data_one[$premi->uuid];
                        $employee_data_one['premi_uuid'] = $premi->uuid;
                        $employee_data_one['uuid'] = $nik_employee . '-' . $premi->uuid;
                        $premi_value = $employee_data_one[$premi->uuid];

                        if (!empty($get_all_employee_premis[$nik_employee . '-' . $premi->uuid])) {
                            $data_old_premi[$premi->uuid] = $get_all_employee_premis[$nik_employee . '-' . $premi->uuid]->toArray();
                            $employee_data_one['premi_value'] = $employee_data_one[$premi->uuid];

                            if ($data_old_premi[$premi->uuid]['date_start'] >  $employee_data_one['date_start']) {
                                if (empty($employee_data_one['date_end_effective'])) {
                                    $employee_data_one['date_end'] = $data_old_premi[$premi->uuid]['date_start'];
                                } else {
                                    $employee_data_one['date_end'] = $employee_data_one['date_end_effective'];
                                }
                                $storeEmployee = EmployeePremi::create($employee_data_one);
                            } elseif ($data_old_premi[$premi->uuid]['date_start']  == $employee_data_one['date_start']) {
                                $storeEmployee = EmployeePremi::updateOrCreate(['id'   => $data_old_premi[$premi->uuid]['id']], $employee_data_one);
                            } else {
                                $storeEmployee = EmployeePremi::updateOrCreate(['id'   => $data_old_premi[$premi->uuid]['id']], ['date_end' => $employee_data_one['date_start']]);
                                $storeEmployee = EmployeePremi::create($employee_data_one);
                            }
                        } else {
                            $storeEmployee = EmployeePremi::create($employee_data_one);
                        }
                        // dd($storeEmployee);
                    }
                    $data_old_arr = [];
                    if (!empty($get_all_employee_premis[$nik_employee . '-' . $premi->uuid])) {
                        if (empty($employee_data_one[$premi->uuid])) {
                            $employee_data_one['premi_value'] = 0;
                            $employee_data_one['premi_uuid'] = $premi->uuid;
                            $employee_data_one['uuid'] = $nik_employee . '-' . $premi->uuid;
                            $storeEmployee = EmployeePremi::updateOrCreate(['id'   => $get_all_employee_premis[$nik_employee . '-' . $premi->uuid]['id']], ['date_end' => $employee_data_one['date_start']]);
                            $storeEmployee = EmployeePremi::create($employee_data_one);
                        }
                        $data_old_arr[] = $get_all_employee_premis[$nik_employee . '-' . $premi->uuid];
                    }
                }
                // dd($data_old_arr);

                echo $nik_employee . "-end</br>";
                // dd('user detail will');
                ob_end_clean();
                $no_employee++;
            }
            ResponseFormatter::setAllSession();
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();
    }

    public function exportSimple()
    { //used
        $row = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];
        // $date = Car
        $year_month = Carbon::today()->isoFormat('Y-M');
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $variables = Dictionary::all();

        $variables = $variables->keyBy(function ($item) {
            return strval($item->database);
        });

        // dd($variables);

        // foreach($variables as $variable){
        //     Dictionary::updateOrCreate(['database'   => $variable->variable_code], ['excel'=> $variable->variable_name]);
        // }


        $arr_exports = [
            'no', //A
            'nik_employee', //B
            'name', //C           
            'machine_id', //D    
            'religion_uuid',
            'gender',
            'place_of_birth',
            'date_of_birth',
            'mother_name',
            'father_name',
            'blood_group',
            'status',
            'last_education',
            'poh_uuid',
            'rt',
            'rw',
            'desa',
            'kecamatan',
            'kabupaten',
            'provinsi',
            'position', //E
            'department', //F
            'contract_status', //G
            'employee_status', //G
            'date_document_contract', //H   
            'date_start_contract',   //I
            'long_contract', //J
            'date_end_contract',
            'tax_status',
            'financial_number',
            'financial_name',
            'bpjs_ketenagakerjaan',
            'bpjs_kesehatan',
            'nik_number',
            'kk_number',
            'phone_number',
            'npwp_number',
            'salary',
            'insentif',
            'tunjangan',
            'hour_meter_price_uuid',
            'company_uuid',
            'site_uuid',
            'roaster_uuid',
            'contract_number_full',
            'date_start_work',
            'group_cuti_uuid',
            'out_status',
            'date_out'
        ];

        $column_import = [

            'employees' => [
                'machine_id',
                'nik_employee',
                'position_uuid',
                'department_uuid',
                'company_uuid',
                'site_uuid',
                'roaster_uuid',
                'contract_number',
                'contract_number_full',
                'contract_status',
                'date_start_contract',
                'date_end_contract',
                'date_document_contract',
                'long_contract',
                'employee_status',
                'tax_status_uuid',
                'is_bpjs_kesehatan',
                'is_bpjs_ketenagakerjaan',
                'is_bpjs_pensiun',
            ],
            'user_details' => [
                'name',
                'nik_number',
                'kk_number',
                'citizenship',
                'gender',
                'place_of_birth',
                'date_of_birth',
                'religion_uuid',
                'blood_group',
                'status',
                'npwp_number',
                'financial_number',
                'financial_name',
                'bpjs_ketenagakerjaan',
                'bpjs_kesehatan',
                'phone_number',
            ]
        ];

        $data_religion = Religion::all();
        $data_database['religion_uuid']['data'] = $data_religion;
        $data_database['religion_uuid']['key'] = 'religion';

        $data_religion = AtributSize::where('size', 'gender')->get();
        $data_database['gender']['data'] = $data_religion;
        $data_database['gender']['key'] = 'name_atribut';

        $data_religion = AtributSize::where('size', 'blood_group')->get();
        $data_database['blood_group']['data'] = $data_religion;
        $data_database['blood_group']['key'] = 'name_atribut';

        $data_religion = AtributSize::where('size', 'status')->get();
        $data_database['status']['data'] = $data_religion;
        $data_database['status']['key'] = 'name_atribut';

        $data_religion = AtributSize::where('size', 'last_education')->get();
        $data_database['last_education']['data'] = $data_religion;
        $data_database['last_education']['key'] = 'name_atribut';

        $data_religion = AtributSize::where('size', 'contract_status')->get();
        $data_database['contract_status']['data'] = $data_religion;
        $data_database['contract_status']['key'] = 'name_atribut';

        $data_religion = AtributSize::where('size', 'poh_uuid')->get();
        $data_database['poh_uuid']['data'] = $data_religion;
        $data_database['poh_uuid']['key'] = 'name_atribut';

        $data_religion = Position::all();
        $data_database['position']['data'] = $data_religion;
        $data_database['position']['key'] = 'position';

        $data_religion = Department::all();
        $data_database['department']['data'] = $data_religion;
        $data_database['department']['key'] = 'department';

        $data_religion = HourMeterPrice::all();
        $data_database['hour_meter_price_uuid']['data'] = $data_religion;
        $data_database['hour_meter_price_uuid']['key'] = 'uuid';

        $data_religion = TaxStatus::all();
        $data_database['tax_status']['data'] = $data_religion;
        $data_database['tax_status']['key'] = 'tax_status_name';

        // dd($data_religion);

        // return $arr_exports;

        $premis = Premi::all();
        foreach ($premis as $premi) {
            $arr_exports[] = $premi->uuid;
        }

        // dd($variables);


        $arr_exports[] = 'date_start_effective';
        $arr_exports[] = 'date_end_effective';
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Import Data Karyawan Simpel');
        $createSheet->setCellValue('C1', 'Bulan');
        $createSheet->setCellValue('D1', $month);
        $createSheet->setCellValue('E1', 'Tahun');
        $createSheet->setCellValue('F1', $year);
        $no_col = 0;
        foreach ($arr_exports as $item_export) {
            $createSheet->setCellValue($row[$no_col] . '2', $variables[$item_export]->excel);
            if (!empty($data_database[$item_export])) {
                // dd($data_database[$item_export]);
                $column_item = 10;
                $name_column = $data_database[$item_export]['key'];
                foreach ($data_database[$item_export]['data'] as $item) {
                    $createSheet->setCellValue($row[$no_col] . $column_item, $item->$name_column);
                    $column_item++;
                }
            }
            $no_col++;
        }
        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/Template Penambahan Karyawan -' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return response()->download($name);
    }

    public function cekNikEmployee(Request $request)
    {
        $data = Employee::where('nik_employee', $request->nik_employee)->get()->first();
        return ResponseFormatter::toJson($data, 'data nik');
    }

    public function storeFile(Request $request)
    {
        $validatedData = $request->validate([
            'nik_employee_file' => '',
        ]);
        // return ResponseFormatter::toJson($validatedData, 'da');
        if ($request->file('user_file')) {
            $imageName =   $validatedData['nik_employee_file'] . '.' . $request->user_file->getClientOriginalExtension();
            $name = 'file/user/' . $imageName;
            if (file_exists($name)) {
                $name = mt_rand(5, 99985) . '-' . $imageName;
                $name = 'file/user/' . $imageName;
            }

            $isMoved = $request->user_file->move('file/user/', $name);

            if ($isMoved) {
                $validatedData['file_path'] = $imageName;
            }
            $store = Employee::updateOrCreate(['nik_employee' => $validatedData['nik_employee_file']], $validatedData);
        }


        return ResponseFormatter::toJson($validatedData, 'file store');
    }

    public function store(Request $request)
    {
        $validateData = $request->all();
        $data = session('recruitment-user');



        $user_detail_uuid = $validateData['uuid'];
        // return ResponseFormatter::toJson($user_detail_uuid, 'data store employee');
        // if(empty($validateData['uuid'])){
        $validateData['uuid'] = $validateData['nik_employee'];
        $validateData['user_detail_uuid'] = $validateData['nik_employee'];
        // }

        if (empty($validateData['date_start'])) {
            $validateData['date_start'] = $data['detail']['date_start'];
        }
        if (empty($validateData['user_detail_uuid'])) {
            $validateData['user_detail_uuid'] = $validateData['uuid'];
        }

        $validateData['uuid'] = $validateData['nik_employee'];
        $validateData['user_detail_uuid'] = $validateData['nik_employee'];

        $number_contract = explode('/', $validateData['contract_number_full']);

        $validateData['contract_number'] = $number_contract[0];
        // return ResponseFormatter::toJson($validateData, 'data store employee');

        $storeEmployee = Employee::updateOrCreate(['uuid' => $validateData['uuid']], $validateData);
        $updateUserDetail = UserDetail::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid']]);
        $updateUserReligion = UserReligion::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserHealth = UserHealth::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserEducation = UserEducation::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserDependent = UserDependent::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserAddress = UserAddress::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserAddress = UserLicense::updateOrCreate(['uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);

        $updateUserCompany = EmployeeCompany::updateOrCreate(['uuid' => $validateData['uuid']], ['date_start' => $validateData['date_start'], 'employee_uuid' => $storeEmployee->uuid, 'company_uuid' => $validateData['company_uuid']]);
        $updateUserRoaster = EmployeeRoaster::updateOrCreate(['uuid' => $validateData['uuid']], ['date_start' => $validateData['date_start'], 'employee_uuid' => $storeEmployee->uuid, 'roaster_uuid' => $validateData['roaster_uuid']]);
        $updateUserDocument = EmployeeDocument::updateOrCreate(['employee_uuid' => $user_detail_uuid], ['date_start' => $validateData['date_start'], 'employee_uuid' => $storeEmployee->uuid]);




        $validateDataUser['uuid'] = $storeEmployee->uuid;
        $validateDataUser['employee_uuid'] =   $validateData['uuid'];
        $validateDataUser['role'] = 'employee';
        $validateDataUser['nik_employee'] = $validateData['nik_employee'];;
        $validateDataUser['password'] = Hash::make('password');

        $updateUser = User::updateOrCreate(['uuid' => $validateDataUser['uuid']], $validateDataUser);
        $data_store = Employee::showWhereNik_employee($validateData['uuid']);
        $data['detail'] = $data_store;
        session()->put('recruitment-user', $data);
        $abc = [
            'validateDataUser' => $validateDataUser,
            'validateData' => $validateData,
            'updateUserDetail' => $updateUserDetail,
            'updateUserReligion' => $updateUserReligion,
            'updateUserHealth' => $updateUserHealth,
            'updateUserEducation' => $updateUserEducation,
            'updateUserDependent' => $updateUserDependent,
            'updateUserAddress' => $updateUserAddress,
            'updateUserCompany' => $updateUserCompany,

            'updateUserRoaster' => $updateUserRoaster,
            'updateUser' => $updateUser,
        ];
        ResponseFormatter::setAllSession();
        return ResponseFormatter::toJson($validateData, 'data store employee');
        return ResponseFormatter::toJson($storeEmployee, 'data store employee');
        return redirect()->intended('/user')->with('success', "Karyawan Ditambahkan");
    }

    public function show($nik_employee)
    {
        $data_employee = Employee::showWhereNik_employee($nik_employee)->toArray();
        $data = [
            'user-role'   => 'employee',
            'detail'    => $data_employee,
        ];

        session()->put('recruitment-user', $data);
        return redirect('/user/detail');
        dd($data);
    }

    public function showData(Request $request)
    {
        $data_employee = Employee::showWhereNik_employee($request->uuid)->toArray();
        $data = [
            'user-role'   => 'employee',
            'detail'    => $data_employee,
        ];
        return ResponseFormatter::toJson($data_employee, 'data employee');



        session()->put('recruitment-user', $data);
        return redirect('/user/detail');
        dd($data);
    }




    public function profile($nik_employee)
    {
        $data = Employee::noGet_employeeAll_detail()->where('employees.uuid', $nik_employee)->first();

        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-profile'
        ];
        return view('employee.show', [
            'title'         => 'Profile Karyawan',
            'data'  => $data,
            'layout'    => $layout,
        ]);
    }


    public function anyMoreData_(Request $request)
    {
        $validateData = $request->all();
        $start = ResponseFormatter::getDateToday();
        $end = ResponseFormatter::getDateToday();



        if (!empty($validateData['filter']['date_range_this_time_in_out'])) {
            $date_validateData_arr = explode(' - ', $validateData['filter']['date_range_this_time_in_out']);
            if (count($date_validateData_arr) > 1) {
                $start = ResponseFormatter::excelToDate($date_validateData_arr[0]);
                $end = ResponseFormatter::excelToDate($date_validateData_arr[1]);
            } elseif (count($date_validateData_arr) == 1) {
                $start = ResponseFormatter::excelToDate($date_validateData_arr[0]);
                $end = ResponseFormatter::excelToDate($date_validateData_arr[0]);
            }
        }
        $date_range_this_time_in_out = [
            'date_start_this_time_in_out' => $start,
            'date_end_this_time_in_out' => $end,
        ];

        $validateData['date_range_this_time_in_out'] = $date_range_this_time_in_out;

        $query = Employee::whereNull('employees.date_end')
            ->where('employee_status', '!=', 'talent');

        $query_employee_out = EmployeeOut::all();
        $data_employee_out = [];
        foreach ($query_employee_out as $employee_out) {
            $data_employee_out[$employee_out->employee_uuid] = $employee_out;
        }


        // ======= DEPARTMENT UUID
        if (!empty($validateData['filter']['department_uuid'])) {
            $query = $query->where('department_uuid', $validateData['filter']['department_uuid']);
        }
        // ======= DEPARTMENT UUID

        // ======= POSITION UUID===
        if (!empty($validateData['filter']['position_uuid'])) {
            $query = $query->where('position_uuid', $validateData['filter']['position_uuid']);
        }
        // ======= POSITION UUID

        // ======= employee_status UUID===
        if ($validateData['filter']['employee_status'] != 'off') {
            $query = $query->where('employee_status', $validateData['filter']['employee_status']);
        }
        // ======= employee_status UUID

        // ======= contract_status UUID===
        if ($validateData['filter']['contract_status'] != 'off') {
            $query = $query->where('contract_status', $validateData['filter']['contract_status']);
        }
        // ======= contract_status UUID

        $query = $query->get();

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

        $filter_company_x_site = [];
        $employee_filter_company_x_site = [];
        $employee_non_filter_company_x_site = [];
        foreach ($validateData['filter']['arr_filter']['company'] as $item_company) {
            foreach ($validateData['filter']['arr_filter']['site_uuid'] as $item_site_uuid) {
                $filter_company_x_site[$item_company . '-' . $item_site_uuid] = ['detail'];
            }
        }


        foreach ($query as $item_query) {
            if (!empty($filter_company_x_site[$item_query->company_uuid . '-' . $item_query->site_uuid])) {
                $employee_filter_company_x_site[] = $item_query;
            } else {
                $employee_non_filter_company_x_site[] = $item_query;
            }
        }

        if ($validateData['filter']['join_status'] != 'off') {
            $for_loop = $employee_filter_company_x_site;
            $employee_filter_company_x_site = [];
            foreach ($for_loop as $item_filtered_employee) {
                if ($validateData['filter']['join_status'] == '!=') {
                    if (($item_filtered_employee->date_document_contract >= $date_range_this_time_in_out['date_start_this_time_in_out']) &&  ($item_filtered_employee->date_document_contract <= $date_range_this_time_in_out['date_end_this_time_in_out'])) {
                        $employee_filter_company_x_site[$item_filtered_employee->nik_employee] = $item_filtered_employee;
                    }
                }
                if ($validateData['filter']['join_status'] == '==') {
                    if (!empty($data_employee_out[$item_filtered_employee->nik_employee])) {
                        if (($data_employee_out[$item_filtered_employee->nik_employee]['date_out'] >= $date_range_this_time_in_out['date_start_this_time_in_out']) && ($data_employee_out[$item_filtered_employee->nik_employee]['date_out'] <= $date_range_this_time_in_out['date_end_this_time_in_out'])) {
                            $employee_filter_company_x_site[$item_filtered_employee->nik_employee] = $item_filtered_employee;
                        }
                    }
                }
            }
        }

        if ($validateData['filter']['status_data'] != 'off') {
            $employee_non_filter_company_x_site = [];
            $for_loop = $employee_filter_company_x_site;
            $employee_filter_company_x_site = [];
            foreach ($for_loop as $item_filtered_employee) {
                if (!empty($data_employee_out[$item_filtered_employee->nik_employee])) {  //ada di karyawan keluar     
                    $employee_non_filter_company_x_site[] = $item_filtered_employee;
                    if (($data_employee_out[$item_filtered_employee->nik_employee]['date_out'] <= $validateData['filter']['date_range_in_out']) && ($validateData['filter']['status_data'] == '==')) { //bukan karyawan
                        $employee_filter_company_x_site[$item_filtered_employee->nik_employee] = $item_filtered_employee;
                    } elseif (($data_employee_out[$item_filtered_employee->nik_employee]['date_out'] >= $validateData['filter']['date_range_in_out']) && ($validateData['filter']['status_data'] == '!=')) { // karyawan
                        $employee_filter_company_x_site[$item_filtered_employee->nik_employee] = $item_filtered_employee;
                    }
                } elseif ($validateData['filter']['status_data'] == '!=') {
                    $employee_filter_company_x_site[$item_filtered_employee->nik_employee] = $item_filtered_employee;
                }
            }
        }

        if ($validateData['filter']['status_join'] != 'off') {

            if (!empty($validateData['filter']['date_range'])) {
                $date_validateData_arr = explode(' - ', $validateData['filter']['date_range']);
                if (count($date_validateData_arr) > 1) {
                    $start = ResponseFormatter::excelToDate($date_validateData_arr[0]);
                    $end = ResponseFormatter::excelToDate($date_validateData_arr[1]);
                } elseif (count($date_validateData_arr) == 1) {
                    $start = ResponseFormatter::excelToDate($date_validateData_arr[0]);
                    $end = ResponseFormatter::excelToDate($date_validateData_arr[0]);
                }
            }
            $date_range = [
                'date_start' => $start,
                'date_end' => $end,
            ];

            $for_loop = $employee_filter_company_x_site;
            $employee_filter_company_x_site = [];
            foreach ($for_loop as $item_filtered_employee) {
                if (count($date_validateData_arr) > 1) {

                    if (($item_filtered_employee->date_end_contract >= $start) &&  ($item_filtered_employee->date_end_contract <= $end)) {
                        // return ResponseFormatter::toJson($validateData['filter']['status_join'], $item_filtered_employee);
                        if ($validateData['filter']['status_join'] == '==') { //akan tidak luarsa dalam range ini
                            $employee_filter_company_x_site[$item_filtered_employee->nik_employee] = $item_filtered_employee;
                        }
                    }
                }
            }
        }



        $data = [
            'query' => $query,
            'employee_filter_company_x_site' => $employee_filter_company_x_site,
            'employee_non_filter_company_x_site' => $employee_non_filter_company_x_site,
            'query' => $query,
            'request' => $validateData
        ];

        return ResponseFormatter::toJson($data, 'query');
    }


    public function testUdin()
    {
        $data = Employee::data_employee_detail();
        var_dump($data);
        die;
        return view('datatableshow', ['data'         => $data]);
    }
}
