<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Slip;
use App\Models\User;
use Illuminate\Http\Request;

class ApiSlipController extends Controller
{
    public function data(Request $request)
    {
        $data = [
            'MBLE-0422003' => [
                1 => [
                    'original_file' => 'mble-0422'
                ],
                2 => [
                    'original_file'
                ],
            ]
        ];

        $filter = $request->validate(
            [
                'year' => '',
            ]
        );

        $auth_login = $request->header('x-auth-login');
        $user = User::where('auth_login', $auth_login)->first();
        $data = Slip::where('year', $filter['year'])
            ->where('employee_uuid', $user->nik_employee)
            ->get();
        return ResponseFormatter::ResponseJson($data, 'Success', 200);
    }
}
