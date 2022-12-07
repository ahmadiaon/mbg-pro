<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Premi;
use Yajra\Datatables\Datatables;
use App\Helpers\ResponseFormatter;
use App\Models\ProductionPremi;
use App\Models\TaxStatus;

class TaxStatusController extends Controller
{
    //
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'tax-status'
        ];
        return view('tax_status.index', [
            'title'         => 'Tax Status',
            'layout'    => $layout
        ]);
    }
    public function anyData(){
        $data = TaxStatus::all();
        return Datatables::of($data)    
        ->make(true);
    }
    public function show(Request $request){
        $data = TaxStatus::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    public function delete(Request $request)
    {
         $store = TaxStatus::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }


    public function store(Request $request){
        // $data = $request->all();
        $tax_status_name = $request->tax_status_name;
        $tax_status_value = $request->tax_status_value;

        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->tax_status_name);
        }
        $strore = TaxStatus::updateOrCreate(['uuid' => $request->uuid], 
        [
            'tax_status_name' => $request->tax_status_name,
            'tax_status_value' => $request->tax_status_value,
            'date_start'    => $request->date_start,
            'date_end'    => $request->date_end,
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }
}
