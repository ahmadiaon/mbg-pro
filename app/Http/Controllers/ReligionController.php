<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use Yajra\Datatables\Datatables;

class ReligionController extends Controller
{
public function anyData()
    {
        
        // return $data = people::latest()->get();
        return Datatables::of(Religion::query())
        ->addColumn('action', function ($model) {
            $url = "/admin/religion/";
            $url_edit = "'".$url.$model->id."'";
            $url_delete = "'".$url."delete/'";
            return '<input type="hidden" value="'. $model->id .'"><button disabled id="'.$model->id .'" onclick="runEdit(' . $model->id . ','.$url_edit.')"  class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button>
            <button onclick="isDelete(' . $model->id . ','.$url_delete.')"  type="button" disabled class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
        })
        ->make(true);           
    }
    public function index()
    {
        return view('admin.religion.index', [
            'title'         => 'religion'
        ]);
    }

   
    public function create()
    {
        //
    }



   
}
