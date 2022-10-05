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
    public function absensiData($months){

        $employees = DB::table('employees')
        ->join('people', 'people.uuid',  '=', 'employees.people_uuid')
        ->join('employee_contracts', 'employee_contracts.employee_uuid', '=', 'employees.uuid')
        ->join('positions', 'positions.uuid',  '=', 'employee_contracts.position_uuid')
        
        ->get(['people.name','positions.position','employees.*']);

        foreach($employees as $employee){
            $count_DS = DB::table('absensi_employees')
            ->join('employees', 'employees.machine_id', '=', 'absensi_employees.machine_id')
            ->join('people', 'people.uuid',  '=', 'employees.people_uuid')
            ->where('absensi_employees.machine_id', $employee->machine_id)
            ->where('absensi_employees.date_month', $months)
            ->where('absensi_employees.status', 'DS')
            ->count();

            // dd($count_DS);

            $count_TC = DB::table('absensi_employees')
            ->join('employees', 'employees.machine_id', '=', 'absensi_employees.machine_id')
            ->join('people', 'people.uuid',  '=', 'employees.people_uuid')
            ->where('absensi_employees.machine_id', $employee->machine_id)
            ->where('absensi_employees.date_month', $months)
            ->where('absensi_employees.status', 'TC')
            ->count();

            $count_TA = DB::table('absensi_employees')
            ->join('employees', 'employees.machine_id', '=', 'absensi_employees.machine_id')
            ->join('people', 'people.uuid',  '=', 'employees.people_uuid')
            ->where('absensi_employees.machine_id', $employee->machine_id)
            ->where('absensi_employees.date_month', $months)
            ->where('absensi_employees.status', 'TA')
            ->count();

            

            $employee->count_ds = $count_DS;
            $employee->count_tc = $count_TC;
            $employee->count_ta = $count_TA;
            $employee->month = $months;
        }
        // dd($employees);

        return Datatables::of($employees)
        ->addColumn('action', function ($model) {
            return '<a class="text-decoration-none" href="/admin-hr/absensi-show/'.$model->month.'/' . $model->nik_employee . '">
                            <button class="btn btn-secondary py-1 px-2 mr-1">
                                <i class="icon-copy bi bi-eye-fill"></i>
                            </button>
                        </a>';
        })
        
        ->make(true);  

    }
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

    public function show($month, $nik){
        $year = 2022;
        // dd('a');
        // $data = DB::table('employees')
        // ->leftJoin('shift_lists', 'shift_lists.employee_id', '=', 'employees.id')
        // ->where('employees.nik_employee', $nik)
        // ->get(['employees.*']);

        // dd($data);
        

        $lastDay = Carbon::now()->endOfMonth()->isoFormat('D');
        // return $today = Carbon::now('Asia/Jakarta')->isoFormat('MMMM Do YYYY, h:mm:ss a');;

        DB::table('shifts')
        ->where('shift_date_start', '<', '24-08-2022')
        ->get();
        
        for($i=1; $i <= $lastDay; $i++){

            $dateGet =$year.'-'.$month.'-'.$i;

            $data = DB::table('employees')
            ->join('employee_contracts', 'employee_contracts.employee_uuid', '=', 'employees.uuid')
           ->leftJoin('shift_lists', 'shift_lists.contract_employee_uuid', '=', 'employee_contracts.uuid')
           ->leftJoin('shifts', 'shifts.uuid', '=', 'shift_lists.shift_uuid')
           ->join('absensi_employees', 'absensi_employees.machine_id','=', 'employees.machine_id')
           ->where('employees.nik_employee', $nik)
        //    ->where('shifts.shift_date_start', '<=', $dateGet)
        //    ->where('shifts.shift_date_end', '>=', $dateGet)
           ->where('absensi_employees.date_date', $i)
           ->where('absensi_employees.date_month', $month)
           ->where('absensi_employees.date_year', $year)
           ->get([
            'shifts.shift_time',
            'absensi_employees.*', 
            'shifts.shift_date_start',
            'shifts.shift_date_end'
            ])->first();

            // dd($data);
           if(!$data){

            $data = DB::table('employees')
            ->join('employee_contracts', 'employee_contracts.employee_uuid', '=', 'employees.uuid')
           ->leftJoin('shift_lists', 'shift_lists.contract_employee_uuid', '=', 'employee_contracts.uuid')
           ->leftJoin('shifts', 'shifts.uuid', '=', 'shift_lists.shift_uuid')
           ->where('employees.nik_employee', $nik)
           ->get([
            'shifts.shift_time',
            'employees.machine_id', 
            ])->first();
            // dd($data);
                // $data = DB::table('employees')
                // ->join('shift_lists', 'shift_lists.employee_id', '=', 'employees.id')
                // ->join('shifts', 'shifts.id', '=', 'shift_lists.shift_id')
                // ->where('employees.nik_employee', $nik)
                // ->where('shifts.shift_date_start', '<=', $dateGet)
                // ->where('shifts.shift_date_end', '>=', $dateGet)
                // ->get([
                //     'shifts.shift_time',
                //     'employees.machine_id', 
                //     'shift_lists.shift_id as shift_id'
                //     ])->first();


                $data->date_year = $year;
                $data->date_month = $month;
                $data->date_date = $i;
                $data->status = "Null";
                $data->cek_log = "";
                $data->id = "";
                // dd($data);
           }
            
           $absens[] = $data;
        }
        // dd($absens);
        

        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => false,
            'javascript_form'       => false,
            'active'                        => 'admin-hr-absensi'
        ];
        return view('hr.absensi.show', [
            'title'         => 'Absensi HR',
            'absens'    => $absens,
            'month'     => $month,
            'nik_employee'     => $nik,
            'layout'        => $layout
        ]);
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
            
            //sore true
            //pagi true
        }
        // dd($hourEvening);
        // AbsensiEmployee::create([
        //     'employee_id'   => $id,
        //     'date'      => $dates,
        //     'status'    => $statusAbsen,
        //     'cek_log'   => $absensi
        // ]);
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
