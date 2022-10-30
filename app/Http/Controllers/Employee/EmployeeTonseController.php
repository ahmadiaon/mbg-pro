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
            'layout'    => $layout
        ]);
    }

    public function create(){
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
            'today'        => Carbon::today()->isoFormat('Y-M-D'),
            'layout'    => $layout
        ]);
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
           
        }

        return ResponseFormatter::toJson($validatedData, 'Data Stored');
    }
    public function anyData(){
        $data = EmployeeTonase::join('employees as employee', 'employee.uuid','employee_tonases.employee_uuid')
        ->join('user_details as ud_employee','ud_employee.uuid','=','employee.user_detail_uuid')
        ->join('positions','positions.uuid','=','employee.position_uuid')
        ->join('coal_froms','coal_froms.uuid','=','employee_tonases.coal_from_uuid')
        ->orderBy('employee_tonases.updated_at', 'asc')
        ->get([
            'employee_tonases.*',
            'ud_employee.name',
            'positions.position',
            'coal_froms.hauling_price',
            'employee_tonases.tonase_value as tonase_value',
        ]);

        $data = $data->unique();
        
        return Datatables::of($data)
        ->make(true);
    }
    
    public function anyDataMonth($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $employees =  EmployeeTonase::leftJoin('employees','employees.uuid','employee_tonases.employee_uuid')
        ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->groupBy( 'positions.position','user_details.name','employees.user_detail_uuid','employee_tonases.employee_uuid')
        ->whereYear('employee_tonases.date', $year)
        ->whereMonth('employee_tonases.date', $month)
        ->select( 
            'employee_tonases.employee_uuid',
            'employees.user_detail_uuid',
            'user_details.name',
            'positions.position',
            DB::raw("count(tonase_value) as ritase"),
            DB::raw("SUM(tonase_value) as total_sell"),
            DB::raw("SUM(tonase_full_value) as total_sells"),
        )
        ->get();
        
        return Datatables::of($employees)
        ->make(true);
    }
}
