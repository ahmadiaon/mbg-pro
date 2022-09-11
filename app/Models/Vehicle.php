<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getAll(){
       return Vehicle::join('vehicle_groups', 'vehicle_groups.uuid', '=', 'vehicles.vehicle_group_uuid')
        ->join('unit_groups',  'unit_groups.uuid','=', 'vehicle_groups.unit_group_uuid')
        ->get(['vehicle_groups.vehicle_group','vehicle_groups.vehicle_code', 'vehicles.*', 'unit_groups.unit_group']);
    }

    public static function vehicleGroup($group){
        return Vehicle::join('vehicle_groups', 'vehicle_groups.uuid', '=', 'vehicles.vehicle_group_uuid')
        ->where('vehicle_groups.vehicle_group', $group)
        ->get([
            'vehicle_groups.*',
            'vehicle_groups.uuid as vehicle_group_uuid',
            'vehicles.uuid as vehicles_uuid',
             'vehicles.*'
            ]);

    }
}
