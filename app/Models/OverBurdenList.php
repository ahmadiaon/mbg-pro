<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OverBurdenList extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getList($overBurden_uuid){
        return  DB::table('over_burden_lists')
        ->join('over_burden_operators', 'over_burden_operators.uuid', '=', 'over_burden_lists.over_burden_operator_uuid' )
        ->join('employee_contracts', 'employee_contracts.uuid', '=', 'over_burden_operators.operator_employee_uuid')
        ->join('employees', 'employees.uuid', '=', 'employee_contracts.employee_uuid' )
        ->join('people', 'people.uuid', '=', 'employees.people_uuid' )
        ->join('vehicles', 'vehicles.uuid', '=', 'over_burden_operators.vehicle_uuid' )
        ->join('vehicle_groups', 'vehicle_groups.uuid', '=', 'vehicles.vehicle_group_uuid' )
        ->where('over_burden_operators.over_burden_uuid', $overBurden_uuid)
        ->get([
            'over_burden_operators.uuid',
            'over_burden_operators.capacity',
            'employees.nik_employee',
            'people.name',
            'vehicles.number',
            'vehicle_groups.vehicle_code',
            'vehicle_groups.vehicle_group',
            'over_burden_lists.over_burden_time'
        ]);
    }
    public static function getListFlit($overBurden_uuid){
        return $over_burden_lists = $over_burden_lists = DB::table('over_burden_lists')
        ->join('over_burden_operators', 'over_burden_operators.uuid', '=', 'over_burden_lists.over_burden_operator_uuid' )
        ->join('employee_contracts', 'employee_contracts.uuid', '=', 'over_burden_operators.operator_employee_uuid')
        ->join('employees', 'employees.uuid', '=', 'employee_contracts.employee_uuid' )
        ->join('people', 'people.uuid', '=', 'employees.people_uuid' )
        ->join('over_burden_flits', 'over_burden_flits.uuid', '=', 'over_burden_lists.over_burden_flit_uuid' )
        ->join('vehicles as v', 'v.uuid', '=', 'over_burden_operators.vehicle_uuid' )
        ->join('vehicle_groups as vg', 'vg.uuid', '=', 'v.vehicle_group_uuid' )
        ->join('vehicles as ve', 've.uuid', '=','over_burden_flits.excavator_vehicle_uuid' )
        ->join('vehicle_groups as vg2', 'vg2.uuid', '=', 've.vehicle_group_uuid')
        ->where('over_burden_operators.over_burden_uuid', $overBurden_uuid)
        ->get([
            'over_burden_operators.uuid',
            'over_burden_operators.capacity',
            'employees.nik_employee',
            'people.name',
            'v.number',
            'vg.vehicle_code',
            'vg.vehicle_group',
            've.number as number_excavator',
            'vg2.vehicle_code as vehicle_code_excavator',
            'vg2.vehicle_group as vehicle_group_excavator',
            'over_burden_lists.over_burden_time',
        ]);
    }
  
}
