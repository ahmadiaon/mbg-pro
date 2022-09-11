<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleTrack extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function unLast($vehicle_id){
        $updated = VehicleTrack::where('last', 1)
                                            ->where('vehicle_uuid', $vehicle_id )
                                            ->update([
                                                'last'  => 0
                                            ]);
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
