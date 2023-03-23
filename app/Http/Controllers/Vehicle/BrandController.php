<?php

namespace App\Http\Controllers\Vehicle;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle\Brand;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'brand'
        ];

        return view('Brand.index', [
            'title'         => 'Brand',
            'layout'    => $layout
        ]);
    }

    public function delete(Request $request)
    {
         $store = Brand::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Brand  deleted');
    }


    public function anyData(){
        $data = Brand::all();
        return DataTables::of($data)    
        ->make(true);
    }


    public function store(Request $request){
        $validateData = $request->all();
        if(empty($validateData['uuid'])){
            $validateData['uuid'] = ResponseFormatter::toUUID($request->brand);
        }
        $strore = Brand::updateOrCreate(['uuid' => $validateData['uuid']], 
        [
            'brand' => $request->brand,
            'date_start'    => $request->date_start,
            'date_end'    => $request->date_end,
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

  
    public function show(Request $request){
        $data = Brand::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }
}
