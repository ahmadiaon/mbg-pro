<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\PaymentGroup;
use Illuminate\Http\Request;

class PaymentGroupController extends Controller
{
    public function indexPayrol(){
        $payments = PaymentGroup::all()->where('status_data','!=', 'delete');
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'payment'
        ];
        return view('payment_group.payrol.index', [
            'title'         => 'Payment',
            'payments'  => $payments,
            'layout'    => $layout
        ]);
   }
   public function storePayrol(Request $request)
   {
    $validatedData = $request->validate([
           'uuid'      => '',
           'payment_group'      => '',
       ]);
       if(!$validatedData['uuid']){
         $validatedData['uuid'] = $validatedData['payment_group'];
       }
        
        $store = PaymentGroup::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return response()->json(['code'=>200, 'message'=>'Data Stored','data' => $validatedData], 200);   
   }
   public function showPayrol($uuid)
   {
        $payments = PaymentGroup::where('uuid', $uuid)->first();

        return response()->json(['code'=>200, 'message'=>'Data get','data' => $payments], 200);   
   }

   public function deletePayrol($uuid)
   {
        $data = ['status_data'=>'delete'];
        $store = PaymentGroup::updateOrCreate(['uuid' => $uuid], $data);

        return response()->json(['code'=>200, 'message'=>'Data get','data' => $store], 200);   
   }
}
