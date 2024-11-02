<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Aktivity\Aktivity;
use App\Models\DatabaseData;
use App\Models\Employee\EmployeeAbsen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class WebAbsensiController extends Controller
{
    public function index(){
        return view('app.pendapatan.absensi.index_list', [
            'title'         => 'Absensi'
        ]);
    }

    public function fileIndex(){
        return view('app.pendapatan.absensi.index_file_fingger', [
            'title'         => 'Absensi'
        ]);
    }

    public function slip(){
        return view('app.pendapatan.slip.index', [
            'title'         => 'Slip'
        ]);
    }

    public function slipManage(){
        return view('app.manage.slip.index', [
            'title'         => 'Slip'
        ]);
    }

    public function storeListAbsensi(Request $request){

        // return ResponseFormatter::ResponseJson($request->all(), 'Store Success', 200);
        $date_end = ResponseFormatter::addDate($request['ketidakhadiran-date_start'], $request['ketidakhadiran-long_day']);

        $data_absen = [
            'NRP' => $request['ketidakhadiran-NRP'],
            'date_start' => $request['ketidakhadiran-date_start'],
            'date_end' => $date_end,
            'status_absen_uuid' => $request['ketidakhadiran-staus_absen_uuid']
        ];

        EmployeeAbsen::storeAbsen($data_absen);
        return ResponseFormatter::ResponseJson($request->all(), 'Store Success', 200);
    }

    public function manageIndex(){
        // dd(Session::all());
        $arr = [];
        foreach(Aktivity::where('table_name', 'ID-FINGGER-KARYAWAN')->where('field', '!=', 'CREATED-BY')->get() as $item){
            $arr[$item->value_field][$item->field] = $item->value_field;
        }

        foreach($arr as $x=>$xx){

            // $data_insert = [
            //     'code_table_data' => 'DATABASE-KODE-TABEL-ID-FINGGER',
            //     'code_field_data' => 'ID-FINGGER',
            //     'value_data' => $xx['ID-FINGGER'],
            //     'code_data' => ResponseFormatter::toUUID($xx['ID-KARYAWAN'].'-'.$xx['ID-FINGGER']),
            //     'uuid_data' => $x, 
            // ];

            // $data_insert = [
            //     'code_table_data' => 'DATABASE-KODE-TABEL-ID-FINGGER',
            //     'code_field_data' => 'KODE-TABEL-ID-FINGGER',
            //     'value_data' => ResponseFormatter::toUUID($xx['ID-KARYAWAN'].'-'.$xx['ID-FINGGER']),
            //     'code_data' => ResponseFormatter::toUUID($xx['ID-KARYAWAN'].'-'.$xx['ID-FINGGER']),
            //     'uuid_data' => $x, 
            // ];

            // $Q_store_data = DatabaseData::updateOrCreate(
            //     [
            //         'code_table_data' => $data_insert['code_table_data'], //table data source
            //         'code_field_data' => $data_insert['code_field_data'],
            //         'code_data' => $data_insert['code_data'], //value primary key
            //         'uuid_data' => $x,
            //     ],
            //     [
            //         'value_data' => $data_insert['value_data'],
            //         'date_start' => Carbon::now()->format('Y-m-d'),
            //         'date_end' => null,
            //     ]
            // );
            // $data_insert = [
            //     'code_table_data' => 'DATABASE-KODE-TABEL-ID-FINGGER',
            //     'code_field_data' => 'NRP',
            //     'value_data' => $xx['ID-KARYAWAN'],
            //     'code_data' => ResponseFormatter::toUUID($xx['ID-KARYAWAN'].'-'.$xx['ID-FINGGER']),
            //     'uuid_data' => $x, 
            // ];

            // $Q_store_data = DatabaseData::updateOrCreate(
            //     [
            //         'code_table_data' => $data_insert['code_table_data'], //table data source
            //         'code_field_data' => $data_insert['code_field_data'],
            //         'code_data' => $data_insert['code_data'], //value primary key
            //         'uuid_data' => $x,
            //     ],
            //     [
            //         'value_data' => $data_insert['value_data'],
            //         'date_start' => Carbon::now()->format('Y-m-d'),
            //         'date_end' => null,
            //     ]
            // );

        }


        return view('app.manage.absensi.index', [
            'title'         => 'Slip'
        ]);
    }
}
