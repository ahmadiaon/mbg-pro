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

        
         $dataUser = User::where('nik_employee', $request->username)->get()->first();
        //  dd($aa = Hash::check($request->password, $dataUser->password));
        if($dataUser){
            if(Hash::check($request->password, $dataUser->password)){
                $dataUserOld = $dataUser;
               $dataUser = User::join('employees', 'employees.uuid', '=', 'users.employee_uuid')
                ->where('users.nik_employee', $request->username)
                ->get([
                    'users.*',
                    'employees.uuid as employee_uuid'
                ])->first();
                if(!$dataUser){
                    $dataUser =$dataUserOld;
                }
            //    dd($dataUser);
                $request->session()->put('dataUser', $dataUser);
                switch($dataUser->role) {
                    case('admin-hr'):
                        return redirect()->intended('/admin-hr');
                        break;
                    case('safety'):
                        // dd('as');
                        return redirect()->intended('/safety/manage');
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
                        return redirect()->intended('/superadmin/database');
                        break;
                    case('employee'):
                        return redirect()->intended('/me/'.session('dataUser')->nik_employee);
                        break;
                    case('logistic'):
                        return redirect()->intended('/logistic');
                        break;
                    case('engineer'):
                        return redirect('/engineer');
                        break;
                    case('hauling'):
                        return redirect()->intended('/hauling');
                        break;
                    case('payrol'):
                        return redirect()->intended('/payrol');
                        break;
                    case('purchase-order'):
                        return redirect()->intended('/purchase-order');
                        break;
                    case('purchase-public'):
                        return redirect()->intended('/penerimaan-barang-po');
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
