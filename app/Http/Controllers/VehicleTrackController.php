<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\VehicleTrack;

class VehicleTrackController extends Controller
{
    function unLast($vehicle_id){
        $updated = VehicleTrack::where('last', 1)
                                            ->where('vehicle_id', $vehicle_id )
                                            ->update([
                                                'last'  => 0
                                            ]);
    }
    public function updatessss($vehicle_id, $hour_meter){
        app('App\Http\Controllers\VehicleTrackController')->unLast($vehicle_id);
         $datetime = Carbon::now('Asia/Jakarta');
        $created = VehicleTrack::create([
            'vehicle_id'    => $vehicle_id,
            'hour_meter'    => $hour_meter,
            'datetime'  => $datetime,
            'last'  => 1
        ]);
    }
    
}
