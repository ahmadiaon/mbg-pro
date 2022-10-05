<?php

namespace App\Http\Controllers;

use App\Models\HourMeterPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HourMeterPriceController extends Controller
{
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
