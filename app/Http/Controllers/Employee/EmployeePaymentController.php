<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeePayment;
use App\Models\Payment\Payment;
use App\Models\Payment\PaymentGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeePaymentController extends Controller
{
    public function create()
    {
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

    public function store(Request $request)
    {
        $payments = Payment::where('uuid', $request->payment_uuid)->get()->first();

        $validatedData = $request->all();
        $employee = Employee::where('uuid', $validatedData['employee_uuid'])->whereNull('date_end')->get()->first();

        if ($validatedData['link_absen'] != 'none') {
            $validatedDataAbsen = [
                'employee_uuid' => $employee->machine_id,
                'date' => $payments->date,
                'status_absen_uuid' => $validatedData['link_absen'],
                'edited' => 'edited'
            ];
            $date = date_create($payments->date);

            for ($i = 0; $i < $payments->long; $i++) {
                $date_absen = $date->format('Y-m-d');

                $validatedDataAbsen['uuid']  = $date_absen . '-' . $validatedDataAbsen['employee_uuid'];
                $storeAbsen = EmployeeAbsen::updateOrCreate(['uuid' => $validatedDataAbsen['uuid']], $validatedDataAbsen);

                $interval = date_interval_create_from_date_string('1 days');
                $date->add($interval);
            }
        }

        if (empty($validatedData['uuid'])) {
            $validatedData['uuid'] = $validatedData['employee_uuid'] . '-' . $payments->payment_group_uuid . '-' . $payments->date . '-' . $payments->uuid;
        }
        $store = EmployeePayment::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, "request");
    }

    public function delete(Request $request)
    {
        $store = EmployeePayment::where('uuid', $request->uuid)->delete();

        return response()->json(['code' => 200, 'message' => 'Data Deleted', 'data' => $request->uuid_delete], 200);
    }
    public function index()
    {
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
        ]);
    }

    public function anyDataMonth(Request $request)
    {
        $validateData = $request->all();
        $data_database = session('data_database');
        $data_employees = $data_database['data_employees'];

        if (empty($validateData['filter']['arr_filter'])) {
            $validateData['filter']['arr_filter'] = $validateData['filter']['value_checkbox'];
        } else {
            if (empty($validateData['filter']['arr_filter']['company'])) {
                $validateData['filter']['arr_filter']['company'] = $validateData['filter']['value_checkbox']['company'];
            }
            if (empty($validateData['filter']['arr_filter']['payment_group_uuid'])) {
                $validateData['filter']['arr_filter']['payment_group_uuid'] = $validateData['filter']['value_checkbox']['payment_group_uuid'];
            }
            if (empty($validateData['filter']['arr_filter']['site_uuid'])) {
                $validateData['filter']['arr_filter']['site_uuid'] = $validateData['filter']['value_checkbox']['site_uuid'];
            }
        }


        $arr_data_tonase = [];
        $data_datatable= [];
        $datatable = [];
        $data_table = [];
        $data_basic = EmployeePayment::leftJoin('payments', 'payments.uuid', 'employee_payments.payment_uuid')
            ->leftJoin('payment_groups', 'payment_groups.uuid', 'payments.payment_group_uuid')
            ->leftJoin('employees', 'employees.nik_employee', 'employee_payments.employee_uuid')
            ->where('payments.date', '>=', $validateData['filter']['date_filter']['date_start_filter_range'])
            ->where('payments.date', '<=', $validateData['filter']['date_filter']['date_end_filter_range'])
            // ->groupBy('employee_payments.uuid')
            ->get([
                'employees.site_uuid',
                'employees.company_uuid',
                'employee_payments.*',
                'payment_groups.payment_group',
                'payments.*',
                'payments.payment_group_uuid',
                'employee_payments.*',
            ]);


        
        if (!empty($validateData['filter']['arr_filter'])) {
            foreach ($validateData['filter']['arr_filter']['company'] as $item_company) {
                foreach ($validateData['filter']['arr_filter']['site_uuid'] as $item_site_uuid) {
                    if ($validateData['filter']['is_combined']  == 'true') {
                        $data_table[$item_company . '-' . $item_site_uuid] = ['detail'];
                    } else {
                        foreach ($validateData['filter']['arr_filter']['payment_group_uuid'] as $item_payment_group_uuid) {
                            $data_table[$item_company . '-' . $item_site_uuid . '-' . $item_payment_group_uuid] = ['detail'];
                        }
                    }
                }
            }
            $uuid = [];
            foreach ($data_basic as $i_db) {
                if (!empty($data_table[$i_db->company_uuid . '-' . $i_db->site_uuid . '-' . $i_db->payment_group_uuid])) {
                    if(empty($uuid[$i_db->uuid])){
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['data'][] = $i_db;
                        if (empty($datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['employee_uuid'])) {
                            $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_payment'] = 0;
                            $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_payment'] = 0;
                            $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['employee_uuid'] = $i_db->employee_uuid;
                        }
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_payment'] = $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_payment'] + 1;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_payment'] = $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_payment'] + $i_db->value;
                        $uuid[$i_db->uuid] = true;
                    }                   
                }
            }
            foreach($datatable as $i_dt){
                if(count($i_dt) > 0){
                    foreach($i_dt as $index_i_dt=>$value_i_dt){
                        $data_datatable[] = $value_i_dt;
                    }
                }                
            }
            $data = [
                'request'    => $validateData,
                'data_basic'  => $data_basic,
                'data_table'  => $data_table,
                'datatable' => $datatable,
                'data_datatable' => $data_datatable,
            ];
            return ResponseFormatter::toJson($data, 'anyData employee payment');
        }
    }
}
