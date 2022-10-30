<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Payment\PaymentGroup;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PaymentGroupController extends Controller
{
    public function index(){
        // return 'aa';
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'payment-group'
        ];
        return view('payment_group.index', [
            'title'         => 'Purchase Order',
            'layout'    => $layout,
            'payment_groups' => ''
        ]);
    }

    public function anyData(){
        $data = PaymentGroup::orderBy('updated_at', 'asc')->get();
        return Datatables::of($data)
        ->make(true);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'uuid' =>'',
            'payment_group' =>'',
            'status_data' =>'',
            'is_last' =>'',
        ]);

        if(empty($validatedData['uuid'])){
            $validatedData['uuid'] = strtolower(str_replace(' ','-',$validatedData['payment_group'] ));
        }

        $store = PaymentGroup::updateOrCreate(['uuid'=> $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, 'Data Stored');
    }

    public function delete(Request $request)
    {
         $store = PaymentGroup::where('uuid',$request->uuid)->delete();
 
         return response()->json(['code'=>200, 'message'=>'Data Deleted','data' => $store], 200);   
    }

    public function show(Request $request){
        $data = PaymentGroup::where('uuid', $request->uuid)->get()->first();

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }
}
