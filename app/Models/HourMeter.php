<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HourMeter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getOperator($overBurden_uuid){
        return DB::table('over_burden_operators')
        ->join('over_burdens', 'over_burdens.uuid', '=', 'over_burden_operators.over_burden_uuid' )    
        ->join('over_burden_flits', 'over_burden_flits.uuid', '=', 'over_burden_operators.over_burden_flit_uuid')
        ->join('employee_contracts', 'employee_contracts.uuid', '=', 'over_burden_operators.operator_employee_uuid')
        ->join('employees', 'employees.uuid', '=', 'employee_contracts.employee_uuid' )
        ->join('positions', 'positions.uuid', '=', 'employee_contracts.position_uuid' )
        ->join('people', 'people.uuid', '=', 'employees.people_uuid' )
        ->join ('hour_meters', 'hour_meters.operator_employee_uuid', '=', 'over_burden_operators.uuid' )
        ->join('vehicles', 'vehicles.uuid', '=', 'over_burden_operators.vehicle_uuid' )
        ->join('vehicle_groups', 'vehicle_groups.uuid', '=', 'vehicles.vehicle_group_uuid' )
        ->join('vehicle_tracks', 'vehicle_tracks.vehicle_uuid', '=', 'over_burden_operators.vehicle_uuid')
        ->where('over_burden_operators.over_burden_uuid','=', $overBurden_uuid)
        ->where('vehicle_tracks.last','=', 1 )
        ->where('vehicle_groups.vehicle_group','=', 'Dump Truck' )
        ->get([
                'over_burden_operators.uuid as over_burden_operator_uuid',
                'over_burden_operators.capacity',
                'employees.NIK_employee',
                'people.name',
                'vehicles.number',
                'vehicles.uuid as vehicle_uuid',
                'vehicle_groups.vehicle_code',
                'vehicle_groups.vehicle_group',
                'positions.position',
                'hour_meters.*',
                'hour_meters.uuid as hm_uuid',
                'vehicle_tracks.hour_meter',
                'over_burden_flits.uuid as over_burden_flit_uuid'
            ]);
    }

    public static function getOperatorSupport($overBurden_uuid){
        return DB::table('over_burden_operators')
        ->join('over_burdens', 'over_burdens.uuid', '=', 'over_burden_operators.over_burden_uuid' )    
        ->join('over_burden_flits', 'over_burden_flits.uuid', '=', 'over_burden_operators.over_burden_flit_uuid')
        ->join('employee_contracts', 'employee_contracts.uuid', '=', 'over_burden_operators.operator_employee_uuid')
        ->join('employees', 'employees.uuid', '=', 'employee_contracts.employee_uuid' )
        ->join('positions', 'positions.uuid', '=', 'employee_contracts.position_uuid' )
        ->join('people', 'people.uuid', '=', 'employees.people_uuid' )
        ->leftJoin ('hour_meters', 'hour_meters.operator_employee_uuid', '=', 'over_burden_operators.uuid' )
        ->join('vehicles', 'vehicles.uuid', '=', 'over_burden_operators.vehicle_uuid' )
        ->join('vehicle_groups', 'vehicle_groups.uuid', '=', 'vehicles.vehicle_group_uuid' )
        ->join('vehicle_tracks', 'vehicle_tracks.vehicle_uuid', '=', 'over_burden_operators.vehicle_uuid')
        ->where('over_burden_operators.over_burden_uuid','=', $overBurden_uuid)
        ->where('vehicle_tracks.last','=', 1 )
        ->where('vehicle_groups.vehicle_group','!=', 'Dump Truck' )
        ->get([
                'over_burden_operators.uuid as over_burden_operator_uuid ',
                'over_burden_operators.capacity',
                'employees.NIK_employee',
                'people.name',
                'vehicles.number',
                'vehicles.uuid as vehicle_uuid',
                'vehicle_groups.vehicle_code',
                'vehicle_groups.vehicle_group',
                'positions.position',
                'hour_meters.*',
                'hour_meters.uuid as hm_uuid',
                'vehicle_tracks.hour_meter',
                'over_burden_flits.uuid as over_burden_flit_uuid'
            ]);
    }
}
