<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Poh;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class PohController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'poh'
        ];
        return view('poh.index', [
            'title'         => 'Daftar POH',
            'layout'    => $layout
        ]);
    }
    public function anyData(){
        $data = Poh::all();
        return DataTables::of($data)    
        ->make(true);
    }
    public function show(Request $request){
        $data = Poh::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    public function delete(Request $request)
    {
         $store = Poh::where('uuid',$request->uuid)->delete(); 
         return ResponseFormatter::toJson($store, 'Data Deleted');
    }

    public function export(){
        $arr_data = Poh::all();
        // dd($arr_data);
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A1', 'Database :');
        
        $createSheet->setCellValue('B1', 'POH');
        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'Nama POH');
        $createSheet->setCellValue('C5', 'Harga POH');

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/database-poh-'.rand(99,9999).'file.xls';
        $row = 6;
        $each = 1;
        foreach($arr_data as $item){
            $createSheet->setCellValue('A'.$row, $each);
            $createSheet->setCellValue('B'.$row, $item->name);
            $createSheet->setCellValue('C'.$row, $item->value);
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
                $data['name'] = $sheet->getCell( 'B'.$no_employee)->getValue();
                $data['value'] = $sheet->getCell( 'C'.$no_employee)->getValue();
                $data['uuid'] = ResponseFormatter::toUUID( $data['name']);    
                $data['date_start'] = '2000-01-01';    
                if(!empty($data)){
                    $store = Poh::updateOrCreate(['uuid' => $data['uuid']], $data);
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
        $validateData = $request->all();
        if(empty($validateData['uuid'])){
            $validateData['uuid'] = ResponseFormatter::toUUID($validateData['name']);
        }

        $strore = Poh::updateOrCreate(['uuid' => $validateData['uuid']], $validateData);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

}
