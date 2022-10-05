<?php

namespace App\Http\Controllers\PurchaseOrder;

;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder\Galery;
use App\Models\PurchaseOrder\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class GaleryController extends Controller
{
    
  
    public function storeAdmin(Request $request){
        $validatedData = $request->validate([
            'purchase_order_uuid' => '',
            'galery_uuid' =>'',
            'title' =>'',
            'galery_path' =>''
        ]);
        if(!$validatedData['galery_uuid']){
            $validatedData['galery_uuid'] = "galery".Str::uuid();
        }
        $store = Galery::updateOrCreate(['uuid' => $validatedData['galery_uuid']], $validatedData);
        if($request->file('image_galery')) {
            $imageName =   mt_rand(5, 99985) . '.'.$request->image_galery->getClientOriginalExtension();
            $name = 'purchase/image/'.$imageName;
            if(file_exists($name)){
                $name = mt_rand(5, 99985) .$name;
            }
            
            $isMoved = $request->image_galery->move('purchase/image/',$name);

            if($isMoved){
                $validatedData['galery_path'] = $imageName;
            }
            $store = Galery::updateOrCreate(['uuid' => $validatedData['galery_uuid']], $validatedData);
        }
      
        
        return ResponseFormatter::toJson($validatedData, 'da');
    }
    public function showAdmin(Request $request){
        
        $data = PurchaseOrder::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Purchase Order');
    }

    public function editAdmin($uuid){
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
            'layout'    => $layout
        ]);
    }
    public function deleteAdmin(Request $request)
   {
        $data = ['deleted_at'=>Carbon::now('Asia/Jakarta')];
        $store = Galery::updateOrCreate(['uuid' => $request->uuid], $data);

        return response()->json(['code'=>200, 'message'=>'Data get','data' => $store], 200);   
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
            <div class="dropdown">
                <a
                    class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                    href="#"
                    role="button"
                    data-toggle="dropdown"
                >
                    <i class="dw dw-more"></i>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                >
                    <a class="dropdown-item" href="'.$url_edit.'"
                        ><i class="dw dw-eye"></i> View</a
                    >
                    <a class="dropdown-item" href="'.$url_edit.'"
                        ><i class="dw dw-edit2"></i> Edit</a
                    >
                    <a class="dropdown-item" href="'.$url_delete.'"
                        ><i class="dw dw-delete-3"></i> Delete</a
                    >
                </div>
            </div>'
            ;
        })
        ->addColumn('document', function ($model) {
            $uuid = $model->uuid;
            $url = "/logistic/unit/";
            $url_edit =$url.$uuid;
            $url_delete = $url."delete/".$uuid;
            return '
            <div class="form-inline">
            <button class="btn btn-primary mr-1">po</button>
            <button class="btn btn-primary">Surat Jalan</button>
        </div>'
            ;
        })
        ->escapeColumns('document')
        ->make(true);
    }
}
