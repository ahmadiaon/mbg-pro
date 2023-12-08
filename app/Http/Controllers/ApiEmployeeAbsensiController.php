<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Employee\EmployeeAbsen;
use App\Models\User;
use Illuminate\Http\Request;

class ApiEmployeeAbsensiController extends Controller
{
    public function getAbsenEmployee(Request $request){
        $filter = $request->validate(
            [
                'employee_uuid' => '',
                'date_start'=> '',
                'date_end' => ''
            ]
        );
        $auth_login = $request->header('auth_login');

        $user = User::where('auth_login', $auth_login)->first();
        // $user = User::where('nik_employee', 'MBLE-0422003')->first();
        // $user = User::all();


        $data_absensi = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
        ->where('employee_absens.employee_uuid',$user->nik_employee)
        ->where('employee_absens.date', '>=',  $filter['date_start'])
        ->where('employee_absens.date', '<=',  $filter['date_end'])
        ->get([
            'status_absens.*',
            'employee_absens.*'
        ]);

        $data_return = [];

        foreach($data_absensi as $absensi){
            $data_return[$absensi->employee_uuid][$absensi->date] = $absensi; 
        }

        return ResponseFormatter::ResponseJson($data_return, 'Success', 200);

    }
}
