<?php

namespace App\Models\Vehicle;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VehicleTrack extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function updateTrack($vehicle_uuid, $hour_meter){
         $datetime = Carbon::now('Asia/Jakarta');

        $updated = VehicleTrack::where('is_last', 1)
                                        ->where('vehicle_uuid', $vehicle_uuid )
                                        ->update([
                                            'is_last'  => 0
                                        ]);
        $created = VehicleTrack::create([
            'uuid'  => 'vehicle-track-.'.Str::uuid(),
            'vehicle_uuid'    => $vehicle_uuid,
            'hm'    => $hour_meter,
            'datetime'  => $datetime,
            'is_last'  => 1
        ]);
        return $created;
    }
    public static function findUuid($vehicle_uuid){
        return VehicleTrack::where('vehicle_uuid', $vehicle_uuid)
        ->where('is_last',1)->get()->first();
    }
}
