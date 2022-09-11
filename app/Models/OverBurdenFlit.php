<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OverBurdenFlit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getFlits($overBurden_uuid){
        return DB::table('over_burden_flits')
        ->join('vehicles', 'vehicles.uuid', '=','over_burden_flits.excavator_vehicle_uuid' )
        ->join('vehicle_groups', 'vehicle_groups.uuid', '=', 'vehicles.vehicle_group_uuid')
        ->where('over_burden_flits.over_burden_uuid', $overBurden_uuid)
        ->get(['vehicle_groups.vehicle_code', 'vehicles.number','over_burden_flits.uuid']);
    }
}
