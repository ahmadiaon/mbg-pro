<?php

namespace App\Models\OverBurden;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HourMeter extends Model
{
    use HasFactory;
     protected $guarded = ['id'];

    public static function getOperator($overBurden_uuid){
        return DB::table('over_burden_operators')
        ->join('over_burdens', 'over_burdens.uuid', '=', 'over_burden_operators.over_burden_uuid' )    
        ->join('over_burden_flits', 'over_burden_flits.uuid', '=', 'over_burden_operators.over_burden_flit_uuid')
        ->join('employees', 'employees.uuid', '=', 'over_burden_operators.operator_employee_uuid' )
        ->join('user_details', 'user_details.uuid', '=', 'employees.user_detail_uuid' )
        ->join ('hour_meters', 'hour_meters.over_burden_operator_uuid', '=', 'over_burden_operators.uuid' )

        ->join('vehicles', 'vehicles.uuid', '=', 'over_burden_operators.vehicle_uuid' )
        ->join('brand_types','brand_types.uuid','=','vehicles.brand_type_uuid')
        ->join('group_vehicles','group_vehicles.uuid','=','brand_types.group_vehicle_uuid')
        // ->join('brands','brands.uuid','=','brand_types.brand_uuid')
        // ->join('units','units.uuid','=','brand_types.unit_uuid')
        
        ->join('vehicle_tracks', 'vehicle_tracks.vehicle_uuid', '=', 'over_burden_operators.vehicle_uuid')
        ->where('over_burden_operators.over_burden_uuid','=', $overBurden_uuid)
        ->where('vehicle_tracks.is_last','=', 1 )
        ->where('over_burden_operators.group','=', 'Dump Truck' )
        ->get([
                'over_burden_operators.uuid as over_burden_operator_uuid',
                'over_burden_operators.capacity',
                'employees.nik_employee',
                'user_details.name',
                'vehicles.number',
                'vehicles.uuid as vehicle_uuid',
                'group_vehicles.group_code',
                'group_vehicles.group_name',
                'hour_meters.*',
                'hour_meters.uuid as hm_uuid',
                'vehicle_tracks.hm',
                'over_burden_flits.uuid as over_burden_flit_uuid'
            ]);
    }

    public static function getOperatorSupport($overBurden_uuid){
        return DB::table('over_burden_operators')
        ->join('over_burdens', 'over_burdens.uuid', '=', 'over_burden_operators.over_burden_uuid' )    
        ->join('over_burden_flits', 'over_burden_flits.uuid', '=', 'over_burden_operators.over_burden_flit_uuid')
        ->join('employees', 'employees.uuid', '=', 'over_burden_operators.operator_employee_uuid' )
        ->join('user_details', 'user_details.uuid', '=', 'employees.user_detail_uuid' )
        ->join ('hour_meters', 'hour_meters.over_burden_operator_uuid', '=', 'over_burden_operators.uuid' )

        ->join('vehicles', 'vehicles.uuid', '=', 'over_burden_operators.vehicle_uuid' )
        ->join('brand_types','brand_types.uuid','=','vehicles.brand_type_uuid')
        ->join('group_vehicles','group_vehicles.uuid','=','brand_types.group_vehicle_uuid')
        ->join('brands','brands.uuid','=','brand_types.brand_uuid')
        ->join('units','units.uuid','=','brand_types.unit_uuid')
        
        ->join('vehicle_tracks', 'vehicle_tracks.vehicle_uuid', '=', 'over_burden_operators.vehicle_uuid')
        ->where('over_burden_operators.over_burden_uuid','=', $overBurden_uuid)
        ->where('vehicle_tracks.is_last','=', 1 )
        ->where('over_burden_operators.group','!=', 'Dump Truck' )
        ->get([
                'over_burden_operators.uuid as over_burden_operator_uuid',
                'over_burden_operators.capacity',
                'employees.nik_employee',
                'user_details.name',
                'vehicles.number',
                'vehicles.uuid as vehicle_uuid',
                'group_vehicles.group_code',
                'group_vehicles.group_name',
                'hour_meters.*',
                'hour_meters.uuid as hm_uuid',
                'vehicle_tracks.hm',
                'over_burden_flits.uuid as over_burden_flit_uuid'
            ]);
    }
}
