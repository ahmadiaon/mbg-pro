<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\CoalFrom;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class CoalFromController extends Controller
{
    public function index(){
        // return 'aa';
        $companies = Company::all();
        // dd($companies);
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'coal-from'
        ];
        return view('coal_from.index', [
            'title'         => 'Purchase Order',
            'layout'    => $layout,
            'companies' => $companies
        ]);
    }
    public function store(Request $request){
        $validatedData = $request->all();

        if(empty($validatedData['uuid'])){
            $validatedData['uuid'] = ResponseFormatter::toUUID($validatedData['coal_from']);
        }
       

        $store = CoalFrom::updateOrCreate(['uuid'=> $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, 'Data Stored');
    }
    public function export(){
        $arr_data = CoalFrom::join('companies','companies.uuid','coal_froms.company_uuid')->get();
// dd($arr_data);
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A1', 'Database :');
        
        $createSheet->setCellValue('B1', 'Jabatan');
        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'Perusahaan');
        $createSheet->setCellValue('C5', 'Asal Batu');
        $createSheet->setCellValue('D5', 'Harga');
        

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/database-jabatan-'.rand(99,9999).'file.xls';
        $row = 6;
        $each = 1;
        foreach($arr_data as $item){
            $createSheet->setCellValue('A'.$row, $each);
            $createSheet->setCellValue('B'.$row, $item->company);
            $createSheet->setCellValue('C'.$row, $item->coal_from);
            $createSheet->setCellValue('D'.$row, $item->hauling_price);
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
                $data['coal_from'] = $sheet->getCell( 'C'.$no_employee)->getValue();
                $data['hauling_price'] = $sheet->getCell( 'D'.$no_employee)->getValue();
                $data['uuid'] = ResponseFormatter::toUUID( $data['coal_from']);                    
                $data['company_uuid'] = ResponseFormatter::toUUID( $sheet->getCell( 'B'.$no_employee)->getValue());    
                $data['date_start'] = '2000-01-01';    
                if(!empty($data)){
                    $store = CoalFrom::updateOrCreate(['uuid' => $data['uuid']], $data);
                }
                $no_employee++;
            }
        } catch (Exception $e) {
            $error_code = $e;
            return back()->with('messageErr', 'file eror!');
        }
        return back();
    }


    public function anyData(){
        $data = CoalFrom::join('companies','companies.uuid','coal_froms.company_uuid')
        ->orderBy('coal_froms.updated_at', 'asc')
        ->get([
            'companies.company',
            'coal_froms.*'
        ]);

        
        return Datatables::of($data)    
        ->make(true);
    }
    public function delete(Request $request)
    {
         $store = CoalFrom::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }
    public function show(Request $request){
        $data = CoalFrom::where('uuid', $request->uuid)->get()->first();

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }
}
