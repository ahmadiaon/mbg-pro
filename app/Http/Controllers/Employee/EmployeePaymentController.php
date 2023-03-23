<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\CoalFrom;
use App\Models\Company;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeePayment;
use App\Models\Payment\Payment;
use App\Models\Payment\PaymentGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class EmployeePaymentController extends Controller
{
    public function create(){
        $employees = Employee::data_employee();
        $payment_groups = PaymentGroup::all();
      
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-payment'
        ];
        return view('employee_payment.create', [
            'title'         => 'Tonase',
            'employees' => $employees,
            'payment_groups' => $payment_groups,
            'payment'   => '',
            'employee_payments'     => '',
            'layout'    => $layout
        ]);
    }

    public function store(Request $request){
        $payments = Payment::where('uuid', $request->payment_uuid)->get()->first();

        $validatedData = $request->all();
        $employee = Employee::where('uuid', $validatedData['employee_uuid'])->whereNull('date_end')->get()->first();

        if($validatedData['link_absen'] != 'none'){
            $validatedDataAbsen = [
                'employee_uuid' => $employee->machine_id,
                'date' => $payments->date,
                'status_absen_uuid' =>$validatedData['link_absen'] ,
                'edited'=> 'edited'
            ];
            $date = date_create($payments->date);
            
            for($i=0; $i<$payments->long; $i++){    
                $date_absen = $date -> format('Y-m-d');
                
                $validatedDataAbsen['uuid']  = $date_absen.'-'.$validatedDataAbsen['employee_uuid'];
                $storeAbsen = EmployeeAbsen::updateOrCreate(['uuid' =>$validatedDataAbsen['uuid']],$validatedDataAbsen);
                
                $interval = date_interval_create_from_date_string('1 days');
                $date->add($interval);
            }
        }
        
        if(empty($validatedData['uuid'])){
            $validatedData['uuid'] = $validatedData['employee_uuid'].'-'.$payments->payment_group_uuid.'-'.$payments->date.'-'.$payments->uuid;
        }
        $store = EmployeePayment::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, "request");
        
    }
    
    public function delete(Request $request){
         $store = EmployeePayment::where('uuid',$request->uuid)->delete();
 
         return response()->json(['code'=>200, 'message'=>'Data Deleted','data' => $request->uuid_delete], 200);   
    }
    public function index(){
        $companies = Company::all();
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-payment'
        ];
        return view('employee_payment.index', [
            'title'         => 'Pembayaran',
            'layout'    => $layout,
            'companies' => $companies
        ]);
    }
    
    public function anyDataMonth($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $data = EmployeePayment::join('payments', 'payments.uuid' , 'employee_payments.payment_uuid')
        ->leftJoin('employees','employees.uuid','employee_payments.employee_uuid')
        ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->leftJoin('payment_groups','payment_groups.uuid','payments.payment_group_uuid')
        ->whereNull('employees.date_end')
        ->whereNull('user_details.date_end')
        ->whereYear('payments.date', $year)
        ->whereMonth('payments.date', $month)
        ->get([
            'user_details.name',
            'employees.nik_employee',
            'positions.position',
            'employee_payments.payment_uuid',
            'payments.description',
            // 'employee_payments.*',
            'payments.*',
            'payments.uuid',
            'employee_payments.value',
            'payment_groups.payment_group'
        ]);
        // dd($data);


        
        
        return Datatables::of($data)
        ->make(true);
    }
}
