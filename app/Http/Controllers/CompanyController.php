<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\CoalFrom;
use App\Models\CoalType;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class CompanyController extends Controller
{
    public function index(){
        // return 'aa';
        $coal_types = CoalType::all();
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'company'
        ];
        return view('company.index', [
            'title'         => 'Perusahaan',
            'coal_types'    => $coal_types,
            'layout'    => $layout,
        ]);
    }

    public function anyData(){
        $data = Company::join('coal_types','coal_types.uuid', 'companies.coal_type_uuid')->orderBy('updated_at', 'asc')
        ->get([
            'companies.*',
            'coal_types.type_name as calorie'
        ]);

        // dd($data);
        return Datatables::of($data)
        ->make(true);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'uuid' =>'',
            'coal_type_uuid' =>'',
            'company' =>'',
            'long_company' =>'',
            'use_start' =>'',
            'use_end' =>'',
            'default_price' =>'',
        ]);
        if(empty($request->uuid)){
            $validatedData['uuid']  = strtoupper(str_replace(' ','-',str_replace('.','-',$validatedData['company'] )) );
            $store = Company::updateOrCreate(['uuid'=> $validatedData['uuid']], $validatedData);

            $coal_from = CoalFrom::create([
                'uuid'  => $store->uuid,
                'company_uuid' => $store->uuid,
                'coal_from' => $store->long_company,
                'hauling_price' => $validatedData['default_price'],
                'use_start' =>  $validatedData['use_start'],
            ]);
        }else{
            $store = Company::updateOrCreate(['uuid'=> $validatedData['uuid']], $validatedData);
        }

        
        return ResponseFormatter::toJson($validatedData, 'Data Stored');
    }

    public function delete(Request $request)
    {
         $store = Company::where('uuid',$request->uuid)->delete();
 
         return response()->json(['code'=>200, 'message'=>'Data Deleted','data' => $store], 200);   
    }

    public function show(Request $request){
        $data = Company::where('uuid', $request->uuid)->get()->first();

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }



    public function indexPayrol(){
        $hour_meter_prices = Company::all();
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
        $store = Company::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return response()->json(['code'=>200, 'message'=>'Data Stored','data' => $store], 200);   
   }
   public function showPayrol($uuid)
   {
        $status_absen = Company::where('uuid', $uuid)->first();

        return response()->json(['code'=>200, 'message'=>'Data get','data' => $status_absen], 200);   
   }
}
