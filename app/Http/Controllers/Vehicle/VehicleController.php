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
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Vehicle\VehicleStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    //
    public function index(){
         $brandTypes =BrandType::getAll();
         $locations =Location::getAll();
        $statuses =Status::getAll();

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
            'title'     => 'Unit'
        ];
        return view('logistic.unit.index', $data);
    }

    public function store(Request $request){
        $uuid ='vehicle-'.$request->brand_type_uuid.'-'.Str::uuid();
        $date_start = ResponseFormatter::toDate($request->date_start);
        $storeVehicle = Vehicle::create([
            'uuid'  => $uuid,
            'brand_type_uuid' => $request->brand_type_uuid,
            'number'    => $request->number,
        ]);
        
        $storeVehicleStatus = VehicleStatus::create([
            'uuid'  => 'status-vehicle-'.$storeVehicle->uuid.Str::uuid(),
            'location_uuid' => $request->location_uuid,
            'vehicle_uuid' => $storeVehicle->uuid,
            'status_uuid' => $request->status_uuid,
            'date_start' => $date_start,
        ]);
        $dataVehicleTrack=[
            'uuid'  => 'track-'.$storeVehicle->uuid,
            'vehicle_uuid'  => $storeVehicle->uuid,
            'location_uuid' => $request->location_uuid,
            'hm'    => 0,
            'km'    => 0,
            'datetime'  => Carbon::now('Asia/Jakarta'),
            'is_last'   => 1
        ];
        $storeVehicleTrack = VehicleTrack::create($dataVehicleTrack);

        $with = [
            'success' => 'Setup done'
        ];
        return redirect('/logistic/unit')->with($with);
    }

    public function anyData(){
        $data = Vehicle::getVehicle();
        return Datatables::of($data)
        ->addColumn('action', function ($model) {
            $uuid = $model->uuid;
            $url = "/logistic/unit/";
            $url_edit =$url.$uuid;
            $url_delete = $url."delete/".$uuid;
            return '
            <div class="dropdown">
                <a
                    class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                    href="#"
                    role="button"
                    data-toggle="dropdown"
                >
                    <i class="dw dw-more"></i>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                >
                    <a class="dropdown-item" href="'.$url_edit.'"
                        ><i class="dw dw-eye"></i> View</a
                    >
                    <a class="dropdown-item" href="'.$url_edit.'"
                        ><i class="dw dw-edit2"></i> Edit</a
                    >
                    <a class="dropdown-item" href="'.$url_delete.'"
                        ><i class="dw dw-delete-3"></i> Delete</a
                    >
                </div>
            </div>'
            ;
        })
        ->make(true);
    }
}
