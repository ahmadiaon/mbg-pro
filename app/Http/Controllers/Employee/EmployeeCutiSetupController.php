<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeCuti;
use App\Models\Employee\EmployeeCutiGroup;
use App\Models\Employee\EmployeeCutiSetup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class EmployeeCutiSetupController extends Controller
{
    public function store(Request $request){
        $group_cuti_uuid =  ResponseFormatter::toUUID($request->group_cuti_name);

        $storeGroupEmployeeCuti = EmployeeCutiGroup::updateOrCreate(['uuid' => $group_cuti_uuid], ['name_group_cuti' => $request->group_cuti_name]);

        $strore = EmployeeCutiSetup::updateOrCreate(['uuid' => $request->employee_uuid], 
        [
            'employee_uuid' => $request->employee_uuid,
            'roaster_uuid' => $request->roaster_uuid,
            'date_start_work' => $request->date_start_work,
            'group_cuti_uuid' => $storeGroupEmployeeCuti->uuid,
            'date_start'    => $request->date_start,
            'date_end'    => $request->date_end,
        ]);

        Employee::updateOrCreate(['nik_employee' => $strore->employee_uuid, 'date_end' => null],['roaster_uuid' => $strore->roaster_uuid]);


       
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }
    public function export($year_month){
        $row = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Setup Cuti Data Karyawan keluar');
        $createSheet->setCellValue('C1', 'Setup Cuti');
        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');
        $createSheet->setCellValue('E5', 'Roaster');
        $createSheet->setCellValue('F5', 'Tanggal Awal Bekerja');
        $createSheet->setCellValue('G5', 'Group Cuti');
        

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/karyawan_keluar/Template Karyawan Cuti -'.'-'.rand(99,9999).'file.xls';
        $crateWriter->save($name);
        return response()->download($name);
    }

    public function show(Request $request){
        $data = EmployeeCutiSetup::join('employee_cuti_groups', 'employee_cuti_groups.uuid', 'employee_cuti_setups.group_cuti_uuid')
        ->where('employee_cuti_setups.uuid', $request->uuid)->get([
            'employee_cuti_groups.name_group_cuti',
            'employee_cuti_setups.*'
        ])->first();

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    public function delete(Request $request)
    {
         $store = EmployeeCutiSetup::where('uuid',$request->uuid)->delete();
         return ResponseFormatter::toJson($store, 'Data Privilege');
    }

    

    public function anyData(Request $request){
        if(!empty($request->filter['group_cuti_uuid'])){
            $data = EmployeeCutiSetup::join('employees','employees.uuid','employee_cuti_setups.employee_uuid')
            ->join('user_details','user_details.uuid', 'employees.user_detail_uuid')
            ->join('positions', 'positions.uuid', 'employees.position_uuid')
            ->join('employee_cuti_groups', 'employee_cuti_groups.uuid', 'employee_cuti_setups.group_cuti_uuid')
            ->whereNull('employees.date_end')
            ->whereNull('user_details.date_end')
            ->whereNull('employee_cuti_setups.date_end')
            ->where('employee_cuti_setups.group_cuti_uuid', $request->filter['group_cuti_uuid'])
            ->get([
                'employee_cuti_groups.name_group_cuti',
                'user_details.name',
                'positions.position',
                'employees.uuid as employee_uuid',
                'employee_cuti_setups.*',
                'employees.*'
            ]);
        }else{
            $data = EmployeeCutiSetup::join('employees','employees.uuid','employee_cuti_setups.employee_uuid')
            ->join('user_details','user_details.uuid', 'employees.user_detail_uuid')
            ->join('positions', 'positions.uuid', 'employees.position_uuid')
            ->join('employee_cuti_groups', 'employee_cuti_groups.uuid', 'employee_cuti_setups.group_cuti_uuid')
            ->whereNull('employees.date_end')
            ->whereNull('employee_cuti_setups.date_end')
            ->whereNull('user_details.date_end')
            ->get([
                'employee_cuti_groups.name_group_cuti',
                'user_details.name',
                'positions.position',
                'employees.uuid as employee_uuid',
                'employee_cuti_setups.*',
                'employees.*'
            ]);
        }   

        return DataTables::of($data)    
        ->make(true);
    }
}
