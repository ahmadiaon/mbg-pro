<?php

namespace App\Models\OverBurden;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OverBurdenList extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getList($overBurden_uuid){
        return  DB::table('over_burden_lists')
        ->join('over_burden_operators', 'over_burden_operators.uuid', '=', 'over_burden_lists.over_burden_operator_uuid' )
        ->join('employees', 'employees.uuid', '=',  'over_burden_operators.operator_employee_uuid' )
        ->join('user_details', 'user_details.uuid', '=', 'employees.user_detail_uuid' )
        ->join('vehicles', 'vehicles.uuid', '=', 'over_burden_operators.vehicle_uuid' )
        ->join('brand_types','brand_types.uuid','=','vehicles.brand_type_uuid')
        ->join('group_vehicles','group_vehicles.uuid','=','brand_types.group_vehicle_uuid')
        // ->join('brands','brands.uuid','=','brand_types.brand_uuid')
        ->join('units','units.uuid','=','brand_types.unit_uuid')
        ->join('vehicle_hms','vehicle_hms.uuid','=','brand_types.vehicle_hm_uuid')
        ->where('over_burden_operators.over_burden_uuid', $overBurden_uuid)
        ->get([
            'over_burden_operators.uuid',
            'over_burden_operators.capacity',
            'employees.nik_employee',
            'user_details.name',
            'over_burden_lists.over_burden_time',

            'vehicles.number',
            'vehicles.uuid',
            'brand_types.capacity',
            'brand_types.type',
            'group_vehicles.group_name',
            'group_vehicles.group_code',
            'units.unit',
            'vehicle_hms.hm_name',
            'brands.brand',
        ]);
    }
    public static function getListFlit($overBurden_uuid){
        return $over_burden_lists = $over_burden_lists = DB::table('over_burden_lists')
        ->join('over_burden_operators', 'over_burden_operators.uuid', '=', 'over_burden_lists.over_burden_operator_uuid' )
        ->join('employees', 'employees.uuid', '=',  'over_burden_operators.operator_employee_uuid' )
        ->join('user_details', 'user_details.uuid', '=', 'employees.user_detail_uuid' )
        ->join('over_burden_flits', 'over_burden_flits.uuid', '=', 'over_burden_lists.over_burden_flit_uuid' )
        ->join('vehicles as v', 'v.uuid', '=', 'over_burden_operators.vehicle_uuid' )
        ->join('brand_types as bv','bv.uuid','=','v.brand_type_uuid')
        ->join('group_vehicles as gv','gv.uuid','=','bv.group_vehicle_uuid')

        ->join('vehicles as ve', 've.uuid', '=','over_burden_flits.excavator_vehicle_uuid' )
        ->join('brand_types as be','be.uuid','=','ve.brand_type_uuid')
        ->join('group_vehicles as ge','ge.uuid','=','be.group_vehicle_uuid')
        ->where('over_burden_operators.over_burden_uuid', $overBurden_uuid)
        ->get([
            'over_burden_operators.uuid',
            'over_burden_operators.capacity',

            'employees.nik_employee',
            'user_details.name',

            'v.number',
            'gv.group_code',
            'gv.group_name',
            've.number as number_excavator',
            'ge.group_code as group_code_excavator',
            'ge.group_name as group_name_excavator',
            'over_burden_lists.over_burden_time',
        ]);
    }
}
