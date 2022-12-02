<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\CoalFrom;
use App\Models\Company;

use Yajra\Datatables\Datatables;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeTonase;
use App\Models\Identity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use File;

class EmployeeTonseController extends Controller
{
    public function index(){
        $companies = Company::where('uuid','!=','MBLE' )->get();
        foreach($companies as $item){
            $item->coal_froms = CoalFrom::where('company_uuid', $item->uuid)->get();
        }

        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-tonase'
        ];
        return view('employee_tonase.index', [
            'title'         => 'Tonase',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'companies' => $companies
        ]);
    }

    public function export($year_month){
        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $datetime = Carbon::createFromFormat('Y-m', $year.'-'.$month);
        $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');

        
        $companies = Company::join('coal_froms', 'coal_froms.uuid', 'companies.uuid')
        ->get([
            'coal_froms.*'
        ]);
  
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Tonase');
        
        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B2', 'Perusahaan');
        $createSheet->setCellValue('D2', 'Harga');
        
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);
        $createSheet->setCellValue('A5', 'No');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');

        $employees = Identity::all();
        for($i = 1; $i <= $day_month; $i++){  
            $first = $i * 3 - 2;
            $second = $first+1;
            $third = $second + 1;
            $createSheet->setCellValue($abjads[$first+3].'5', $i);
            $createSheet->setCellValue($abjads[$second+3].'5', $i);
            $createSheet->setCellValue($abjads[$third+3].'5', $i);
        }
        $employee_row = 6;
        $no = 1;
            

        // foreach($employees as $item){
        //     $createSheet->setCellValue( $abjads[0].$employee_row, $no);
        //     $createSheet->setCellValue( $abjads[1].$employee_row, $item->nik_employee);
        //     $createSheet->setCellValue( $abjads[2].$employee_row, $item->name);
        //     $createSheet->setCellValue( $abjads[3].$employee_row, $item->position);

        //     $data_tonase_employee = Employee::leftJoin('employee_tonases','employee_tonases.employee_uuid', 'employees.uuid')
        //     ->where('employee_tonases.employee_uuid', $item->employee_uuid)
            
        //     ->where('employee_tonases.coal_from_uuid', $item->uuid)
        //     ->whereYear('employee_tonases.date', $year)->whereMonth('employee_tonases.date', $month)
        //     ->orderBy('employee_tonases.date', 'asc')
        //     ->groupBy(
        //         'employee_tonases.employee_uuid',
        //         'employee_tonases.date',
        //     )
        //     ->select( 
        //         'employee_tonases.date', 
        //         'employee_tonases.employee_uuid',
        //         DB::raw("count(employee_tonases.tonase_value) as tonase_count"),
        //         DB::raw("sum(employee_tonases.tonase_value) as tonase_value"),
        //     )
        //     ->get();
            
        //     $item->data_tonase_employee = $data_tonase_employee;

        //     $employee_row++;
        //     $no++;    

           

        //     for($i = 1; $i <= $day_month; $i++){  
        //         $first = $i * 3 - 2;
        //         $second = $first+1;
        //         $third = $second + 1;
        //         $cel_for = $abjads[$second+3].$employee_row;
        //         $formula = '=IF('.$abjads[$first+3].$employee_row.'>4,'.$cel_for.'*0.15+'.$cel_for.','.$cel_for.')';
        //         $createSheet->setCellValue($abjads[$first+3].$employee_row, '0');
        //         $createSheet->setCellValue($abjads[$second+3].$employee_row, '0');
        //         $createSheet->setCellValue($abjads[$third+3].$employee_row, $formula);
        //     }

        //     foreach($data_tonase_employee as $tonase){
        //         $date = $tonase->date;
        //         $date = explode('-', $date);
        //         $date_day = (int)$date[2];
        //         $first = $date_day * 3 - 2;
        //         $second = $first+1;
        //         $third = $second + 1;
                
        //         if(!empty($tonase->tonase_count)){
        //             $count = $tonase->tonase_count;
        //             $value = $tonase->tonase_value;
        //         }else{
        //             $count = 0;
        //             $value = 0;
        //         }
        //         $createSheet->setCellValue($abjads[$first+3].$employee_row, $count);
        //         $createSheet->setCellValue($abjads[$second+3].$employee_row, $value);
        //     }
        // }
        // dd($employees);
        // var_dump($employees);die;
                         

        $zip = new ZipArchive;
        $fileName = 'file/absensi/Tonase '.$year_month.'-'.rand(99,9999).'file.zip';
        if ($zip->open($fileName, ZipArchive::CREATE) === TRUE){
            foreach($companies as $company){
                
                $employees = Identity::all();
                for($i = 1; $i <= $day_month; $i++){  
                    $first = $i * 3 - 2;
                    $second = $first+1;
                    $third = $second + 1;
                    $createSheet->setCellValue($abjads[$first+3].'5', $i);
                    $createSheet->setCellValue($abjads[$second+3].'5', $i);
                    $createSheet->setCellValue($abjads[$third+3].'5', $i);
                }
                $employee_row = 6;
                $no = 1;
                    

                foreach($employees as $item){
                    $createSheet->setCellValue( $abjads[0].$employee_row, $no);
                    $createSheet->setCellValue( $abjads[1].$employee_row, $item->nik_employee);
                    $createSheet->setCellValue( $abjads[2].$employee_row, $item->name);
                    $createSheet->setCellValue( $abjads[3].$employee_row, $item->position);

                    $data_tonase_employee = Employee::leftJoin('employee_tonases','employee_tonases.employee_uuid', 'employees.uuid')
                    ->where('employee_tonases.employee_uuid', $item->employee_uuid)
                    
                    ->where('employee_tonases.coal_from_uuid', $company->uuid)
                    ->whereYear('employee_tonases.date', $year)->whereMonth('employee_tonases.date', $month)
                    ->orderBy('employee_tonases.date', 'asc')
                    ->groupBy(
                        'employee_tonases.employee_uuid',
                        'employee_tonases.date',
                    )
                    ->select( 
                        'employee_tonases.date', 
                        'employee_tonases.employee_uuid',
                        DB::raw("count(employee_tonases.tonase_value) as tonase_count"),
                        DB::raw("sum(employee_tonases.tonase_value) as tonase_value"),
                    )
                    ->get();
                    
                    $item->data_tonase_employee = $data_tonase_employee;

                   
                

                    for($i = 1; $i <= $day_month; $i++){  
                        $first = $i * 3 - 2;
                        $second = $first+1;
                        $third = $second + 1;
                        $cel_for = $abjads[$second+3].$employee_row;
                        $formula = '=IF('.$abjads[$first+3].$employee_row.'>4,'.$cel_for.'*0.15+'.$cel_for.','.$cel_for.')';
                        $createSheet->setCellValue($abjads[$first+3].$employee_row, '0');
                        $createSheet->setCellValue($abjads[$second+3].$employee_row, '0');
                        $createSheet->setCellValue($abjads[$third+3].$employee_row, $formula);
                    }

                    foreach($data_tonase_employee as $tonase){
                        $date = $tonase->date;
                        $date = explode('-', $date);
                        $date_day = (int)$date[2];
                        $first = $date_day * 3 - 2;
                        $second = $first+1;
                        $third = $second + 1;
                        
                        if(!empty($tonase->tonase_count)){
                            $count = $tonase->tonase_count;
                            $value = $tonase->tonase_value;
                        }else{
                            $count = 0;
                            $value = 0;
                        }
                        $createSheet->setCellValue($abjads[$first+3].$employee_row, $count);
                        $createSheet->setCellValue($abjads[$second+3].$employee_row, $value);
                    }
                    $employee_row++;
                    $no++;    

                }
                // dd($company);
                $createSheet->setCellValue('D3', $company->hauling_price);
                $createSheet->setCellValue('C2', $company->uuid);


                $crateWriter = new Xls($createSpreadsheet);
                $name = 'file/absensi/Tonase Perusahaan '.$company->uuid.'-'.$year_month.'-'.rand(99,9999).'file.xls';
                // ob_end_clean();

                $crateWriter->save($name);
                $zip->addFile($name, $company->uuid.'.xls.');
            }
        }
        $zip->close();
        return response()->download(public_path($fileName));
    }

    public static function funcStore($validatedData){
        if($validatedData['ritase'] ){
            $tonase_each_ritase = $validatedData['tonase_value'] / $validatedData['ritase'] ;
            $tonase_each_ritase = round( $tonase_each_ritase, 2);
            $validatedData['employee_uuid'] =  $validatedData['nik_employee'];
            $validatedData['coal_from_uuid'] =  $validatedData['company_uuid'];
            $validatedData['uuid'] = $validatedData['date'].'-'.$validatedData['company_uuid'].'-'.$validatedData['nik_employee'];
            $dd=[];
            for($i = 0; $i < $validatedData['ritase']; $i++){
                if($validatedData['ritase'] >3){
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                    $validatedData['tonase_full_value'] = $tonase_each_ritase + $tonase_each_ritase * 0.15;  
                    $validatedData['tonase_full_value'] = round( $validatedData['tonase_full_value'], 2);
                }else{
                    $validatedData['tonase_full_value'] = $tonase_each_ritase;
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                }
                $store = EmployeeTonase::create($validatedData);
                $dd[] = $store;
            }
            // dd($dd);
            // $store = EmployeeTonase::create($validatedData);
    
        }
          
      
    }

    public function import(Request $request){
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
            // DESCRIPTION
            $month_hm =  $sheet->getCell( 'C3')->getValue();
            $year_hm = $sheet->getCell( 'C4')->getValue();
            $datetime = Carbon::createFromFormat('Y-m', $year_hm.'-'.$month_hm);
            $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');

            $price_code = $sheet->getCell( 'D3')->getValue();
            $company_uuid = $sheet->getCell( 'C2')->getValue();


            $no_employee = 6;
            $employees = [];
            EmployeeTonase::whereYear('date', $year_hm)
            ->whereMonth('date', $month_hm)->delete();
            /*
            1. loop all employee
            2.
            EmployeeHourMeterDay::
            */
            if($sheet->getCell( 'E'.'5')->getValue() == $sheet->getCell( 'F'.'5')->getValue()  ){
                while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                    $date_row = 3;
                    $nik_employee = $sheet->getCell( 'B'.$no_employee)->getValue();

                    for($day =1; $day <= $day_month; $day++){//hm biasa

                        $first = $day * 3 - 2;
                        $second = $first+1;
                        $third = $second + 1;
                        
                        $cell_ritase = $abjads[$first+3].$no_employee;
                        $cell_tonase = $abjads[$second+3].$no_employee;
                        if($sheet->getCell($cell_ritase)->getValue() != null){
                            $data_each_day = [
                                'nik_employee'  => $nik_employee,
                                'date'  => $year_hm.'-'.$month_hm.'-'.$day,
                                'ritase'       => $sheet->getCell($cell_ritase)->getValue(),
                                'tonase_value' => $sheet->getCell($cell_tonase)->getValue(),
                                'price_code'  => $price_code,
                                'company_uuid'  => $company_uuid,
                            ];

                           
                            EmployeeTonseController::funcStore($data_each_day);
                            $employees[$day] = $data_each_day;    
                        }
                    } 
                    // dd( $employees);
                    $no_employee++;
                }
            }else{
                while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                    $date_row = 3;
                    $nik_employee = $sheet->getCell( 'B'.$no_employee)->getValue();
                    for($day =1; $day <= $day_month; $day++){//hm biasa
                        $cell_ritase = $abjads[$date_row+$day].$no_employee;
                        $cell_tonase = $abjads[$date_row+$day_month+$day+1].$no_employee;
                        if($sheet->getCell($cell_ritase)->getValue() != null){
                            $data_each_day = [
                                'nik_employee'  => $nik_employee,
                                'date'  => $year_hm.'-'.$month_hm.'-'.$day,
                                'ritase'       => $sheet->getCell($cell_ritase)->getValue(),
                                'tonase_value' => $sheet->getCell($cell_tonase)->getValue(),
                                'price_code'  => $price_code,
                                'company_uuid'  => $company_uuid,
                            ];
                            EmployeeTonseController::funcStore($data_each_day);
                            $employees[$day] = $data_each_day;
                        }
    
                    }
                    $no_employee++;
                }
            }
            
            return back();
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function indexForEmployee($nik_employee){
        $employee = Employee::where('nik_employee',$nik_employee)->get()->first();
        $companies = Company::where('uuid','!=','MBLE' )->get();
        foreach($companies as $item){
            $item->coal_froms = CoalFrom::where('company_uuid', $item->uuid)->get();
        }
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'tonase-employee-me'
        ];
        return view('employee_tonase.employee.index', [
            'title'         => 'Tonase',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'companies' => $companies,
            'nik_employee' => $nik_employee
        ]);
    }

    public function create(){
        $year_month_day = null;
        $year_month = null;
        $nik_employee = null;
        $employees = Employee::getAll();
        $companies = Company::where('uuid', '!=','MBLE')->get();
        foreach($companies as $item){
            $item->coal_from = CoalFrom::where('company_uuid', $item->uuid)->get();
        }
        //  dd($companies);
        // return Carbon::today()->isoFormat('Y-M-D');
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-tonase'
        ];
        return view('employee_tonase.create', [
            'title'         => 'Tonase',
            'employees' => $employees,
            'companies' => $companies,
            'year_month_day' => $year_month_day,
            'year_month' => $year_month,
            'nik_employee'  =>$nik_employee,
            'today'        => Carbon::today()->isoFormat('Y-M-D'),
            'layout'    => $layout
        ]);
    }

    public function detail($nik_employee, $time){
        $date = explode("-", $time);
        $year = $date[0];
        $month = $date[1];
        $day = null;
        $year_month_day = null;
        $year_month = null;

        if(!empty($date[2])){
            $day = $date[2];
            $year_month_day = $time;
        }else{
            $year_month = $time;
        }

        $employees = Employee::getAll();
        $companies = Company::where('uuid', '!=','MBLE')->get();
        foreach($companies as $item){
            $item->coal_from = CoalFrom::where('company_uuid', $item->uuid)->get();
        }
        //  dd($companies);
        // return Carbon::today()->isoFormat('Y-M-D');
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-tonase'
        ];
        return view('employee_tonase.create', [
            'title'         => 'Tonase',
            'employees' => $employees,
            'companies' => $companies,
            'year_month_day' => $year_month_day,
            'year_month' => $year_month,
            'nik_employee'  =>$nik_employee,
            'today'        => '',
            'layout'    => $layout
        ]);
    }

    public function show(Request $request){

        // $data = EmployeeTonase::where('uuid', $request->uuid)->get();
        $base =  EmployeeTonase::leftJoin('employees','employees.uuid','employee_tonases.employee_uuid')
                ->join('coal_froms', 'coal_froms.uuid','employee_tonases.coal_from_uuid')
                ->leftJoin('companies','companies.uuid','coal_froms.company_uuid')
                ->where('employee_tonases.uuid', $request->uuid)
                ->groupBy( 
                    'companies.uuid',
                    'employee_tonases.uuid',
                    'employee_tonases.employee_uuid',
                    'employee_tonases.coal_from_uuid',
                    'employee_tonases.tonase_value',
                    'employee_tonases.tonase_full_value',
                    'employee_tonases.date',
                    'employee_tonases.shift',
                    )
                ->select( 
                    'employee_tonases.uuid',
                    'companies.uuid as company_uuid',
                    'employee_tonases.employee_uuid',
                    'employee_tonases.coal_from_uuid',
                    'employee_tonases.tonase_value',
                    'employee_tonases.tonase_full_value',
                    'employee_tonases.date',
                    'employee_tonases.shift',
                    DB::raw("count(employee_tonases.uuid) as amount_ritase"),
                    DB::raw("SUM(employee_tonases.tonase_value) as total_tonase_value"),
                    DB::raw("SUM(employee_tonases.tonase_full_value) as total_tonase_full_value"),
                )->get()->first();
        return ResponseFormatter::toJson($base, 'edit');
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
          'uuid' => '',
          'ritase' => '',
          'employee_create_uuid' => '',
          'employee_know_uuid' => '',
          'employee_approve_uuid' => '',
          'vehicle_uuid' => '',

            
          'employee_uuid' => '',
          'coal_from_uuid' => '',
          'tonase_value' => '',//di kertas
          'tonase_full_value' => '',//bonus
            'date' => '',
          'shift' => '', 
            
            'time_start' => '',
            'time_come' => '',
        ]);
        
        $tonase_each_ritase = $validatedData['tonase_value'] / $validatedData['ritase'] ;
        $tonase_each_ritase = round( $tonase_each_ritase, 2);
        //======================================== ritase ke 5 keatas dapat bonus
        // if(empty($validatedData['uuid'])){
        //     for($i = 0; $i < $validatedData['ritase']; $i++){
        //         if($i >3){
        //             $validatedData['tonase_value'] = $tonase_each_ritase;
        //             $validatedData['tonase_full_value'] = $tonase_each_ritase + $tonase_each_ritase * 0.15;  
        //         }else{
        //             $validatedData['tonase_full_value'] = $tonase_each_ritase;
        //             $validatedData['tonase_value'] = $tonase_each_ritase;
        //         }
                
                
                
        //         if(empty($validatedData['uuid'])){
        //             $validatedData['uuid'] = "tonase-".$validatedData['date'].'-'.$validatedData['shift'].'-'.$validatedData['employee_uuid'].'-'.rand(99,999);
        //         }
        //         $store = EmployeeTonase::create($validatedData);
                
        //     }
           
        // }


        if(empty($validatedData['uuid'])){
            for($i = 0; $i < $validatedData['ritase']; $i++){
                if($validatedData['ritase'] >3){
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                    $validatedData['tonase_full_value'] = $tonase_each_ritase + $tonase_each_ritase * 0.15;  
                }else{
                    $validatedData['tonase_full_value'] = $tonase_each_ritase;
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                }
                
                
                $validatedData['uuid'] = $validatedData['date'].'-'.$validatedData['company_uuid'].'-'.$validatedData['nik_employee'];
            
                if(empty($validatedData['uuid'])){
                    $validatedData['uuid'] = $validatedData['date'].'-'.$validatedData['shift'].'-'.$validatedData['employee_uuid'];
                }
                $store = EmployeeTonase::create($validatedData);
                
            }
           
        }else{
            EmployeeTonase::where('uuid', $validatedData['uuid'])->delete();
            for($i = 0; $i < $validatedData['ritase']; $i++){
                if($validatedData['ritase'] >3){
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                    $validatedData['tonase_full_value'] = $tonase_each_ritase + $tonase_each_ritase * 0.15;  
                }else{
                    $validatedData['tonase_full_value'] = $tonase_each_ritase;
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                }
                
                
                
                if(empty($validatedData['uuid'])){
                    $validatedData['uuid'] = "tonase-".$validatedData['date'].'-'.$validatedData['shift'].'-'.$validatedData['employee_uuid'].'-'.rand(99,999);
                }
                $store = EmployeeTonase::create($validatedData);
                
            }
        }

        return ResponseFormatter::toJson($validatedData, 'Data Stored');
    }

    public function anyData(Request $request){
        $date = explode("-", $request->year_month);
        $year = $date[0];
        $month = $date[1];
        
      
        $coal_froms = CoalFrom::all();
        $data =[];
        $collecection = collect($data);
        
        foreach($coal_froms as $value)
        {
            $da =  EmployeeTonase::leftJoin('employees','employees.uuid','employee_tonases.employee_uuid')
                ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
                ->leftJoin('positions','positions.uuid','employees.position_uuid')
                ->join('coal_froms', 'coal_froms.uuid','employee_tonases.coal_from_uuid')
                ->where('coal_from_uuid', $value->uuid)
                ->groupBy( 
                    
                    'user_details.photo_path',
                    'employees.nik_employee',
                    'positions.position',
                    'user_details.name',
                    'employees.user_detail_uuid',
                    'employee_tonases.employee_uuid',
                    'coal_froms.uuid',
                    'coal_froms.coal_from',
                    )
                ->whereYear('employee_tonases.date', $year)
                ->whereMonth('employee_tonases.date', $month)
                ->select( 
                    'employee_tonases.employee_uuid',
                    'employees.user_detail_uuid',
                    'employees.nik_employee',
                    'user_details.photo_path',
                    'user_details.name',
                    'positions.position',
                    'coal_froms.uuid',
                    'coal_froms.coal_from',
                    DB::raw("count(tonase_value) as ritase"),
                    DB::raw("SUM(tonase_value) as total_sell"),
                    DB::raw("SUM(tonase_full_value) as total_sells"),
                )
                ->get(); 
                if($da->count() > 0){
                    $collecection = $collecection->merge($da);
                }
        }
        return Datatables::of($collecection)
        ->make(true);
    }

    public function anyDataCreate(Request $request){
        // year_month: year_month,
        // year_month_day: year_month_day,
        // filter: vall,
        // nik_employee: nik_employee,

        $filters = [];
        // create
        if(!empty($request->today)){
            // create
            $year_month_day = $request->today;
        }else{
            $nik_employee = $request->nik_employee;
            $nik_employee = $request->nik_employee;
            if(!empty($request->year_month_day)){
                // perhari
                $year_month_day = $request->year_month_day; 
            }else{
                $year_month = $request->year_month;
                $date = explode("-", $year_month);
                $year = $date[0];
                $month = $date[1];
            }
        }
        // filters
            
        
        $coal_froms = $request->filter;
    
        if(empty($coal_froms)){
            $coal_froms = CoalFrom::all();
            foreach($coal_froms as $value){
                $filters[] = $value->uuid;
            }
        }
        
        $data =[];
        $collecection = collect($data);
        
        foreach($filters as $value){
            $da =  EmployeeTonase::leftJoin('employees','employees.uuid','employee_tonases.employee_uuid')
                ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
                ->leftJoin('positions','positions.uuid','employees.position_uuid')
                ->join('coal_froms', 'coal_froms.uuid','employee_tonases.coal_from_uuid')
                ->where('coal_from_uuid', $value)
                ->groupBy( 
                    'employee_tonases.id',
                    'employee_tonases.uuid',
                    'user_details.photo_path',
                    'employees.nik_employee',
                    'positions.position',
                    'user_details.name',
                    'employees.user_detail_uuid',
                    'employee_tonases.employee_uuid',
                    'coal_froms.uuid',
                    'coal_froms.coal_from',
                    'employee_tonases.updated_at',
                    'employee_tonases.date',
                    'employee_tonases.uuid'
                    )
                ->select( 
                    'employee_tonases.updated_at',
                    'employee_tonases.id',
                    'employee_tonases.uuid',
                    'employee_tonases.employee_uuid',
                    'employee_tonases.date',
                    'employees.user_detail_uuid',
                    'employees.nik_employee',
                    'user_details.photo_path',
                    'user_details.name',
                    'positions.position',
                    'coal_froms.uuid',
                    'employee_tonases.uuid as employee_tonase_uuid',
                    'coal_froms.coal_from',
                    DB::raw("count(tonase_value) as ritase"),
                    DB::raw("SUM(tonase_value) as total_sell"),
                    DB::raw("SUM(tonase_full_value) as total_sells"),
                ); 

                if(!empty($nik_employee)){
                    // lihat per karyawan
                    $ff = $da->where('nik_employee', $nik_employee);  
                    if(!empty($year_month_day)){
                        $ff = $ff->where('date', $year_month_day);
                    }else{
                        $ff = $ff->whereYear('date', $year)
                        ->whereMonth('date', $month);
                    }
                }else{
                    // get updated today || create
                    // return ResponseFormatter::toJson('today','bbb');
                    $ff = $da->whereDate('employee_tonases.updated_at', $year_month_day)->orderBy('employee_tonases.updated_at','desc');
                }

                $da = $ff->get();
                if($da->count() > 0){
                    $collecection = $collecection->merge($da);
                }
        }
        // return ResponseFormatter::toJson($collecection,'bbb');

        // return view('datatableshow', [ 'data'         => $collecection]);
 

        return Datatables::of($collecection)
        ->make(true);
    }

    public function anyDataMonthFilter(Request $request){
        $date = explode("-", $request->year_month);
        $year = $date[0];
        $month = $date[1];

        $filters = [];
        $data =[];
        $collecection = collect($data);
        
        $coal_froms = $request->filter;
        
        if(!empty($request->year_month_day)){
            if(empty($coal_froms)){
                $coal_froms = CoalFrom::all();
                foreach($coal_froms as $value){
                    $filters[] = $value->uuid;
                }
            }else{
                $filters = $request->filter;
            }
            foreach($filters as $value){
                $base =  EmployeeTonase::leftJoin('employees','employees.uuid','employee_tonases.employee_uuid')
                    ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
                    ->leftJoin('positions','positions.uuid','employees.position_uuid')
                    ->join('coal_froms', 'coal_froms.uuid','employee_tonases.coal_from_uuid')
                    ->where('coal_from_uuid', $value)
                    ->groupBy(                     
                        'user_details.photo_path',
                        'employees.nik_employee',
                        'positions.position',
                        'user_details.name',
                        'employees.user_detail_uuid',
                        'employee_tonases.employee_uuid',
                        'coal_froms.uuid',
                        'coal_froms.coal_from',
                        )
                    ->select( 
                        'employee_tonases.employee_uuid',
                        'employees.user_detail_uuid',
                        'employees.nik_employee',
                        'user_details.photo_path',
                        'user_details.name',
                        'positions.position',
                        'coal_froms.uuid',
                        'coal_froms.coal_from',
                        DB::raw("count(tonase_value) as ritase"),
                        DB::raw("SUM(tonase_value) as total_sell"),
                        DB::raw("SUM(tonase_full_value) as total_sells"),
                    );
                if(!empty($request->year_month_day)){
                    $da = $base->where('date', $request->year_month_day);  
                }else{
                    $da = $base->whereYear('date', $year)
                    ->whereMonth('date', $month);                  
                }
    
                if(!empty($request->nik_employee)){
                    $da = $da->where('nik_employee', $request->nik_employee);
                }
    
                $da = $da->get();
    
    
                if($da->count() > 0){
                    $collecection = $collecection->merge($da);
                }        
            }
        }elseif((empty($coal_froms)) && (empty($request->nik_employee))){
            $collecection =  EmployeeTonase::leftJoin('employees','employees.uuid','employee_tonases.employee_uuid')
                ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
                ->leftJoin('positions','positions.uuid','employees.position_uuid')
                // ->join('coal_froms', 'coal_froms.uuid','employee_tonases.coal_from_uuid')
                // ->where('coal_from_uuid', $value)
                ->whereYear('employee_tonases.date', $year)
                ->whereMonth('employee_tonases.date', $month)
                ->groupBy(                     
                    'user_details.photo_path',
                    'employees.nik_employee',
                    'positions.position',
                    'user_details.name',
                    'employees.user_detail_uuid',
                    'employee_tonases.employee_uuid',
                    // 'coal_froms.uuid',
                    // 'coal_froms.coal_from',
                    )
                ->select( 
                    'employee_tonases.employee_uuid',
                    'employees.user_detail_uuid',
                    'employees.nik_employee',
                    'user_details.photo_path',
                    'user_details.name',
                    'positions.position',
                    // 'coal_froms.uuid',
                    // 'coal_froms.coal_from',
                    DB::raw("count(tonase_value) as ritase"),
                    DB::raw("SUM(tonase_value) as total_sell"),
                    DB::raw("SUM(tonase_full_value) as total_sells"),
                )
                ->get();
                
        }else{
            if(empty($coal_froms)){
                $coal_froms = CoalFrom::all();
                foreach($coal_froms as $value){
                    $filters[] = $value->uuid;
                }
            }else{
                $filters = $request->filter;
            }
            // return ResponseFormatter::toJson( $filters, 'aa');
            foreach($filters as $value){
                
                $base =  EmployeeTonase::leftJoin('employees','employees.uuid','employee_tonases.employee_uuid')
                    ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
                    ->leftJoin('positions','positions.uuid','employees.position_uuid')
                    ->join('coal_froms', 'coal_froms.uuid','employee_tonases.coal_from_uuid')
                    ->where('coal_from_uuid', $value)
                    ->groupBy(                     
                        'user_details.photo_path',
                        'employees.nik_employee',
                        'positions.position',
                        'user_details.name',
                        'employees.user_detail_uuid',
                        'employee_tonases.employee_uuid',
                        'coal_froms.uuid',
                        'coal_froms.coal_from',
                        )
                    ->select( 
                        'employee_tonases.employee_uuid',
                        'employees.user_detail_uuid',
                        'employees.nik_employee',
                        'user_details.photo_path',
                        'user_details.name',
                        'positions.position',
                        'coal_froms.uuid',
                        'coal_froms.coal_from',
                        DB::raw("count(tonase_value) as ritase"),
                        DB::raw("SUM(tonase_value) as total_sell"),
                        DB::raw("SUM(tonase_full_value) as total_sells"),
                    );
                
                if(!empty($request->year_month_day)){
                    $da = $base->where('date', $request->year_month_day);  
                }else{
                    $da = $base->whereYear('date', $year)
                    ->whereMonth('date', $month);                  
                }
                
                if(!empty($request->nik_employee)){
                    $da = $da->where('nik_employee', $request->nik_employee);
                }
    
                $da = $da->get();
    
    
                if($da->count() > 0){
                    $collecection = $collecection->merge($da);
                }        
            }
        }

        return Datatables::of($collecection)
        ->make(true);
    }
}
