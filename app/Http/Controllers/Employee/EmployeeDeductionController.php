<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeDeduction;
use Illuminate\Http\Request;

class EmployeeDeductionController extends Controller
{
    public function index()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-deduction'
        ];
        return view('employee_deduction.index', [
            'title'         => 'Pengurang Pendapatan',
            'layout'    => $layout,
        ]);
    }
    public function store(Request $request)
    {
        $validateData = $request->all();
        if (empty($validateData['uuid'])) {
            $validateData['uuid'] = $validateData['date_employee_deduction'] . '-' . $validateData['group_deduction_uuid'] . '-' . $validateData['employee_uuid'];
        }
        $storeData = EmployeeDeduction::updateOrCreate(['uuid' =>  $validateData['uuid']], $validateData);
        return ResponseFormatter::toJson(['request' => $validateData, 'storeData' => $storeData], 'store ahmadi');
    }
    public function anyData(Request $request)
    {
        $validateData = $request->all();
        $validateData['filter']['is_combined']   = false;
        $data_database = session('data_database');
        $data_employees = $data_database['data_employees'];

        if (empty($validateData['filter']['arr_filter'])) {
            $validateData['filter']['arr_filter'] = $validateData['filter']['value_checkbox'];
        } else {
            if (empty($validateData['filter']['arr_filter']['company'])) {
                $validateData['filter']['arr_filter']['company'] = $validateData['filter']['value_checkbox']['company'];
            }
            if (empty($validateData['filter']['arr_filter']['group_deduction_uuid'])) {
                $validateData['filter']['arr_filter']['group_deduction_uuid'] = $validateData['filter']['value_checkbox']['group_deduction_uuid'];
            }
            if (empty($validateData['filter']['arr_filter']['site_uuid'])) {
                $validateData['filter']['arr_filter']['site_uuid'] = $validateData['filter']['value_checkbox']['site_uuid'];
            }
        }


        $arr_data_tonase = [];
        $data_table = [];

        $data_basic = EmployeeDeduction::join('atribut_sizes', 'atribut_sizes.uuid', 'employee_deductions.group_deduction_uuid')
            ->join('employees', 'employees.nik_employee', 'employee_deductions.employee_uuid')
            ->whereNull('employees.date_end')
            ->where('employee_deductions.date_employee_deduction', '>=', $validateData['filter']['date_filter']['date_start_filter_range'])
            ->where('employee_deductions.date_employee_deduction', '<=', $validateData['filter']['date_filter']['date_end_filter_range'])
            ->get([
                'employees.nik_employee',
                'employees.site_uuid',
                'employees.company_uuid',
                'atribut_sizes.*',
                'employee_deductions.*'
            ]);
        $data_uuid = [];
        foreach ($data_basic as $item_data_basic) {
            $data_uuid[$item_data_basic->uuid] = $item_data_basic;
        }

        $data_datatable = [];
        $datatable = [];
        if (!empty($validateData['filter']['arr_filter'])) {
            foreach ($validateData['filter']['arr_filter']['company'] as $item_company) {
                foreach ($validateData['filter']['arr_filter']['site_uuid'] as $item_site_uuid) {
                    if ($validateData['filter']['is_combined']  == 'true') {
                        $data_table[$item_company . '-' . $item_site_uuid] = ['detail'];
                    } else {
                        foreach ($validateData['filter']['arr_filter']['group_deduction_uuid'] as $item_group_deduction_uuid) {
                            $data_table[$item_company . '-' . $item_site_uuid . '-' . $item_group_deduction_uuid] = ['detail'];
                        }
                    }
                }
            }

            foreach ($data_basic as $i_db) {
                if (!empty($data_table[$i_db->company_uuid . '-' . $i_db->site_uuid . '-' . $i_db->group_deduction_uuid])) {
                    $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['data'][] = $i_db;
                    if (empty($datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['employee_uuid'])) {
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_payment'] = 0;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_payment'] = 0;
                        $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['employee_uuid'] = $i_db->employee_uuid;
                    }
                    $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_payment'] = $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['count_payment'] + 1;
                    $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_payment'] = $datatable[$i_db->company_uuid . '-' . $i_db->site_uuid][$i_db->employee_uuid]['sum_payment'] + $i_db->value_employee_deduction;
                }
            }

            foreach ($datatable as $i_dt) {
                if (count($i_dt) > 0) {
                    foreach ($i_dt as $index_i_dt => $value_i_dt) {
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
                'data_uuid' => $data_uuid
            ];

            return ResponseFormatter::toJson($data, 'anyData employee payment');
        }
    }

    public function delete(Request $request){//used
        $store = EmployeeDeduction::where('uuid',$request->uuid)->delete();

        return ResponseFormatter::toJson($store, 'Data deleted');
   }
}
