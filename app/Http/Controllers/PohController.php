<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Poh;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PohController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'poh'
        ];
        return view('poh.index', [
            'title'         => 'Daftar POH',
            'layout'    => $layout
        ]);
    }
    public function anyData(){
        $data = Poh::all();
        return DataTables::of($data)    
        ->make(true);
    }
    public function show(Request $request){
        $data = Poh::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    public function delete(Request $request)
    {
         $store = Poh::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }


    public function store(Request $request){
        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->name);
        }
        $strore = Poh::updateOrCreate(['uuid' => $request->uuid], 
        [
            'name' => $request->name,
            'value' => $request->value,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

}
