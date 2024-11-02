<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function userGet(Request $request){
        $auth_login = $request->header('x-auth-login');
        $user = User::where('auth_login', $auth_login)->first();

       
        return ResponseFormatter::ResponseJson($user, 'Success', 200);
    }
}
