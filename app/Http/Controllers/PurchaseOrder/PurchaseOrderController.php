<?php

namespace App\Http\Controllers\PurchaseOrder;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder\Galery;
use App\Models\PurchaseOrder\PurchaseOrder;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class PurchaseOrderController extends Controller
{
    // indexAdmin
    public function indexPublic(){
        
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'purchase-order'
        ];
        return view('purchase_order.public.index', [
            'title'         => 'Purchase Order',
            'layout'    => $layout
        ]);
   }
     public function indexAdmin(){        
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'purchase-order'
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
            'active'                        => 'purchase-order'
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
                'active'                        => 'purchase-order'
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
            'active'                        => 'purchase-order'
        ];
        return view('purchase_order.admin.create', [
            'title'         => 'purchase order',
            'uuid'      => $uuid,
            'galeries'  => $galeries,
            'layout'    => $layout
        ]);
    }

    public function anyData(){
        $data = PurchaseOrder::all();

        
        return Datatables::of($data)
        ->addColumn('action', function ($model) {
            $uuid = $model->uuid;
            $url = "/purchase-order/";
            $url_edit =$url.'show/'.$uuid;
            $url_delete = $url."delete/".$uuid;
            return '
            <div class="form-inline">          
            <a class="mr-3" href="'.$url_edit.'"
                ><i class="dw dw-edit2"></i> </a
            >
            </div>
            '
            ;
        })
        ->addColumn('actionPublic', function ($model) {
            $url = "/penerimaan-barang-po/";
            $url_edit =$url.'detail/'.$model->uuid;
            return '
            <div class="form-inline">          
            <a class="mr-3" href="'.$url_edit.'"
                ><i class="dw dw-edit2"></i> </a
            >
            </div>
            '
            ;
        })
        ->addColumn('document', function ($model) {
            $uuid = $model->uuid;
            $url = "/logistic/unit/";
            $url_edit =$url.$uuid;
            $url_delete = $url."delete/".$uuid;
            $po_path = "'".$model->po_path."'";
            $travel_document_path = "'".$model->travel_document_path."'";
            return '
            <div class="form-inline">
            <button type="button" onclick="showdoc('.$po_path.')" class="btn btn-primary mr-1">Lihat PO</button>
            <button type="button" onclick="showdoc('.$travel_document_path.')" class="btn btn-primary">Lihat SJ</button>
        </div>'
            ;
        })
        ->escapeColumns('document')
        ->make(true);
    }
}
