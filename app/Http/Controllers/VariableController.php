<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Variable;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VariableController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'variable'
        ];
        return view('variable.index', [
            'title'         => 'Variable',
            'layout'    => $layout
        ]);
    }

    public function anyData(){
        $data = Variable::all();
        return DataTables::of($data)    
        ->make(true);
    }
    public function show(Request $request){
        $data = Variable::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    public function delete(Request $request)
    {
         $store = Variable::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }


    public function store(Request $request){
        $variable_name = $request->variable_name;
        $variable_code = $request->variable_code;

        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->variable_name);
        }
        $strore = Variable::updateOrCreate(['uuid' => $request->uuid], 
        [
            'variable_name' => $request->variable_name,
            'variable_code' => $request->variable_code,
            'date_start'    => $request->date_start,
            'date_end'    => $request->date_end,
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

}
