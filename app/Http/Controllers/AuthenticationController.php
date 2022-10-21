<?php

namespace App\Http\Controllers;

use App\Models\Employee\Employee;
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

               $dataUser = Employee::where_employee_nik_employee_nullable($dataUser->nik_employee);
               if(!empty($dataUser->user_privileges)){
                    foreach($dataUser->user_privileges as $item){
                        $thiss = $item->privilege_uuid;
                        $dataUser->$thiss = 1;
                    }
                }
                if(!$dataUser){
                    $dataUser =$dataUserOld;
                    $request->session()->put('dataUser', $dataUser);
                }else{
                    $request->session()->put('dataUser', $dataUser);
                    return redirect()->intended('/me/'.$dataUser->nik_employee);
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
            return back()->with('loginError', 'Login Failed!');
        }
    }
}
