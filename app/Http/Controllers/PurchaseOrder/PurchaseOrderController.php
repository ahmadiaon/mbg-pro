<?php

namespace App\Http\Controllers\PurchaseOrder;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder\Galery;
use App\Models\PurchaseOrder\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class PurchaseOrderController extends Controller
{
    public function indexAdmin(){        
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'list-purchase-order'
        ];
        return view('purchase_order.admin.index', [
            'title'         => 'Purchase Order',
            'layout'    => $layout
        ]);
    }
    public function showPublic($uuid){   
        $data_po = PurchaseOrder::where('uuid', $uuid)->get()->first();
        $galeries = Galery::where('purchase_order_uuid', $data_po->uuid)->where('deleted_at','=',null)->get();
        // dd($data_po);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'list-purchase-order'
        ];
        return view('purchase_order.public.show', [
            'title'         => 'Purchase Order',
            'uuid'  => $uuid,
            'layout'    => $layout,
            'purchase_orders'   => $data_po,
            'galeries'      => $galeries
        ]);
    }
    public function createAdmin(){
        $layout = [
                'head_core'            => true,
                'javascript_core'       => true,
                'head_datatable'        => true,
                'javascript_datatable'  => true,
                'head_form'             => true,
                'javascript_form'       => true,
                'active'                        => 'list-purchase-order'
            ];
        return view('purchase_order.admin.create', [
            'title'         => 'purchase order',
            'uuid'      => '',
            'galeries'  => '',
            'layout'    => $layout
        ]);
    }

    public function storeAdmin(Request $request){
        $validatedData = $request->validate([
            'po_number' => '',
            'uuid' =>'',
            'date' =>'',
            'description' =>'',
            'po_path' =>'',
            'travel_document_path' =>'',
        ]);
        if(!$validatedData['uuid']){
            $validatedData['uuid'] = "uuid".Str::uuid();
        }
        $store = PurchaseOrder::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        if($request->file('po_file')) {
            $imageName =   mt_rand(5, 99985) . '.'.$request->po_file->getClientOriginalExtension();
            $name = 'purchase/pdf/'.$imageName;
            if(file_exists($name)){
                $name = mt_rand(5, 99985) .$name;
            }
            
            $isMoved = $request->po_file->move('purchase/pdf/',$name);

            if($isMoved){
                $validatedData['po_path'] = $imageName;
            }
            $store = PurchaseOrder::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        }
        if($request->file('td_file')) {
            $imageName =   mt_rand(5, 99985) . '.'.$request->td_file->getClientOriginalExtension();
            $name = 'purchase/pdf/'.$imageName;
            if(file_exists($name)){
                $name = mt_rand(5, 99985) .$name;
            }
            
            $isMoved = $request->td_file->move('purchase/pdf/',$name);

            if($isMoved){
                $validatedData['travel_document_path'] = $imageName;
            }
            $store = PurchaseOrder::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        }
        
        return ResponseFormatter::toJson($store, 'da');
    }
    public function showAdmin(Request $request){
        $galeries = Galery::where('purchase_order_uuid', $request->uuid)->where('deleted_at','=',null)->get();
        $data_po = PurchaseOrder::where('uuid', $request->uuid)->get()->first();
        $data = [
            'purchase_orders'   => $data_po,
            'galeries'      => $galeries
        ];
        return ResponseFormatter::toJson($data, 'Data Purchase Order');
    }

    public function editAdmin($uuid){
        $galeries = Galery::where('purchase_order_uuid', $uuid)->where('deleted_at','=',null)->get();

        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'list-purchase-order'
        ];
        return view('purchase_order.admin.create', [
            'title'         => 'purchase order',
            'uuid'      => $uuid,
            'galeries'  => $galeries,
            'layout'    => $layout
        ]);
    }
    public function deleteAdmin(Request $request){
        $data = ['deleted_at'=>Carbon::now('Asia/Jakarta')];
        $store = PurchaseOrder::updateOrCreate(['uuid' => $request->uuid], $data);

        return response()->json(['code'=>200, 'message'=>'Data get','data' => $store], 200);   
    }

    public function anyData(){
        $data = PurchaseOrder::whereNull('deleted_at')->get();

        
        return Datatables::of($data)
       
        ->make(true);
    }
}
