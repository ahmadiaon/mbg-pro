<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Privilege\UserPrivilege;
use App\Models\User;
use App\Models\UserDetail\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class WebUserController extends Controller
{
    public function login(Request $request)
    {
        $dataUser = User::where('nik_employee', ResponseFormatter::toUUID($request->nik_employee))->first();
        
        $isValid = false;
        if ($dataUser) {
            
            if (Hash::check($request->pin, $dataUser->pin)) {
                $isValid = true;
            }
            if (Hash::check($request->nik_number, $dataUser->password)) {
                $isValid = true;
            }
            

            if($isValid){
               
                $token = Str::random(60);
                $storeEmployee = User::updateOrCreate(
                    ['id'   => $dataUser->id],
                    ['auth_login' => $token]
                );
                $storeEmployee = User::where('auth_login', $token)->first();
                $userDetail = UserDetail::where('uuid', ResponseFormatter::toUUID($storeEmployee->nik_employee))->first();
                $storeEmployee->user_details = $userDetail;

                $user_privileges = UserPrivilege::where_nik_employee(ResponseFormatter::toUUID($storeEmployee->nik_employee));

                $storeEmployee->user_privileges = $user_privileges;
                session()->flush();
                session(['user_authentication' => $storeEmployee]);
                session()->put('user_authentication', $storeEmployee);
               
                return redirect()->intended('/web/profile');

                Session::put('user_authentication', $storeEmployee);
                return ResponseFormatter::ResponseJson([
                    'status'=>'success',
                    'data'  => session('user_authentication')
                ], 'Validasi Login Sukses', 200);
                
                
            }
            
        }
        return back()->with('isError', 'Login Failed!');
      
        
        
        if ($dataUser) {
            if (Hash::check($request->password, $dataUser->password)) {
                $token = Str::random(60);
                $storeEmployee = User::updateOrCreate(
                    ['id'   => $dataUser->id],
                    ['auth_login' => $token]
                );
                $storeEmployee = User::where('auth_login', $token)->first();
                $userDetail = UserDetail::where('uuid', $storeEmployee->nik_employee)->first();
                $storeEmployee->user_details = $userDetail;

                $user_privileges = UserPrivilege::where_nik_employee($storeEmployee->nik_employee);

                $storeEmployee->user_privileges = $user_privileges;

                session()->put('user_authentication', $storeEmployee);
                return redirect()->intended('/web/profile');
                return $storeEmployee;
            }
        }
        return back()->with('isError', 'Login Failed!');
    }


    public function logout()
    {
        if (!empty(session('user_authentication'))) {
            $storeEmployee = User::updateOrCreate(
                ['id'   => session('user_authentication')->id],
                ['auth_login' => null]
            );
        }
        return view('app.login');
    }

    public function profile()
    {
        return view('app.user.profile', [
            'title'         => 'Login'
        ]);
    }

    public function user()
    {
        return view('app.user.user', [
            'title'         => 'User'
        ]);
    }
}
