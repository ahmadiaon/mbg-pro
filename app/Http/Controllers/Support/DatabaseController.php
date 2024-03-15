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
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Str;

class SetCell extends Controller{
    public static function setColorCell($color){
        return ['fill' => [
            'fillType' =>  fill::FILL_SOLID,
            'startColor' => [
                'rgb' => $color
            ]
        ],];
    }
    public static function fontBOLD(){
        return ['font' => [
            'bold' => true,
        ]];
    }

    public static function setColorBlue($color){
        return ['fill' => [
            'fillType' =>  fill::FILL_SOLID,
            'startColor' => [
                'rgb' => $color
            ]
        ],];
    }
    public static function setColorGrey($color){
        return ['fill' => [
            'fillType' =>  fill::FILL_SOLID,
            'startColor' => [
                'rgb' => $color
            ]
        ],];
    }


}

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

        // return ResponseFormatter::ResponseJson($request->all(),"store database", 200);

        $Q_is_data_exist = DatabaseData::where('code_data', $data_database_datatable[$request['data_table']['primary_table']])->where('code_table_data',  $request['data_table']['code_table'])->whereNull('date_end')->get();
        
        if($Q_is_data_exist->count() > 0 ){
            $AA = DatabaseData::where('code_data', $data_database_datatable[$request['data_table']['primary_table']])
            ->where('code_table_data',  $request['data_table']['code_table'])->update(['date_end' =>Carbon::now()->format('Y-m-d') ]);
        }


        $uuid_data = Str::uuid();
        foreach($data_database_datatable as $index=>$value){
            $store_data = DatabaseData::create([
                'code_table_data' => $request['data_table']['code_table'],
                'code_field_data' => $index,
                'value_data' => $value,
                'code_data' => $data_database_datatable[$request['data_table']['primary_table']],
                'uuid_data' => $uuid_data,
                'date_start' => Carbon::now()->format('Y-m-d'),
                'date_end' => null,
            ]);
        }


        return ResponseFormatter::ResponseJson($request->data_table,"store database", 200);
    }

    public function store(Request $request){
        $request_data = $request->data;
        $store_database_table = DatabaseTable::updateOrCreate([
            'code_table' => ResponseFormatter::toUUID($request_data['description_table'])
        ],[
            'parent_table' => (!empty($request_data['parent_table']))?$request_data['parent_table']:null,
            'primary_table' => ResponseFormatter::toUUID($request_data['primary_table']),
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
                'level_data_field'=> $field['level_data_field'],
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

       if(!empty($request_data['parent_table'])){

        $store_database_fields = DatabaseField::updateOrCreate([
            'full_code_field'=> $store_database_table->code_table.'-'.ResponseFormatter::toUUID($field['description_field'])
        ],[
            'code_table_field'=> $store_database_table->code_table,
            'description_field'=> $request_data['parent_table'],
            'type_data_field'=> 'hidden',
            'level_data_field'=> 1,
            'code_field'=> ResponseFormatter::toUUID($request_data['parent_table']),
            'full_code_field'=> $store_database_table->code_table.'-'.ResponseFormatter::toUUID($request_data['parent_table']),
            'sort_field'=> null,
        ]);
       }


        
        return ResponseFormatter::ResponseJson($request_data,"store database", 200);
    }


    public function getData(Request $request)
    {
        $Q_table = DatabaseTable::where('code_table', $request->code_table)->get();
        $data_table = [];
        $data_table_child = [];
        foreach ($Q_table as $table) {
            // $data_table['table'] = $table;
            $data_table['all_table'][$table->code_table] = $table;
            $data_table['the_table'] = $table;
        }
        

        $Q_field = DatabaseField::where('code_table_field', $request->code_table)->get();
        foreach ($Q_field as $field) {
            // $data_table['fields'][$field->code_field] = $field;
            $data_table['all_fields'][$field->full_code_field] = $field;
        }

        $Q_table = DatabaseTable::where('parent_table', $request->code_table)->get();
        foreach ($Q_table as $table) {
            $Q_field = DatabaseField::where('code_table_field', $table->code_table)->get();
            foreach ($Q_field as $field) {
                // $data_table['child']['table'][$table->code_table]['fields'][$field->code_field] = $field;                
                $data_table['all_fields'][$field->full_code_field] = $field;
            }
            // $data_table['child']['table'][$table->code_table]['table'] = $table;            
            $data_table['all_table'][$table->code_table] = $table;
        }

        foreach($data_table['all_fields']  as $arr_field){
            $data_table['arr_fields'][] =  $arr_field;
            $data_table['the_fields'][$arr_field->code_field] = $arr_field;
        }
       


        // DATA
        $Q_data_table = DatabaseData::where('code_table_data', $request->code_table)->whereNull('date_end')->get();
        // $data_table['the_data'] = $Q_data_table;
        foreach($Q_data_table  as $data){
            $data_table['the_data'][$data->uuid_data][$data->code_field_data] =  $data;
        }

        return ResponseFormatter::ResponseJson($data_table, 'Success get data', 200);
    }

    public function deleteData(Request $request){
        $Q_delete = DatabaseData::where('uuid_data', $request->uuid_data)->delete();

        return ResponseFormatter::ResponseJson($Q_delete,"store database", 200);
    }
}
