<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeePayment;
use App\Models\Payment\Payment;
use App\Models\Payment\PaymentGroup;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'uuid' => '',
            'payment_group_uuid' => '',
            'date' => '',
            'date_end' => '',
            'long' => '',
            'employee_create_uuid' => '',
            'employee_know_uuid' => '',
            'employee_approve_uuid' => '',
            'description' => '',
        ]);
        


        if(empty($validatedData['uuid'])){
            $validatedData['uuid'] = $validatedData['date'].'-'.$validatedData['payment_group_uuid'].'-'.rand(99,999);
        }
        // return ResponseFormatter::toJson($validatedData, "request");
        $store = Payment::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, "request");
        
    }

    public function show($uuid){
        $payment = Payment::where('uuid', $uuid)->get()->first();
        $employee_payments = EmployeePayment::where('payment_uuid', $uuid)->get();

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
            'payment'   => $payment,
            'employee_payments'     => $employee_payments,
            'payment_groups' => $payment_groups,
            'layout'    => $layout
        ]);

    }
    

    public function indexPayrol($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        

        $employees = Employee::getAll();

        // dd($employees);
        // return $employees;
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'payment'
        ];
        return view('payment.payrol.index', [
            'title'         => 'Mobilisasi Karyawan',
            'employees' => $employees,
            'month'     => $year.'-'.$month,
            'layout'    => $layout
        ]);
    }
    public function createPayrol(){
        $employees = Employee::getAll();

        $payment_groups = PaymentGroup::all();
        $layout = [
                'head_core'            => true,
                'javascript_core'       => true,
                'head_datatable'        => true,
                'javascript_datatable'  => true,
                'head_form'             => true,
                'javascript_form'       => true,
                'active'                        => 'payment-employee'
            ];
            return view('payment.payrol.create', [
                'title'         => 'Mobilisasi Karyawan',
                'payment_groups' => $payment_groups,
                'employees' => $employees,
                'uuid'      => '',
                'layout'    => $layout
            ]);
    }

    public function storePayrol(Request $request){
        $validatedData = $request->validate([
            'uuid' => '',
            'payment_group_uuid' => '',
            'date' => '',
            'known_employee_uuid' => '',
            'approve_employee_uuid' => '',
            'create_employee_uuid' => '',
            'description' => '',
        ]);
        


        if(!$validatedData['uuid']){
            $validatedData['uuid'] = "uuid".Str::uuid();
        }
         
        $store = Payment::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($validatedData, "request");
        
    }
    
    public function editPayrol($uuid){
        $employees = Employee::getAll();
        
        $payment_groups = PaymentGroup::all();
        $layout = [
                'head_core'            => true,
                'javascript_core'       => true,
                'head_datatable'        => true,
                'javascript_datatable'  => true,
                'head_form'             => true,
                'javascript_form'       => true,
                'active'                        => 'payment-employee'
            ];
        return view('payment.payrol.create', [
            'title'         => 'Mobilisasi Karyawan',
            'payment_groups' => $payment_groups,
            'employees' => $employees,
            'uuid'      => $uuid,
            'layout'    => $layout
        ]);
    }
    public function showPayrol(Request $request){
        
        $data = Payment::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Payment');
    }
    public function dataPayment($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $payments = Payment::join('payment_groups','payment_groups.uuid','payments.payment_group_uuid')
        ->whereYear('payments.date', $year)
        ->whereMonth('payments.date', $month)
        ->get([
            'payments.*',
            'payment_groups.payment_group'
        ]);
        
        return Datatables::of($payments)
        ->addColumn('action', function ($model) {
            $url = "/payrol/payment/show/".$model->uuid;
            
            return '<a class="text-decoration-none" href="'.$url.'">
                            <button class="btn btn-secondary py-1 px-2 mr-1">
                                <i class="icon-copy bi bi-eye-fill"></i>
                            </button>
                        </a>
            ';
        })         
        ->make(true);
    }
}
