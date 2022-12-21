<?php

namespace App\Http\Controllers\Vehicle;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Safety\AtributSize;
use App\Models\Vehicle\Brand;
use App\Models\Vehicle\BrandType;
use App\Models\Vehicle\GroupVehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrandTypeController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'group-vehicle'
        ];

        $atribut_sizes = AtributSize::where('size','unit')->get();
        $group_vehicles = GroupVehicle::all();
        $brands = Brand::all();

        return view('BrandType.index', [
            'title'         => 'Type Brand',
            'layout'    => $layout,
            'atribut_sizes' => $atribut_sizes,
            'group_vehicles' => $group_vehicles,
            'brands' => $brands,
        ]);
    }

    public function delete(Request $request)
    {
         $store = BrandType::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data BrandType  deleted');
    }


    public function anyData(){
        $data = BrandType::join('brands','brands.uuid', 'brand_types.brand_uuid')
        ->join('group_vehicles','group_vehicles.uuid', 'brand_types.group_vehicle_uuid')
        ->join('atribut_sizes','atribut_sizes.uuid', 'brand_types.atribut_size_uuid')
        ->get([
            'brands.brand',
            'group_vehicles.group_name',
            'brand_types.*'
        ]);
        return DataTables::of($data)    
        ->make(true);
    }


    public function store(Request $request){
        

        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->brand_uuid.'-'.$request->type.'-'.$request->group_vehicle_uuid);
        }
        
        // return ResponseFormatter::toJson($request->all(), 'Data Stored');
        $strore = BrandType::updateOrCreate(['uuid' => $request->uuid], 
        [
            'atribut_size_uuid' => $request->atribut_size_uuid,
            'group_vehicle_uuid' => $request->group_vehicle_uuid,
            'vehicle_hm_uuid' => $request->vehicle_hm_uuid,
            'brand_uuid' => $request->brand_uuid,
            'vehicle_hm_uuid' => $request->vehicle_hm_uuid,
            'type' => $request->type,
            'capacity' => ResponseFormatter::toFloat($request->capacity)
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

  
    public function show(Request $request){
        $data = BrandType::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }
}
