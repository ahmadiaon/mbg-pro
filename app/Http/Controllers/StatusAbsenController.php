<?php

namespace App\Http\Controllers;

use App\Models\StatusAbsen;
use Illuminate\Http\Request;

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
}
