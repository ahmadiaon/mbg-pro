<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeCuti;
use App\Models\Employee\EmployeeCutiGroup;
use App\Models\Employee\EmployeeCutiSetup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class EmployeeCutiController extends Controller
{
    public function index(){
        $employees = Employee::getAll();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-cuti'
        ];
        $data =[
            [
                'x'  => 'Ahmadi',
                'y' => [
                    '2022-01-01',
                    '2022-02-21'

                ],
            ],
            [
                'x'  => 'Ahmadi',
                'y' => [
                    '2022-03-03',
                    '2022-05-23'

                ],
            ],
        ];

        $group_names = EmployeeCutiGroup::all();
        $group_namees = [];
        foreach($group_names as $group_name){
            $group_namees[] = $group_name->name_group_cuti;
        }
        // return 'a';
        $employee_setup_cutis = EmployeeCutiSetup::join('employees', 'employees.uuid', 'employee_cuti_setups.employee_uuid')
        ->join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
        ->get([
            'user_details.name',
            'employee_cuti_setups.*'
        ]);

        $cuti = [];
        $employee_cuti = [];
        $work=[];
        $date_today = Carbon::today();
        $date_half_year_prev = Carbon::today()->subDay(180);
        $date_half_year_next =  Carbon::today()->addDay(180);

        foreach($employee_setup_cutis as $employee_setup_cuti){
            $isLoop = true;
            $date_cuti_employe = [];
            $date_works = $employee_setup_cuti->date_start_work;          
            $date_work = Carbon::createFromFormat('Y-m-d', $date_works); 
            $count_ = 1; 
            $day_new_work = 0;
            while($isLoop){
                // dd($employee_setup_cuti);
                $date_ = (int)$employee_setup_cuti->roaster_uuid + $day_new_work ;
                $long_cuti = $date_ + 14;
                $day_new_work = $long_cuti + 1;
              
                $date_start_cuti= Carbon::createFromFormat('Y-m-d', $date_works)->addDay(($date_));
                $date_end_cuti = Carbon::createFromFormat('Y-m-d', $date_works)->addDay($long_cuti);
               

               
                if(($date_work > $date_half_year_prev) && ($date_work < $date_half_year_next) ){
                    $data_cuti= [
                        'x' => $employee_setup_cuti->name,
                        'y' => [
                            // $date_work
                            $date_start_cuti, $date_end_cuti
                        ]
                    ];

                    $cuti[] =$data_cuti;
                    $date_cuti_employe[] = $date_start_cuti->format('Y-m-d').' sd '.$date_end_cuti->format('Y-m-d');
                    
                }else{
                    $isLoop = false;
                }
                
                $date_work = Carbon::createFromFormat('Y-m-d', $date_works)->addDay($day_new_work);
                $count_++;
            } 
            $employee_cuti[$employee_setup_cuti->employee_uuid] = $date_cuti_employe;
        }
        

        // return view('datatableshow', [ 'data'         => $employeeee]);
        // dd($employeeee);
       
        return view('employee.cuti.index', [
            'title'         => 'Karyawan Cuti',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'employees' => $employees,
            'nik_employee' => '',
            'data_cuti' => $data_cuti,
            'employees_schedule_cuti' => $employee_cuti,
            'employee_cuti_groups' => $group_namees,
            'cutis' => $cuti
        ]);
    }

    public function anyData(Request $request){
        
        $date = explode("-", $request->year_month);
        $year = $date[0];
        $month = $date[1];
        
        $employeeee = Employee::noGet_employeeAll()
        ->join('employee_cutis','employee_cutis.employee_uuid', 'nik_employee')
        ->get();


        return DataTables::of($employeeee)    
        ->make(true);
        
        return ResponseFormatter::toJson($employeeee, 'bbb');
    }

    public function import(Request $request){
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
                $group_cuti_uuid = ResponseFormatter::toUUID($sheet->getCell( 'G'.$no_employee)->getValue());

                $store_group_cuti = EmployeeCutiGroup::updateOrCreate(['uuid' => $group_cuti_uuid], ['name_group_cuti' => $sheet->getCell( 'G'.$no_employee)->getValue()]);

                $employee_cuti_setup = [
                    'employee_uuid'  => $employee_uuid,
                    'roaster_uuid' =>  $sheet->getCell( 'E'.$no_employee)->getValue(),
                    'date_start_work'    => $date,
                    'group_cuti_uuid'    => $store_group_cuti->uuid,
                    'date_start'    => $date,
                ];
                $store_group_cuti = EmployeeCutiSetup::updateOrCreate(['uuid' => $employee_uuid], $employee_cuti_setup);               
                $no_employee++;
            }
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();


        
        $employee_cutis = EmployeeCutiSetup::all();

        $employee_setup_cutis = EmployeeCutiSetup::join('employees', 'employees.uuid', 'employee_cuti_setups.employee_uuid')
        ->join('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
        ->get([
            'user_details.name',
            'employee_cuti_setups.*'
        ]);

        $cuti = [];
        $work=[];
        $date_today = Carbon::today();
        $date_half_year_prev = Carbon::today()->subDay(180);
        $date_half_year_next =  Carbon::today()->addDay(180);

        foreach($employee_setup_cutis as $employee_setup_cuti){
            $isLoop = true;
            

            while($isLoop){
                $date_work = $employee_setup_cuti->date_start_work;
                $date_start_work = Carbon::createFromFormat('Y-m-d', $date_work );
                $date_end_work = $date_start_work->addDay(70);
                // dd($date_end_work);
                $ret = [
                    'date_prev' => $date_half_year_prev,
                    'date_now'  => $date_today,
                    'date_next' => $date_half_year_next,
                    'date_start_work'   => $date_start_work,
                    'date_end_work' => $date_end_work
                ];

                // dd($ret);
                if(($date_work > $date_half_year_prev) && ($date_work < $date_half_year_next) ){
                    $employee_setup_cuti->date_start_work;
                    $cuti[]= [
                        'x' => $employee_setup_cuti->name,
                        'y' => [
                            $date_start_work, $date_end_work
                        ]
                    ];
                    dd($cuti);
                }
                return 'a';
            }
        }
        dd($employee_cutis);
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
                $roaster_uuid = ResponseFormatter::toUUID($sheet->getCell( 'E'.$no_employee)->getValue());
                $date_start_work = ResponseFormatter::excelToDate($sheet->getCell( 'F'.$no_employee)->getValue());

                $employee_setup_cutis = [
                    'employee_uuid'  => $employee_uuid,
                    'roaster_uuid' =>  $roaster_uuid,
                    // 'date_start_work'   => 
                    
                    // 'date_out'    => $date
                ];

                // EmployeeCuti::updateOrCreate(['uuid'=> $employee_uuid ],$employee_out);
               
                $no_employee++;
            }
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();
    }

    public function store(Request $request){
        return ResponseFormatter::toJson($request->all(), 'Data Stored');
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
       
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }
}
