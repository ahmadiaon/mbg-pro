<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Location;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LocationController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'Location'
        ];

        return view('Location.index', [
            'title'         => 'Location',
            'layout'    => $layout
        ]);
    }

    public function delete(Request $request)
    {
         $store = Location::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }


    public function anyData(){
        $data = Location::all();
        return DataTables::of($data)    
        ->make(true);
    }


    public function store(Request $request){
        $location = $request->location;

        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->location);
        }
        $strore = location::updateOrCreate(['uuid' => $request->uuid], 
        [
            'location' => $request->location,
            'date_start'    => $request->date_start,
            'date_end'    => $request->date_end,
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

  
    public function show(Request $request){
        $data = Location::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    
    public function destroy($Location)
    {
        $data = Location::where('id', $Location)->first();
        $post= Location::find($Location)->delete();
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $data], 200);

    }
}
