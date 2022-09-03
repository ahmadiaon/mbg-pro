<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UtilityController extends Controller
{
    // Function Check Email Admin
    public function checkEmailAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $checkEmail = Admin::query()->where('email', $email)->get();

        if ($checkEmail->isEmpty()) {
            $meta = [
                'message' => "Email is available",
                'code'  => 200,
                'status'  => "success"
            ];
            $data = [
                'email' => $email,
            ];
            $response = [
                'meta'  => $meta,
                'data'  => $data
            ];
            return response()->json($response, 200);
        } else {
            $meta = [
                'message' => "Email is not available",
                'code'  => 400,
                'status'  => "failed"
            ];
            $data = [
                'email' => $email,
            ];
            $response = [
                'meta'  => $meta,
                'data'  => $data
            ];
            return response()->json($response, 400);
        }
    }

    // Function Check Email User
    public function checkEmailUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $checkEmail = User::query()->where('email', $email)->get();

        if ($checkEmail->isEmpty()) {
            $meta = [
                'message' => "Email is available",
                'code'  => 200,
                'status'  => "success"
            ];
            $data = [
                'email' => $email,
            ];
            $response = [
                'meta'  => $meta,
                'data'  => $data
            ];
            return response()->json($response, 200);
        } else {
            $meta = [
                'message' => "Email is not available",
                'code'  => 400,
                'status'  => "failed"
            ];
            $data = [
                'email' => $email,
            ];
            $response = [
                'meta'  => $meta,
                'data'  => $data
            ];
            return response()->json($response, 400);
        }
    }

    // Function Check Phone Number User
    public function checkPhoneUser(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $phone = $request->phone;
        $checkPhone = User::query()->where('phone_number', $phone)->get();

        if ($checkPhone->isEmpty()) {
            $meta = [
                'message' => "Phone is available",
                'code'  => 200,
                'status'  => "success"
            ];
            $data = [
                'phone' => $phone,
            ];
            $response = [
                'meta'  => $meta,
                'data'  => $data
            ];
            return response()->json($response, 200);
        } else {
            $meta = [
                'message' => "Phone is not available",
                'code'  => 400,
                'status'  => "failed"
            ];
            $data = [
                'phone' => $phone,
            ];
            $response = [
                'meta'  => $meta,
                'data'  => $data
            ];
            return response()->json($response, 400);
        }
    }

    // Function Check Phone Number Admin
    public function checkPhoneAdmin(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $phone = $request->phone;
        $checkPhone = Admin::query()->where('phone', $phone)->get();

        if ($checkPhone->isEmpty()) {
            $meta = [
                'message' => "Phone is available",
                'code'  => 200,
                'status'  => "success"
            ];
            $data = [
                'phone' => $phone,
            ];
            $response = [
                'meta'  => $meta,
                'data'  => $data
            ];
            return response()->json($response, 200);
        } else {
            $meta = [
                'message' => "Phone is not available",
                'code'  => 400,
                'status'  => "failed"
            ];
            $data = [
                'phone' => $phone,
            ];
            $response = [
                'meta'  => $meta,
                'data'  => $data
            ];
            return response()->json($response, 400);
        }
    }
}
