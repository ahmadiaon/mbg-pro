<?php

namespace App\Http\Controllers\Vehicle;

use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\Status;
use App\Models\Vehicle\VehicleTrack;
use App\Models\Location;
use App\Models\Vehicle\BrandType;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Models\Safety\AtributSize;
use App\Models\Vehicle\VehicleLocation;
use App\Models\Vehicle\VehicleStatus;

class VehicleController extends Controller
{
    //
    public function index(){
         $brandTypes =BrandType::getAll();
         $brandTypes = $brandTypes->keyBy(function ($item) {
            return strval($item->uuid);
        });

         $locations =Location::getAll();
         $locations = $locations->keyBy(function ($item) {
            return strval($item->uuid);
        });

        $statuses =Status::getAll();
        $statuses = $statuses->keyBy(function ($item) {
            return strval($item->uuid);
        });
        
        $atribut_sizes =AtributSize::where('size', 'unit')->get();
        $atribut_sizes = $atribut_sizes->keyBy(function ($item) {
            return strval($item->uuid);
        });

        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'logistic-unit'
        ];
        $data = [
            'layout' => $layout,
            'brand_types'   => $brandTypes,
            'locations'     => $locations,
            'statuses'    =>$statuses,
            'atribut_sizes' => $atribut_sizes,
            'title'     => 'Unit'
        ];
        return view('logistic.unit.index', $data);
    }

    public function store(Request $request){
        
        
        $vehicle_uuid = ResponseFormatter::toUUID($request->brand_type_uuid.'-'.$request->number);
        // return ResponseFormatter::toJson($request->all(), 'Data Privilege');
        // $date_start = ResponseFormatter::toDate($request->date_start);
        $storeVehicle = Vehicle::updateOrCreate(['uuid' => $vehicle_uuid],[
            'brand_type_uuid' => $request->brand_type_uuid,
            'number'    => $request->number,
            'capacity'    => $request->capacity,
        ]);

        $vehicle_status_uuid = $storeVehicle->uuid.'-'.$request->date_start.'-'.$request->status_uuid;

        
        $storeVehicleStatus = VehicleStatus::updateOrCreate(['uuid' => $vehicle_status_uuid],
            [
            'vehicle_uuid' => $storeVehicle->uuid,
            'status_uuid' => $request->status_uuid,
            'date_start' => $request->date_start,
        ]);

        $vehicle_location_uuid = $storeVehicle->uuid.'-'.$request->date_start.'-'.$request->location_uuid;

        $storeVehicleLocation = VehicleLocation::updateOrCreate(['uuid' => $vehicle_location_uuid],
        [
            'vehicle_uuid' => $storeVehicle->uuid,
            'location_uuid' => $request->location_uuid,
            'date_start' => $request->date_start,
        ]);

        $vehicle_track_uuid =  $storeVehicle->uuid.'-'.$request->date_start.'-'.$request->location_uuid;

        $dateTime = $request->date_start.' 00:00:00';
        $vehicle_track_uuid = $storeVehicle->uuid.'-'.$request->date_start.'-'.$dateTime;

        $dataVehicleTrack=[
            'vehicle_uuid'  => $storeVehicle->uuid,
            'hm'    =>  ($request->vehicle_hm_uuid == 'hm')?$request->vehicle_track_value:0,
            'km'    =>  ($request->vehicle_hm_uuid == 'km')?$request->vehicle_track_value:0,
            'datetime'  => $dateTime
        ];
       

        $storeVehicleTrack = VehicleTrack::updateOrCreate(['uuid' => $vehicle_track_uuid],$dataVehicleTrack);

        
        
        $with = [
            'storeVehicle' => $storeVehicle,
            'storeVehicleLocation' => $storeVehicleLocation,
            'storeVehicleStatus' => $storeVehicleStatus,
            'storeVehicleTrack' => $storeVehicleTrack,
        ];
        return ResponseFormatter::toJson($with, 'Data Privilege');
    }

    public function anyData(){
        $data = Vehicle::join('brand_types', 'brand_types.uuid', 'vehicles.brand_type_uuid')
        ->join('group_vehicles', 'group_vehicles.uuid', 'brand_types.group_vehicle_uuid')
        ->join('vehicle_locations', 'vehicle_locations.vehicle_uuid', 'vehicles.uuid')
        ->join('vehicle_statuses', 'vehicle_statuses.vehicle_uuid', 'vehicles.uuid')
        ->join('statuses', 'statuses.uuid', 'vehicle_statuses.status_uuid')
        ->join('brands','brands.uuid', 'brand_types.brand_uuid')
        ->join('locations', 'locations.uuid', 'vehicle_locations.location_uuid')
        ->get([
            'brands.brand',
            'statuses.status',
            'locations.location',
            'group_vehicles.group_name',
            'group_vehicles.group_code',
            'brand_types.*',
            'vehicles.*'
        ]);
        
        // dd($data);
        return Datatables::of($data)
        ->make(true);
    }

    public function delete(Request $request)
    {
         $store = Vehicle::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Brand  deleted');
    }

    public function show(Request $request){
        $data = Vehicle::join('brand_types', 'brand_types.uuid', 'vehicles.brand_type_uuid')
        ->join('group_vehicles', 'group_vehicles.uuid', 'brand_types.group_vehicle_uuid')
        ->join('vehicle_locations', 'vehicle_locations.vehicle_uuid', 'vehicles.uuid')
        ->join('vehicle_statuses', 'vehicle_statuses.vehicle_uuid', 'vehicles.uuid')
        ->join('statuses', 'statuses.uuid', 'vehicle_statuses.status_uuid')
        ->join('brands','brands.uuid', 'brand_types.brand_uuid')
        ->join('locations', 'locations.uuid', 'vehicle_locations.location_uuid')
        ->join('vehicle_tracks', 'vehicle_tracks.vehicle_uuid', 'vehicles.uuid')
        ->where('vehicles.uuid', $request->uuid)
        ->get([
            'vehicle_tracks.hm',
            'vehicle_tracks.km',
            'brands.brand',
            'statuses.status',
            'locations.location',
            'locations.uuid as location_uuid',
            'group_vehicles.group_name',
            'group_vehicles.group_code',
            'brand_types.*',
            'vehicle_statuses.date_start',
            'vehicles.*'
        ])->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }
}
