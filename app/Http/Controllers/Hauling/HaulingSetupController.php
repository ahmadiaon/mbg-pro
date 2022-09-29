<?php

namespace App\Http\Controllers\Hauling;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hauling\HaulingSetup;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class HaulingSetupController extends Controller
{
    //
    public function index(){
        //  "dd";
        return $hauling_setup = HaulingSetup::getAll();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'              => 'hauling'
        ];
        return view('hauling.setup.index',[
            'title'         => 'Home - Logistic',
            'layout'    => $layout,
            'hauling_setup' => $hauling_setup
        ]);
    }

    public function anyData(){
        return $data = HaulingSetup::getAll();
        return Datatables::of($data)
        ->addColumn('action', function ($model) {
            $uuid = $model->uuid;
            $url = "/logistic/unit/";
            $url_edit =$url.$uuid;
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
        ->make(true);
    }
}
