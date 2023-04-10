<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\EmployeeOut;
use Carbon\Carbon;

use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeDocument;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Yajra\DataTables\Facades\DataTables;

class EmployeeOutController extends Controller
{
    
    public function index(){
        $employees = Employee::data_employee();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-out'
        ];
        return view('employee.out.index', [
            'title'         => 'Karyawan Keluar',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'employees' => $employees,
            'nik_employee' => ''
        ]);
    }

    public function import(Request $request){
        // return 'aaa';
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $rows = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
            $no_employee = 6;
            $employees = [];

            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                $date_row = 3;

                $employee_uuid = ResponseFormatter::toUUID($sheet->getCell( 'B'.$no_employee)->getValue());
                $date = ResponseFormatter::excelToDate($sheet->getCell( 'F'.$no_employee)->getValue());


                $employee_out = [
                    'employee_uuid'  => $employee_uuid,
                    'out_status' =>  $sheet->getCell( 'E'.$no_employee)->getValue(),
                    'date_out'    => $date
                ];

                EmployeeOut::updateOrCreate(['uuid'=> $employee_uuid ],$employee_out);
               
                $no_employee++;
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();
    }

    public function store(Request $request){
        $employee_uuid = $request->employee_uuid;
        $validatedData = $request->all();
        $data_employees = session('data_database')['data_employees'][$validatedData['employee_uuid']];
       

        $employee_out = [
            'employee_uuid' => $employee_uuid,
            'date_out'  => $request->date_out,
            'date_start'  => $request->date_out,
            'out_status'    => $request->out_status,
        ];
        $arr_date_out = explode('-', $request->date_out);
        $store = EmployeeOut::updateOrCreate(['uuid' => $employee_uuid], $employee_out);
       
        
        $store = Employee::updateOrCreate(['uuid' => $employee_uuid, 'date_end' => null], ['employee_status' => 'out']);
        $endDateThisMonth = ResponseFormatter::getEndDay($arr_date_out[0].'-'.$arr_date_out[1]);
        
     
      
        if($request->file('document_out')) {
            $document_name =   $employee_uuid.'-'.mt_rand(5, 99985) . '.'.$request->document_out->getClientOriginalExtension();
            $name = 'file/karyawan_keluar/'.$document_name;

            $isMoved = $request->document_out->move('file/karyawan_keluar/',$name);

            $store_employee_document = EmployeeDocument::updateOrCreate(['uuid' => 'EMPLOYEE-OUT-'.$employee_uuid], [
                'employee_uuid' => $employee_uuid,
                'document_path' => $document_name,
                'document_table_name'   => 'employee_outs'
            ]);
        }
        $startDate = new \DateTime($request->date_out);
        $endDate = new \DateTime($arr_date_out[0].'-'.$arr_date_out[1].'-'.$endDateThisMonth);
        $validatedData['status_absen_uuid']  = 'X';
        $validatedData['employee_uuid'] = $data_employees['machine_id'];
        for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
            $validatedData['date'] = $date->format('Y-m-d');
            $validatedData['uuid']  = $validatedData['date'] . '-' .$validatedData['employee_uuid'];
            $store = EmployeeAbsen::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        }


        return ResponseFormatter::toJson($store, 'no file data request');        
    }

    public function dataOut(Request $request){
        $date = explode("-", $request->year_month);
        $year = $date[0];
        $month = $date[1];

        $employee_outs = EmployeeOut::join('employees', 'employees.uuid', 'employee_outs.employee_uuid')
        ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->whereYear('date_out', $year)
        ->whereMonth('date_out', $month)
        ->get([
            'user_details.photo_path',
            'employees.nik_employee',
            'positions.position',
            'user_details.name',
            'employee_outs.*'
        ]);

        $employee_outs = $employee_outs->keyBy(function ($item) {
            return strval($item->uuid);
        });

        
        foreach($employee_outs as $emp_out){
            $emp_out->document_path = null;
        }

        $employee_documents = EmployeeDocument::join('employee_outs','employee_outs.employee_uuid','employee_documents.employee_uuid')
        ->where('document_table_name', 'employee_outs')
        ->whereYear('employee_outs.date_out', $year)
        ->whereMonth('employee_outs.date_out', $month)
        ->get();

        foreach($employee_documents as $item){
            $employee_outs[$item->employee_uuid]->document_path = $item->document_path;
        }




        return DataTables::of($employee_outs)
        ->make(true);



        // return ResponseFormatter::toJson($employee_outs, 'bbb');
    }

    public function export($year_month){
        $row = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Import Data Karyawan keluar');
        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');
        $createSheet->setCellValue('E5', 'Keterangan');
        $createSheet->setCellValue('F5', 'Tanggal');
        

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/karyawan_keluar/Template Karyawan Keluar -'.'-'.rand(99,9999).'file.xls';
        $crateWriter->save($name);

        return response()->download($name);
    }

    public function delete(Request $request)
    {
         $store = EmployeeOut::where('uuid',$request->uuid)->delete();
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }
}
