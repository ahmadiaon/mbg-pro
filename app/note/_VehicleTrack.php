<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;
class VehicleTrack extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function unLast($vehicle_id){
        
    }

    public static function updateHM($vehicle_id, $hour_meter){
        VehicleTrack::unLast($vehicle_id);
         $datetime = Carbon::now('Asia/Jakarta');
        $created = VehicleTrack::create([
            'uuid'  => 'vehicle-track-.'.Str::uuid(),
            'vehicle_uuid'    => $vehicle_id,
            'hour_meter'    => $hour_meter,
            'datetime'  => $datetime,
            'last'  => 1
        ]);
    }
}
