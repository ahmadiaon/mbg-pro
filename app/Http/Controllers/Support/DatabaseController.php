<?php

namespace App\Http\Controllers\Support;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Controller;
use App\Models\DatabaseData;
use App\Models\DatabaseDataSource;
use App\Models\DatabaseField;
use App\Models\DatabaseTable;
use App\Models\Support\DatabaseFieldShow;
use App\Models\Support\UserTemplate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpParser\Node\Stmt\Foreach_;

class SetCell extends Controller
{
    public static function setColorCell($color)
    {
        return ['fill' => [
            'fillType' =>  fill::FILL_SOLID,
            'startColor' => [
                'rgb' => $color
            ]
        ],];
    }
    public static function fontBOLD()
    {
        return ['font' => [
            'bold' => true,
        ]];
    }

    public static function setColorBlue($color)
    {
        return ['fill' => [
            'fillType' =>  fill::FILL_SOLID,
            'startColor' => [
                'rgb' => $color
            ]
        ],];
    }
    public static function setColorGrey($color)
    {
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


    public function indexData()
    {
        return view('app.manage.database.index');
    }

    public function indexHR()
    {
        return view('app.manage.database.index_HR');
    }

    public function getTableData($code_table)
    {

        $Q_table = DatabaseTable::where('code_table', $code_table)->get();
        $data_table = [];
        $data_table_child = [];
        foreach ($Q_table as $table) {
            // $data_table['table'] = $table;
            $data_table['all_table'][$table->code_table] = $table;
            $data_table['the_table'] = $table;
        }


        $Q_field = DatabaseField::where('code_table_field', $code_table)->get();
        foreach ($Q_field as $field) {
            // $data_table['fields'][$field->code_field] = $field;
            $data_table['all_fields'][$field->full_code_field] = $field;
        }

        $Q_table = DatabaseTable::where('parent_table', $code_table)->get();
        foreach ($Q_table as $table) {
            $Q_field = DatabaseField::where('code_table_field', $table->code_table)->get();
            foreach ($Q_field as $field) {
                // $data_table['child']['table'][$table->code_table]['fields'][$field->code_field] = $field;                
                $data_table['all_fields'][$field->full_code_field] = $field;
            }
            $data_table['child']['table'][$table->code_table]['table'] = $table;
            $data_table['all_table'][$table->code_table] = $table;
        }

        foreach ($data_table['all_fields']  as $arr_field) {
            $data_table['arr_fields'][] =  $arr_field;
            if ($arr_field->code_table_field ==  $data_table['the_table']['code_table']) {
                $data_table['the_fields'][$arr_field->code_field] = $arr_field;
            }
        }

        $data_table['the_table']['fields'] = $data_table['the_fields'];



        // DATA
        $Q_data_table = DatabaseData::where('code_table_data', $code_table)->whereNull('date_end')->get();
        // $data_table['the_data'] = $Q_data_table;
        foreach ($Q_data_table  as $data_datatable) {
            $data_table['the_data'][$data_datatable->uuid_data][$data_datatable->code_field_data] =  $data_datatable;
        }

        $data_table['the_template'] = null;

        return ResponseFormatter::ResponseJson($data_table, 'Success get data', 200);
    }

    public function storeTemplate(Request $request)
    {
        $auth_login = $request->header('auth_login');
        $user = User::where('auth_login', $auth_login)->first();
        $Q_delete = UserTemplate::where('employee_uuid', $user->employee_uuid)->where('code_table_get', $request['code_table_get'])->delete();
        if (!empty($request['show-fields'])) {
            $arr_store = [];
            foreach ($request['show-fields'] as $field) {
                $store_database_fields = UserTemplate::insert([
                    'employee_uuid' => $user->employee_uuid,
                    'code_table_get' => $request['code_table_get'],
                    'code_table' => $field['code_table_field'],
                    'code_field' => $field['code_field'],
                ]);
                $arr_store[] = $store_database_fields;
            }
        }
        $Q_get = UserTemplate::where('employee_uuid', $user->employee_uuid)->where('code_table_get', $request['code_table_get'])->get();
        foreach ($Q_get as $data_user_template) {
            $dataUserTemplate[$data_user_template->code_field] = $data_user_template;
        }

        return ResponseFormatter::ResponseJson($dataUserTemplate, 'success from storeTemplate DatabaseController', 200);
    }

    public function storeData(Request $request)
    {
        $data_database_datatable = [];
        foreach ($request->formData as $field) {
            $data_database_datatable[$field['name']] = $field['value'];
        }

        $database_datatable['database_data_source'] = DatabaseController::getDataSource();

        if (!empty($request['data_source_this_field'])) { //store data source dari input autocomplite
            foreach ($request['data_source_this_field'] as $data_source_this_field) {
                $uuid_data = Str::uuid();
                $store_data = DatabaseData::updateOrCreate(
                    [
                        'code_table_data' => $data_source_this_field['table_data_source'], //table data source
                        'code_field_data' => $data_source_this_field['field_get_data_source'],
                        'code_data' => ResponseFormatter::toUUID($data_database_datatable[$data_source_this_field['code_field']]),
                    ],
                    [
                        'uuid_data' => $uuid_data,
                        'value_data' => $data_database_datatable['description-' . $data_source_this_field['code_field']],
                        'date_start' => Carbon::now()->format('Y-m-d'),
                        'date_end' => null,
                    ]
                );
                unset($data_database_datatable['description-' . $data_source_this_field['code_field']]);
            }
        }


        // return ResponseFormatter::ResponseJson($data_database_datatable,"store database", 200);

        $Q_is_data_exist = DatabaseData::where('code_data', ResponseFormatter::toUUID($data_database_datatable[$request['data_table']['primary_table']]))->where('code_table_data',  $request['data_table']['code_table'])->whereNull('date_end')->get();

        if ($Q_is_data_exist->count() > 0) {
            $AA = DatabaseData::where('code_data', ResponseFormatter::toUUID($data_database_datatable[$request['data_table']['primary_table']]))
                ->where('code_table_data',  $request['data_table']['code_table'])->update(['date_end' => Carbon::now()->format('Y-m-d')]);
        }


        $uuid_data = ($request->uuid_data) ? $request->uuid_data : Str::uuid();

        foreach ($data_database_datatable as $index => $value) {
            // if($database_datatable['database_data_source'][$request['data_table']['code_table'].'-'.$index]){

            // }
            $store_data = DatabaseData::updateOrCreate(
                [
                    'uuid_data' => $uuid_data,
                    'code_table_data' => $request['data_table']['code_table'],
                    'code_field_data' => $index,
                ],
                [
                    'value_data' => $value,
                    'code_data' => ResponseFormatter::toUUID($data_database_datatable[$request['data_table']['primary_table']]),
                    'uuid_data' => $uuid_data,
                    'date_start' => Carbon::now()->format('Y-m-d'),
                    'date_end' => null,
                ]
            );
        }


        $data_return['uuid_data'] = $uuid_data;
        $data_return['data_database_datatable'] = $data_database_datatable;


        return ResponseFormatter::ResponseJson($data_return, "store database", 200);
    }

    public function store(Request $request)
    {
        $request_data = $request->data;
        // return ResponseFormatter::ResponseJson($request_data, "store database", 200);
        $store_database_table = DatabaseTable::updateOrCreate([
            'code_table' => ResponseFormatter::toUUID($request_data['description_table'])
        ], [
            'parent_table' => (!empty($request_data['parent_table'])) ? $request_data['parent_table'] : null,
            'primary_table' => ResponseFormatter::toUUID($request_data['primary_table']),
            'menu_table' => $request_data['menu_table'],
            'description_table' => $request_data['description_table'],
        ]);

        foreach ($request_data['field'] as $field) {
            $store_database_fields = DatabaseField::updateOrCreate([
                'full_code_field' => $store_database_table->code_table . '-' . ResponseFormatter::toUUID($field['description_field'])
            ], [
                'code_table_field' => $store_database_table->code_table,
                'description_field' => $field['description_field'],
                'type_data_field' => $field['type_data_field'],
                'level_data_field' => $field['level_data_field'],
                'code_field' => ResponseFormatter::toUUID($field['description_field']),
                'full_code_field' => $store_database_table->code_table . '-' . ResponseFormatter::toUUID($field['description_field']),
                'sort_field' => $field['sort_field'],
            ]);



            if (!empty($field['data_source'])) {
                $store_database_data_source = DatabaseDataSource::updateOrCreate([
                    'code_data_source' => $store_database_fields->full_code_field
                ], [
                    'table_data_source' =>  $field['data_source']['table_data_source'],
                    'field_get_data_source' =>  $field['data_source']['field_get_data_source'],
                ]);
            }

            if (!empty($field['gabungan'])) {
                $table_code = $store_database_table->code_table;
                $field_code = ResponseFormatter::toUUID($field['description_field']);
                foreach ($field['gabungan'] as $key => $value) {
                    $store_database_field_shows = DatabaseFieldShow::updateOrCreate([
                        'table_code' => $table_code,
                        'field_code' => $field_code,
                        'field_show_code' => $value['field_show_code']
                    ], [
                        'split_by' =>  $value['split_by'],
                        'sort_field' =>  $value['sort_field'],
                        'table_show_code' => ($value['table_show_code']) ? ($value['table_show_code']) : $table_code
                    ]);
                }
            }
        }

        if (!empty($request_data['parent_table'])) {
            $table_parent = DatabaseTable::where('code_table', $request_data['parent_table'])->first();
            $store_database_fields = DatabaseField::updateOrCreate([
                'full_code_field' => $store_database_table->code_table . '-' . $table_parent->primary_table, //CODE-TABLE-FIELD-PRIMARY-CODE-TABLE
            ], [
                'code_table_field' => $store_database_table->code_table,
                'description_field' => ResponseFormatter::toUUID($request_data['primary_table']),
                'type_data_field' => 'hidden',
                'level_data_field' => 1,
                'code_field' => $table_parent->primary_table,
                'full_code_field' => $store_database_table->code_table . '-' . ResponseFormatter::toUUID($table_parent->primary_table),
                'sort_field' => null,
            ]);
        }

        return ResponseFormatter::ResponseJson($request_data, "store database", 200);
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
            $data_table['child']['table'][$table->code_table]['table'] = $table;
            $data_table['all_table'][$table->code_table] = $table;
        }

        foreach ($data_table['all_fields']  as $arr_field) {
            $data_table['arr_fields'][] =  $arr_field;
            if ($arr_field->code_table_field ==  $data_table['the_table']['code_table']) {
                $data_table['the_fields'][$arr_field->code_field] = $arr_field;
            }
        }

        $data_table['the_table']['fields'] = $data_table['the_fields'];



        // DATA
        $Q_data_table = DatabaseData::where('code_table_data', $request->code_table)->whereNull('date_end')->get();
        // $data_table['the_data'] = $Q_data_table;
        foreach ($Q_data_table  as $data_datatable) {
            $data_table['the_data'][$data_datatable->uuid_data][$data_datatable->code_field_data] =  $data_datatable;
        }

        $data_table['the_template'] = null;

        return ResponseFormatter::ResponseJson($data_table, 'Success get data', 200);
    }


    function exportDatatable(Request $request)
    {
        $auth_login =  $request->header('auth_login');
        $database_datatable = UserController::db_local_storage($auth_login);
        // return ResponseFormatter::ResponseJson($database_datatable, 'saaaaaa', 200);
        $abjads = ResponseFormatter::abjads();
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        $code_table_data = ($database_datatable['db']['database_table'][$request->code_table_data]['parent_table']) ? $database_datatable['db']['database_table'][$request->code_table_data]['parent_table'] : $request->code_table_data;
        

        $createSheet->setCellValue('A1', 'No.');

        $count_data = 1;
        foreach ($request->fields as $field) {
            $createSheet->setCellValue($abjads[$count_data] . '1', $field['description_field']);
            $createSheet->setCellValue($abjads[$count_data] . '2', $field['code_table_field']);
            $count_data++;
        }
        $count_data_export = 3;

        if (!empty($request['data_export']['data'])) {
            $Q_get_data = DatabaseData::where('code_table_data', $request->code_table_data)->whereNull('date_end')->get();
            $data_get_data = [];

            foreach ($Q_get_data as $item_get_data) {
                $data_get_data[$item_get_data->code_data][$item_get_data->code_field_data] = $item_get_data;
            }
            // return ResponseFormatter::ResponseJson('$name', $database_datatable, 200);
            foreach ($request['data_export']['data'] as $code_data => $item_export) {
                $createSheet->setCellValue('A' . $count_data_export, $count_data_export - 2);
                $count_abjads_field = 1;

                if (!empty($database_datatable['public']['public_value'][$code_table_data][$code_data])) {
                    $data_code_data = $database_datatable['public']['public_value'][$code_table_data][$code_data];
                    foreach ($request->fields as $field) {
                        if (!empty($data_code_data[$field['code_field']])) {
                            $value_show = $data_code_data[$field['code_field']];
                            $createSheet->setCellValue($abjads[$count_abjads_field] . $count_data_export, $value_show);
                        }
                        $count_abjads_field++;
                    }
                }


                $count_data_export++;
            }
        }


        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/export/' .$code_table_data.'-'. rand(99, 9999) . '-file.xls';
        $crateWriter->save($name);

        return ResponseFormatter::ResponseJson($name, 'export database', 200);
    }


    public function importDatatable(Request $request)
    {
        $the_file = $request->file('uploaded_file');
        $auth_login =  $request->header('auth_login');
        $abjads = ResponseFormatter::abjads();
        $database_datatable['database_table'] = DatabaseController::getTables();
        $database_datatable['database_field'] = DatabaseController::getFields();
        $database_datatable['database_data_source'] = DatabaseController::getDataSource();

        $db = UserController::db_local_storage($auth_login);
        // $db = session('db_local_storage');
        // return ResponseFormatter::ResponseJson($db, 'column_fields', 200);
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();

            /*
                1. tabel apa saja yang di insert
                2. uuid data yg ada childnya sama (1 row sama uuidnya)
                3. jika ada data yang code datanya sama dan di field yang sama maka matikan dulu data ini
                
            */
            $column_fields = [];
            $loop_col = 1;

            $table_arr = [];
            $field_arr = [];

            while ($sheet->getCell($abjads[$loop_col] . '2')->getValue() != null) {
                $table_code = $sheet->getCell($abjads[$loop_col] . '2')->getValue();
                if (!in_array($table_code, $table_arr)) {
                    $table_arr[] = $table_code;
                }

                $field_code = ResponseFormatter::toUUID($sheet->getCell($abjads[$loop_col] . '1')->getValue());
                $column_fields['excel_properties'][$table_code][] = $field_code;
                if (!empty($database_datatable['database_field'][$table_code])) {
                    if (!empty($database_datatable['database_field'][$table_code][$field_code])) {
                        if (!in_array($field_code, $field_arr)) {
                            $field_arr[] = $field_code;
                        }
                        $column_fields['index_column'][$abjads[$loop_col]]['table_code'] = $table_code;
                        $column_fields['index_column'][$abjads[$loop_col]]['field_code'] = $field_code;
                        $column_fields['index_column'][$abjads[$loop_col]]['type_data_field'] = $db['db']['database_field'][$table_code][$field_code]['type_data_field'];
                        $column_fields['index_column'][$abjads[$loop_col]]['is_uuid'] = false;
                        if (!empty($database_datatable['database_data_source'][$table_code . '-' . $field_code])) { //jika ada di data source
                            $column_fields['index_column'][$abjads[$loop_col]]['is_uuid'] = true;
                        }
                    }
                }
                $loop_col++;
            }

            // return ResponseFormatter::ResponseJson($db, 'column_fields', 200);
            $i = 3;
            while ($sheet->getCell('A' . $i)->getValue() != null) {


                $uuid_data = Str::uuid();
                // return ResponseFormatter::ResponseJson($uuid_data, 'store data from importDatatable', 200);

                foreach ($column_fields['index_column'] as $index_column_key => $value) {
                    $code_table_data = null;
                    $code_field_data = null;
                    $code_data = null;
                    $value_data = null;
                    if ($sheet->getCell($index_column_key . $i)->getValue() != null) {
                        $value_data = ($value['is_uuid']) ? ResponseFormatter::toUUID($sheet->getCell($index_column_key . $i)->getValue()) : $sheet->getCell($index_column_key . $i)->getValue();
                        if ($value['type_data_field'] == 'DATE') {
                            if ($value_data) {
                                $value_data = ResponseFormatter::convertToDate($value_data);
                            }
                        }
                        $code_table_data = $value['table_code'];
                        $code_field_data = $value['field_code'];
                        $code_data = ResponseFormatter::toUUID($value_data);
                        $arr_value[$i][$code_table_data][$code_field_data] = $value_data;
                    }
                }
                // return ResponseFormatter::ResponseJson($arr_value,'store data from importDatatable', 200);

                $i++;
            }
            // return ResponseFormatter::ResponseJson($arr_value,'store data from importDatatable', 200);

            foreach ($arr_value as $row_to_insert) {
                $uuid_data = null;
                foreach ($row_to_insert as $table_code => $table_to_insert) {
                    // try {
                        $field_code_primary_code = $database_datatable['database_table'][$table_code]['primary_table'];
                        $table_code_primary_code = ($database_datatable['database_table'][$table_code]['parent_table']) ? $database_datatable['database_table'][$table_code]['parent_table'] : $table_code;
                        // $x = $db['db']['database_data'][$table_code_primary_code][$code_data];

                        if (empty($uuid_data)) {
                            $code_data = ResponseFormatter::toUUID($row_to_insert[$table_code_primary_code][$field_code_primary_code]);
                            if (!empty($db['db']['database_data'][$table_code_primary_code][$code_data])) {
                                try {
                                    $uuid_data = $db['db']['database_data'][$table_code_primary_code][$code_data][$field_code_primary_code]['uuid_data'];
                                } catch (\Throwable $th) {
                                    return ResponseFormatter::ResponseJson($db['db']['database_data'][$table_code_primary_code][$code_data], $field_code_primary_code, 200);
                                }
                                
                            } else {
                                $uuid_data = Str::uuid();
                            }
                        }

                        foreach ($table_to_insert as $field_code => $field_to_insert) {
                            // return ResponseFormatter::ResponseJson($field_to_insert, 'store data from importDatatable', 200);
                            $data_insert = [
                                'code_table_data' => $table_code,
                                'code_field_data' => $field_code,
                                'value_data' => $field_to_insert,
                                'code_data' => ResponseFormatter::toUUID($row_to_insert[$table_code_primary_code][$field_code_primary_code]),
                                'uuid_data' => $uuid_data,
                            ];

                            $Q_store_data = DatabaseData::updateOrCreate(
                                [
                                    'code_table_data' => $data_insert['code_table_data'], //table data source
                                    'code_field_data' => $data_insert['code_field_data'],
                                    'code_data' => $data_insert['code_data'], //value primary key
                                    'uuid_data' => $uuid_data,
                                ],
                                [
                                    'value_data' => $data_insert['value_data'],
                                    'date_start' => Carbon::now()->format('Y-m-d'),
                                    'date_end' => null,
                                ]
                            );
                            $arr_data_insert[] = $data_insert;
                        }
                    // } catch (\Throwable $th) {
                        
                    //     return ResponseFormatter::ResponseJson($field_to_insert, 'err', 200);
                    //     //throw $th;
                    // }
                }
            }

            if (in_array('IDENTITAS-KARYAWAN', $table_arr)) {
                if (in_array('NIK-KTP', $field_arr)) {
                    foreach ($arr_value as $row_to_insert) {
                        if ($row_to_insert['IDENTITAS-KARYAWAN']['NIK-KTP']) {
                            User::updateOrCreate([
                                'uuid' => ResponseFormatter::toUUID($row_to_insert['KARYAWAN']['NRP']),
                                'employee_uuid' => ResponseFormatter::toUUID($row_to_insert['KARYAWAN']['NRP']),
                                'nik_employee' => ResponseFormatter::toUUID($row_to_insert['KARYAWAN']['NRP']),

                            ], [
                                'password' => Hash::make($row_to_insert['IDENTITAS-KARYAWAN']['NIK-KTP']),
                                'role' => 'employee'
                            ]);
                        }
                    }
                }
            }
            return ResponseFormatter::ResponseJson($arr_data_insert, 'store data from importDatatable', 200);
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return ResponseFormatter::ResponseJson($e, 'store data from importDatatable err', 200);
        }
    }

    public function deleteData(Request $request)
    {
        $Q_delete = DatabaseData::where('uuid_data', $request->uuid_data)->delete();
        return ResponseFormatter::ResponseJson($Q_delete, "store database", 200);
    }












    public static function getTables($code_table = null)
    {

        if ($code_table == null) {
            $Q_table = DatabaseTable::get();
        } else {
            $Q_table = DatabaseTable::where('code_table', $code_table)->get();
        }

        $data_table = [];
        $data_table_child = [];
        foreach ($Q_table as $table) {
            $data_table[$table->code_table] = $table;
            if ($table->parent_table) {
                $data_table_child[$table->parent_table][] = $table->code_table;
            }
        }

        return $data_table;
    }

    public static function getDataFull($code_table = null, $code_data = null)
    {
        if ($code_table == null) {
            $Q_table = DatabaseTable::get();
        } else {
            $Q_table = DatabaseTable::where('code_table', $code_table)->get();
        }

        $data_table = [];
        $data_fields = [];
        $arr_data_table = [];
        $data_table_child = [];
        foreach ($Q_table as $table) {
            $data_table[$table->code_table] = $table;
            $Q_field = DatabaseField::where('code_table_field', $table->code_table)->get();

            foreach ($Q_field as $field) {
                $data_fields[$table->code_table][$field->code_table_field][$field->code_field] = $field;
            }

            $arr_data_table[$table->code_table] = $table;
            if ($table->parent_table) {
                $data_table_child[$table->parent_table][] = $table->code_table;
            }
        }

        $Q_table_childs = DatabaseTable::where('parent_table', $code_table)->get();


        if ($Q_table_childs) {
            foreach ($Q_table_childs as $I_table_childs) {
                $arr_data_table[$I_table_childs->code_table] = $I_table_childs;
                $Q_field = DatabaseField::where('code_table_field', $I_table_childs->code_table)->get();

                foreach ($Q_field as $field) {
                    $data_fields[$I_table_childs->code_table][$field->code_table_field][$field->code_field] = $field;
                }
            }
        }
        $data_return = [];

        $data_return['tables'] = $arr_data_table;
        $data_return['fields'] = $data_fields;











        return $data_return;
    }

    public static function getFields($code_field = null)
    {
        if ($code_field == null) {
            $Q_field = DatabaseField::get();
        } else {
            $Q_field = DatabaseField::where('code_field', $code_field)->get();
        }


        $data_field = [];
        foreach ($Q_field as $field) {
            $data_field[$field->code_table_field][$field->code_field] = $field;
        }

        return $data_field;
    }

    public static function getDataSource()
    {

        $Q_data_source = DatabaseDataSource::get();
        $data_data_source = [];
        foreach ($Q_data_source as $data_source) {
            $data_data_source[$data_source->code_data_source] = $data_source;
        }

        return $data_data_source;
    }
}
