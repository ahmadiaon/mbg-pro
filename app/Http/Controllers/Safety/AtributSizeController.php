<?php

namespace App\Http\Controllers\Safety;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Privilege\Privilege;
use App\Models\Safety\AtributSize;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class AtributSizeController extends Controller
{
    public function index(){

        $data_atribut_size_groups = AtributSize::where('size','group')->get();
        // dd($data_atribut_size_groups);
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'atribut-size'
        ];
        // $data_site = AtributSize::where('size', 'site_uuid')->get();
        // foreach($data_site as $item_companies){
        //     Privilege::updateOrCreate(['uuid' => 'site_privilege_'.$item_companies->uuid ], ['privilege' =>'site_privilege_'.$item_companies->uuid  ]);
        // }
        

        AtributSize::updateOrCreate(['uuid' => 'group'],['name_atribut' => 'GROUP', 'size'=>'group'] );

        return view('AtributSize.index', [
            'title'         => 'Satuan',
            'data_atribut_size_groups' => $data_atribut_size_groups,
            'layout'    => $layout
        ]);
    }

    public function delete(Request $request)
    {
         $store = AtributSize::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }


    public function anyData(){
        $data = AtributSize::orderBy('size')->get();
        return DataTables::of($data)    
        ->make(true);
    }

    public function export(){
        $arr_data = AtributSize::all();
        // dd($arr_data);
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A1', 'Database :');
        
        $createSheet->setCellValue('B1', 'Atribut');
        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'Kode Atribut');        
        $createSheet->setCellValue('C5', 'Nama Atribut');     
        $createSheet->setCellValue('D5', 'Nilai Atribut');
        $createSheet->setCellValue('E5', 'Group Atribut');


        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/database-atribut-'.rand(99,9999).'file.xls';
        $row = 6;
        $each = 1;
        foreach($arr_data as $item){
            $createSheet->setCellValue('A'.$row, $each);
            $createSheet->setCellValue('B'.$row, $item->uuid);
            $createSheet->setCellValue('C'.$row, $item->name_atribut);     
            $createSheet->setCellValue('D'.$row, $item->value_atribut);            
            $createSheet->setCellValue('E'.$row, $item->size);
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
                $data['uuid'] = ResponseFormatter::toUuidLower($sheet->getCell( 'B'.$no_employee)->getValue());                
                $data['size'] = ResponseFormatter::toUuidLower($sheet->getCell( 'E'.$no_employee)->getValue());
                $data['name_atribut'] = $sheet->getCell( 'C'.$no_employee)->getValue();
                $data['value_atribut'] = $sheet->getCell( 'D'.$no_employee)->getValue();
                $data['date_start'] = '2000-01-01';    
                if(!empty($data)){
                    $store = AtributSize::updateOrCreate(['uuid' => $data['uuid']], $data);
                    if($store->size == 'site_uuid'){
                        Privilege::updateOrCreate(['uuid' => 'site_privilege_'.$store->uuid ], ['privilege' =>'site_privilege_'.$store->uuid  ]);
                    }
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
            $validateData['uuid'] = ResponseFormatter::toUuidLower($validateData['name_atribut']);
        }
       
        $strore = AtributSize::updateOrCreate(['uuid' => $request->uuid], $validateData);
        if($strore->size == 'site_uuid'){
            Privilege::updateOrCreate(['uuid' => 'site_privilege_'.$strore->uuid ], ['privilege' =>'site_privilege_'.$strore->uuid  ]);
        }



        ResponseFormatter::setAllSession();
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }

  
    public function show(Request $request){
        $data = AtributSize::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

}
