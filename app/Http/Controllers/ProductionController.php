<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Premi;
use App\Models\Production;
use Carbon\Carbon;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class ProductionController extends Controller
{
    public function index(){
        $premis = Premi::all();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'production'
        ];
        return view('production.index', [
            'title'         => 'Production',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'premis'    => $premis,
            'today'        => Carbon::today()->isoFormat('Y-MM-DD'),
            'nik_employee' => ''
        ]);
    }
    public function show(Request $request){
        $data = Production::where('uuid', $request->uuid)->get()->first();

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }
    public function delete(Request $request)
    {
         $delete = Production::where('uuid',$request->uuid)->delete();
 
         return ResponseFormatter::toJson($delete, 'Production Deleted');
    }

    public function import(Request $request){
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();

            $rows = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
            $no_employee = 6;
            $employees = [];

            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){

                $data = [
                    'date_production' => ResponseFormatter::excelToDate($sheet->getCell( 'B'.$no_employee)->getValue()),
                    'premi_uuid'    => ResponseFormatter::toUUID($sheet->getCell( 'C'.$no_employee)->getValue()),
                    'value_production'    => $sheet->getCell( 'D'.$no_employee)->getValue(),
                ];

                $employees[] = Production::updateOrCreate(['uuid' => $data['date_production'].'-'.$data['premi_uuid']], $data);

                $no_employee++;
            }
            return back();
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function store(Request $request){
        $validateData = $request->all();
        if(empty($validateData['uuid'])){
            $validateData['uuid'] = $validateData['date_production'].'-'.$validateData['premi_uuid'];
        }
        $store = Production::updateOrCreate(['uuid' => $validateData['uuid']] ,$validateData);
        
        return ResponseFormatter::toJson($validateData, 'Data Stored');
    }

    public function create(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'production'
        ];

        $premis = Premi::all();

        return view('production.create', [
            'title'         => 'Tonase',
            'today'        => Carbon::today()->isoFormat('Y-MM-DD'),
            'premis'    => $premis,
            'layout'    => $layout
        ]);
    }

    public function anyData(Request $request){
        $validateData = $request->all();

        $date = explode("-", $validateData['filter']['date_filter']['date_end_filter_range']);
        $year = $date[0];
        $month = $date[1];
        

        $datax = Production::join('premis', 'premis.uuid', 'productions.premi_uuid')
        ->whereYear('productions.date_production', $year)
        ->whereMonth('productions.date_production', $month)
        ->get([
            'premis.premi_name',
            'productions.*'
        ]);
        
        $data = [
            'request' => $validateData,
            'data_datatable' => $datax
        ];
        return ResponseFormatter::toJson($data, 'from production');

    }
}
