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
        $employees = Employee::getAll();
        $payment_groups = PaymentGroup::where('status_data','Aktif')->get();
      
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

        $validatedData = $request->validate([
            'uuid' => '',
            'employee_uuid' => '',
            'payment_uuid' => '',
            'value' => '',
            'link_absen' => '',
        ]);

        $employee = Employee::where('uuid', $validatedData['employee_uuid'])->get()->first();


        if($validatedData['link_absen'] != 'none'){
            $validatedDataAbsen = [
                'employee_uuid' => $employee->machine_id,
                'date' => $payments->date,
                'status_absen_uuid' =>$validatedData['link_absen'] ,
            ];
    
            $validatedDataAbsen['uuid']  = $validatedDataAbsen['date'].'-'.$validatedDataAbsen['employee_uuid'];
            $validatedDataAbsen['edited'] = 'edited';
            $storeAbsen = EmployeeAbsen::updateOrCreate(['uuid' =>$validatedDataAbsen['uuid']],$validatedDataAbsen);
        }
        
        if(empty($validatedData['uuid'])){
            $validatedData['uuid'] = $validatedData['employee_uuid'].'-'.$validatedData['payment_uuid'].'-'.rand(99,999);
        }
        $store = EmployeePayment::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, "request");
        
    }
    public function delete(Request $request){
         $store = EmployeePayment::where('uuid',$request->uuid)->delete();
 
         return response()->json(['code'=>200, 'message'=>'Data Deleted','data' => $request->uuid_delete], 200);   
    }
    public function index(){
        // return 'aa';
        $companies = Company::all();
        // dd($companies);
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-payment'
        ];
        return view('employee_payment.index', [
            'title'         => 'Purchase Order',
            'layout'    => $layout,
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
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
        ->whereYear('payments.date', $year)
        ->whereMonth('payments.date', $month)
        ->get([
            'user_details.name',
            'employees.nik_employee',
            'positions.position',
            'employee_payments.payment_uuid',
            'payments.description',
            'payments.date',
            'payments.uuid',
            'employee_payments.value',
            'payment_groups.payment_group'
        ]);
        // dd($data);


        
        
        return Datatables::of($data)
        ->make(true);
    }
}
