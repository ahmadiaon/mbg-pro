<?php

namespace App\Http\Controllers\Support;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Controller;
use App\Models\DatabaseData;
use App\Models\DatabaseDataSource;
use App\Models\DatabaseField;
use App\Models\DatabaseTable;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Support\DatabaseDataKehadiran;
use App\Models\Support\DatabaseDataPersetujuan;
use App\Models\Support\DatabaseFieldShow;
use App\Models\Support\DatabasePersetujuan;
use App\Models\Support\UserTemplate;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

/*
    PRIORITY-1      : importDatatable
*/

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

    public function file()
    { //use
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index'
        ];
        return view('application.file', [
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
        //1.0 GET table properties
        $Q_table = DatabaseTable::where('code_table', $code_table)->get();
        $data_return = [];
        $data_table = [];
        $data_table_child = [];
        foreach ($Q_table as $table) {
            // $data_table['table'] = $table;
            $data_table['all_table'][$table->code_table] = $table;
            $data_table['the_table'] = $table;
            $data_return['table'] = $table;
        }


        

        // 1.1 GET Fields
        $Q_field = DatabaseField::where('code_table_field', $code_table)->get();
        foreach ($Q_field as $field) {
            // $data_table['fields'][$field->code_field] = $field;
            $data_table['all_fields'][$field->full_code_field] = $field;
            $data_return['fields'][$field->code_table_field] = $field;
        }


        // 2.0 GET data
        $Q_data_table = DatabaseData::where('code_table_data', $code_table)->whereNull('date_end')->get([
            'code_table_data','code_field_data','value_data','code_data','uuid_data'
        ]);

        $data_datatables = [];
        foreach ($Q_data_table  as $data_datatable) {
            $data_datatables[$data_datatable->code_data][$data_datatable->code_field_data] =   $data_datatable;
            $data_table['the_data'][$data_datatable->uuid_data][$data_datatable->code_field_data] =  $data_datatable;
        }
        $data_return['data_tables'] = $data_datatables;
        

        return ResponseFormatter::ResponseJson($data_return, 'Success Get '.$code_table, 200);

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

        return ResponseFormatter::ResponseJson($data_table, 'Success Get '.$code_table, 200);
    }

    public function storeTemplate(Request $request)
    {
        $auth_login = $request->header('x-auth-login');
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

    public function storeDataFile(Request $request) //store slip
    {
        // return ResponseFormatter::ResponseJson($request->all(), 'kosong', 200);
        $parent_path = 'file/database/';
        if ($request->all()) {
            $arr_key = [];
            foreach ($request->all() as $key => $file) {
                // $files_file = $request->file($key);
                if ($request->file($key)) {
                    $arr_key[] = $key;
                    $the_file = $request->file($key);
                    $file_name_original = $the_file->getClientOriginalName();
                    $file_extension = $the_file->getClientOriginalExtension();
                    $filenameWithoutExtension = pathinfo($file_name_original, PATHINFO_FILENAME);
                    $file_name_change = $request->code_table_data . "-" . $request->code_data . "-" . $key . "." . $file_extension;
                    $xxxx = $the_file->move($parent_path, $file_name_change);
                    $store_data = DatabaseData::updateOrCreate(
                        [
                            'uuid_data' => $request->uuid_data,
                            'code_table_data' => $request->code_table_data,
                            'code_field_data' => $key,
                        ],
                        [
                            'value_data' => $file_name_change,
                            'code_data' => $request->code_data,
                            'uuid_data' => $request->uuid_data,
                            'date_start' => Carbon::now()->format('Y-m-d'),
                            'date_end' => null,
                        ]
                    );
                }
                // return ResponseFormatter::ResponseJson($files_file->getClientOriginalName(), 'success', 200);
            }
            return ResponseFormatter::ResponseJson($arr_key, 'success', 200);
        } else {
            return ResponseFormatter::ResponseJson($request->all(), 'kosong', 200);
        }



        $request->validate([
            'file' => '',
        ]);
        $files_file = $request->file('file');

        $pdf = new Pdf($files_file[0]->path());
        // $imagePath = public_path('pdf-image.jpg');
        // $pdf->saveImage($imagePath);


        // return ResponseFormatter::ResponseJson($files_file[0]->getClientOriginalName(),'success', 200);


        $files = [];
        $split_year_month = explode(" ", $request['month-year']);
        $month = ResponseFormatter::monthSort($split_year_month[0]);
        $year   = $split_year_month[1];

        $to_store = [];

        $parent_path = 'file/slips/';
        foreach ($files_file as $item_file) {
            $file_name_original = $item_file->getClientOriginalName();
            $file_extension = $item_file->getClientOriginalExtension();
            $filenameWithoutExtension = pathinfo($file_name_original, PATHINFO_FILENAME);
            $file_name_change = Str::uuid() . "." . $file_extension;
            $employee_uuid = ResponseFormatter::toUUID($filenameWithoutExtension);
            $to_store[$file_name_original] = $file_name_change;
            $item_file->move($parent_path, $file_name_change);

            $imageName = $employee_uuid . "-" . $year . "-" . $month;

            $data_for_store = [
                'employee_uuid' => $employee_uuid,
                'code_file' => $imageName,
                'year'  => $year,
                'month' => $month,
                'original_file'  => $file_name_change
            ];
            $files[] = $data_for_store;
            // Slip::updateOrCreate(['code_file'=>$data_for_store['code_file']],$data_for_store);
        }

        return ResponseFormatter::ResponseJson($files, 'success', 200);
    }

    public function storeDataWeb(Request $request)
    {
        $files = $request->allFiles();
        // return ResponseFormatter::ResponseJson($request->all(), "stored database", 200);
        foreach ($files as $key => $file) {
            $the_file = $request->file($key);
            $fileName = $file->getClientOriginalName();
        }
        // return ResponseFormatter::ResponseJson($request->all() , "stored database", 200);
        $fileCount = count($files);
        $Q_field = DatabaseField::where('code_table_field', $request->code_table)->get();

        $code_data = '';
        $uuid_data = '';
        $data_one_row = [];
        $auth_login = $request->header('user-token-mbg');
        $user = User::where('auth_login', $auth_login)->first();
        $dibuat_oleh = $user->employee_uuid;
        $db = session('db_local_storage');
        $data_database_datatable = $request->all();
        if (!empty($request['data_source_this_field'])) {
            $data_database_datatable['data_source_this_field'] = json_decode($request['data_source_this_field']);
        }


        switch ($request->code_table) {
            case 'KEHADIRAN':
                if (empty($request->NRP)) {
                    $request['NRP'] = $dibuat_oleh;
                }
                if (empty($request['TANGGAL-PENGAJUAN'])) {
                    $request['TANGGAL-PENGAJUAN'] = Carbon::today()->format('Y-m-d');
                }
                $uuid_data = $code_data = $request['NRP'] . '-' . $request['TANGGAL-MULAI'];
                if ($request['uuid_data']) {
                    $uuid_data = $code_data = $request['uuid_data'];
                }
                $file_name_change = null;
                if ($fileCount > 0) {
                    $parent_path = 'file/kehadiran/';
                    foreach ($files as $key => $file) {
                        $the_file = $request->file($key);
                        $arr_key[] = $key;
                        $the_file = $request->file($key);
                        $file_extension = $the_file->getClientOriginalExtension();
                        $file_name_change = $code_data . "." . $file_extension;
                        $xxxx = $the_file->move($parent_path, $file_name_change);
                    }
                }





                $arr_store = [
                    'tanggal_diajukan' => $request['TANGGAL-PENGAJUAN'],
                    'tanggal_mulai' => $request['TANGGAL-MULAI'],
                    'lama' => $request['LAMA'],
                    'code_jenis_kehadiran' => $request['JENIS-KEHADIRAN'],
                    'dokumen' => $file_name_change,
                    'keterangan' => $request['KETERANGAN'],
                    'status_absen' => $request['STATUS-ABSEN'],
                    'dibuat_oleh' => $dibuat_oleh,
                ];

                if (empty($request['STATUS-ABSEN'])) {
                    unset($arr_store['status_absen']);
                }

                $is_data_available = DatabaseDataKehadiran::where('code_data', $code_data)->get();
                if ($is_data_available->count() > 0) {
                    $dibuat_oleh = null;
                    unset($arr_store['dibuat_oleh']);
                }
                $store_data = DatabaseDataKehadiran::updateOrCreate(
                    [
                        'code_data' => $code_data,
                        'nrp' => $request['NRP'],
                    ],
                    $arr_store
                );


                // JIKA ADA STATUS ABSEN UPDATE ATAU CREATE STATUS ABSEN, INI HANYA HR YG BOLEH.

                if ($request['STATUS-ABSEN']) {
                    // LOOPING UPDATE ABSENSI
                    $data_one_row = [
                        'nik_employee' => $request->NRP,
                        'employee_uuid' => $request->NRP,
                        'date_start' => $request['TANGGAL-MULAI'],
                        'date_end' => ResponseFormatter::addDate($request['TANGGAL-MULAI'], $request['LAMA']),
                        'status_absen_uuid' => $request['STATUS-ABSEN'],
                        'absen_description' => $request['KETERANGAN'],
                    ];

                    $startDate = new \DateTime($data_one_row['date_start']);
                    $endDate = new \DateTime($data_one_row['date_end']);
                    $validatedData['edited'] = 'edited';

                    for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
                        $data_one_row['date'] =  $date->format('Y-m-d');

                        $data_one_row['uuid']  = $data_one_row['date'] . '-' . $data_one_row['employee_uuid'];

                        $store = EmployeeAbsen::updateOrCreate(
                            [
                                'employee_uuid'  => $data_one_row['nik_employee'],
                                'date' => $data_one_row['date'],
                            ],
                            $data_one_row
                        );
                        $validatedData['store'][] = $store;
                    }
                }

                // }
                break;
            default:

                $date_start =  Carbon::now()->format('Y-m-d');

                $data_database_datatable_data = $data_database_datatable;

                unset($data_database_datatable_data['uuid_data']);
                unset($data_database_datatable_data['data_table']);
                unset($data_database_datatable_data['_token']);
                unset($data_database_datatable_data['code_table']);

                $database_datatable['database_data_source'] = DatabaseController::getDataSource();
                // store input autocomplite
                if (!empty($data_database_datatable['data_source_this_field'])) { //store data source dari input autocomplite
                    foreach ($data_database_datatable['data_source_this_field'] as $data_source_this) {
                        $data_source_this_field = get_object_vars($data_source_this);
                        if (!empty($data_database_datatable_data[$data_source_this_field['code_field']])) {
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
                        }
                        unset($data_database_datatable_data['description-' . $data_source_this_field['code_field']]);
                    }
                }
                // store input autocomplite

                unset($data_database_datatable_data['data_source_this_field']);
                $Q_is_data_exist = DatabaseData::where('code_data', ResponseFormatter::toUUID($data_database_datatable[$request['data_table']['primary_table']]))->where('code_table_data',  $request['data_table']['code_table'])->whereNull('date_end')->get();

                if ($Q_is_data_exist->count() > 0) {
                    $AA = DatabaseData::where('code_data', ResponseFormatter::toUUID($data_database_datatable[$request['data_table']['primary_table']]))
                        ->where('code_table_data',  $request['data_table']['code_table'])->update(['date_end' => Carbon::now()->format('Y-m-d')]);
                }
                if ($request->code_table == 'DATA-SHIFT-KARYAWAN') {
                    $date_start = $data_database_datatable_data['TANGGAL-MULAI'];
                }

                // insert general
                $uuid_data = ($request->uuid_data) ? $request->uuid_data : Str::uuid();
                foreach ($data_database_datatable_data as $index => $value) {
                    // return ResponseFormatter::ResponseJson($index, "store database 2", 200);
                    if ($value) {
                        $store_data = DatabaseData::updateOrCreate(
                            [
                                'uuid_data' => $uuid_data,
                                'code_table_data' => $data_database_datatable['data_table']['code_table'],
                                'code_field_data' => $index,
                            ],
                            [
                                'value_data' => $value,
                                'code_data' => ResponseFormatter::toUUID($data_database_datatable[$data_database_datatable['data_table']['primary_table']]),
                                'uuid_data' => $uuid_data,
                                'date_start' => $date_start,
                                'date_end' => null,
                            ]
                        );
                    }
                }
                // insert general


                $code_table = $request['data_table']['code_table'];
                // if emp PHK
                if ($code_table == 'PHK-KARYAWAN') {
                    if (!empty($data_database_datatable['TANGGAL-BERAKHIR-KONTRAK--TBK-'])) {
                        //UPDATE ABSENSI
                        // ambil bulannya - ambil akhir bulan - loop 
                        $NRP = ResponseFormatter::toUUID($data_database_datatable_data[$data_database_datatable['data_table']['primary_table']]);


                        $data_absen = [
                            'NRP' => $NRP,
                            'date_start' => $data_database_datatable_data['TANGGAL-BERAKHIR-KONTRAK--TBK-'],
                            'date_end' => ResponseFormatter::getEndDayFromDate($data_database_datatable_data['TANGGAL-BERAKHIR-KONTRAK--TBK-']),
                            'status_absen_uuid' => 'X'
                        ];

                        EmployeeAbsen::storeAbsen($data_absen);

                        if (empty($data_database_datatable_data['JENIS-PHK'])) {
                            $data_database_datatable_data['JENIS-PHK'] = "PHK";

                            $store_data = DatabaseData::updateOrCreate(
                                [
                                    'uuid_data' => $uuid_data,
                                    'code_table_data' => $data_database_datatable['data_table']['code_table'],
                                    'code_field_data' => "JENIS-PHK",
                                ],
                                [
                                    'value_data' => "PHK",
                                    'code_data' => $NRP,
                                    'uuid_data' => $uuid_data,
                                    'date_start' => Carbon::now()->format('Y-m-d'),
                                    'date_end' => null,
                                ]
                            );
                        }

                        // STATUS KARYAWAN 
                        $store_data = DatabaseData::updateOrCreate(
                            [
                                'uuid_data' => $uuid_data,
                                'code_table_data' => "KARYAWAN",
                                'code_field_data' => "STATUS-KERJA",
                            ],
                            [
                                'value_data' => "PHK",
                                'code_data' => $NRP,
                                'uuid_data' => $uuid_data,
                                'date_start' => Carbon::now()->format('Y-m-d'),
                                'date_end' => null,
                            ]
                        );
                    }
                }


                if ($code_table == 'KARYAWAN') {
                    $NRP = ResponseFormatter::toUUID($data_database_datatable_data[$data_database_datatable['data_table']['primary_table']]);
                    $obj_TMK = ResponseFormatter::dateToArray($data_database_datatable_data['TANGGAL-MASUK-KERJA--TMK-']);
                    $data_absen = [
                        'NRP' => $NRP,
                        'date_start' => $obj_TMK['year'] . '-' . $obj_TMK['month'] . '-01',
                        'date_end' => $data_database_datatable_data['TANGGAL-MASUK-KERJA--TMK-'],
                        'status_absen_uuid' => 'X'
                    ];

                    EmployeeAbsen::storeAbsen($data_absen);
                    $data_absen = [
                        'NRP' => $NRP,
                        'date_start' => $data_database_datatable_data['TANGGAL-MASUK-KERJA--TMK-'],
                        'date_end' => $data_database_datatable_data['TANGGAL-MASUK-KERJA--TMK-'],
                        'status_absen_uuid' => 'DS'
                    ];

                    EmployeeAbsen::storeAbsen($data_absen);

                    if (!empty($data_database_datatable_data['NIK-KTP'])) {
                        User::updateOrCreate([
                            'uuid' => $NRP,
                            'employee_uuid' => $NRP,
                            'nik_employee' => $NRP,

                        ], [
                            'password' => Hash::make($data_database_datatable_data['NIK-KTP']),
                            'role' => 'employee'
                        ]);
                    }

                    // if (empty($data_database_datatable_data['NIK-KTP'])) {
                    //     $data_database_datatable_data['NIK-KTP'] = "password";

                    //     $store_data = DatabaseData::updateOrCreate(
                    //         [
                    //             'uuid_data' => $uuid_data,
                    //             'code_table_data' => 'IDENTITAS-KARYAWAN',
                    //             'code_field_data' => "NIK-KTP",
                    //         ],
                    //         [
                    //             'value_data' => "password",
                    //             'code_data' => $NRP,
                    //             'uuid_data' => $uuid_data,
                    //             'date_start' => Carbon::now()->format('Y-m-d'),
                    //             'date_end' => null,
                    //         ]
                    //     );
                    // }
                }

                return ResponseFormatter::ResponseJson($data_database_datatable_data, "store database 2", 200);
                return response()->json(['error' => 'Invalid action'], 400);
        }


        // return ResponseFormatter::ResponseJson($request->all(), "stored database", 200);

        if ($db['db']['database_persetujuan'][$request->code_table]) {
            $status = null;
            $date_change = null;

            foreach ($db['db']['database_persetujuan'][$request->code_table] as $code_level => $persetujuan) {
                if ($request[$code_level]) {
                    $status = null;
                    $date_change =  null;

                    if ($dibuat_oleh == $request->NRP) {
                        $status = null;
                        $date_change = null;

                        if ($persetujuan['grade'] == 'NRP') {
                            $status = 'ACC';
                            $date_change =  Carbon::today()->format('Y-m-d');
                        }
                    }

                    if ($request[$code_level] == $user->employee_uuid) {
                        if ($request->STATUS) {
                            $status = $request->STATUS;
                            $date_change =  Carbon::today()->format('Y-m-d');
                        }
                    }




                    if (!$dibuat_oleh) { //jika dibuat kosong berrti ini update
                        if ($request[$code_level] == $user->employee_uuid) { //jika update hanya yang sesuai dengan NRP yg update yg terupdate
                            if ($request->STATUS) {
                                $status = $request->STATUS;
                                $date_change =  Carbon::today()->format('Y-m-d');
                            }
                            $store_data = DatabaseDataPersetujuan::updateOrCreate(
                                [
                                    'code_data' => $code_data,
                                    'code_form' => $request->code_table,
                                    'nrp' => $request[$code_level],
                                    'level' => $code_level
                                ],
                                [
                                    'status' =>  $status,
                                    'date_change' => $date_change,
                                ]
                            );
                        }
                    } else {
                        $store_data = DatabaseDataPersetujuan::updateOrCreate(
                            [
                                'code_data' => $code_data,
                                'code_form' => $request->code_table,
                                'nrp' => $request[$code_level],
                                'level' => $code_level
                            ],
                            [
                                'status' =>  $status,
                                'date_change' => $date_change,
                            ]
                        );
                    }

                    /*
                        jika adminyang input harus ada file,
                            untuk sekarang masih bisa,
                        jika karyawan yang input admin tidak boleh me yes, atasan yang yes,
                    */
                }
            }
        }

        return ResponseFormatter::ResponseJson($request->all(), "stored database", 200);
    }

    public function store(Request $request)
    {
        $request_data = $request->data;
        // return ResponseFormatter::ResponseJson($request_data, "store database", 200);
        $code_table = ResponseFormatter::toUUID($request_data['description_table']);
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

        if (!empty($request_data['persetujuan'])) {

            $Q_delete = DatabasePersetujuan::where('form_code', $code_table)->delete();
            foreach ($request_data['persetujuan'] as $persetujuan) {
                DatabasePersetujuan::updateOrCreate(
                    [
                        'form_code' => $code_table,
                        'level' =>  $persetujuan['level'],
                        'grade' =>  $persetujuan['grade'],
                    ],
                    [
                        'form_code' => $code_table,
                        'level' =>  $persetujuan['level'],
                        'grade' =>  $persetujuan['grade'],
                        'description' =>  $persetujuan['description'],
                        'reference' =>  $persetujuan['reference'],
                    ]
                );
            }
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
        $auth_login =  $request->header('x-auth-login');
        $database_datatable = UserController::db_local_storage($auth_login);
        $db = session('db_local_storage');

        // return ResponseFormatter::ResponseJson($db['public']['public_value'][$request->code_table_data], 'saaaaaa', 200);
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

        if (!empty($db['public']['public_value'][$request->code_table_data])) {
            $Q_get_data = DatabaseData::where('code_table_data', $request->code_table_data)->whereNull('date_end')->get();
            $data_get_data = [];

            foreach ($Q_get_data as $item_get_data) {
                $data_get_data[$item_get_data->code_data][$item_get_data->code_field_data] = $item_get_data;
            }
            // return ResponseFormatter::ResponseJson('$name', $database_datatable, 200);
            foreach ($db['public']['public_value'][$request->code_table_data] as $code_data => $item_export) {
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
        $name = 'file/export/' . $code_table_data . '-' . rand(99, 9999) . '-file.xls';
        $crateWriter->save($name);

        return ResponseFormatter::ResponseJson($name, 'export database', 200);
    }


    public function importDatatable(Request $request) // PRIORITY-1
    {

        $the_file = $request->file('uploaded_file');
        $auth_login =  $request->header('x-auth-login');
        $database_datatable = [];
        $abjads = ResponseFormatter::abjads();
        $database_datatable['database_table'] = DatabaseController::getTables();
        $database_datatable['database_field'] = DatabaseController::getFields();
        $database_datatable['database_data_source'] = DatabaseController::getDataSource();


        $db = UserController::db_local_storage($auth_login);
        // $db = session('db_local_storage');
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
            $ARR_ALL = [];


            // 1. MENGAMBIL TABEL APA SAJA YANG IMPORT
                while ($sheet->getCell($abjads[$loop_col] . '1')->getValue() != null) {
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
            // 1. MENGAMBIL TABEL APA SAJA YANG IMPORT


            $i = 3;
            while ($sheet->getCell('A' . $i)->getValue() != null) {
                $uuid_data = Str::uuid();
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
                $i++;
            }

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
                }
            }

            if (in_array('IDENTITAS-KARYAWAN', $table_arr)) {
                if (in_array('NIK-KTP', $field_arr)) {
                    foreach ($arr_value as $row_to_insert) {
                        if ($row_to_insert['IDENTITAS-KARYAWAN']['NIK-KTP']) {
                            $for_users = [
                                'uuid' => ResponseFormatter::toUUID($row_to_insert['KARYAWAN']['NRP']),
                                'employee_uuid' => ResponseFormatter::toUUID($row_to_insert['KARYAWAN']['NRP']),
                                'nik_employee' => ResponseFormatter::toUUID($row_to_insert['KARYAWAN']['NRP']),
                                'password' => Hash::make($row_to_insert['IDENTITAS-KARYAWAN']['NIK-KTP']),
                                'role' => $row_to_insert['KONTRAK-KARYAWAN']['GRADE'],
                                'email' => (!empty($row_to_insert['IDENTITAS-KARYAWAN']['EMAIL'])) ? $row_to_insert['IDENTITAS-KARYAWAN']['EMAIL'] : null,
                                'phone_number' => (!empty($row_to_insert['IDENTITAS-KARYAWAN']['NO-HP'])) ? $row_to_insert['IDENTITAS-KARYAWAN']['NO-HP'] : null,
                            ];

                            // 10. MEMBUAT ID FINGGER
                                // $NRP = ;
                                // $ID_FINGER = ;
                                // $Q_store_data = DatabaseData::updateOrCreate(
                                //     [
                                //         'code_table_data' => 'DATABASE-KODE-TABEL-ID-FINGGER', //table data source
                                //         'code_field_data' => 'ID-FINGGER',
                                //         'code_data' => $NRP.'-'.$ID_FINGER, //GABUNGAN NRP+ID
                                //         'uuid_data' => ,
                                //     ],
                                //     [
                                //         'value_data' => $data_insert['value_data'],
                                //         'date_start' => Carbon::now()->format('Y-m-d'),
                                //         'date_end' => null,
                                //     ]
                                // );


                            // 10. MEMBUAT ID FINGGER

                            $for_users = array_filter($for_users);
                            User::updateOrCreate(
                                [
                                    'uuid' => ResponseFormatter::toUUID($row_to_insert['KARYAWAN']['NRP']),
                                    'employee_uuid' => ResponseFormatter::toUUID($row_to_insert['KARYAWAN']['NRP']),
                                    'nik_employee' => ResponseFormatter::toUUID($row_to_insert['KARYAWAN']['NRP']),
                                ],
                                $for_users
                            );
                        }
                        $ARR_ALL[$row_to_insert['KARYAWAN']['NRP']] = $for_users;
                    }
                }
            }
            // 11. JIKA KARYAWAN PHK
                // 11.1 ADD ABSENSI X
                if (in_array('PHK-KARYAWAN', $table_arr)) {
                    if (in_array('TANGGAL-BERAKHIR-KONTRAK--TBK-', $field_arr)) {
                        if (!empty($row_to_insert['PHK-KARYAWAN'])) {
                            $data_absen = [
                                'NRP' => ResponseFormatter::toUUID($row_to_insert['KARYAWAN']['NRP']),
                                'date_start' =>  $row_to_insert['PHK-KARYAWAN']['TANGGAL-BERAKHIR-KONTRAK--TBK-'],
                                'date_end' => ResponseFormatter::getEndDayFromDate($row_to_insert['KARYAWAN']['TANGGAL-BERAKHIR-KONTRAK--TBK-']),
                                'status_absen_uuid' => 'X'
                            ];
                            EmployeeAbsen::storeAbsen($data_absen);
                        }
                    }
                }
            // 11. JIKA KARYAWAN PHK
            
            // 12. ADA DATA KARYAWAN
                // 12.1 MENAMBAHKAN ABSENSI X KE TANGGAL SEBELUM MASUK
                if (in_array('KARYAWAN', $table_arr)) {
                    if (in_array('TANGGAL-MASUK-KERJA--TMK-', $field_arr)) {
                        $data_absen = [
                            'NRP' => ResponseFormatter::toUUID($row_to_insert['KARYAWAN']['NRP']),
                            'date_start' =>  ResponseFormatter::getStartDayFromDate($row_to_insert['KARYAWAN']['TANGGAL-MASUK-KERJA--TMK-']),
                            'date_end' => $row_to_insert['KARYAWAN']['TANGGAL-MASUK-KERJA--TMK-'],
                            'status_absen_uuid' => 'X'
                        ];
                        EmployeeAbsen::storeAbsen($data_absen);
                    }
                }
            // 12. ADA DATA KARYAWAN

            return ResponseFormatter::ResponseJson($ARR_ALL, 'store data from importDatatable', 200);
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


























































































    // remove this
    public function storeData(Request $request)
    {
        return ResponseFormatter::ResponseJson($request->all(), "store database", 200);

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

        $code_table = $request['data_table']['code_table'];
        // if emp PHK
        if ($code_table == 'PHK-KARYAWAN') {
            if (!empty($data_database_datatable['TANGGAL-BERAKHIR-KONTRAK--TBK-'])) {
                //UPDATE ABSENSI
                // ambil bulannya - ambil akhir bulan - loop 
                $NRP = ResponseFormatter::toUUID($data_database_datatable[$request['data_table']['primary_table']]);


                $data_absen = [
                    'NRP' => $NRP,
                    'date_start' => $data_database_datatable['TANGGAL-BERAKHIR-KONTRAK--TBK-'],
                    'date_end' => ResponseFormatter::getEndDayFromDate($data_database_datatable['TANGGAL-BERAKHIR-KONTRAK--TBK-']),
                    'status_absen_uuid' => 'X'
                ];

                EmployeeAbsen::storeAbsen($data_absen);

                if (empty($data_database_datatable['JENIS-PHK'])) {
                    $data_database_datatable['JENIS-PHK'] = "PHK";

                    $store_data = DatabaseData::updateOrCreate(
                        [
                            'uuid_data' => $uuid_data,
                            'code_table_data' => $request['data_table']['code_table'],
                            'code_field_data' => "JENIS-PHK",
                        ],
                        [
                            'value_data' => "PHK",
                            'code_data' => $NRP,
                            'uuid_data' => $uuid_data,
                            'date_start' => Carbon::now()->format('Y-m-d'),
                            'date_end' => null,
                        ]
                    );
                }

                // STATUS KARYAWAN 
                $store_data = DatabaseData::updateOrCreate(
                    [
                        'uuid_data' => $uuid_data,
                        'code_table_data' => "KARYAWAN",
                        'code_field_data' => "STATUS-KERJA",
                    ],
                    [
                        'value_data' => "PHK",
                        'code_data' => $NRP,
                        'uuid_data' => $uuid_data,
                        'date_start' => Carbon::now()->format('Y-m-d'),
                        'date_end' => null,
                    ]
                );
            }
        }

        if ($code_table == 'KARYAWAN') {
            $NRP = ResponseFormatter::toUUID($data_database_datatable[$request['data_table']['primary_table']]);
            $obj_TMK = ResponseFormatter::dateToArray($data_database_datatable['TANGGAL-MASUK-KERJA--TMK-']);
            $data_absen = [
                'NRP' => $NRP,
                'date_start' => $obj_TMK['year'] . '-' . $obj_TMK['month'] . '-01',
                'date_end' => $data_database_datatable['TANGGAL-MASUK-KERJA--TMK-'],
                'status_absen_uuid' => 'X'
            ];

            EmployeeAbsen::storeAbsen($data_absen);
            $data_absen = [
                'NRP' => $NRP,
                'date_start' => $data_database_datatable['TANGGAL-MASUK-KERJA--TMK-'],
                'date_end' => $data_database_datatable['TANGGAL-MASUK-KERJA--TMK-'],
                'status_absen_uuid' => 'DS'
            ];

            EmployeeAbsen::storeAbsen($data_absen);

            if (!empty($data_database_datatable['NIK-KTP'])) {
                User::updateOrCreate([
                    'uuid' => $NRP,
                    'employee_uuid' => $NRP,
                    'nik_employee' => $NRP,

                ], [
                    'password' => Hash::make($data_database_datatable['NIK-KTP']),
                    'role' => 'employee'
                ]);
            }

            if (empty($data_database_datatable['NIK-KTP'])) {
                $data_database_datatable['NIK-KTP'] = "password";

                $store_data = DatabaseData::updateOrCreate(
                    [
                        'uuid_data' => $uuid_data,
                        'code_table_data' => 'IDENTITAS-KARYAWAN',
                        'code_field_data' => "NIK-KTP",
                    ],
                    [
                        'value_data' => "password",
                        'code_data' => $NRP,
                        'uuid_data' => $uuid_data,
                        'date_start' => Carbon::now()->format('Y-m-d'),
                        'date_end' => null,
                    ]
                );
            }
        }





        $data_return['code_data'] = ResponseFormatter::toUUID($data_database_datatable[$request['data_table']['primary_table']]);
        $data_return['uuid_data'] = $uuid_data;
        $data_return['data_database_datatable'] = $data_database_datatable;
        // return $data_return;

        return ResponseFormatter::ResponseJson($data_return, "store database", 200);
    }
}
