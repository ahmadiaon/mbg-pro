<?php

namespace App\Http\Controllers\Privilege;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Privilege\Privilege;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PrivilegeController extends Controller
{
    public function index(){
        // return 'aa';
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'privilege'
        ];
        return view('database.index', [
            'title'         => 'Purchase Order',
            'layout'    => $layout,
        ]);
    }

    public function anyData(){
        $data = Privilege::orderBy('updated_at', 'asc')->whereNull('deleted_at')->get();

        
        return Datatables::of($data)
        ->addColumn('action', function ($model) {
            $uuid = $model->uuid;
            $delete = "'".$uuid."'";
            return '
            <div class="form-inline"> 
                <button onclick="editPrivilege('.$delete.')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
                    <i class="dw dw-edit2"></i>
                </button>
                <button onclick="deletePrivilege(' .$delete. ')"  type="button" class="btn btn-danger  py-1 px-2">
                    <i class="icon-copy dw dw-trash"></i>
                </button>
            </div>'
            ;
        })      
        ->make(true);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'uuid' =>'',
            'privilege' =>'',
        ]);

        $store = Privilege::updateOrCreate(['uuid'=> $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, 'Data Stored');
    }

    public function delete(Request $request)
    {
         $data = ['deleted_at'=>Carbon::now('Asia/Jakarta')];
         $store = Privilege::updateOrCreate(['uuid' => $request->uuid], $data);
 
         return response()->json(['code'=>200, 'message'=>'Data Deleted','data' => $store], 200);   
    }

    public function show(Request $request){
        $data = Privilege::where('uuid', $request->uuid)->where('deleted_at','=',null)->get()->first();

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }
}
