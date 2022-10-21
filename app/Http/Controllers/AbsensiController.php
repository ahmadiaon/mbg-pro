<?php

namespace App\Http\Controllers;

// use Carbon\Carbon;
use Carbon\Carbon;
use App\Models\People;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\AbsensiEmployee;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class AbsensiController extends Controller
{
  
    public function edit(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'machine_id'      => 'required',
            'date_year'      => 'required',
            'date_month'      => 'required',
            'date_date'      => 'required',
            'status'      => 'required',
        ]);

        $created = AbsensiEmployee::updateOrCreate(['id' => $request->id], $validatedData );
        // $dependent = Dependent::updateOrCreate(['id' => $request->id], $dependents );
       
        return redirect('/admin-hr/absensi-show/'.$request->month.'/'.$request->nik_employee);


    }

    public function exportAbsen($months){

        $employees = DB::table('employees')
        ->join('people', 'people.id',  '=', 'employees.people_id')
        ->join('positions', 'positions.id',  '=', 'employees.position_id')->get(['people.name','positions.position','employees.*']);

        foreach($employees as $employee){
            $absensEachEmployee = DB::table('absensi_employees')
            ->join('employees', 'employees.id', '=', 'absensi_employees.employee_id')
            ->join('people', 'people.id',  '=', 'employees.people_id')
            ->where('absensi_employees.employee_id', $employee->id)
            ->where('absensi_employees.date_month', $months)            
            ->get(['absensi_employees.*']);

            foreach($absensEachEmployee as $ab){
                $dt = $ab->date_date;
                $employee->$dt = $ab->status;
            }
        }
        dd($employees);
       

        return Datatables::of($employees)
        ->addColumn('action', function ($model) {
            return '<a class="text-decoration-none" href="/admin-hr/absensi/' . $model->nik_employee . '">
                            <button class="btn btn-secondary py-1 px-2 mr-1">
                                <i class="icon-copy bi bi-eye-fill"></i>
                            </button>
                        </a>';
        })
        
        ->make(true);  

    }

    public function index($month){

        // $month = 'juli';
             $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            // 
            // $monthInt =array_search($month, $months);
            $monthInt = $month;
            $month_name = $months[$month];
            $layout = [
                'head_core'            => true,
                'javascript_core'       => true,
                'head_datatable'        => true,
                'javascript_datatable'  => true,
                'head_form'             => false,
                'javascript_form'       => false,
                'active'                        => 'admin-hr-absensi'
            ];
            // dd(\Carbon\Carbon::now()->locale('IDN')->isoFormat('M'));
            return view('hr.absensi.index', [
                'title'         => 'Beranda HR',
                'month'     => $monthInt,
                'month_name'    => $month_name,
                'layout'        => $layout
            ]);
    }

    
    function ekstrackAbsen($year, $month, $date, $id, $absensi){
        $timeA = false; //from 00 to 6
        $timeB = false; //from 06 to 12
        $timeC = false; //from 12 to 17
        $timeD = false; //from 17 to 24
        // $statusAbsen;
        $cek_log =null;
        $dates = $year.'-'.$month.'-'.$date;

        // $ketAbsensi;
        $hourEvening = array();
        $hourMorning = array();
        $length = Str::length( $absensi);
        $absens = str_split( $absensi, 5);

        foreach( $absens as $absen){
            $hour = str_split( $absen, 2);
            $hourInt    =  (int)$hour[0];
            if(( $hourInt >= 00) && ( $hourInt <= 5) ){
                $timeA = true;
            }else if(($hourInt >= 6)&&($hourInt <= 12) ){
                $timeB = true;
            }else if(($hourInt >=13)&&($hourInt <= 16) ){
                $timeC = true;
            }else if(( $hourInt >= 17) && ( $hourInt <= 23) ){
                $timeD = true;
            }

            
            if($timeD && $timeA){
                $statusAbsen = 'DS';
            }else if($timeC || $timeB){
                $statusAbsen = 'TA';
            }else if(!$timeA && $timeD){
                $statusAbsen = 'TA';
            }else if($timeA && !$timeD){
                $statusAbsen = 'TA';
            }else if(!$timeA && !$timeD){
                $statusAbsen = 'TC';
            }else{
                $statusAbsen = "unknown";
            }
            if($cek_log){
                $cek_log = $cek_log.".'".$absen."'";
            }else{
                $cek_log = "'".$absen."'";
            }
        }

        $data = [
            'cek_log' => $cek_log,
            'status_absen' => $statusAbsen
        ];
        return   $data;
    }

    public function store(Request $request)
    {
       
        $this->validate($request, [
            'uploaded_file' => 'required'
        ]);
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

            //2022-07-01 ~ 2022-07-31
            //2022-07-01 ~ 2022-07-31


            $date_start =  $splitTanggal[8].$splitTanggal[9];
            $date_end   =  $splitTanggal[21].$splitTanggal[22] ;
            $month_start = $splitTanggal[5].$splitTanggal[6] ;
            $month_end   =$splitTanggal[18].$splitTanggal[19] ;
            $year_start = $splitTanggal[0].$splitTanggal[1].$splitTanggal[2].$splitTanggal[3];
            $year_end  = $splitTanggal[13].$splitTanggal[14].$splitTanggal[15].$splitTanggal[16];

            $month = 7;
            $year = 2022;

            // dd($year_end);
            // list tanggal 
            
            $tanggalAbsensi = array();

            $employees = array();
            $employees_count = (count($row_range) - 4)/2;
            $i= 5;

            // foreach employees
            for ($j=0; $j<$employees_count ;$j++ ) {
                $employeeName = $sheet->getCell( 'K' . $i )->getValue();
                $columnNow = $j + 2;
                $createSheet->setCellValue('A'.$columnNow, $employeeName);
                $absensies = array();
                $k=1;
                foreach($abjads as $abjad){
                    $machine_id = $sheet->getCell( 'C' . $i )->getValue();
                    $absensi = $sheet->getCell($abjad . $i+1)->getValue();
                    if($absensi){
                        $statusAbsen = AbsensiController::ekstrackAbsen($year, $month,$k,  $machine_id,  $absensi);
                        // dd($statusAbsen); 
                        $createSheet->setCellValue($abjads[$k+1].$columnNow, $statusAbsen['status_absen']);
                        
                        $absensies[] = [
                            'tanggal' => $k+$date_start,
                            'value'     =>  $statusAbsen['cek_log'],
                            'status'  =>  $statusAbsen['status_absen']
                        ];
                        $data[]=[
                            'machine_id'   => $machine_id,
                            'uuid'   => Str::uuid(),
                            'date_date' => $k+$date_start-1,
                            'date_month' => $month_start,
                            'date_year' => $year_start,
                            'status'                => $statusAbsen['status_absen'],
                            'cek_log'       =>  $statusAbsen['cek_log'],
                            'created_at' =>  Carbon::now('Asia/Jakarta'), # new \Datetime()
                             'updated_at' => Carbon::now('Asia/Jakarta'),
                        ];
                    }
                    $k++;
                }
                $employees[]=[
                    'id'    =>$machine_id,
                    'name' => $employeeName,
                    'absensi'   => $absensies
                ];                
                $i = $i+2;
            }
            //   dd( $data);
            $crateWriter = new Xls($createSpreadsheet);
        $nameExcell = Carbon::today('Asia/Jakarta')->format('y-m-d').Str::uuid();
            $crateWriter->save($nameExcell.'.xlsx');
            // dd( $data);

           $store = DB::table('absensi_employees')->insert($data);
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        dd($store);
        
        return back()->withSuccess('Great! Data has been successfully uploaded.');
        return $request;
        return view('excell.index', [
            'title'         => 'Excel'
        ]);
    }
    
}
