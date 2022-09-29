<?php

namespace App\Http\Controllers\Api\Auth;

use Validator;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;


class AuthController extends Controller
{
    public function fail(){
        return ResponseFormatter::error(null,'User Not Found', 404);
    }
    public function Login(Request $request){
        $validator = Validator::make($request->all(), [
            'nik_employee'         => 'required',
            'password'        => 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $meta = [
                'message' => "Register Failed",
                'code'  => 201,
                'status'  => "errors"
            ];
            $response = [
                'meta'  => $meta,
                'errors'  => $errors,
            ];
            return response()->json($response, 201);
        }
        $user = User::where('nik_employee', $request->nik_employee)->first();
        if($user){
            if(Hash::check($request->password, $user->password) ){
                $token = JWTAuth::fromUser($user);
                $data = [
                    'user'  => $user,
                    'token' => $token
                ];
                return ResponseFormatter::success($data, 'Login Success');
            }
            return ResponseFormatter::error(null,'User Not Found', 404);
            
        }else{
            return ResponseFormatter::error(null,'User Not Found', 404);
        }  
    }
}
