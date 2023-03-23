<?php

namespace App\Http\Controllers\Logistic;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Logistic\StorageLogistic;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class StorageLogisticController extends Controller
{
    public function index(){        
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'logistic-store'
        ];

        // dd('storage');
        return view('StorageLogistic.index', [
            'title'         => 'Form Recruitment',
            'layout'    => $layout
        ]);
    }

    public function show($uuid){
        $data = StorageLogistic::where('uuid', $uuid)->first();
        $data_p = StorageLogistic::where('parent_uuid', $uuid)->get();
        $arr_data = [];
        foreach($data_p as $item){
            $arr_data[$item->uuid] = $item;
        }

        if($data_p->count() == 0){
            return 'ini data';
        }
        
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'logistic-store'
        ];
        // dd($arr_data);
        return view('StorageLogistic.show', [
            'title'         => 'Form Recruitment',
            'data'      => $data,
            'data_parent'      => $arr_data,
            'layout'    => $layout
        ]);
    }

    public function store(Request $request){
        $validateData = $request->all();
        if(!empty($validateData['parent_uuid'])){
            $validateData['pending_uuid'] = $validateData['uuid'];
            $validateData['uuid'] = ResponseFormatter::toUUID($validateData['parent_uuid']);
            $validateData['parent_uuid'] = ResponseFormatter::toUUID($validateData['pending_uuid']);
        }else{
            if(empty($validateData['uuid'])){
                $validateData['uuid'] = ResponseFormatter::toUUID($validateData['storage_name']);
            }
        }
        
        $strore = StorageLogistic::updateOrCreate(['uuid' =>  $validateData['uuid']], $validateData);
        
        $muchLoop = $strore->p_storage * $strore->l_storage;

        $child_storage = [
            'uuid' => 'a',
            'storage_name' => 'a',
            'p_storage' => 1,
            'l_storage' => 1,
            'parent_uuid' => $strore->uuid,
        ];

        for($i = 0; $i < $muchLoop;$i++){
            $alfhabet_child = ResponseFormatter::numberToAlfhabet($i);
            $child_storage['uuid']  = $strore->uuid.'-'.$alfhabet_child;
            $child_storage['storage_name']  = $strore->uuid.'-'.$alfhabet_child;
            StorageLogistic::updateOrCreate(['uuid' =>  $child_storage['uuid']], $child_storage);
        

        }   
        
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

    public function anyData(){
        $data = StorageLogistic::whereNull('parent_uuid')->get();
        return Datatables::of($data)     
        ->make(true);
    }  
}
