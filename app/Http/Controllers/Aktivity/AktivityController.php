<?php

namespace App\Http\Controllers\Aktivity;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Aktivity\Aktivity;
use Illuminate\Http\Request;
use Throwable;

class AktivityController extends Controller
{
    //
    public function storeForm(Request $request){
        $validatedData = $request->all();
        $validatedData['form_field'] = json_decode($validatedData['form_field']);
        $form_field = $validatedData['form_field'];
        // return ResponseFormatter::toJson($validatedData, 'saya dari storeForm');
        try {
            Aktivity::where('code_data', $form_field->form_code)->delete();
            $arry_field_db = $form_field->field;

            foreach($form_field->field as $item_db){
                if(gettype($item_db->type_data) == 'object'){
                    foreach($item_db->type_data as $index_object=>$item_object){
                        if($index_object){
                            
                        }
                    }
                }

                $item_db->gettypes= gettype($item_db->type_data);
            }
        } catch (\Exception $e) {
            // report($e);
            return ResponseFormatter::toJson($e->getMessage(), 'saya dari storeForm');
     
            return false;
        }
        // $store = Aktivity::updateOrCreate();

        return ResponseFormatter::toJson($form_field, 'saya dari storeForm');
    }

    public function allTable(Request $request){
        $validatedData = $request->all();

        $aktivities = Aktivity::where('type_data','!=', 'data')->get();
        $tables = [];

        foreach($aktivities as $aktivity){
            $tables[$aktivity->table_name][$aktivity->code_data][$aktivity->field]= $aktivity->value_field;
        }

        $datas = Aktivity::where('type_data', 'data')->get();
        foreach($datas as $aktivity){
            $tables['data'][$aktivity->table_name][$aktivity->code_data][$aktivity->field]= $aktivity->value_field;
        }

        return ResponseFormatter::toJson($tables, 'huams from all table');

    }
}
