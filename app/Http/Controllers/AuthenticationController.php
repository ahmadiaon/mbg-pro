<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Api\User\UserController;
use App\Models\Company;
use App\Models\Employee\Employee;
use App\Models\Privilege\UserPrivilege;
use App\Models\Safety\AtributSize;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class AuthenticationController extends Controller
{
    //
    public function index()
    {
        return view('authentication.login', [
            'title'         => 'Login'
        ]);
    }
    public function logout()
    {
        session()->forget('dataUser');
        return view('authentication.login', [
            'title'         => 'Login'
        ]);
    }
    public function login(Request $request)
    {
        // return $request;
        $validateData = $request->validate([
            'username'         => 'required',
            'password'          => 'required'
        ]);

        $dataUser = User::where('nik_employee', $request->username)->get()->first();
        
        if ($dataUser) {
            try {
                if (Hash::check($request->password, $dataUser->password)) {
                    $dataUserOld = $dataUser;

                    $col_dataUser = Employee::join('user_details', 'user_details.uuid', 'employees.nik_employee')
                        ->where('employees.nik_employee', $dataUser->nik_employee)
                        ->whereNull('employees.date_end')
                        ->whereNull('user_details.date_end')
                        ->get()
                        ->first();
                    // return $dataUser = $col_dataUser;
                  

                    $dataUser->user_privileges =  $user_privileges = UserPrivilege::where_nik_employee($col_dataUser['nik_employee']);
                    $dataUser->is_login  = true;


                    if (!empty(count($user_privileges))) {
                        foreach ($user_privileges as $user_privilege => $value) {
                            $arr_privilege[$value] = $value;
                            $name_index = $user_privilege;
                            $dataUser->$name_index = $value;
                        }
                    }

                    $data_company = Company::all();
                    $data_site = AtributSize::where('size', 'site_uuid')->get();
                    $employee_data_company = [];
                    foreach ($data_company as $company) {
                        if (!empty($dataUser['company_privilege_' . $company->uuid])) {
                            $employee_data_company[$company->uuid] = $company->uuid;
                        }
                    }

                    $employee_data_site = [];
                    foreach ($data_site as $site) {
                        if (!empty($dataUser['site_privilege_' . $site->uuid])) {
                            $employee_data_site[$site->uuid] = $site->uuid;
                        }
                    }
                    $dataUser->company_privilege = $employee_data_company;
                    $dataUser->site_privilege = $employee_data_site;

                    // dd($employee_data_site);

                    if (!$dataUser) {
                        $dataUser = $dataUserOld;
                        $request->session()->put('dataUser', $dataUser);
                    } else {
                        $request->session()->put('dataUser', $dataUser);
                    }

                    // $arr_employees= Employee::data_employee();
                    // // dd($arr_employees);
                    // $arr_companies= Company::all();
                    // $request->session()->put('data_employees', $arr_employees);                
                    // $request->session()->put('data_companies', $arr_companies);

                    ResponseFormatter::setAllSession();

                    // dd(session('data_database'));
                    $auth_login = $dataUser->auth_login;
                    $request->session()->put('db_local_storage', UserController::db_local_storage($auth_login));

                    // dd(session()->all());

                    return redirect()->intended('/me/' . $col_dataUser['nik_employee']);
                } else {
                    return back()->with('loginError', 'Login Failed!');
                }
            } catch (Exception $e) {
                return back()->with('loginError', 'Login Failed!');
            }
        } else {
            return back()->with('loginError', 'Login Failed!');
        }
    }
}
