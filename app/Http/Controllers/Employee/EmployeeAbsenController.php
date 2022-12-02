<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeAbsenTotal;
use App\Models\Employee\EmployeeTotalHmMonth;
use App\Models\HourMeterPrice;
use App\Models\Identity;
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
        $month = (int)$month;
        $datetime = Carbon::createFromFormat('Y-m', $year.'-'.$month);
        $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');
        $employees = Employee::getAll();
        $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR'];
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('A2', 'Absensi Bulan '.$months[(int)$month].'-'.$year);
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

    public function exportTemplate($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $month = (int)$month;
        $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $datetime = Carbon::createFromFormat('Y-m', $year.'-'.$month);
        $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');
        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
        
        $status_absens = StatusAbsen::orderBy('math', 'desc')->get();
        $status_absen_pay = StatusAbsen::where('math', 'pay')->get()->count();
        // return view('datatableshow', [ 'data'         => $status_absens]);
        
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Absen Excel');
        
        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B2', 'Perusahaan');
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);

        // $createSheet->setCellValue('A2', 'Absensi Bulan '.$months[$month].'-'.$year);
        $createSheet->setCellValue('B20', 'Nama');
        $createSheet->setCellValue('C20', 'NIK');
        $createSheet->setCellValue('D20', 'Jabatan');

        $status_absens_col = 1;
        $date_row = 4;
        // header table tanggal
        for($i = 1; $i <= $day_month; $i++){         
            $createSheet->setCellValue($abjads[$i+3].'20', $year_month.'-'.$i);
            $createSheet->getColumnDimension($abjads[$i+3])->setWidth(4);
            $createSheet->getStyle($abjads[$i+3]."20")->getAlignment()->setTextRotation(-90);
            $status_absens_col = 1;
            foreach($status_absens as $item){  
                $createSheet->setCellValue($abjads[$date_row].$status_absens_col,  $item->status_absen_code); 
                $status_absens_col++;
            }
            
            $date_row++;
        }
       
        // simpulan data
        $pay=[];
        $unpay=[];
        
        // dd($pay);
        // loop karyawan
        $employees = Identity::all();
        $employee_row = 21;
        $status_absens_col_employee = $date_row;
        $arr_status_absens = [];

        foreach($status_absens as $item){
            $createSheet->setCellValue($abjads[$date_row].'20',  $item->status_absen_code); 
            if($item->math == 'pay'){
                $pay[] = $abjads[$date_row];
            }else{
                $unpay[] = $abjads[$date_row];
            }
            $arr_status_absens[$item->status_absen_code] =$date_row;
            $date_row++;
        }
        $createSheet->setCellValue($abjads[$date_row].'20',  'pay'); 
        $createSheet->setCellValue($abjads[$date_row+1].'20',  'cut'); 

        // dd($pay);
        foreach($employees as $employee){

            $createSheet->setCellValue('B'.$employee_row,  $employee->name); 
            $createSheet->setCellValue('C'.$employee_row,  $employee->nik_employee); 
            $createSheet->setCellValue('D'.$employee_row,  $employee->position); 
            // data absen
            $data_absens_employee = EmployeeAbsen::where('employee_uuid', $employee->machine_id)
            ->whereYear('employee_absens.date', $year)
            ->whereMonth('employee_absens.date', $month)
            ->orderBy('employee_absens.date', 'asc')
            ->get([
                'employee_absens.*'
            ]);

            if($data_absens_employee->count() == 0){
                // return $year_month;
                return EmployeeAbsenTotal::where('nik_employee', $employee->nik_employee)
                ->where('year_month', $year_month)
                ->get();
            }

            foreach($data_absens_employee as $item){
                $date_explode = explode('-',$item->date);
                // dd($item);
                $item_date = $date_explode[2] + 3;
                $createSheet->setCellValue($abjads[$item_date].$employee_row,  $item->status_absen_uuid); 
            }


            foreach($arr_status_absens as $item=>$value){
                $column_start_date = 4;
                $column_end_date = $day_month + 3;
                
                $formula = '=COUNTIF('.$abjads[$column_start_date].$employee_row.':'.$abjads[$column_end_date].$employee_row.',"'.$item.'")';
                $createSheet->setCellValue($abjads[$value].$employee_row,  $formula); 
                
            }
            // simpulan dibayar
            $formula_pay = '=SUM(';
            foreach($pay as $p){
                $formula_pay = $formula_pay.$p.$employee_row.',';
            }
            $formula_pay  = rtrim($formula_pay, ",");
            $formula_pay = $formula_pay.')';
            $formula_unpay = '=SUM(';
            foreach($unpay as $p){
                $formula_unpay = $formula_unpay.$p.$employee_row.',';
            }
            $formula_unpay  = rtrim($formula_unpay, ",");
            $formula_unpay = $formula_unpay.')';
            // dd($formula_unpay);
            $createSheet->setCellValue($abjads[$date_row].$employee_row,  $formula_pay); 
            // simpulan potongan
            $createSheet->setCellValue($abjads[$date_row+1].$employee_row,  $formula_unpay); 




        //     $date_row = $status_absens_col_employee;
        //     $count_if_pay = '';
        //     foreach($status_absens as $item){
        //         $createSheet->setCellValue($abjads[$date_row].$employee_row,  $item->status_absen_code); 
        //         if($item->math == 'pay'){
        //             $pay[] = $abjads[$date_row];
        //         }
        //         $date_row++;
        //     }
            $employee_row++;
        }
        // return view('datatableshow', [ 'data'         => $employees]);




        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/'.$year_month.'-'.rand(99,9999).'file.xls';
        $crateWriter->save($name);

        return response()->download($name);


    }

    public function exportWithData($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $month = (int)$month;
        $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $datetime = Carbon::createFromFormat('Y-m', $year.'-'.$month);
        $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');
        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
        
        $status_absens = StatusAbsen::orderBy('math', 'desc')->get();
        $status_absen_pay = StatusAbsen::where('math', 'pay')->get()->count();
        // return view('datatableshow', [ 'data'         => $status_absens]);
        
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();


        $createSheet->setCellValue('B16', 'ABSENSI BULAN  '.$months[$month].' Tahun '.$year);
       

        $status_absens_col = 1;
        $date_row = 4;
        // header table tanggal
        for($i = 1; $i <= $day_month; $i++){         
            $createSheet->setCellValue($abjads[$i+3].'20', $year_month.'-'.$i);
            $createSheet->getColumnDimension($abjads[$i+3])->setWidth(4);
            $createSheet->getStyle($abjads[$i+3]."20")->getAlignment()->setTextRotation(-90);
            $status_absens_col = 1;
            foreach($status_absens as $item){  
                $createSheet->setCellValue($abjads[$date_row].$status_absens_col,  $item->status_absen_code); 
                $status_absens_col++;
            }
            $date_row++;
        }

        // simpulan data
        $pay=[];
        $unpay=[];
        
        // dd($pay);
        // loop karyawan
        $employees = Identity::all();
        $employee_row = 21;
        $status_absens_col_employee = $date_row;
        $arr_status_absens = [];

        foreach($status_absens as $item){
            $createSheet->setCellValue($abjads[$date_row].'20',  $item->status_absen_code); 
            if($item->math == 'pay'){
                $pay[] = $abjads[$date_row];
            }else{
                $unpay[] = $abjads[$date_row];
            }
            $arr_status_absens[$item->status_absen_code] =$date_row;
            $date_row++;
        }

        // dd($pay);
        foreach($employees as $employee){

            $createSheet->setCellValue('B'.$employee_row,  $employee->name); 
            $createSheet->setCellValue('C'.$employee_row,  $employee->nik_employee); 
            $createSheet->setCellValue('D'.$employee_row,  $employee->position); 
            // data absen
            $data_absens_employee = EmployeeAbsen::where('employee_uuid', $employee->machine_id)
            ->whereYear('employee_absens.date', $year)
            ->whereMonth('employee_absens.date', $month)
            ->orderBy('employee_absens.date', 'asc')
            ->get([
                'employee_absens.*'
            ]);

            foreach($data_absens_employee as $item){
                $date_explode = explode('-',$item->date);
                // dd($item);
                $item_date = $date_explode[2] + 3;
                $createSheet->setCellValue($abjads[$item_date].$employee_row,  $item->status_absen_uuid); 
            }


            foreach($arr_status_absens as $item=>$value){
                $column_start_date = 4;
                $column_end_date = $day_month + 3;
                
                $formula = '=COUNTIF('.$abjads[$column_start_date].$employee_row.':'.$abjads[$column_end_date].$employee_row.',"'.$item.'")';
                $createSheet->setCellValue($abjads[$value].$employee_row,  $formula); 
                
            }
            // simpulan dibayar
            $formula_pay = '=SUM(';
            foreach($pay as $p){
                $formula_pay = $formula_pay.$p.$employee_row.',';
            }

            $formula_pay  = rtrim($formula_pay, ",");
            $formula_pay = $formula_pay.')';
            $formula_unpay = '=SUM(';
            foreach($unpay as $p){
                $formula_unpay = $formula_unpay.$p.$employee_row.',';
            }
            $formula_unpay  = rtrim($formula_unpay, ",");
            $formula_unpay = $formula_unpay.')';
            // dd($formula_unpay);
            $createSheet->setCellValue($abjads[$date_row].$employee_row,  $formula_pay); 
            // simpulan potongan
            $createSheet->setCellValue($abjads[$date_row+1].$employee_row,  $formula_unpay); 

            $employee_row++;
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/'.$year_month.'-'.rand(99,9999).'file.xls';
        $crateWriter->save($name);

        // return 'aaa';
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
        


        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $data = array();

            $rows = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
            $tanggal = $sheet->getCell( 'C' . 3 )->getValue();

            $much_status_absen = StatusAbsen::all()->count();

             $much_status_absen;



            if($sheet->getCell( 'C' . '1' )->getValue() == 'Excel'){

                $employees = Identity::all();

                $employees = $employees->keyBy(function ($item) {
                    return strval($item->employee_uuid);
                });
                // dd($employees['MBLE-0422007']);
                // return $employees;
                $year = $sheet->getCell( 'C' . 4 )->getValue();
                $month = $sheet->getCell( 'C' . 3 )->getValue();
                $month = str_pad($month, 2, '0', STR_PAD_LEFT);
                $year_month = $year.'-'.$month;
                $last_day = ResponseFormatter::getEndDay($year.'-'.$month);
                $isCount = 0;
                $row_a = 0;
                while($isCount <=1){
                    if($sheet->getCell( $rows[$row_a].'20')->getValue() == 'pay'){
                        $sheet->getCell( $rows[$row_a].'20')->getValue();
                        $isCount++;
                        $pay = $rows[$row_a];
                    }
                    if($sheet->getCell( $rows[$row_a].'20')->getValue() == 'cut'){
                        $cut = $rows[$row_a];
                        $isCount++;
                    }
                    $row_a++;
                    // $isCount++;
                    // $isCount++;

                    // return $sheet->getCell( $rows[$row_a].'20')->getValue();
                }

                // return $sheet->getCell( $rows[$row_a].'20')->getValue();

                $no_employee = 21;
                // $employees = [];
                while($sheet->getCell( 'A'.$no_employee)->getValue() != null){
                    $column_date = 4;
                    $nik_employee = $sheet->getCell( 'C'.$no_employee)->getValue();
                    $status_absen['year_month'] = $year_month;
                    $status_absen['nik_employee'] = $nik_employee;
                    for($day=1; $day <= $last_day; $day++){
                        $status_absen['day-'.$day] = $sheet->getCell( $rows[$column_date].$no_employee)->getValue();
                        EmployeeAbsen::updateOrCreate([
                            'uuid' => $year_month.'-'.$day.'-'.$employees[$nik_employee]->machine_id],
                            [
                                'employee_uuid'  => $employees[$nik_employee]->machine_id,
                                'date' => $year_month.'-'.$day,
                                'status_absen_uuid'     => $sheet->getCell( $rows[$column_date].$no_employee)->getValue(),
                                'cek_log'       =>  null,
                            ]);
                        $column_date++;
                    }

                    $column_date = 4 + $last_day;
                    $status_absen['cut'] = $sheet->getCell( $cut.$no_employee)->getOldCalculatedValue();
                    $status_absen['pay'] = $sheet->getCell( $pay.$no_employee)->getOldCalculatedValue();
                    $no_employee++;
                    EmployeeAbsenTotal::updateOrCreate(['uuid' => $year_month.'-'.$nik_employee], $status_absen);
                }
                // dd($employees);
                // return view('datatableshow', [ 'data'         => $employees]);
                return 'from excel';

            }else{
                $splitTanggal =  str_split( $tanggal, 1);

                $date_start =  $splitTanggal[8].$splitTanggal[9];
                $date_end   =  $splitTanggal[21].$splitTanggal[22] ;
                $month_start = $splitTanggal[5].$splitTanggal[6] ;
                $month_end   =$splitTanggal[18].$splitTanggal[19] ;
                $year_start = $splitTanggal[0].$splitTanggal[1].$splitTanggal[2].$splitTanggal[3];
                $year_end  = $splitTanggal[13].$splitTanggal[14].$splitTanggal[15].$splitTanggal[16];
                // return $year_end."-".$month_end."-".$date_end;
                $start_date = date_create($year_start."-".$month_start."-".$date_start);
                $end_date = date_create($year_end."-".$month_end."-".$date_end);
                $end_date = date_add($end_date,date_interval_create_from_date_string("1 days"));
                // dd($end_date);
                // EmployeeAbsen::where
                $result = $end_date->format('Y-m-d');
                // dd($result);
                $interval = date_diff($start_date, $end_date) ;
                $interval_data =  $interval->days + 1;  
                $period = new DatePeriod(
                    new DateTime($year_start."-".$month_start."-".$date_start),
                    new DateInterval('P1D'),
                    new DateTime($result)
                );
               $date_data=array();
               foreach ($period as $key => $value) {
                    $date_data[] = $value->format('Y-m-d');                
                }
                // dd($date_data);
                $employees_count = ($row_limit - 4)/2;
                $i= 5;
                // foreach employees
                for ($j=0; $j<$employees_count ;$j++ ) {
                    $employeeName = $sheet->getCell( 'K' . $i )->getValue();
                    $absensies = array();
                    $count_day = 0;
                  
                    foreach($date_data as $abjad){
                        $cell_d = $i+1;
                        $absensi = $sheet->getCell($rows[$count_day] .$cell_d )->getValue();
                        if($absensi){
                            $statusAbsen = EmployeeAbsenController::ekstrackAbsen($absensi);
                            if(!empty($statusAbsen['cek_log'])){
                                $absensies= [
                                    'employee_uuid'  => $employeeName,
                                    'date' => $abjad,
                                    'status_absen_uuid'     => $statusAbsen['status_absen'],
                                    'count_zone'     => $statusAbsen['count_zone'],
                                    'cek_log'       =>  $statusAbsen['cek_log'],
                                ];
                            }
                        }else{
                            $absensies= [
                                'employee_uuid'  => $employeeName,
                                'date' => $abjad,
                                'status_absen_uuid'     => 'A',
                                'cek_log'       =>  null,
                            ];
                            
                            $date = explode('-', $abjad);
                        }
    
                        $store = EmployeeAbsen::updateOrCreate(['uuid'  => $abjad.'-'.$employeeName],$absensies);
                        $data[]= $absensies;
                        
                        $count_day++;
                    }
                    $i = $i+2;
                }
            }
            // update employee_absen_totals
            /*
            1. cek month data import
            2. update by month thats.
            */
            $employees = Employee::all();
            $year = $year_start;
            $month = $month_start;

            $year_month = $year.'-'.$month;
            foreach($employees as $employee){
                $data_insert_employee_absen_totals = [
                    'nik_employee'      => $employee->nik_employee,
                    'year_month'        => $year_month,
                ];
                $status_absen_each_day = EmployeeAbsen::join('status_absens', 'status_absens.uuid','employee_absens.status_absen_uuid')
                ->where('employee_absens.employee_uuid', $employee->machine_id)
                ->whereYear('employee_absens.date', $year)
                ->whereMonth('employee_absens.date', $month)
                ->get([
                    'employee_absens.date',
                    'employee_absens.status_absen_uuid'
                ]);

                foreach($status_absen_each_day as $each_day){
                    $date = explode('-', $each_day->date);
                    $the_day = (int) $date[2];
                    $data_insert_employee_absen_totals["day-".$the_day.""] = $each_day->status_absen_uuid;
                }


                


                $employee->pay = EmployeeAbsen::join('status_absens', 'status_absens.uuid','employee_absens.status_absen_uuid')
                ->where('employee_absens.employee_uuid', $employee->machine_id)
                ->whereYear('employee_absens.date', $year)
                ->where('status_absens.math', 'pay')
                ->whereMonth('employee_absens.date', $month)
                ->count();
                $employee->cut = EmployeeAbsen::join('status_absens', 'status_absens.uuid','employee_absens.status_absen_uuid')
                ->where('employee_absens.employee_uuid', $employee->machine_id)
                ->whereYear('employee_absens.date', $year)
                ->where('status_absens.math', 'cut')
                ->whereMonth('employee_absens.date', $month)
                ->count();

                $data_insert_employee_absen_totals['cut'] =  $employee->cut;
                $data_insert_employee_absen_totals['pay'] =  $employee->pay;
                // dd($data_insert_employee_absen_totals);
                EmployeeAbsenTotal::updateOrCreate([
                    'uuid'  => $year_month.'-'.$employee->nik_employee,
                ],$data_insert_employee_absen_totals);


            }

        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function anyData($year_month){
        
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        // $employees = Employee::join('user_details','user_details.uuid','employees.user_detail_uuid')
        // ->leftJoin('positions','positions.uuid','employees.position_uuid')
        // ->get([
        //     'employees.nik_employee',
        //     'user_details.photo_path',
        //     'positions.position',
        //     'employees.uuid',
        //     'employees.nik_employee',
        //     'employees.machine_id',
        //     'user_details.name'
        // ]);

 
        
        // // return view('datatableshow', [ 'data'         => $employees]);

        // foreach($employees as $employee){
        //     $employee->pay = EmployeeAbsen::join('status_absens', 'status_absens.uuid','employee_absens.status_absen_uuid')
        //     ->where('employee_absens.employee_uuid', $employee->machine_id)
        //     ->whereYear('employee_absens.date', $year)
        //     ->where('status_absens.math', 'pay')
        //     ->whereMonth('employee_absens.date', $month)
        //     ->count();
        //     $employee->cut = EmployeeAbsen::join('status_absens', 'status_absens.uuid','employee_absens.status_absen_uuid')
        //     ->where('employee_absens.employee_uuid', $employee->machine_id)
        //     ->whereYear('employee_absens.date', $year)
        //     ->where('status_absens.math', 'cut')
        //     ->whereMonth('employee_absens.date', $month)
        //     ->count();

        //     EmployeeAbsenTotal::updateOrCreate([
        //         'uuid'  => $year_month.'-'.$employee->nik_employee,
        //     ],[
        //         'nik_employee'      => $employee->nik_employee,
        //         'pay'                     => $employee->pay,
        //         'year_month'        => $year_month,
        //         'cut'                       => $employee->cut,
        //     ]);
        // }

        $employees = EmployeeAbsenTotal::join('identities','identities.nik_employee','employee_absen_totals.nik_employee')
        ->where('year_month', $year_month)->get([
            'identities.*',
            'employee_absen_totals.*'
        ]);
        // return view('datatableshow', [ 'data'         => $employees]);
       
        return Datatables::of($employees)
        ->make(true);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'employee_uuid' => '',
            'date' =>'',
            'nik_employee' =>'',
            'year_month' =>'',
            'status_absen_uuid' =>'',
        ]);

        $validatedData['uuid']  = $validatedData['date'].'-'.$validatedData['employee_uuid'];
        $validatedData['edited'] = 'edited';
        $store = EmployeeAbsen::updateOrCreate(['uuid' =>$validatedData['uuid']],$validatedData);
        // update employee_absen_totals
        /*
        1. cek month data by nik and month
        2. update by month thats.
        */
            $date = explode("-", $validatedData['year_month']);
            $year = $date[0];
            $month = $date[1];
            $pay = EmployeeAbsen::join('status_absens', 'status_absens.uuid','employee_absens.status_absen_uuid')
            ->where('employee_absens.employee_uuid', $validatedData['employee_uuid'])
            ->whereYear('employee_absens.date', $year)
            ->where('status_absens.math', 'pay')
            ->whereMonth('employee_absens.date', $month)
            ->count();
            $cut = EmployeeAbsen::join('status_absens', 'status_absens.uuid','employee_absens.status_absen_uuid')
            ->where('employee_absens.employee_uuid', $validatedData['employee_uuid'])
            ->whereYear('employee_absens.date', $year)
            ->where('status_absens.math', 'cut')
            ->whereMonth('employee_absens.date', $month)
            ->count();
            $dates = explode("-", $validatedData['date']);
            $the_day = (int) $dates[2];
            $day = 'day-'. $the_day;

            EmployeeAbsenTotal::updateOrCreate([
                'uuid'  => $validatedData['year_month'].'-'.$validatedData['nik_employee'],
            ],[
                'nik_employee'      => $validatedData['nik_employee'],
                'pay'                     => $pay,
                'year_month'        => $validatedData['year_month'],
                'cut'                       => $cut,
                $day => $validatedData['status_absen_uuid']
            ]);
        
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
