<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Aktivity\Aktivity;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Dictionary;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\Employee\EmployeeOut;
use App\Models\Identity;
use App\Models\User;
use App\Models\UserDetail\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function pdfs(){       
        $pdf = Pdf::loadView('myPDF')->setPaper('a4', 'potret');
        return $pdf->download('invoice.pdf');
    }
    public function setSessionDatabase(){
        return ResponseFormatter::setAllSession();
    }

    public function refreshData(){
        echo 'refreshData';
        session(['keys_random' => rand(0,100000000)]);
        return back();
        
    }

    public function indexActivity(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'activity'
        ];

        


        ResponseFormatter::setAllSession();

        $database = session('data_database');

        foreach($database['data_employees'] as $employee){
            $uuid =  Str::uuid();
            $string = $employee->nik_employee;
            $result = preg_replace("/[^0-9]/", "", $string) ;
            $result = $result * 1;

            $insert_data = [
                'table_name' => 'ID-FINGGER-KARYAWAN',
                'field'     => 'ID-KARYAWAN',
                'value_field'   => $employee->nik_employee,                
                'type_data' => 'EMPLOYEES',
                'code_data' => $uuid,
            ];

            // $store_id_karyawan = Aktivity::insert($insert_data);

            $insert_data['field'] = 'ID-FINGGER';
            $insert_data['value_field'] = $employee->machine_id;            
            // $insert_data['value_field'] = $result;
            // $store_id_karyawan = Aktivity::insert($insert_data);

            $insert_data['field'] = 'CREATED-BY';
            $insert_data['value_field'] = 'MBLE-0422003';            
            // $store_id_karyawan = Aktivity::insert($insert_data);
            $isert[] = $insert_data;

        }

        // return $isert;

        return view('admin.indexActivity', [
            'title'         => 'Aktivitas',
            'layout'    => $layout
        ]);
    }

    public function indexSimple(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'activity'
        ];
        // ResponseFormatter::setAllSession();

        return view('activity.indexSimple', [
            'title'         => 'Aktivitas',
            'layout'    => $layout
        ]);
    }

    public function setDate(Request $request){
        $data = [
            'year'  => $request->year,
            'month' => (int)$request->month,
            'day'   => null
        ];
        session()->put('year_month', $data);
        return ResponseFormatter::toJson($data, 'set date');
    }

    public function setSession(Request $request){
        $data = [
            'year'  => $request->year,
            'month' => (int)$request->month,
            'day'   => null
        ];
        session()->put('year_month', $data);
        return ResponseFormatter::toJson($data, 'set date');
    }

    public function getSession($uniq_name){        
        return ResponseFormatter::toJson(session($uniq_name), 'set date');
    }

    public function exportTable($table_name){
        $arr_table_name = [
            'purchase_orders',
            'users',
            'pohs',
            'positions',
            'departments',
            'religions',
            'hour_meter_prices',
            'mines',
            'absensi_employees',
            'statuses',
            'database_statuses',
            'roasters',
            'companies',
            'vehicles',
            'coal_types',
            'locations',
            'brands',
            'brand_types',
            'employee_absens',
            'units',
            'vehicle_problems',
            'vehicle_breakdown_details',
            'user_details',
            'user_education',
            'vehicle_tracks',
            'vehicle_hms',
            'user_religions',
            'user_addresses',
            'vehicle_statuses',
            'user_healths',
            'hour_meters',
            'pits',
            'user_experiences',
            'over_burden_operators',
            'over_burdens',
            'over_burden_lists',
            'employee_salaries',
            'over_burden_notes',
            'employees',
            'haulings',
            'hauling_setups',
            'employee_roasters',
            'employee_companies',
            'over_burden_flits',
            'group_vehicles',
            'employee_total_hm_months',
            'status_absens',
            'payment_groups',
            'galeries',
            'user_privileges',
            'privileges',
            'user_licenses',
            'user_dependents',
            'atribut_sizes',
            'safety_employees',
            'coal_froms',
            'employee_tonases',
            'payments',
            'employee_payments',
            'employee_hour_meter_days'
        ];
        $data = Employee::leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->get([
            'employees.nik_employee',
            'employees.machine_id',
            'user_details.name',
            'positions.position',
        ]);
        // dd($data);
        foreach ($data as $key) {
            Identity::create([
                'nik_employee' => $key->nik_employee,
                'name' => $key->name,
                'machine_id' => $key->machine_id,
                'position' => $key->position,
            ]);
        }
        return 'done';

        /*

        foreach($arr_table_name as $tb_name){
            $tables = DB::getSchemaBuilder()->getColumnListing($tb_name);
            $data = DB::table($tb_name)->get();

            if($data->count()  > 0){
                $text_column = '';
            foreach($tables as $column){
                $text_column = $text_column.','.$column;
            }

            $text_column = ltrim($text_column, ',');
            rtrim($text_column, ", ");
            echo 'insert into '.$tb_name.' ('.$text_column.') VALUES </br>';
            
            foreach($data as $dt){
                $text_data_column = '';
                foreach($tables as $column){
                    $text_data_column = $text_data_column.',"'.$dt->$column.'"';
                    
                }
                $text_data_column = ltrim($text_data_column, ',');
                echo "(".$text_data_column."),</br>";
               
            }
            }
            

            


        }
        die;


        */

        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
       
        // foreach($arr_table_name as $tb_name){
        //     $createSpreadsheet = new spreadsheet();
        //     $createSheet = $createSpreadsheet->getActiveSheet();
        //     $tables = DB::getSchemaBuilder()->getColumnListing($tb_name);

        //     $row = 0;
        //     foreach($tables as $table){
        //         $createSheet->setCellValue($abjads[$row].'4', $table);  
        //         $row++; 

        //         $data = DB::table($tb_name)->get();

        //         if($data->count()  > 0){
                    
        //             $column = 5;
                    
        //             foreach($data as $cd){
        //                 $row_c = 0;
        //                 foreach($tables as $table){
        //                     $createSheet->setCellValue($abjads[$row_c].$column, $cd->$table);  
        //                     $row_c++;
        //                 }
        //                 $column++;
        //             } 
        //         }
        //     }
        //     $crateWriter = new Xls($createSpreadsheet);
        //     $name = 'file/data/'.$tb_name.'-'.rand(99,9999).'-file.xlsx';
        //     // $crateWriter->save($name);
        //     // return response()->download($name);

        // }
        $data = UserDetail::join('employees','employees.user_detail_uuid', 'user_details.uuid')
        ->join('positions','positions.uuid','employees.position_uuid')
        ->leftJoin('departments','departments.uuid','employees.department_uuid')
        ->leftJoin('employee_salaries', 'employee_salaries.employee_uuid', 'employees.uuid')
        ->leftJoin('employee_companies', 'employee_companies.employee_uuid', 'employees.uuid')
        ->leftJoin('employee_roasters', 'employee_roasters.employee_uuid', 'employees.uuid')
        ->leftJoin('user_addresses', 'user_addresses.user_detail_uuid', 'user_details.uuid')
        ->leftJoin('user_licenses', 'user_licenses.user_detail_uuid', 'user_details.uuid')
        ->get([
            'employees.*', 
            'user_details.*',
            
            'user_addresses.*',
            'user_licenses.*',
            'departments.*',
            'positions.*',
            'employee_salaries.*',
            'employee_roasters.*',
            'employee_companies.*'
        ]);
        // $data = UserDetail::join('employees','employees.user_detail_uuid', 'user_details.uuid')
        // ->get();
        // dd();
        return view('datatableshow', [ 'data'         => $data]);
        $data_row = 1;
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $header_excel = Dictionary::all();


        foreach($header_excel as $he){
            // echo $he->excel."</br>";
            $createSheet->setCellValue($abjads[$data_row]."3", $he->excel);  
            $data_row++;
        }
        $data_col = 4;
        foreach($data as $tb_data){
            dd($tb_data);
            $data_row = 1;
            foreach($header_excel as $he){
                // echo $he->excel."</br>";
                $namee = $he->database;
                // dd($namee);
                $createSheet->setCellValue($abjads[$data_row].$data_col, $tb_data->$namee);  
                $data_row++;
            }
            $data_col++;
        
           
            // $crateWriter->save($name);
            // return response()->download($name);

        }
        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/data/exportttt-'.rand(99,9999).'-file.xlsx';
         $crateWriter->save($name);


            return response()->download($name);
        return view('datatableshow', [ 'data'         => $data]);
        die;

       
       
       
        // ======================================                                   EXTRACT TO EXCELL
        $createSpreadsheet = new spreadsheet();
        $createSpreadsheet->setActiveSheetIndex(1);
        $createSpreadsheet->getActiveSheet()->setTitle('Second tab');
        $createSheet = $createSpreadsheet->getActiveSheet();
        // -----------------------------------------------------------------------nama column
    
        
        $tables = DB::getSchemaBuilder()->getColumnListing($table_name);
        $data = DB::table($table_name)->get();
        $row = 0;
        foreach($tables as $table_column){
            $createSheet->setCellValue($abjads[$row].'4', $table_column);           
            $row++;
        }
        
        
        
        

        if($data->count() > 0){
            $column = 5;
            foreach($data as $item){
                $row = 0;
                foreach($tables as $table_column){
                    $createSheet->setCellValue($abjads[$row].$column, $item->$table_column);           
                    $row++;
                }

                $column++;
            }
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/extrack-karyawan-'.rand(99,9999).'-file.xlsx';
        $crateWriter->save($name);
        return response()->download($name);
        // foreach()
        dd($tables);


    }

    public function index(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'index'
        ];
        

        // ====VARIABLE===
        $date_today = ResponseFormatter::getDateToday();
        $explode_date_today = explode('-', $date_today);

        $date_eigth_before = new Carbon($date_today);
        $date_eigth_before->subMonths(7);
        $date_eigth_before->subDays($explode_date_today[2]-1);

        $date_eigth_before_date = $date_eigth_before->format("Y-m-d");

        // dd($date_eigth_before_date);
        $explode_date_eigth_before_date = explode('-', $date_eigth_before_date); 


        $date_end_this_month_day = ResponseFormatter::getEndDay($explode_date_eigth_before_date[0].'-'.$explode_date_eigth_before_date[1]);
        $date_end_this_month = $explode_date_eigth_before_date[0].'-'.$explode_date_eigth_before_date[1].'-'.$date_end_this_month_day;
        $date_start_this_month = $explode_date_eigth_before_date[0].'-'.$explode_date_eigth_before_date[1].'-01';
        $data_for_grafik_flow_employee = [];
        
        $date_today = new Carbon($date_today);
        $date_today->subMonths(1);
        // dd('active');
        
        while($date_start_this_month < $date_today){            
            $date_eigth_before = new Carbon($date_start_this_month);
            $date_eigth_before = $date_eigth_before->addMonths(1);
            $date_eigth_before_date = $date_eigth_before->format("Y-m-d");
            $explode_date_eigth_before_date = explode('-', $date_eigth_before_date); 

           
            $date_end_this_month_day = ResponseFormatter::getEndDay($explode_date_eigth_before_date[0].'-'.$explode_date_eigth_before_date[1]);
            // $date_end_this_month_day = ResponseFormatter::getEndDay('2023-04');
            // $datetime = Carbon::createFromFormat('Y-m-d', $explode_date_eigth_before_date[0].'-'.($explode_date_eigth_before_date[1] ).'-01');
            // $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');
                // dd($date_end_this_month_day);
            if($explode_date_eigth_before_date[0].'-'.$explode_date_eigth_before_date[1].'-'.$date_end_this_month_day == '2023-02-31'){
                $date_end_this_month_day = ResponseFormatter::getEndDay($explode_date_eigth_before_date[0].'-'.($explode_date_eigth_before_date[1] ));
                dd($explode_date_eigth_before_date[0].'-'.$explode_date_eigth_before_date[1].$date_end_this_month_day);
            }

            $date_end_this_month = $explode_date_eigth_before_date[0].'-'.$explode_date_eigth_before_date[1].'-'.$date_end_this_month_day;
            $date_start_this_month = $explode_date_eigth_before_date[0].'-'.$explode_date_eigth_before_date[1].'-01';
            

            $get_employee_total_this_month = Employee::whereNull('date_end')
            ->where('date_document_contract', '<=', $date_end_this_month)
            ->count();
    
            $get_employee_out_total_this_month = EmployeeOut::where('date_out', '<=', $date_end_this_month)
            ->where('date_out', '>=', $date_start_this_month)
            ->count();

            $get_employee_out_total_before_this_month = EmployeeOut::where('date_out', '<=', $date_end_this_month)
            ->count();
    
            $get_employee_in_total_this_month = Employee::whereNull('date_end')
            ->where('date_document_contract', '<=', $date_end_this_month)
            ->where('date_document_contract', '>=', $date_start_this_month)
            ->count();
            

            $data_for_grafik_flow_employee['month'][] = ResponseFormatter::getMonthName((int)$explode_date_eigth_before_date[1]);
            $data_for_grafik_flow_employee['data_aktif'][] = $get_employee_total_this_month - $get_employee_out_total_before_this_month;
            $data_for_grafik_flow_employee['data_in'][] = $get_employee_in_total_this_month;
            $data_for_grafik_flow_employee['data_out'][] = $get_employee_out_total_this_month;
            $data_for_grafik_flow_employee['data_total'][] = $get_employee_total_this_month ;

        }

        // dd($data_date);
        // $date_end_this_month_day = ResponseFormatter::getEndDay($explode_date_today[0].'-'.$explode_date_today[1]);
        // $date_end_this_month = $explode_date_today[0].'-'.$explode_date_today[1].'-'.$date_end_this_month_day;
        // $date_start_this_month = $explode_date_today[0].'-'.$explode_date_today[1].'-01';
        
        // $get_employee_total_this_month = Employee::whereNull('date_end')
        // ->where('date_document_contract', '<=', $date_end_this_month)
        // ->count();

        // $get_employee_out_total_this_month = EmployeeOut::where('date_out', '<=', $date_end_this_month)
        // ->where('date_out', '>=', $date_start_this_month)
        // ->count();

        // $get_employee_in_total_this_month = Employee::whereNull('date_end')
        // ->where('date_document_contract', '<=', $date_end_this_month)
        // ->where('date_document_contract', '>=', $date_start_this_month)
        // ->count();

        // dd($get_employee_in_total_this_month);

        // dd($date_end_this_month);

        $data_flow_employee = [
                    'month' => [
                        'Jan' => [
                            'employee_out' => 10,
                            'employee_in' => 20,
                            'total_employee' => 100
                        ]
                    ]
                ];

        // $data_for_grafik_flow_employee = [
        //     'month' => [
        //         'Jan',
        //         'Feb',                
        //         'Mar'
        //     ],
        //     'data_in' =>[10,20,10],
        //     'data_out' =>[20,20,13],
        //     'data_total' =>[10,20,13],
        // ];




        // dd($date_eigth_before->format("Y-m-d"));

        $departments = Employee::get_employee_all_latest_full_data_no_get();
        $departments = $departments->groupBy([
            'department_uuid',
            'department'
        ])
        ->select(
            'department',
            DB::raw("count(department_uuid) as count"),
        )
        ->get();

        // dd($departments);
        $arr_department = [];
        $arr_department = [];
        $count_arr_department = count($arr_department);
        foreach($departments as $department){
            if($department->count > 0){
                $arr_department[] = [
                    $department->department, $department->count, false
                ];
            }
           
        }


        /*
            => 8 bulan kebelakang dari sekarang

        */

        // dd($arr_department);
        
        return view('admin.index', [
            'title'         => 'Beranda',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'arr_department'    => $arr_department,
            'data_for_grafik_flow_employee'  => $data_for_grafik_flow_employee,
            'layout'        => $layout,
        ]);
    }

    public function listEmployee(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => false,
            'javascript_form'       => false,
            'active'                        => 'listEmployee'
        ];

        return view('hr.listEmployee', [
            'title'         => 'List Employee',
            'layout'       => $layout
        ]);
    }

}
