<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login', [
            'title'         => 'Authentication',
        ]);
    }
    public function forgot()
    {
        return view('auth.forgot', [
            'title'         => 'I am Forgot',
        ]);
    }
    public function forgot_proses(Request $request)
    {
        $dataAdmin = Admin::where('email', $request->email)->first();
        // return $request->email;
        if($dataAdmin){
            $data["email"] = $dataAdmin->email ;
            $data["title"] = "From Digital Creative Hub";
            $data["body"] = "Reset Password";
            $data["content"] = env('APP_URL').'reset/'.$dataAdmin->uuid;


            Mail::send('contenMail', $data, function($message)use($data) {
                $message->to($data["email"], $data["email"])
                        ->subject($data["title"]);
            });
        }else{
            return back()->with('loginError', 'Email not Found!');
        }
        return redirect('/login-admin');
    }
    public function new_pass(Request $request){
        if ($request->password === $request->confirm) {

            $validateData['password'] =  Hash::make($request->password);

            Admin::where('uuid', $request->uuid)->update($validateData);
            return redirect('/login-admin');
        }else{
            return back()->with('loginError', 'passwords are not same!');
        }
    }
    public function reset($uuid)
    {
        $admin =  Admin::where('uuid', $uuid)->first();
        return view('auth.reset', [
            'title'    => 'Authentication',
            'admin'    => $admin
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password =  Hash::make($request->password);
        $pass =  Hash::make($request->password);
        // return $password;
        $dataadmin = Admin::where('phone', $request->phone_number)
          ->first();
        // return $dataadmin;
        if($dataadmin){
            if(Hash::check($request->password, $dataadmin->password)){
                $request->session()->put('isAdmin','1');
                $request->session()->put('admin', $dataadmin);
                return redirect()->intended('/');
            }else{
                return back()->with('loginError', 'Login Failed!');
            }

        }else{
            $request->session()->put('isAdmin','0');
        }
        return back()->with('loginError', 'Login Failed!');
    }
    public function logout()
    {

            session()->put('isAdmin','0');
            session()->put('admin', '');
            return redirect()->intended('/login-admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
