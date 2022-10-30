<?php

namespace App\Http\Controllers;

use App\Models\StatusAbsen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class StatusAbsenController extends Controller
{
    public function indexPayrol(){
        // return 'aa';
        $status_absen = StatusAbsen::all();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'database-status-absen'
        ];
        return view('status_absen.index', [
            'title'         => 'Status Absen',
            'status_absen' => $status_absen,
            'layout'    => $layout
        ]);
   }
   public function anyData(){
        $data = StatusAbsen::orderBy('updated_at', 'asc')->get();

        return Datatables::of($data)
        ->addColumn('action', function ($model) {
            $uuid = $model->uuid;
            $delete = "'".$uuid."'";
            return '
            <div class="form-inline"> 
                <button onclick="edit('.$delete.')" type="button" class="btn btn-outline-primary mr-1">
                <i class="icon-copy ion-wrench"></i>
                </button>
                <button onclick="deletePrivilege(' .$delete. ')"  type="button" class="btn btn-outline-danger">
                <i class="icon-copy ion-trash-b"></i> 
                </button>
            </div>'
            ;
        })      
        ->make(true);
    }
   public function storePayrol(Request $request)
   {
    $validatedData = $request->validate([
           'uuid'      => '',
           'status_absen_code'      => '',
           'status_absen_description'      => '',
           'math'      => '',
           'use_start'      => '',
           'use_end'      => ''
       ]);
        $validatedData['uuid'] = $validatedData['status_absen_code'];
        $store = StatusAbsen::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return response()->json(['code'=>200, 'message'=>'Data Stored','data' => $store], 200);   
   }
   public function showPayrol($uuid)
   {
        $status_absen = StatusAbsen::where('uuid', $uuid)->first();

        return response()->json(['code'=>200, 'message'=>'Data get','data' => $status_absen], 200);   
   }
   public function delete(Request $request)
    {
         $data = ['deleted_at'=>Carbon::now('Asia/Jakarta')];
         $store = StatusAbsen::where('uuid',$request->uuid)->delete();
 
         return response()->json(['code'=>200, 'message'=>'Data Deleted','data' => $store], 200);   
    }
}
