<?php

namespace App\Http\Controllers\Safety;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Safety\AtributSize;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AtributSizeController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'atribut-size'
        ];

        return view('AtributSize.index', [
            'title'         => 'Satuan',
            'layout'    => $layout
        ]);
    }

    public function delete(Request $request)
    {
         $store = AtributSize::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }


    public function anyData(){
        $data = AtributSize::all();
        return DataTables::of($data)    
        ->make(true);
    }


    public function store(Request $request){

        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->uuid);
        }
        $strore = AtributSize::updateOrCreate(['uuid' => $request->uuid], 
        [
            'size' => $request->size,
            'date_start'    => $request->date_start,
            'date_end'    => $request->date_end,
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

  
    public function show(Request $request){
        $data = AtributSize::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

}
