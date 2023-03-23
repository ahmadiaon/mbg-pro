<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Company;
use App\Models\Employee\Employee;
use App\Models\Privilege\UserPrivilege;
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
    public function logout(){
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
        if($dataUser){
            try{
                if(Hash::check($request->password, $dataUser->password)){
                    $dataUserOld = $dataUser;

                $arr_employees= Employee::data_employee();
                $arr_companies= Company::all();
                $request->session()->put('data_employees', $arr_employees);                
                $request->session()->put('data_companies', $arr_companies);

                ResponseFormatter::setAllSession();

                $col_dataUser = Employee::noGet_employeeAll_detail();
                
                $dataUser = $col_dataUser->where('nik_employee', $dataUser->nik_employee)->get()->first();
              
                $dataUser->user_privileges =  $user_privileges = UserPrivilege::where_nik_employee($dataUser->nik_employee);
                $dataUser->is_login  = true;
                foreach($user_privileges as $user_privilege=>$value){
                        $name_index = $user_privilege;
                        $dataUser->$name_index = $value;
                }                
                    if(!$dataUser){
                        $dataUser =$dataUserOld;
                        //  dd('/me/');
                        $request->session()->put('dataUser', $dataUser);
                    }else{
                        $request->session()->put('dataUser', $dataUser);
                        return redirect()->intended('/user');
                    }
                }else{
                    return back()->with('loginError', 'Login Failed!');
                }
            } catch (Exception $e) {
                return back()->with('loginError', 'Login Failed!');
            }
        }else{
            return back()->with('loginError', 'Login Failed!');
        }
    }
}
