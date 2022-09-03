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
        $validateData = $request->validate([
            'username'         => 'required',
            'password'          => 'required'
        ]);

        
        $dataUser = User::where('NIK_employee', $request->username)->first();
        if($dataUser){
            if(Hash::check($request->password, $dataUser->password)){
                $request->session()->put('dataUser', $dataUser);
                switch($dataUser->group) {
                    case('admin-hr'):
                        return redirect()->intended('/admin-hr');
                        break;
                    case('supervisor'):
                        return redirect()->intended('/supervisor');
                        break;
                        case('foreman'):
                            return redirect()->intended('/foreman');
                            break;
                    case('admin-ob'):
                        // dd('a');
                        return redirect()->intended('/admin-ob/create');
                        break;
                    case('superadmin'):
                        // dd('a');
                        return redirect()->intended('/superadmin');
                        return session('dataUser.id');
                        return "superadmin ";
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
