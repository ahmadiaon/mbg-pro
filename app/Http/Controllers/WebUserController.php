<?php

namespace App\Http\Controllers;

use App\Models\Privilege\UserPrivilege;
use App\Models\User;
use App\Models\UserDetail\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class WebUserController extends Controller
{
    public function login(Request $request){
        $validateValue =  $request->validate([
            'nik_employee'         => 'required',
            'password'          => ['required']
        ]);
        $dataUser = User::where('nik_employee', $request->nik_employee)->first();
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

    public function profile(){
        return view('app.user.profile', [
            'title'         => 'Login'
        ]);
    }


}
