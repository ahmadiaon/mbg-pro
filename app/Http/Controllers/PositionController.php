<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Position;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'position'
        ];
        return view('position.index', [
            'title'         => 'Jabatan',
            'layout'    => $layout
        ]);
    }

    public function delete(Request $request)
    {
         $store = Position::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }


    public function anyData(){
        $data = Position::all();
        return DataTables::of($data)    
        ->make(true);
    }


    public function store(Request $request){
        $position = $request->position;

        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->position);
        }
        $strore = Position::updateOrCreate(['uuid' => $request->uuid], 
        [
            'position' => $request->position,
            'date_start'    => $request->date_start,
            'date_end'    => $request->date_end,
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

  
    public function show(Request $request){
        $data = Position::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    

    
  

   
    public function destroy($position)
    {
        $data = Position::where('id', $position)->first();
        $post= Position::find($position)->delete();
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $data], 200);

    }
}
