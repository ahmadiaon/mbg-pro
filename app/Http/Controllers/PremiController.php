<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Company;
use App\Models\Premi;
use App\Models\ProductionPremi;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PremiController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'premi'
        ];
        $companies = Company::all();
        return view('premi.index', [
            'title'         => 'Premi',
            'layout'    => $layout,
            'companies' => $companies
        ]);
    }
    public function anyData(){
        $data = Premi::all();
        return Datatables::of($data)    
        ->make(true);
    }
    public function show(Request $request){
        $data = Premi::where('uuid', $request->uuid)->get()->first();

        if($data){
            $data->production_premis = ProductionPremi::where('premi_uuid', $data->uuid)->get();
        }

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    public function delete(Request $request)
    {
         $store = Premi::where('uuid',$request->uuid)->delete();
         $delete = ProductionPremi::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }


    public function store(Request $request){
        // $data = $request->all();
        $premi_name = $request->premi_name;

        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->premi_name);
        }
        $strore = Premi::updateOrCreate(['uuid' => $request->uuid], 
        [
            'premi_name' => $request->premi_name,
            'date_start'    => $request->date_start,
            'date_end'    => $request->date_end,
        ]);

        $data = $request->except(['uuid','premi_name','_token','date_start','date_end']);
        foreach($data as $item=>$value){
            ProductionPremi::updateOrCreate(
            [
                'uuid'  => $request->uuid.'-'.$value
            ],
            [
                'premi_uuid' => $strore->uuid,
                'company_uuid'    => $value
            ]);
        }
        
        return ResponseFormatter::toJson($data, 'Data Stored');
    }
}
