<?php

namespace App\Http\Controllers\Privilege;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Privilege\Privilege;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class PrivilegeController extends Controller
{
    public function index(){
        // return 'aa';
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'privilege'
        ];
        return view('database.index', [
            'title'         => 'Purchase Order',
            'layout'    => $layout,
        ]);
    }

    public function anyData(){
        $data = Privilege::orderBy('updated_at', 'asc')->whereNull('deleted_at')->get();

        
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
        $arr_data = Privilege::all();
        // dd($arr_data);
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A1', 'Database :');
        
        $createSheet->setCellValue('B1', 'Privilege');
        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'Kode Privilege');
        $createSheet->setCellValue('C5', 'Nama Privilege');

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/database-privilege-'.rand(99,9999).'file.xls';
        $row = 6;
        $each = 1;
        foreach($arr_data as $item){
            $createSheet->setCellValue('A'.$row, $each);
            $createSheet->setCellValue('B'.$row, $item->uuid);
            $createSheet->setCellValue('C'.$row, $item->privilege);
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
                $data['uuid'] = $sheet->getCell( 'B'.$no_employee)->getValue();
                $data['privilege'] = $sheet->getCell( 'C'.$no_employee)->getValue();
                $data['date_start'] = '2000-01-01';    
                if(!empty($data)){
                    $store = Privilege::updateOrCreate(['uuid' => $data['uuid']], $data);
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
        $validatedData = $request->validate([
            'uuid' =>'',
            'privilege' =>'',
        ]);

        $store = Privilege::updateOrCreate(['uuid'=> $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, 'Data Stored');
    }

    public function delete(Request $request){
         $data = ['deleted_at'=>Carbon::now('Asia/Jakarta')];
         $store = Privilege::updateOrCreate(['uuid' => $request->uuid], $data);
 
         return response()->json(['code'=>200, 'message'=>'Data Deleted','data' => $store], 200);   
    }

    public function show(Request $request){
        $data = Privilege::where('uuid', $request->uuid)->where('deleted_at','=',null)->get()->first();

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }
}
