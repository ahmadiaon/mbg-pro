<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\CoalFrom;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CoalFromController extends Controller
{
    public function index(){
        // return 'aa';
        $companies = Company::all();
        // dd($companies);
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'coal-from'
        ];
        return view('coal_from.index', [
            'title'         => 'Purchase Order',
            'layout'    => $layout,
            'companies' => $companies
        ]);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
           'uuid'=> '',
           'company_uuid'=> '',
           'coal_from'=> '',
           'hauling_price'=> '',            
            'use_start'=> '',
            'use_end'=> '',
            'is_last'=> '',
        ]);
        if($validatedData['uuid']){
            $coal_from = CoalFrom::where('uuid',$request->uuid)->get()->first();
            if($validatedData['hauling_price'] != $coal_from->hauling_price){
                $validatedData['uuid'] = strtolower(str_replace(' ','-',$validatedData['company_uuid'] )).'-'.strtolower(str_replace(' ','-',$validatedData['coal_from'] ).'-'.$validatedData['hauling_price'] );
                $validatedData['is_last'] = 1;
            }
        }else{
            $validatedData['uuid'] = strtolower(str_replace(' ','-',$validatedData['company_uuid'] )).'-'.strtolower(str_replace(' ','-',$validatedData['coal_from'] ).'-'.$validatedData['hauling_price'] );
            $validatedData['is_last'] = 1;
        }
       

        $store = CoalFrom::updateOrCreate(['uuid'=> $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, 'Data Stored');
    }
    public function anyData(){
        $data = CoalFrom::join('companies','companies.uuid','coal_froms.company_uuid')
        ->orderBy('coal_froms.updated_at', 'asc')
        ->get([
            'companies.name',
            'coal_froms.*'
        ]);

        
        return Datatables::of($data)    
        ->make(true);
    }
    public function delete(Request $request)
    {
         $store = CoalFrom::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }
    public function show(Request $request){
        $data = CoalFrom::where('uuid', $request->uuid)->get()->first();

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }
}
