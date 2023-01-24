<?php

namespace App\Http\Controllers;

use App\Models\Employee\Employee;
use App\Models\Privilege\UserPrivilege;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    //
    public function index()
    {
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
        // dd($dataUser);
        //  dd($aa = Hash::check($request->password, $dataUser->password));
        if($dataUser){
            // dd($request->password);
            if(Hash::check($request->password, $dataUser->password)){
                $dataUserOld = $dataUser;

               $col_dataUser = Employee::noGet_employeeAll();
             
               $dataUser = $col_dataUser->where('nik_employee', $dataUser->nik_employee)->get()->first();
               $dataUser->user_privileges =  $user_privileges = UserPrivilege::where_nik_employee($dataUser->nik_employee);
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
        }else{
            return back()->with('loginError', 'Login Failed!');
        }
    }
}
