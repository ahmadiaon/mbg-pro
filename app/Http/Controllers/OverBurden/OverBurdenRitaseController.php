<?php

namespace App\Http\Controllers\OverBurden;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Vehicle\Vehicle;
use Illuminate\Support\Facades\DB;

class OverBurdenRitaseController extends Controller
{
    public function create(){
        $employees = Employee::getAll();
        $vehicles =  Vehicle::getVehicle();

        $pits = DB::table('pits')->get();


        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'ritase'
        ];


        $data =  [
            'title'         => 'Over Burden',
            'employees'     => $employees,
            'vehicles'      => $vehicles,
            'pits'          => $pits,
            'layout'        => $layout
        ];
        // dd($dateToday);
        return view('engineer.ritasi.index', $data);
    }
}
