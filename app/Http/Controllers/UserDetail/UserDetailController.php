<?php

namespace App\Http\Controllers\UserDetail;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeePremi;
use App\Models\Employee\EmployeeTotalHmMonth;
use App\Models\HourMeterPrice;
use App\Models\Poh;
use App\Models\Position;
use App\Models\Premi;
use App\Models\Religion;
use App\Models\Roaster;
use App\Models\TaxStatus;
use App\Models\UserDetail\UserAddress;
use App\Models\UserDetail\UserDetail;
use App\Models\UserDetail\UserReligion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;
use Yajra\Datatables\Datatables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\Storage;

class UserDetailController extends Controller
{

    public function store(Request $request){
        $validateData = $request->all();
        $data = session('recruitment-user');

        if ($validateData['uuid'] == null) {
            $validateData['uuid'] = ResponseFormatter::toUUID($validateData['nik_number']);
        }
        if ($validateData['date_start'] == null) {
            $validateData['date_start'] =  ResponseFormatter::getDateToday();
        }
        if(empty($validateData['nik_employee'])){
            $validateData['nik_employee'] = $validateData['uuid'];
        }
        if(empty($validateData['employee_status'])){
            $validateData['employee_status'] = 'Training';

        }

        $storeUserDetail = UserDetail::updateOrCreate(['uuid' => $validateData['uuid']], $validateData);
        $storeUserDetail = Employee::updateOrCreate(['uuid' => $validateData['uuid']], $validateData);
        $storeUserReligion = UserReligion::updateOrCreate(['uuid' => $validateData['uuid']], [
            'user_detail_uuid' => $validateData['uuid'],
            'religion_uuid' => $request->religion_uuid,
        ]);

        $data_store = Employee::showWhereNik_employee($validateData['uuid']);
        $data['detail'] = $data_store;
        session()->put('recruitment-user', $data);
        ResponseFormatter::setAllSession();
        return ResponseFormatter::toJson($data, 'store from user-detail');
    }


    public function myRecruitmentProfile()
    {
        return redirect()->to('/recruitment/up');
        if (empty(session('recruitment-profile'))) {
          
            return redirect()->to('/recruitment/up');
            return 'empty';
        } else {
            return 'have profile';
        }
        return 'me';
    }

    public function showRecruitment()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'user-detail'
        ];

        return view('user_detail.create', [
            'title'         => 'Identitas',
            'layout'    => $layout,
        ]);
    }


    public function login()
    {
        return view('authentication.login', [
            'title'         => 'Login'
        ]);
    }



    public function exportData()
    {
        $datas = Employee::leftJoin('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
            ->leftJoin('positions', 'positions.uuid', 'employees.position_uuid')
            ->leftJoin('employee_salaries', 'employee_salaries.employee_uuid', 'employees.uuid')
            ->get([
                'employee_salaries.*',
                'employees.uuid as employee_uuid',
                'user_details.name'
            ]);

        $data = $datas->keyBy(function ($item) {
            return strval($item->employee_uuid);
        });
        // dd($data);
        $premis = Premi::all();

        foreach ($premis as $premi) {
            $employee_premis = EmployeePremi::where('premi_uuid', $premi->uuid)
                ->get();
            $name_premi = $premi->uuid;
            foreach ($employee_premis as $emp_premi) {
                $data[$emp_premi->employee_uuid]->$name_premi = $emp_premi->premi_value;
            }
        }

        return view('datatableshow', ['data'         => $datas]);
        return 'exportData';
    }


    public function create()
    {
        /*
            access create
            perbedaan role
            edit->show-employee,
            tambah 
        */

        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'user-detail',
        ];

        $data = [
            'user-role'   => 'new-talent',
            'detail'    => [
                'nik_employee'  =>null,
                'user_detail_uuid'  =>null,
                'nik_number'    => null,
                'kk_number'     => null,
                'status_employee'     => 'talent',
                'date_start'    => ResponseFormatter::getDateToday()
            ],
        ];

        if(session('recruitment-user') == null){
            session()->put('recruitment-user', $data);
        }

        return view('user_detail.create', [
            'title'         => 'Karyawan',
            'layout'    => $layout
        ]);
    }


    public function closeSession(){
        session()->forget('recruitment-user');
        return redirect('/user');
    }

    public function export()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index',
        ];

        $religions = Religion::all();
        $pohs = Poh::all();

        $column_table_employees = DB::getSchemaBuilder()->getColumnListing('employees');
        $column_table_user_details = DB::getSchemaBuilder()->getColumnListing('user_details');
        $data = UserDetail::leftJoin('employees', 'employees.user_detail_uuid', 'user_details.uuid')
            // ->leftJoin()
            ->get([
                'user_details.*',
                'user_details.uuid as user_detail_uuid',
                'employees.*',
                'employees.uuid as employee_uuid'
            ]);
        $data = [
            'tables' => [
                'employees',
                'user_details'
            ],
            'column_tables' => [
                'employees' => $column_table_employees,
                'user_details' => $column_table_user_details
            ],
            'data'  => $data
        ];

        return view('employee.hr.export', [
            'title'         => 'Tambah Karyawan',
            'religions' => $religions,
            'pohs' => $pohs,
            'data'  => $data,
            'layout'    => $layout
        ]);
    }

    public function show($nik_employee)
    {
        $data = Employee::showWhereNik_employee($nik_employee);
        return ResponseFormatter::toJson($data, 'store one');
    }

    public function anyDataOne($uuid)
    {
        $data = UserDetail::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_detail');
    }

    public function anyDataDetailOne($uuid)
    {
        $data = Employee::noGet_employeeAll_detail()->where('user_details.uuid', $uuid)->get()->first();

        return ResponseFormatter::toJson($data, 'data user_detail');
    }

    public function exportAction(Request $request)
    {
        $requests = $request->all();
        $arr_column = [];
        // dd($requests);
        $arr_only_null = [];
        $arr_all = [];
        $arr_all_name = [];
        $arr_only_be = [];
        $arr_off = [];
        foreach ($requests as $req => $val) {
            // dd($val);
            $arr_column[] = $req;
            $arr_index = explode('-', $req);
            if ($val == 'only-null') {
                $arr_only_null[] = $arr_index[0] . '.' . $arr_index[1];
            }
            if ($val == 'off') {
                $arr_off[] = $arr_index[0] . '.' . $arr_index[1];
            }
            if ($val == 'all') {
                $arr_all[] = $arr_index[0] . '.' . $arr_index[1];
                $arr_all_name[] = $arr_index[1];
            }
            if ($val == 'only-be') {
                $arr_all[] = $arr_index[0] . '.' . $arr_index[1];
                $arr_all_name[] = $arr_index[1];
                $arr_only_be[] = $arr_index[0] . '.' . $arr_index[1];
            }
        }

        $columns = [
            'arr_only_null' => $arr_only_null,
            'off'   => $arr_off,
            'all'   =>  $arr_all,
            'only_be'   => $arr_only_be
        ];
        // dd($columns);

        $column_table_employees = DB::getSchemaBuilder()->getColumnListing('employees');
        $column_table_user_details = DB::getSchemaBuilder()->getColumnListing('user_details');
        $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR'];

        $empty_null = UserDetail::leftJoin('employees', 'employees.user_detail_uuid', 'user_details.uuid');

        foreach ($arr_only_null as $arr) {
            $empty_null = $empty_null->whereNull($arr);
        }

        foreach ($arr_only_be as $arr) {
            $empty_null = $empty_null->whereNotNull($arr);
        }

        $data_employee = $empty_null->get($arr_all);

        $data = [
            'tables' => [
                'employees',
                'user_details'
            ],
            'column_tables' => [
                'employees' => $column_table_employees,
                'user_details' => $column_table_user_details
            ],
            'data'  => $data_employee
        ];


        // ======================================                                   EXTRACT TO EXCELL
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        // -----------------------------------------------------------------------nama column
        $row = 0;
        foreach ($arr_all_name as $column_header) {
            $createSheet->setCellValue($abjads[$row] . '4', $column_header);
            $row++;
        }

        $column = 5;
        foreach ($data_employee as $d) {
            $row = 0;
            foreach ($arr_all_name as $column_header) {
                $createSheet->setCellValue($abjads[$row] . $column, $d->$column_header);
                $row++;
            }
            $column++;
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/extrack-karyawan-' . rand(99, 9999) . '-file.xlsx';
        $crateWriter->save($name);

        return response()->download($name);
    }


    public function monitoring()
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'user-monitoring',
        ];
        return view('employee.monitoring.index', [
            'title'         => 'Employee',
            'layout'    => $layout
        ]);
    }

    //validate nik and kk
    public function createUp($nik_employee = null, $is_edit = null)
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index',
        ];

        return view('user_detail.up', [
            'title'         => 'Validasi',
            'layout'    => $layout
        ]);
    }

    public function storeUp(Request $request)
    {
        $validateData = $request->all();

        $data_user = UserDetail::whereNull('date_end')
            ->where('nik_number', $validateData['nik_number'])->get()->first();

        $is_employee = UserDetail::join('employees', 'employees.user_detail_uuid', 'user_details.uuid')
        ->where('user_details.nik_number', $validateData['nik_number'])
        ->where('employees.employee_status','!=', 'talent')
        ->first();

        if($is_employee){
            $data = [
                'user-role'=> 'employee'
            ];
            return ResponseFormatter::toJson($data, 'Ini Adalah Karyawan');
        }

        // return ResponseFormatter::toJson($data, 'data recrutment have data user detail');
        /*
        user-role
        1. new-talent, !data
        2. old-talent, data

        new talent store => goto empty profile.
        old-talent store => have data profile

        to 
        1. show profile
        */



        if (empty($data_user)) {
            $data = [
                'is_employee'   => null,
                'nik_number'    => $validateData['nik_number'],
                'kk_number'     => $validateData['kk_number']
            ];
            session()->put('recruitment-user-detail', $data);

            $data = [
                'user-role'   => 'new-talent',
                'detail'    => [
                    'nik_employee'  =>$validateData['nik_number'],
                    'user_detail_uuid'  =>$validateData['nik_number'],
                    'nik_number'    => $validateData['nik_number'],
                    'kk_number'     => $validateData['kk_number'],
                    'employee_status'     => 'talent',
                    'date_start'    => ResponseFormatter::getDateToday()
                ],
            ];

            UserDetail::updateOrCreate(['uuid'=> $data['detail']['nik_employee']], $data['detail']);
            Employee::updateOrCreate(['uuid'=> $data['detail']['nik_employee']], $data['detail']);
            $data_emp = Employee::showWhereNik_employee($validateData['nik_number']);
            if(empty($data_emp->nik_employee)){
                $data['user-role'] = 'new-talent';
            }
            $data['detail'] = $data_emp;

            session()->put('recruitment-user', $data);
            return ResponseFormatter::toJson($data, 'data store up');
        }else{
            $data_emp = Employee::showWhereNik_employee($validateData['nik_number']);
            if(empty($data_emp->nik_employee)){
                $data['user-role'] = 'new-talent';
            }
            $data['detail'] = $data_emp;
            session()->put('recruitment-user', $data);
            return ResponseFormatter::toJson($data, 'data recrutment have data');
        }
    }



    public function createRecruitment($nik_employee = null, $is_edit = null)
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index',
        ];
        if ($is_edit != null) {
            $is_edit = true;
        }

        $religions = Religion::all();
        $pohs = Poh::all();
        $companies = Company::all();
        $departments = Department::all();
        $positions = Position::all();
        $roasters = Roaster::all();
        $tax_statuses = TaxStatus::all();
        $hour_meter_prices = HourMeterPrice::all();
        $premis = Premi::all();


        return view('user_detail.create', [
            'title'         => 'Tambah Karyawan',
            'religions' => $religions,
            'pohs' => $pohs,
            'companies' => $companies,
            'departments' => $departments,
            'is_edit'  => $is_edit,
            'positions' => $positions,
            'tax_statuses' => $tax_statuses,
            'roasters' => $roasters,
            'hour_meter_prices' => $hour_meter_prices,
            'nik_employee' => $nik_employee,

            'premis' => $premis,
            'data'  => null,
            'layout'    => $layout
        ]);
    }
}
