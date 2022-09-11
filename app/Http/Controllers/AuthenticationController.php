<?php

namespace App\Http\Controllers;
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

        
         $dataUser = User::where('NIK_employee', $request->username)->get()->first();
        //  dd($aa = Hash::check($request->password, $dataUser->password));
        if($dataUser){
            if(Hash::check($request->password, $dataUser->password)){
                $dataUserOld = $dataUser;
                $dataUser = User::join('employees', 'employees.uuid', '=', 'users.employee_uuid')
                ->join('employee_contracts', 'employee_contracts.employee_uuid', '=', 'employees.uuid')
                ->where('users.NIK_employee', $request->username)
                ->get([
                    'employee_contracts.uuid as employee_contract_uuid',
                    'users.*',
                ])->first();
                if(!$dataUser){
                    $dataUser =$dataUserOld;
                }
               
                $request->session()->put('dataUser', $dataUser);
                switch($dataUser->role) {
                    case('admin-hr'):
                        return redirect()->intended('/admin-hr');
                        break;
                    case('safety'):
                        // dd('as');
                        return redirect()->intended('/safety');
                        break;
                    case('supervisor'):
                        return redirect()->intended('/supervisor');
                        break;
                        case('foreman'):
                            return redirect()->intended('/foreman');
                            break;
                case('admin-ob'):
                        return redirect()->intended('/admin-ob');
                        break;
                    case('superadmin'):
                        return redirect()->intended('/superadmin');
                        break;
                    case('employee'):
                        return redirect()->intended('/');
                        break;
                    default:
                        $msg = 'Something went wrong.';
                }
                return redirect()->intended('/');
            }else{
                return back()->with('loginError', 'Login Failed!');
            }
        }else{
            $request->session()->put('isAdmin','0');
        }
        return back()->with('loginError', 'Login Failed!');;
        
    }


}
