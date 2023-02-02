<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Position;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class PositionController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'position'
        ];
        return view('position.index', [
            'title'         => 'Jabatan',
            'layout'    => $layout
        ]);
    }

    public function delete(Request $request)
    {
         $store = Position::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }


    public function anyData(){
        $data = Position::all();
        return DataTables::of($data)    
        ->make(true);
    }

    public function export(){
        $arr_data = Position::all();
        // dd($arr_data);
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A1', 'Database :');
        
        $createSheet->setCellValue('B1', 'Jabatan');
        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'Nama Jabatan');

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/database-jabatan-'.rand(99,9999).'file.xls';
        $row = 6;
        $each = 1;
        foreach($arr_data as $item){
            $createSheet->setCellValue('A'.$row, $each);
            $createSheet->setCellValue('B'.$row, $item->position);
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
                $data['position'] = $sheet->getCell( 'B'.$no_employee)->getValue();
                $data['uuid'] = ResponseFormatter::toUUID( $data['position']);    
                $data['date_start'] = '2000-01-01';    
                if(!empty($data)){
                    $store = Position::updateOrCreate(['uuid' => $data['uuid']], $data);
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
            $validateData['uuid'] = ResponseFormatter::toUUID($validateData['position']);
        }

        $strore = Position::updateOrCreate(['uuid' => $request->uuid], $validateData);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

  
    public function show(Request $request){
        $data = Position::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    

    
  

   
    public function destroy($position)
    {
        $data = Position::where('id', $position)->first();
        $post= Position::find($position)->delete();
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $data], 200);

    }
}
