<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\HourMeterPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class HourMeterPriceController extends Controller
{
    public function index(){
        // return 'aa';
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'hour-meter-price'
        ];
        return view('hour_meter_price.index', [
            'title'         => 'Purchase Order',
            'layout'    => $layout,
        ]);
    }

    public function anyData(){
        $data = HourMeterPrice::orderBy('updated_at', 'asc')->get();

        
        return Datatables::of($data)
        ->addColumn('action', function ($model) {
            $uuid = $model->uuid;
            $delete = "'".$uuid."'";
            return '
            <div class="form-inline"> 
                <button onclick="editPrivilege('.$delete.')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
                    <i class="dw dw-edit2"></i>
                </button>
                <button onclick="deletePrivilege(' .$delete. ')"  type="button" class="btn btn-danger  py-1 px-2">
                    <i class="icon-copy dw dw-trash"></i>
                </button>
            </div>'
            ;
        })      
        ->make(true);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'uuid' =>'',
            'name' =>'',
            'value' =>'',
            'key_excel' =>'',
            'use_start' =>'',
            'use_end' =>'',
        ]);
        if(empty($request->uuid)){
            $validatedData['uuid']  = strtolower(str_replace(' ','-',$validatedData['key_excel'] ) .'-'.rand(99,9999));
        }

        $store = HourMeterPrice::updateOrCreate(['uuid'=> $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($validatedData, 'Data Stored');
    }

    public function delete(Request $request)
    {
         $store = HourMeterPrice::where('uuid',$request->uuid)->delete();
 
         return response()->json(['code'=>200, 'message'=>'Data Deleted','data' => $store], 200);   
    }

    public function show(Request $request){
        $data = HourMeterPrice::where('uuid', $request->uuid)->get()->first();

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }



    public function indexPayrol(){
        $hour_meter_prices = HourMeterPrice::all();
        // dd($hour_meter_prices);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'mobilisasi'
        ];
        return view('hour_meter_price.payrol.index', [
            'title'         => 'Status Absen',
            'hour_meter_prices' => $hour_meter_prices,
            'layout'    => $layout
        ]);
   }
   public function storePayrol(Request $request)
   {
    $validatedData = $request->validate([
           'uuid'      => '',
           'name' =>'',
           'value' =>'',
           'key_excel' =>'',  
           'use_start'      => '',
           'use_end'      => ''
       ]);
       if(!$validatedData['uuid']){
            $validatedData['uuid'] = "hmp-".Str::uuid();
        }
        $store = HourMeterPrice::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return response()->json(['code'=>200, 'message'=>'Data Stored','data' => $store], 200);   
   }
   public function showPayrol($uuid)
   {
        $status_absen = HourMeterPrice::where('uuid', $uuid)->first();

        return response()->json(['code'=>200, 'message'=>'Data get','data' => $status_absen], 200);   
   }
}
