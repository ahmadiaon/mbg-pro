<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Support\DatabaseDataKehadiran;
use App\Models\Support\DatabaseDataPersetujuan;
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
        $auth_login = $request->header('x-auth-login');

        $user = User::where('auth_login', $auth_login)->first();
        // $user = User::where('nik_employee', 'MBLE-0422003')->first();
        // $user = User::all();


        $data_absensi = EmployeeAbsen::where('employee_absens.employee_uuid',$user->nik_employee)
        ->where('employee_absens.date', '>=',  $request['filter_absensi']['date_start'])
        ->where('employee_absens.date', '<=',  $request['filter_absensi']['date_end'])
        ->get([
            'employee_absens.*'
        ]);

        $data_return = [];

        foreach($data_absensi as $absensi){
            $data_return[$absensi->employee_uuid][$absensi->date] = $absensi; 
        }
        $data_to_return['data_absensi'] =$data_return;
        $data_to_return['data_ketidakhadiran'] = DatabaseDataKehadiran::getData($user->nik_employee);
        $data_to_return['data_persetujuan'] = DatabaseDataPersetujuan::getDataPersetujuan('KEHADIRAN',null);
        return ResponseFormatter::ResponseJson($data_to_return, 'Success', 200);

    }
}
