<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\CoalFrom;
use App\Models\Company;

use Yajra\Datatables\Datatables;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeTonase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                
                
                
                if(empty($validatedData['uuid'])){
                    $validatedData['uuid'] = "tonase-".$validatedData['date'].'-'.$validatedData['shift'].'-'.$validatedData['employee_uuid'].'-'.rand(99,999);
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
