<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResponseFormatter;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebUserController;
use App\Models\Company;
use App\Models\DatabaseData;
use App\Models\DatabaseDataSource;
use App\Models\DatabaseField;
use App\Models\DatabaseTable;
use App\Models\Department;
use App\Models\Employee\Employee;
use App\Models\Identity;
use App\Models\Menu;
use App\Models\Position;
use App\Models\Privilege\UserPrivilege;
use App\Models\Support\DatabaseFieldShow;
use App\Models\Support\DatabasePersetujuan;
use App\Models\Support\UserTemplate;
use App\Models\UserDetail\UserDetail;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Else_;

class UserController extends Controller
{


    public function getUser(Request $request)
    {
        $auth_login = $request->header('auth_login');
        $user = User::where('auth_login', $auth_login)->first();
        $identity = UserDetail::where('uuid', $user->nik_employee)->whereNull('date_end')->first();


        $mergedArray = (array)$user + (array)$identity;
        $data = (object)$mergedArray;

        $data = array_merge($user->toArray(), $identity->toArray());

        return ResponseFormatter::ResponseJson($data, 'Success', 200);
    }

    public function cekAvailableEmployee(Request $request)
    {
        $dataForm = $request->all();
        $data = User::where('nik_employee', ResponseFormatter::toUUID($request->nik_employee))->first();
        if (!$request->pin && !$request->nik_number) {
            if ($data) {
                if ($data->pin) {
                    $data = "pin";
                } else {
                    $data = "ktp";
                }
            }
            return ResponseFormatter::ResponseJson($data, 'Store Success', 200);
        } else {
            //    login

            $dataUser = User::where('nik_employee', ResponseFormatter::toUUID($request->nik_employee))->first();
            $isValid = false;
            if ($dataUser) {
                if (Hash::check($request->pin, $dataUser->pin)) {
                    $isValid = true;
                }

                if (Hash::check($request->nik_number, $dataUser->password)) {
                    $isValid = true;
                }


                if ($isValid) {
                    $token = Str::random(60);
                    $storeEmployee = User::updateOrCreate(
                        ['id'   => $dataUser->id],
                        ['auth_login' => $token]
                    );
                    $storeEmployee = User::where('auth_login', $token)->first();
                    $userDetail = UserDetail::where('uuid', ResponseFormatter::toUUID($storeEmployee->nik_employee))->first();
                    $storeEmployee->user_details = $userDetail;

                    $user_privileges = UserPrivilege::where_nik_employee($storeEmployee->nik_employee);

                    $storeEmployee->user_privileges = $user_privileges;

                    session(['user_authentication' => $storeEmployee]);
                    Session::put('user_authentication', $storeEmployee);
                    return ResponseFormatter::ResponseJson([
                        'status' => 'success',
                        'data'  => session('user_authentication')
                    ], 'Validasi Login Sukses', 200);
                }
            }
            return ResponseFormatter::ResponseJson(['status' => 'failed', 'data' => $request->nik_number], 'Validasi Login Gagal', 200);
        }
    }


    public static function getUserLogin($auth_login)
    {
        $user = User::where('auth_login', $auth_login)->first();
        return $user;
    }


    public function storeUser(Request $request)
    {
        $auth_login = $request->header('auth_login');
        $user = User::where('auth_login', $auth_login)->first();
        $dataForm = $request->formData;
        $hashPin = $user->pin;
        if ($dataForm['pin']) {
            if (strlen($dataForm['pin']) == 6) {
                $hashPin = Hash::make($dataForm['pin']);
            }
        }


        $userStore = User::updateOrCreate(['nik_employee' => $user->nik_employee], [
            'pin'   => $hashPin,
            'email' => $dataForm['email'],
            'phone_number' => $dataForm['phone_number'],
        ]);

        if ($userStore) {
            $userDetailStore = UserDetail::updateOrCreate(['date_end' => null, 'uuid' => $user->nik_employee], [
                'phone_number' => $dataForm['phone_number'],
            ]);
        }
        return ResponseFormatter::ResponseJson($userStore, 'Store Success', 200);
    }

    public function editUser(Request $request)
    {
        $password = Hash::make($request->nik_number);
        $userStore = User::updateOrCreate(['nik_employee' => ResponseFormatter::toUUID($request->nik_employee)], [
            'pin'   => NULL,
            'password' => $password,
        ]);
        if ($userStore) {
            $userDetailStore = UserDetail::updateOrCreate(['date_end' => null, 'uuid' => ResponseFormatter::toUUID($request->nik_employee)], [
                'nik_number' => $request->nik_number,
            ]);
        }
        return ResponseFormatter::ResponseJson($request->all(), 'Store Success', 200);
    }

    public static function db_local_storage($auth_login)
    {
        $database = [];
        $user = UserController::getUserLogin($auth_login);
        $user->level_user = 3;
        
        $session_user = WebUserController::sessionUserAuthentication($auth_login);
        if(!empty($session_user['feature']['MANAGE-DATA-HR'])){
            $user->level_user = 5;
        }


        // C O M P A N Y

        $Q_Menu = Menu::get();
        $data_menu = [];
        foreach ($Q_Menu as $menu) {
            $data_menu[$menu->uuid] = $menu;
        }

        // $database['employees'] = $data_employee;

        $database['db']['menu'] = $data_menu;

        // 

        $Q_table = DatabaseTable::get();
        $data_table = [];
        $data_table_child = [];

        $data_table_menu = [];
        foreach ($Q_table as $table) {
            $data_table[$table->code_table] = $table;
            $data_table_menu[$table->menu_table][] = $table->code_table;
            if ($table->parent_table) {
                $data_table_child[$table->parent_table][] = $table->code_table;
            }
        }

        $Q_field = DatabaseField::where('level_data_field', '<=', $user->level_user)->get();
        $data_field = [];
        $data_field_join = [];
        foreach ($Q_field as $field) {
            $data_field[$field->code_table_field][$field->code_field] = $field;
            $tipe_data_field[$field->code_table_field][$field->code_field] = $field->type_data_field;
            if ($data_table[$field->code_table_field]['parent_table']) {
                $data_field_join[$data_table[$field->code_table_field]['parent_table']][$field->code_field] = $field;
            } else {
                $data_field_join[$field->code_table_field][$field->code_field] = $field;
            }
        }



        $data_data = [];
        $uuid_all = [];

        // return $session_user;
        if (count($session_user['feature']) == 0) {
            $Q_data_self = DatabaseData::where('date_end')->where('code_data', $user->employee_uuid)->get();
            
            $Q_data = DatabaseData::leftJoin('database_tables', 'database_tables.code_table', 'database_data.code_table_data')->where('date_end')
                ->where('database_tables.menu_table', 'DATABASE')
                ->get([
                    'database_data.*'
                ]);
                $Q_data_self =  DatabaseData::where('date_end')->get();
            

            foreach ($Q_data as $data) {
                $data_data[$data->code_table_data][ResponseFormatter::toUUID($data->code_data)][$data->code_field_data]['value_data'] = $data->value_data;
                $data_data[$data->code_table_data][ResponseFormatter::toUUID($data->code_data)][$data->code_field_data]['uuid_data'] = $data->uuid_data;
                $uuid_all[$data->code_table_data][ResponseFormatter::toUUID($data->code_data)] = $data->uuid_data;
            }
            $data = null;
            foreach ($Q_data_self as $data) {
                $data_data[$data->code_table_data][ResponseFormatter::toUUID($data->code_data)][$data->code_field_data]['value_data'] = $data->value_data;
                $data_data[$data->code_table_data][ResponseFormatter::toUUID($data->code_data)][$data->code_field_data]['uuid_data'] = $data->uuid_data;
                $uuid_all[$data->code_table_data][ResponseFormatter::toUUID($data->code_data)] = $data->uuid_data;
            }
        } else {
            $Q_data_self = DatabaseData::where('date_end')->get();
            foreach ($Q_data_self as $data) {
                $data_data[$data->code_table_data][ResponseFormatter::toUUID($data->code_data)][$data->code_field_data]['value_data'] = $data->value_data;
                $data_data[$data->code_table_data][ResponseFormatter::toUUID($data->code_data)][$data->code_field_data]['uuid_data'] = $data->uuid_data;
                $uuid_all[$data->code_table_data][ResponseFormatter::toUUID($data->code_data)] = $data->uuid_data;
            }
        }
       

        $Q_data_DatabaseFieldShow = DatabaseFieldShow::get();
        $dataDatabaseFieldShow = [];
        foreach ($Q_data_DatabaseFieldShow as $data_user_template) {
            $dataDatabaseFieldShow[$data_user_template->table_code][$data_user_template->field_code][$data_user_template->sort_field] = $data_user_template;
        }






        $Q_data_source = DatabaseDataSource::get();
        $data_data_source = [];
        foreach ($Q_data_source as $data_source) {
            $data_data_source[$data_source->code_data_source] = $data_source;
        }

        $Q_data_source = UserTemplate::get();
        $dataUserTemplate = [];
        foreach ($Q_data_source as $data_user_template) {
            $dataUserTemplate[$data_user_template->employee_uuid][$data_user_template->code_table_get][$data_user_template->code_field] = $data_user_template;
        }



        $all_field_parent_table = [];

        foreach ($data_table_child as $code_table_parent => $table_parent) {
            if (!empty($data_field[$code_table_parent])) {
                $all_field_parent_table[$code_table_parent] = $data_field[$code_table_parent];
                foreach ($table_parent as $item_table_child) {
                    $all_field_parent_table[$code_table_parent] = array_merge($data_field[$item_table_child], $all_field_parent_table[$code_table_parent]);
                }
            }
        }

        foreach ($dataDatabaseFieldShow as $index_code_table => $itemFS) { //loop table
            if (!empty($data_data[$index_code_table])) {
                foreach ($data_data[$index_code_table] as $code_data => $item_data_field_gabungan) { //loop data
                    foreach ($itemFS as $item_code_field_show => $item_field_item_gabungan) { //loop field
                        if (empty($item_data_field_gabungan[$item_code_field_show])) {
                            $data_data[$index_code_table][$code_data][$item_code_field_show]['value_data'] = $code_data;
                            $data_data[$index_code_table][$code_data][$item_code_field_show]['uuid_data'] = $uuid_all[$index_code_table][$code_data];
                        }
                    }
                }
            }
        }



        $data_public = [];
        foreach ($data_table as $code_table_parent => $table_parent) {
        //     $field_table_parent = [];
        //     if (!empty($all_field_parent_table[$code_table_parent])) {
        //         $field_table_parent = $all_field_parent_table[$code_table_parent];
        //     } else {
        //         $field_table_parent = $data_field[$code_table_parent];
        //     }
            if (!empty($data_data[$code_table_parent])) {
                $code_table = (!empty($data_table[$code_table_parent]['parent_table'])) ? $data_table[$code_table_parent]['parent_table'] : $code_table_parent;
                foreach ($data_data[$code_table_parent] as $code_data => $item_data) {
                    foreach ($item_data as $code_field => $item_field) {
                        if (!empty($data_field[$code_table_parent][$code_field])) {
                            $data_public[$code_table][$code_data][$code_field] = $item_field['value_data'];
                            $value = $item_field['value_data'];
                            switch ($tipe_data_field[$code_table_parent][$code_field]) {
                                case 'DARI-TABEL':
                                    $code_table_data_source = $data_data_source[$code_table_parent . '-' . $code_field]['table_data_source'];
                                    $field_data_source = $data_data_source[$code_table_parent . '-' . $code_field]['field_get_data_source'];
                                    if (!empty($data_data[$code_table_data_source][$value])) {
                                        $value = (!empty($data_data[$code_table_data_source][$value][$field_data_source])) ? $data_data[$code_table_data_source][$value][$field_data_source]['value_data'] : null;
                                    } else {
                                        $value = null;
                                    }
                                    break;
                                case 'INPUT-AUTOCOMPLITE':
                                    $code_table_data_source = $data_data_source[$code_table_parent . '-' . $code_field]['table_data_source'];
                                    $field_data_source = $data_data_source[$code_table_parent . '-' . $code_field]['field_get_data_source'];
                                    $value = (!empty($data_data[$code_table_data_source][$value])) ? $data_data[$code_table_data_source][$value][$field_data_source]['value_data'] : null;
                                    break;
                                case 'GABUNGAN':
                                    $value = $item_field['value_data'];
                                    break;
                                default:
                                    $value = $item_field['value_data'];
                                    break;
                            }
                            $data_public['public_value'][$code_table][$code_data][$code_field] = $value;
                        }
                    }
                }
            }
        }
        // }

        $data_gabungan = [];
        foreach ($dataDatabaseFieldShow as $index_code_table => $itemFS) {
            if (!empty($data_public['public_value'][$index_code_table])) {
                foreach ($data_public['public_value'][$index_code_table] as $code_data => $item_data_field_gabungan) {
                    foreach ($itemFS as $item_code_field_show => $item_field_item_gabungan) {
                        $gabungan = '';
                        $uuid_data = '';
                        foreach ($item_field_item_gabungan as $item_code_field) {
                            // return $item_field_item_gabungan;
                            // $code_data_real = $data_field_join[$index_code_table][$item_code_field->field_show_code]['code_table_field'];
                            $code_data_real = $item_code_field->table_code;
                            if (!empty($data_public['public_value'][$code_data_real][$code_data][$item_code_field->field_show_code])) {
                                $gabungan =  $gabungan . $item_code_field->split_by . $data_public['public_value'][$code_data_real][$code_data][$item_code_field->field_show_code];
                            } else {
                                $gabungan = $gabungan . $item_code_field->split_by . '-';
                            }
                        }
                        $gabungan = substr($gabungan, 1);
                        $data_public['public_value'][$index_code_table][$code_data][$item_code_field_show] = $gabungan;
                        $data_public[$index_code_table][$code_data][$item_code_field_show] = $gabungan;
                        $data_data[$index_code_table][$code_data][$item_code_field_show]['value_data'] = $gabungan;
                    }
                }
            }
        }
        // return $data_public['KARYAWAN'];
        $arr_employee = [];
        if($user->level_user > 1){
            foreach($data_public['KARYAWAN'] as $NRP=>$item_karyawan){
                $arr_employee['all_employees'][] =$NRP;
                if(!empty($item_karyawan['PERUSAHAAN'])){
                    $arr_employee['PERUSAHAAN'][$item_karyawan['PERUSAHAAN']][] = $NRP;
                }else{
                    $arr_employee['PERUSAHAAN']['-'][] = $NRP;
                }
                // project
                if(!empty($item_karyawan['PROJECT'])){
                    $arr_employee['PROJECT'][$item_karyawan['PROJECT']][] = $NRP;
                }else{
                    $arr_employee['PROJECT']['-'][] = $NRP;
                }
    
                // DEPARTEMEN
                if(!empty($item_karyawan['DEPARTEMEN'])){
                    $arr_employee['DEPARTEMEN'][$item_karyawan['DEPARTEMEN']][] = $NRP;
                }else{
                    $arr_employee['DEPARTEMEN']['-'][] = $NRP;
                }
    
                // DIVISI
                if(!empty($item_karyawan['DIVISI'])){
                    $arr_employee['DIVISI'][$item_karyawan['DIVISI']][] = $NRP;
                }else{
                    $arr_employee['DIVISI']['-'][] = $NRP;
                }
                // DIVISI
                if(!empty($item_karyawan['GRADE'])){
                    $arr_employee['GRADE'][$item_karyawan['GRADE']][] = $NRP;
                }else{
                    $arr_employee['GRADE']['-'][] = $NRP;
                }
            }
        }
        

        // return  $data_public['public_value'];

        $Q_Database_Persetujuan = DatabasePersetujuan::all();
        $databasePersetujuan = [];
        foreach($Q_Database_Persetujuan as $I_databasePersetujuan){
            $databasePersetujuan[$I_databasePersetujuan->form_code][$I_databasePersetujuan->level] = $I_databasePersetujuan; 
        }


        $database['db']['database_field'] = $data_field;
        $database['db']['database_persetujuan'] = $databasePersetujuan;
        $database['db']['database_field_join'] = $data_field_join;
        $database['db']['database_field_show'] = $dataDatabaseFieldShow;
        $database['db']['database_data'] = $data_data;
        // $database['db']['database_data_history'] = $data_data_history;
        $database['db']['arr_employees'] = $arr_employee;
        $database['db']['database_table'] = $data_table;
        $database['db']['database_data_source'] = $data_data_source;
        $database['db']['data_table_child'] = $data_table_child;
        $database['db']['table_show_template'] = $dataUserTemplate;
        $database['db']['all_field_parent_table'] = $all_field_parent_table;
        $database['db']['data_table_menu'] = $data_table_menu;
        $database['user'] = $user;
        $database['public'] = $data_public;

        return $database;
    }

    public function localStorage(Request $request)
    {

        request()->session()->put('db_local_storage', $this->db_local_storage($request->header('auth_login')));
        return ResponseFormatter::ResponseJson(session('db_local_storage'), 'Store Success', 200);
    }

    public function localStorageWeb($auth_login)
    {
        request()->session()->put('db_local_storage', $this->db_local_storage($auth_login));
    }


    public function getEmployees(Request $request)
    {
        $employees = Employee::whereNull('date_end')->get();
        $data_employees = [];
        foreach ($employees as $employee) {
            $data_employees[] = $employee->nik_employee;
        }
        return ResponseFormatter::ResponseJson($data_employees, 'Success', 200);
    }


    public function getfull(Request $request)
    {
        $token = $request->token;

        $user = User::where('auth_login', $token)->first();
        if ($user) {
            $data = Employee::showWhereNik_employee($user->nik_employee);

            return ResponseFormatter::toJson($data, 'success');
        }
        return ResponseFormatter::toJson(null, 'Not Found');
    }

    public function indexManage()
    {
    }


    // Show User Profile By Id
    public function showProfile($id)
    {
        $user = User::where('uuid', '=', $id)->firstOrFail();
        $meta = [
            'message' => "Show user profile",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $user
        ];
        return response()->json($response, 200);
    }

    // Update User Profile By Id
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required',
            'phone_number'  => 'required',
            'email'         => 'required|email',
            'avatar'    => '',
        ]);

        try {
            $user = User::where('uuid', '=', $id)->firstOrFail();
            if ($request->file('avatar') == "") {
                $user->update([
                    'name'          => $request->name,
                    'phone_number'  => $request->phone_number,
                    'email'         => $request->email,
                    // 'photo_path'    => $request->avatar,
                ]);
            } else {
                if ($avatar = $request->file('avatar')) {
                    $uploadAvatar = 'images/profile/';
                    $profileImage = date('YmdHis') . "." . $avatar->getClientOriginalExtension();
                    $avatar->move($uploadAvatar, $profileImage);
                    // $request->avatar = '/' . $uploadAvatar . $profileImage;
                } else {
                    return response()->json(422);
                }
                $user->update([
                    'name'          => $request->name,
                    'phone_number'  => $request->phone_number,
                    'email'         => $request->email,
                    'photo_path'    => $request->avatar,
                ]);
            }

            $meta = [
                'message'   => "User has been updated",
                'code'      => 200,
                'status'    => "success"
            ];

            $data = [
                'user' => $user,
            ];

            $response = [
                'meta'  => $meta,
                'data'  => $data,
            ];
            return response()->json($response, 201);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed' . $e->errorInfo
            ]);
        }
    }
    public function manageUser()
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'listEmployee'
        ];
        return view('superadmin.users', [
            'title'         => 'Beranda Superadmin',
            'layout'        => $layout
        ]);
    }
    public function showLevelEmployeeUser($id)
    {
        $employee = DB::table('users')
            ->join('employees', 'employees.id', '=',  'users.employee_id')
            ->join('people', 'people.id', '=',  'employees.people_id')
            ->where('employees.nik_employee', $id)
            ->get(['employees.nik_employee', 'people.nik_number', 'employees.id', 'people.name', 'users.group'])
            ->first();
        // dd($employee);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'listEmployee'
        ];
        return view('superadmin.changeLevelEmployee', [
            'title'         => 'Beranda Superadmin',
            'layout'        => $layout
        ]);
    }

    public function anyData()
    {
        return Datatables::of(DB::table('users')
            ->join('employees', 'employees.id', '=',  'users.employee_id')
            ->join('people', 'people.id', '=',  'employees.people_id')
            ->get(['employees.nik_employee', 'people.nik_number', 'employees.id', 'people.name', 'users.group']))
            ->addColumn('action', function ($model) {
                $id = $model->nik_employee;

                // $textId = "'".$id."'";
                return '
            <a href="/superadmin/manage-user/' . $id . '">
                <button class="btn btn-warning py-1 px-2 mr-1">
                    <i class="icon-copy dw dw-pencil"></i>
                </button>
            </a>';
            })
            ->addColumn('name', function ($model) {
                return '<div class="name-avatar d-flex align-items-center">
            <div class="avatar mr-2 flex-shrink-0">
                <img src="http://mb-center.test/vendors/images/photo8.jpg" class="border-radius-100 shadow" width="40" height="40" alt="">
            </div>
            <div class="txt">
                <div class="weight-600">' . $model->name . '</div>
            </div>
        </div>';
            })
            ->addColumn('statusPass', function ($model) {
                return '<td>
                         <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7"
                            style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">Default</span>
                     </td>';
            })
            ->escapeColumns('name')
            ->make(true);
    }
}
