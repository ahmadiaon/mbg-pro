<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Premi;
use Yajra\Datatables\Datatables;
use App\Helpers\ResponseFormatter;
use App\Models\PaymentOther;
use App\Models\ProductionPremi;
use App\Models\TaxStatus;

class PaymentOtherController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'payment-other'
        ];
        return view('payment_other.index', [
            'title'         => 'Satuan Pembayaran',
            'layout'    => $layout
        ]);
    }
    public function anyData(){
        $data = PaymentOther::all();
        return Datatables::of($data)    
        ->make(true);
    }
    public function show(Request $request){
        $data = PaymentOther::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Showed');
    }

    public function delete(Request $request)
    {
         $store = PaymentOther::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data deleted');
    }


    public function store(Request $request){
        // $data = $request->all();
        $payment_other_name = $request->payment_other_name;

        if(empty($request->uuid)){
            $request->uuid = ResponseFormatter::toUUID($request->payment_other_name);
        }
        $strore = PaymentOther::updateOrCreate(['uuid' => $request->uuid], 
        [
            'payment_other_name' => $request->payment_other_name,
            'date_start'    => $request->date_start,
            'date_end'    => $request->date_end,
        ]);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }
}
