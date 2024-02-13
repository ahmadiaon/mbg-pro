<?php

namespace App\Http\Controllers\Support;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\DatabaseData;
use App\Models\DatabaseDataSource;
use App\Models\DatabaseField;
use App\Models\DatabaseTable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function index()
    { //use
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index'
        ];
        return view('application.index', [
            'title'         => 'Apps',
            'layout'    => $layout
        ]);
    }

    public function indexData(){
        return view('app.manage.database.index');
    }

    public function storeData(Request $request){
        $data_database_datatable = [];
        foreach($request->formData as $field){
            $data_database_datatable[$field['name']] = $field['value']; 
        }

        foreach($data_database_datatable as $index=>$value){
            $store_data = DatabaseData::create([
                'code_table_data' => $request['data_table']['code_table'],
                'code_field_data' => $index,
                'value_data' => $value,
                'code_data' => $data_database_datatable[$request['data_table']['primary_table']],
                'uuid_data' => ResponseFormatter::toUUID($data_database_datatable[$request['data_table']['primary_table']]),
                'date_start' => $currentDate = Carbon::now()->format('Y-m-d'),
                'date_end' => null,
            ]);
        }

        // $store_data = DatabaseData::updateOrCreate([
        //     'code_table_data'=> $request['data_table']['code_table'],
        //     ''
        // ],[
        //     'code_table_data' => $request['data_table']['code_table'],
        //     'code_field_data' => $request[''],
        //     'value_data' => $request->,
        //     'code_data' => $request->,
        //     'uuid_data' => $request->,
        //     'date_start' => $request->,
        //     'date_end' => $request->,
        // ]);


        return ResponseFormatter::ResponseJson($request->data_table,"store database", 200);
    }

    public function store(Request $request){
        $request_data = $request->data;
        $store_database_table = DatabaseTable::updateOrCreate([
            'code_table' => ResponseFormatter::toUUID($request_data['description_table'])
        ],[
            'parent_table' => (!empty($request_data['parent_table']))?$request_data['parent_table']:null,
            'primary_table' => ResponseFormatter::toUUID($request_data['description_table']).'-'.ResponseFormatter::toUUID($request_data['primary_table']),
            'menu_table' => $request_data['menu_table'],
            'description_table' => $request_data['description_table'],
        ]);

        foreach($request_data['field'] as $field){
            $store_database_fields = DatabaseField::updateOrCreate([
                'full_code_field'=> $store_database_table->code_table.'-'.ResponseFormatter::toUUID($field['description_field'])
            ],[
                'code_table_field'=> $store_database_table->code_table,
                'description_field'=> $field['description_field'],
                'type_data_field'=> $field['type_data_field'],
                'code_field'=> ResponseFormatter::toUUID($field['description_field']),
                'full_code_field'=> $store_database_table->code_table.'-'.ResponseFormatter::toUUID($field['description_field']),
                'sort_field'=> $field['sort_field'],
            ]);
            if(!empty($field['data_source'])){
                $store_database_data_source = DatabaseDataSource::updateOrCreate([
                    'code_data_source'=> $store_database_fields->full_code_field
                ],[
                    'table_data_source' =>  $field['data_source']['table_data_source'],
                    'field_get_data_source' =>  $field['data_source']['field_get_data_source'],
                ]);
            }
        }
        
        return ResponseFormatter::ResponseJson($request_data,"store database", 200);
    }
}
