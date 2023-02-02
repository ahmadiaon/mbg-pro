<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\HourMeterPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class HourMeterPriceController extends Controller
{
    public function index(){
        // return 'aa';
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'hour-meter-price'
        ];
        return view('hour_meter_price.index', [
            'title'         => 'Purchase Order',
            'layout'    => $layout,
        ]);
    }

    public function anyData(){
        $data = HourMeterPrice::orderBy('updated_at', 'asc')->get();

        
        return Datatables::of($data)
        ->addColumn('action', function ($model) {
            $uuid = $model->uuid;
            $delete = "'".$uuid."'";
            return '
            <div class="form-inline"> 
                <button onclick="editPrivilege('.$delete.')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
                    <i class="dw dw-edit2"></i>
                </button>
                <button onclick="deletePrivilege(' .$delete. ')"  type="button" class="btn btn-danger  py-1 px-2">
                    <i class="icon-copy dw dw-trash"></i>
                </button>
            </div>'
            ;
        })      
        ->make(true);
    }

    public function export(){
        $arr_data = HourMeterPrice::all();
        // dd($arr_data);
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A1', 'Database :');
        
        $createSheet->setCellValue('B1', 'Harga HM');
        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'Nama HM');
        $createSheet->setCellValue('C5', 'Nama Diexcel');
        $createSheet->setCellValue('D5', 'Harga HM');

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/database-harga-hm-'.rand(99,9999).'file.xls';
        $row = 6;
        $each = 1;
        foreach($arr_data as $item){
            $createSheet->setCellValue('A'.$row, $each);
            $createSheet->setCellValue('B'.$row, $item->hour_meter_name);
            $createSheet->setCellValue('C'.$row, $item->key_excel);
            $createSheet->setCellValue('D'.$row, $item->hour_meter_value);
            $each++;$row++;
        }
        $crateWriter->save($name);
        
        return response()->download($name);
        
    }

    public function import(Request $request){
        $the_file = $request->file('uploaded_file');
        try{
            $createSpreadsheet = new spreadsheet();
            $createSheet = $createSpreadsheet->getActiveSheet();
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
            $no_employee = 6;

            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                $data['hour_meter_name'] = $sheet->getCell( 'B'.$no_employee)->getValue();
                $data['hour_meter_value'] = $sheet->getCell( 'D'.$no_employee)->getValue();
                $data['key_excel'] = $sheet->getCell( 'C'.$no_employee)->getValue();
                $data['uuid'] = ResponseFormatter::toUUID( $data['hour_meter_name']);    
                $data['date_start'] = '2000-01-01';    
                if(!empty($data)){
                    $store = HourMeterPrice::updateOrCreate(['uuid' => $data['uuid']], $data);
                }
                $no_employee++;
            }
        } catch (Exception $e) {
            $error_code = $e;
            return back()->with('messageErr', 'file eror!');
        }
        return back();
    }

    public function store(Request $request){
        $validatedData = $request->all();
     
        if(empty($validatedData['uuid'])){
            $validatedData['uuid'] = ResponseFormatter::toUUID($validatedData['hour_meter_name']);
        }

        $store = HourMeterPrice::updateOrCreate(['uuid'=> $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($validatedData, 'Data Stored');
    }

    public function delete(Request $request)
    {
         $store = HourMeterPrice::where('uuid',$request->uuid)->delete();
 
         return response()->json(['code'=>200, 'message'=>'Data Deleted','data' => $store], 200);   
    }

    public function show(Request $request){
        $data = HourMeterPrice::where('uuid', $request->uuid)->get()->first();

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }



   public function indexPayrol(){
        $hour_meter_prices = HourMeterPrice::all();
        // dd($hour_meter_prices);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'mobilisasi'
        ];
        return view('hour_meter_price.payrol.index', [
            'title'         => 'Status Absen',
            'hour_meter_prices' => $hour_meter_prices,
            'layout'    => $layout
        ]);
   }

   public function showPayrol($uuid){
        $status_absen = HourMeterPrice::where('uuid', $uuid)->first();
        return response()->json(['code'=>200, 'message'=>'Data get','data' => $status_absen], 200);   
   }
}
