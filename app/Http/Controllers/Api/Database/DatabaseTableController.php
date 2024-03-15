<?php

namespace App\Http\Controllers\Api\Database;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\DatabaseField;
use App\Models\DatabaseTable;
use Illuminate\Http\Request;

class DatabaseTableController extends Controller
{
    //
    public function getData(Request $request)
    {
        $Q_table = DatabaseTable::where('code_table', $request->code_table)->get();
        $data_table = [];
        $data_table_child = [];
        foreach ($Q_table as $table) {
            // $data_table['table'] = $table;
            $data_table['all_table'][$table->code_table] = $table;
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
        }

        return ResponseFormatter::ResponseJson($data_table, 'Success get table', 200);
    }
}
