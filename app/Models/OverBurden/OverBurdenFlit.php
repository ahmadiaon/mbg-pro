<?php

namespace App\Models\OverBurden;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OverBurdenFlit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getFlits($overBurden_uuid){
        return DB::table('over_burden_flits')
        ->join('vehicles', 'vehicles.uuid', '=','over_burden_flits.excavator_vehicle_uuid' )
        ->join('brand_types','brand_types.uuid','=','vehicles.brand_type_uuid')
        ->join('group_vehicles','group_vehicles.uuid','=','brand_types.group_vehicle_uuid')
        ->join('brands','brands.uuid','=','brand_types.brand_uuid')
        ->join('units','units.uuid','=','brand_types.unit_uuid')
        ->join('vehicle_hms','vehicle_hms.uuid','=','brand_types.vehicle_hm_uuid')
        ->where('over_burden_flits.over_burden_uuid', $overBurden_uuid)
        ->get([
            'vehicles.number',
            'over_burden_flits.uuid',
            'brand_types.capacity',
            'brand_types.type',
            'group_vehicles.group_name',
            'group_vehicles.group_code',
            'units.unit',
            'vehicle_hms.hm_name',
            'brands.brand',
        ]);
    }
}
