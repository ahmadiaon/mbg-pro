<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeTotalHmMonth;
use App\Models\HourMeterPrice;
use App\Models\StatusAbsen;
use App\Models\UserDetail\UserDetail;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\Storage;

use File;

use Response;


class EmployeeAbsenController extends Controller
{
    public function index(){
        $year = Carbon::today()->isoFormat('Y');
        $month =Carbon::today()->isoFormat('M');
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'list-employees-absensi'
        ];
        return view('employee.absensi.index', [
            'title'         => 'Absensi Karyawan',
            'month'     => $year.'-'.$month,
            'year'      => $year,
            'months'    => $month,
            'layout'    => $layout
        ]);
    }
    public function export($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $datetime = Carbon::createFromFormat('Y-m', $year.'-'.$month);
        $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');
        $employees = Employee::getAll();
        $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR'];
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A2', 'Absensi Bulan '.$months[$month].'-'.$year);
        $createSheet->setCellValue('A4', 'Nama');
        $createSheet->setCellValue('B4', 'NIK');
        $createSheet->setCellValue('C4', 'JABATAN');
        for($i = 1; $i <= $day_month; $i++){         
            $createSheet->setCellValue($abjads[$i+3].'4', $year_month.'-'.$i);
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/'.$year_month.'-'.rand(99,9999).'file.xlsx';
        $cell = 5;
        foreach($employees as $employee){
            $absens = EmployeeAbsen::where('employee_uuid', $employee->machine_id)
            ->whereYear('employee_absens.date', $year)
            ->whereMonth('employee_absens.date', $month)
            ->orderBy('employee_absens.date', 'asc')
            ->get();   
            $employee->absen = $absens;
            $createSheet->setCellValue('A'.$cell, $employee->name);
            $createSheet->setCellValue('B'.$cell, $employee->nik_employee);
            $createSheet->setCellValue('C'.$cell, $employee->position);
            $cell_absen = 1;
            foreach($absens as $item){
                // if($employee->machine_id == "ItaNorrahmahMedic" ){
                //     dd($absens);die;
                // }
                $createSheet->setCellValue($abjads[$cell_absen+3].$cell, $item->status_absen_uuid);
                $cell_absen++;
            }
            $cell++;
        }
        
        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/'.$year_month.'-'.rand(99,9999).'file.xlsx';
        // return $name;
        $crateWriter->save($name);

        return response()->download($name);
    }

    function ekstrackAbsen($absensi){
        $timeA = false; //from 00 to 6
        $timeB = false; //from 06 to 12
        $timeC = false; //from 12 to 17
        $timeD = false; //from 17 to 24
        // $statusAbsen;
        $cek_log =null;
        $absens = str_split( $absensi, 5);
        $count_time_zone = 0;
        foreach( $absens as $absen){
            
            $hour = str_split( $absen, 2);
            $hourInt    =  (int)$hour[0];
            if(( $hourInt >= 00) && ( $hourInt <= 5) ){
                if($timeA == false){
                    $count_time_zone++;
                }
                $timeA = true;
                
            }
            if(($hourInt >= 6)&&($hourInt <= 12) ){
                if($timeB == false){
                    $count_time_zone++;
                }
                $timeB = true;
                
            }
            if(($hourInt >=12)&&($hourInt <= 17) ){
                if($timeC == false){
                    $count_time_zone++;
                }
                $timeC = true;
            }
            if(( $hourInt >= 17) && ( $hourInt <= 23) ){
                if($timeD == false){
                    $count_time_zone++;
                }
                $timeD = true;
            }
            
            if($cek_log){
                $cek_log = $cek_log.".'".$absen."'";
            }else{
                $cek_log = "'".$absen."'";
            }
        }
        if($count_time_zone > 1){
            $statusAbsen = 'DS';
        }else if($count_time_zone == 1){
            $statusAbsen = 'TA';
        }else if($count_time_zone < 1){
            $statusAbsen = 'TC';
        }else{
            $statusAbsen = "unknown";
        }
        $data = [
            'cek_log' => $cek_log,
            'status_absen' => $statusAbsen,
            'count_zone'    => $count_time_zone
        ];
        return  $data;
    }

    public function import(Request $request){
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A1', 'nama');



        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'F', $column_limit );
            $startcount = 2;
            $data = array();

            $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH'];

            $tanggal = $sheet->getCell( 'C' . 3 )->getValue();

            $splitTanggal =  str_split( $tanggal, 1);

            $date_start =  $splitTanggal[8].$splitTanggal[9];
            $date_end   =  $splitTanggal[21].$splitTanggal[22]  + 1;
            $month_start = $splitTanggal[5].$splitTanggal[6] ;
            $month_end   =$splitTanggal[18].$splitTanggal[19] ;
            $year_start = $splitTanggal[0].$splitTanggal[1].$splitTanggal[2].$splitTanggal[3];
            $year_end  = $splitTanggal[13].$splitTanggal[14].$splitTanggal[15].$splitTanggal[16];

            $start_date = date_create($year_start."-".$month_start."-".$date_start);
            $end_date = date_create($year_end."-".$month_end."-".$date_end);
            $interval = date_diff($start_date, $end_date);
            $interval_data =  $interval->days;
            $period = new DatePeriod(
                new DateTime($year_start."-".$month_start."-".$date_start),
                new DateInterval('P1D'),
                new DateTime($year_end."-".$month_end."-".$date_end)
            );
           $date_data=array();
           foreach ($period as $key => $value) {
                $date_data[] = $value->format('Y-m-d');                
            }
            $employees_count = ($row_limit - 4)/2;
            $i= 5;


            // foreach employees
            for ($j=0; $j<$employees_count ;$j++ ) {
                $employeeName = $sheet->getCell( 'K' . $i )->getValue();
                $columnNow = $j + 2;
                $absensies = array();
                $count_day = 0;
                foreach($date_data as $abjad){
                    $machine_id = $sheet->getCell( 'C' . $i )->getValue();
                    $cell_d = $i+1;
                    $absensi = $sheet->getCell($abjads[$count_day] .$cell_d )->getValue();
                    if($absensi){
                        $statusAbsen = EmployeeAbsenController::ekstrackAbsen($absensi);
                        if(!empty($statusAbsen['cek_log'])){
                            $absensies= [
                                'employee_uuid'  => $employeeName,
                                'machine_id'   => $machine_id,
                                'uuid'  => $abjad.'-'.$employeeName,
                                'date' => $abjad,
                                'status_absen_uuid'     => $statusAbsen['status_absen'],
                                'count_zone'     => $statusAbsen['count_zone'],
                                'cek_log'       =>  $statusAbsen['cek_log'],
                            ];
                            EmployeeAbsen::updateOrCreate(['uuid' =>$abjad.'-'.$machine_id],$absensies);
                            $data[]=$absensies;
                        }
                    }
                   
                    
                    $count_day++;
                }
                // dd($data);  
                
                $i = $i+2;
            }
            var_dump($data);die;

            


            return 'true';
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }
    public function anyData($year_month){
        
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $employees = Employee::leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->get([
            'employees.nik_employee',
            'user_details.photo_path',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            'employees.machine_id',
            'user_details.name',
        ]);

        foreach($employees as $employee){
            $employee->pay = EmployeeAbsen::join('status_absens', 'status_absens.uuid','employee_absens.status_absen_uuid')
            ->where('employee_absens.employee_uuid', $employee->machine_id)
            ->whereYear('employee_absens.date', $year)
            ->where('status_absens.math', 'pay')
            ->whereMonth('employee_absens.date', $month)
            ->count();
            $employee->unpay = EmployeeAbsen::join('status_absens', 'status_absens.uuid','employee_absens.status_absen_uuid')
            ->where('employee_absens.employee_uuid', $employee->machine_id)
            ->whereYear('employee_absens.date', $year)
            ->where('status_absens.math', 'unpay')
            ->whereMonth('employee_absens.date', $month)
            ->count();
            $employee->cut = EmployeeAbsen::join('status_absens', 'status_absens.uuid','employee_absens.status_absen_uuid')
            ->where('employee_absens.employee_uuid', $employee->machine_id)
            ->whereYear('employee_absens.date', $year)
            ->where('status_absens.math', 'cut')
            ->whereMonth('employee_absens.date', $month)
            ->count();

        }
        
        // return view('datatableshow', [ 'data'         => $employees]);
       
        return Datatables::of($employees)
        ->make(true);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'employee_uuid' => '',
            'date' =>'',
            'status_absen_uuid' =>'',
        ]);

        $validatedData['uuid']  = $validatedData['date'].'-'.$validatedData['employee_uuid'];
        $validatedData['edited'] = 'edited';
        $store = EmployeeAbsen::updateOrCreate(['uuid' =>$validatedData['uuid']],$validatedData);
        return ResponseFormatter::toJson($store, "data stored");
    }


   public function anyDataEmployee($year_month, $nik_employee){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $data = Employee::join('employee_absens','employee_absens.employee_uuid','employees.machine_id')
        ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->where('employees.nik_employee', $nik_employee)
        ->whereYear('employee_absens.date', $year)
        ->whereMonth('employee_absens.date', $month)
        ->orderBy('employee_absens.date')
        ->get([
            'employees.nik_employee',
            'user_details.photo_path',
            'employee_absens.date',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            'employees.machine_id',
            'user_details.name',
            'employee_absens.status_absen_uuid',
            'employee_absens.cek_log'
        ]);
        return Datatables::of($data)
        ->make(true);
        return ResponseFormatter::toJson($data, 'udin');
        return view('datatableshow', [ 'data'         => $data]);
   }
   
      
    public function showPayrol($year_month, $employee_uuid){
        $nik_employeess = Employee::where_uuid($employee_uuid);
        $employee = Employee::where_employee_nik_employee_nullable($nik_employeess->nik_employee); 
        $status_absen = StatusAbsen::all();
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'list-employees-absensi'
        ];
        
        // for get last date (30/31)
        $datetime = Carbon::createFromFormat('Y-m', $year.'-'.$month);
        $lastDay = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');

        for($i=1; $i <= $lastDay; $i++){
            $day_date =$year.'-'.$month.'-'.$i;
            $data_absen_day = EmployeeAbsen::join('status_absens','status_absens.uuid','employee_absens.status_absen_uuid')
            ->where('employee_uuid', $employee->machine_id)
            ->where('date', $day_date)->get([
                'status_absens.status_absen_code',
                'status_absens.math',
                'employee_absens.*'
            ])->first();           
            // dd($data_absen_day);
            
            if(!$data_absen_day){
                $data_absen_day =collect([
                    'date'=> $day_date,
                    'cek_log'=> '',
                    'status_absen_code'=> 'NULL',
                    'math'=>  ''
                ]) ;
            }else{
                if($data_absen_day['cek_log'] == ''){
                    $data_absen_day['cek_log'] = "NULL";
                }
            }
            $data_absens[] = $data_absen_day;
        }
        //  dd($data_absens);
        return view('employee.absensi.show', [
            'title'         => 'Absensi Karyawan',
            'month'     => $year.'-'.$month,
            'year_month' => $year_month,
            'year'      => $year,
            'employee'  => $employee,
            'status_absen'  => $status_absen,
            'absens'    => $data_absens,
            'is'            => 'admin',
            'months'    => $month,
            'layout'    => $layout
        ]);
    }
    public function show($nik_employee){

         $employee = Employee::where_employee_nik_employee_nullable($nik_employee); 
         
         $layout = [
             'head_datatable'        => true,
             'javascript_datatable'  => true,
             'head_form'             => true,
             'javascript_form'       => true,
             'active'                        => 'list-employees-absensi'
         ];
         
         $year_month = Carbon::today('Asia/Jakarta')->isoFormat('Y-M');

         //  dd($data_absens);
         return view('employee.absensi.detail', [
             'title'         => 'Absensi Karyawan',
             'year_month' => $year_month,
             'status_absen' => '',
             'nik_employee'  => $nik_employee,
             'employee'  => $employee,
             'is'            => 'me',
             'layout'    => $layout
         ]);
     }
    public function showEmployee($year_month, $nik_employee){
       $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $employee = Employee::where_employee_nik_employee_nullable($nik_employee); 
        $status_absen = StatusAbsen::all();
        
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'list-employees-absensi'
        ];
        
        // for get last date (30/31)
        $datetime = Carbon::createFromFormat('Y-m', $year.'-'.$month);
        $lastDay = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');

        for($i=1; $i <= $lastDay; $i++){
            $day_date =$year.'-'.$month.'-'.$i;
            $data_absen_day = EmployeeAbsen::join('status_absens','status_absens.uuid','employee_absens.status_absen_uuid')
            ->where('employee_uuid', $employee->machine_id)
            ->where('date', $day_date)->get([
                'status_absens.status_absen_code',
                'status_absens.math',
                'employee_absens.*'
            ])->first();           
            // dd($data_absen_day);
            
            if(!$data_absen_day){
                $data_absen_day =collect([
                    'date'=> $day_date,
                    'cek_log'=> '',
                    'status_absen_code'=> 'NULL',
                    'math'=>  ''
                ]) ;
            }else{
                if($data_absen_day['cek_log'] == ''){
                    $data_absen_day['cek_log'] = "NULL";
                }
            }
            $data_absens[] = $data_absen_day;
        }
        //  dd($data_absens);
        return view('employee.absensi.detail', [
            'title'         => 'Absensi Karyawan',
            'month'     => $year.'-'.$month,
            'year_month' => $year_month,
            'nik_employee'  => $nik_employee,
            'year'      => $year,
            'employee'  => $employee,
            'status_absen'  => $status_absen,
            'absens'    => $data_absens,
            'is'            => 'admin',
            'months'    => $month,
            'layout'    => $layout
        ]);
    }

}
