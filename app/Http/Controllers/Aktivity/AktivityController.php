<?php

namespace App\Http\Controllers\Aktivity;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Aktivity\Aktivity;
use App\Models\Support\DataSource;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Svg\Tag\Rect;
use Throwable;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AktivityController extends Controller
{
    public function indexForm()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'formIndex'
        ];
        // ResponseFormatter::setAllSession();

        return view('activity.indexForm', [
            'title'         => 'Forms',
            'layout'    => $layout
        ]);
    }

    public static function storeDataSource($data_store_data_source)
    {
        $data_store_data_source = (array)$data_store_data_source;
        return DataSource::updateOrCreate(
            [
                'source_code' => $data_store_data_source['source_code'],
                'table_source' => $data_store_data_source['table_source']
            ],
            $data_store_data_source
        );
    }

    public function exportForm(Request $request)
    {
        $validatedData = $request->all();
        $data_database = session('data_database');
        $data_database = $data_database['data_datatable_database']['database']['data-table'];
        $data_data_source = []; 

        //get dataSource
        $data_sources = [];
        $arr_data_source = DataSource::where('table_source', $validatedData['data'])->get();
        foreach ($arr_data_source as $data_source) {
            $data_sources[$data_source->source_code] = $data_source;
        }
        $abjads = ResponseFormatter::abjads();

        $data_field = Aktivity::where('table_name', 'table_field')->where('code_data', $validatedData['data'])
            ->orderBy('sub_code_data', 'ASC')->get();
        $data_table = Aktivity::where('table_name', $validatedData['data'])->get();

        $data_data = [];
        foreach ($data_table as $item) {
            $data_data[$item->code_data][$item->field] = $item;
        }
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet = $createSheet->setTitle("Nama Tabel");

        // function foreachHeaderTableExcel
        $row_header_table = 1;
        $col_header_table = 20;

        $array_data_field = [];
        foreach ($data_field as $item_field) {
            $createSheet->setCellValue($abjads[$row_header_table] . $col_header_table, $item_field->description);
            $array_data_field[$item_field->sub_code_data] = $item_field;
            
            $data_data_source[$data_sources[$item_field->field]['table_name']] = $data_database[$data_sources[$item_field->field]['table_name']];
            $row_header_table++;
            
            
        }
        
        return ResponseFormatter::toJson($data_field, "success ge data");

        //function foreachDataTable
        $col_header_table++;
        foreach ($data_data as $item_data) {
            $row_header_table = 1;

            foreach ($data_field as $item_field) {
                return ResponseFormatter::toJson($data_data, "success ge data from_table");
                // $value_field = $item_data[$field_name]['value_field'];
                $field_name = $item_field->field;
                switch ($item_field->value_field) {
                    case "from_table":
                    
                        break;
                    default:
                        echo "n";
                        // 
                }
                
                $createSheet->setCellValue($abjads[$row_header_table] . $col_header_table, '$value_field');
                $row_header_table++;
            }
            $col_header_table++;
        }


        $createSheet->setCellValue('A20', 'NO.');

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/export-table-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return ResponseFormatter::toJson($data_database, "success ge data");

        return response()->download($name);



        return ResponseFormatter::toJson($data_data, "success");
    }


    public function storeForm(Request $request)
    {
        $validatedData = $request->all();
        $validatedData['form_field'] = json_decode($validatedData['form_field']);
        $form_field = $validatedData['form_field'];

        try {
            Aktivity::where('code_data', $form_field->form_code)->delete();
            $arry_field_db = $form_field->field;

            foreach ($form_field->field as $item_db) {
                if (gettype($item_db->type_data) != 'string') {
                    foreach ($item_db->type_data as $index_object => $item_object) {
                        if ($index_object == 'from_table') {
                            $item_db->value_field = 'from_table';
                            $item_object->source_code = $item_db->field;
                            $item_object->table_source = $form_field->form_code;
                            $isStored_data_source = $this->storeDataSource($item_object);
                        }
                    }
                }
                $item_db->type_data = 'table';
                $storeActivity = Aktivity::create((array)$item_db);
                // return ResponseFormatter::toJson($storeActivity, 'storeActivity');
            }
        } catch (\Exception $e) {
            // report($e);
            return ResponseFormatter::toJson($e->getMessage(), 'saya dari storeForm');

            return false;
        }
        return ResponseFormatter::toJson($validatedData, 'saya dari storeForm');
    }

    public function storeData(Request $request)
    {
        $validatedData = (array)$request->all();
        $dataUser = session('dataUser');

        $validatedData['CREATED-BY'] =  $dataUser['nik_employee'];

        // $data_database = session('data_database');
        // $fields = $data_database['data_datatable_database']['database']['data-schema'][$validatedData['table_name']];

        $data_field = Arr::except($validatedData, ['_token', 'table_name']);
        //cariable support 
        $validatedData['code_data'] = Str::uuid();
        $validatedData['field'] =  $validatedData['code_data'];

        $dataa = [];
        foreach ($data_field as $index_field => $item_data) {
            $data_to_store = [
                'table_name'    => $validatedData['table_name'],
                'field' => $index_field,
                'value_field' => $item_data,
                'code_data' => $validatedData['code_data'],
                'sub_code_data' => null,
                'type_data' => 'data',
                'description' => null,
            ];
            Aktivity::create($data_to_store);
            $dataa[] = $data_to_store;
        }

        return ResponseFormatter::toJson($dataa, 'from store data');
    }

    public function allTable(Request $request)
    {
        $validatedData = $request->all();

        $aktivities = Aktivity::where('type_data', '!=', 'data')->get();
        $tables = [];

        foreach ($aktivities as $aktivity) {
            $tables[$aktivity->table_name][$aktivity->code_data][$aktivity->field] = $aktivity->value_field;
        }

        $datas = Aktivity::where('type_data', 'data')->get();
        foreach ($datas as $aktivity) {
            $tables['data'][$aktivity->table_name][$aktivity->code_data][$aktivity->field] = $aktivity->value_field;
        }

        return ResponseFormatter::toJson($tables, 'huams from all table');
    }

    public function getDataTable(Request $request)
    {
        $validatedData = (array)$request->all();
        $arr_aktivity = Aktivity::all();
        $data = $arr_aktivity->where('table_name', $validatedData['data']['table_name']);
        if (!empty($validatedData['data']['code_data'])) {
            $data = $data->where('code_data', $validatedData['data']['code_data']);
        }
        $data_datatable = [];
        foreach ($data as $item_data) {
            $data_datatable[$item_data->code_data][$item_data->field] = $item_data;
        }
        $data_for_datatable = [];
        foreach ($data_datatable as $code_data=>$for_datatable) {
            $data_for_datatable[]= $for_datatable;
        }




        return ResponseFormatter::toJson($data_for_datatable, 'get data_table');
    }

    public function deleteDataTable(Request $request)
    {
        $validatedData = (array)$request->all();
        $data = '';
        $data = Aktivity::where('code_data', $validatedData['data']['code_data'])->delete();
        return ResponseFormatter::toJson($data, 'get data_table');
    }

    public function getData(Request $request)
    {
        $data = Aktivity::where('table_name', $request['data']['table_name'])->get();
        $data_table = [];
        foreach ($data as $item) {
            $data_table[$item->code_data][$item->field] = $item->value_field;
        }

        return ResponseFormatter::toJson($data_table, 'data get');
    }
}
