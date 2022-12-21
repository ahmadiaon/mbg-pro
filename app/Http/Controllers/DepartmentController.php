<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DepartmentController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'department'
        ];

        return view('department.index', [
            'title'         => 'Department',
            'layout'    => $layout
        ]);
    }

    public function delete(Request $request)
    {
         $store = Department::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }


    public function anyData(){
        $data = Department::all();
        return DataTables::of($data)    
        ->make(true);
    }


    public function store(Request $request){
        $Department = $request->department;

        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->department);
        }
        $strore = Department::updateOrCreate(['uuid' => $request->uuid], 
        [
            'department' => $request->department,
            'date_start'    => $request->date_start,
            'date_end'    => $request->date_end,
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

  
    public function show(Request $request){
        $data = Department::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    
    public function destroy($Department)
    {
        $data = Department::where('id', $Department)->first();
        $post= Department::find($Department)->delete();
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $data], 200);

    }
}
