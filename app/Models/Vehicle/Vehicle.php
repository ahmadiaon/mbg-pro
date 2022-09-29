<?php

namespace App\Models\Vehicle;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Vehicle extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function getVehicle(){
        return Vehicle::join('brand_types','brand_types.uuid','=','vehicles.brand_type_uuid')
        ->join('group_vehicles','group_vehicles.uuid','=','brand_types.group_vehicle_uuid')
        ->join('brands','brands.uuid','=','brand_types.brand_uuid')
        ->join('units','units.uuid','=','brand_types.unit_uuid')
        ->join('vehicle_hms','vehicle_hms.uuid','=','brand_types.vehicle_hm_uuid')
        ->get([
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
    public static function getVehicleGroup(){
        return Vehicle::join('brand_types','brand_types.uuid','=','vehicles.brand_type_uuid')
        ->join('group_vehicles','group_vehicles.uuid','=','brand_types.group_vehicle_uuid')
        ->join('brands','brands.uuid','=','brand_types.brand_uuid')
        ->join('units','units.uuid','=','brand_types.unit_uuid')
        ->join('vehicle_hms','vehicle_hms.uuid','=','brand_types.vehicle_hm_uuid')
        ->get([
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

    

    
   
}
