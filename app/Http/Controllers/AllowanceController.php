<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\CoalFrom;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeAbsenTotal;
use App\Models\Employee\EmployeeCompany;
use App\Models\Employee\EmployeeDeduction;
use App\Models\Employee\EmployeeHourMeterBonus;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\Employee\EmployeePayment;
use App\Models\Employee\EmployeePaymentDebt;
use App\Models\Employee\EmployeePaymentOther;
use App\Models\Employee\EmployeePremi;
use App\Models\Employee\EmployeeSalary;
use App\Models\Employee\EmployeeTonase;
use App\Models\Formula;
use App\Models\GroupFormula;
use App\Models\HourMeterPrice;
use App\Models\Identity;
use App\Models\Position;
use App\Models\Premi;
use App\Models\Production;
use App\Models\Safety\AtributSize;
use App\Models\StatusAbsen;
use App\Models\TaxStatus;
use App\Models\UserDetail\UserDetail;
use App\Models\VariableCount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class AllowanceController extends Controller
{
    public function index()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => false,
            'active'                        => 'employee-allowance'
        ];
        return view('allowance.index', [
            'title'         => 'Pendapatan Karyawan',
            'layout'    => $layout,
        ]);
    }

    public function export(Request $request){
        $data_databases = (session('data_database'));
        $data_employees = $data_databases['data_employees'];        
        $arr_date_today = (session('year_month'));
        $validatedData = $request->all();
        $validatedData['data_export'] = json_decode($request->data_export);
        
        $year_month = $arr_date_today['year'] . '-' . $arr_date_today['month'];

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();


        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('B5', 'ID EMP');
        $createSheet->setCellValue('C5', 'NAMA');
        $createSheet->setCellValue('D5', 'JABATAN');
        $createSheet->setCellValue('E5', 'GAJIH BERSIH');
        $createSheet->setCellValue('F5', 'GAJIH KOTOR');
        $createSheet->setCellValue('G5', 'Besar Potongan');
        $no_emp = 1;
        foreach ($validatedData['data_export'] as $item_data_export) {
            $no_emp_col = $no_emp + 5;
            $item_payrol = $item_data_export->item_payrol;
            // return ResponseFormatter::toJson($item_payrol['gajih_bersih'], '$item_data_export');

            $createSheet->setCellValue('A' . $no_emp_col, $no_emp);
            $createSheet->setCellValue('B' . $no_emp_col, $item_payrol->nik_employee);
            $createSheet->setCellValue('C' . $no_emp_col, $item_payrol->name);
            $createSheet->setCellValue('D' . $no_emp_col, $item_payrol->position);
            // if(!empty()){

            // }
            $createSheet->setCellValue('E' . $no_emp_col, $item_payrol->gajih_bersih);
            $createSheet->setCellValue('F' . $no_emp_col, $item_payrol->gajih_kotor);
            $createSheet->setCellValue('G' . $no_emp_col, $item_payrol->pengurang_pendapatan);
            $no_emp++;
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/export/' . $year_month . '-' . rand(99, 9999) . 'file.xls';
        $crateWriter->save($name);

        return ResponseFormatter::toJson($name, $request->data_export);
    }

    public function countPayrol(Request $request)
    {
        $validateData = $request->all();
        // $validateData['filter']['date'] = [
        //     'month' =>1,
        //     'year' =>2023,
        // ];
        $data_database = session('data_database');
        $data_employees = $data_database['data_employees'];
        $data_premis = Premi::all();
        
        



        $database_payrol = [
            'percent_bpjs_ketenagakerjaan' => 2,
            'percent_bpjs_kesehatan' => 1,
            'percent_bpjs_pensiun' => 1,
            'percent_JKK' => 1.74,
            'percent_JK' => 0.3,
            'percent_JHT' => 2,
            'percent_iuran_pensiun' => 1,
            'percent_pph21' => 5,
            'percent_jabatan' => 5,
            'percent_kesehatan' => 4,
            'percent_insentif_produksi' => 50,
            'max_biaya_jabatan' => 500000,
            'item_pendapatan_kotor' => [
                'gajih_pokok',
                'insentif',
                'tunjangan',
                'hour_meter',
                'premi',
                'payment_other',
                'tonase',
                'payment',
            ],
            'item_detail_karyawan' => [
                'name',
                'nik_employee',
                'position',
                'pay_method',
                'company',
                'company_uuid',
                'site',
                'tmk',
                'salary_basic',
                'insentif_basic',
                'tunjangan_basic',
                'tax_status',
                'no_bpjs_kesehatan',
                'no_bpjs_ketenagakerjaan',
                'tax_status',
                'tax_year_value',

            ],
            'item_brutto_this_month' => [
                'gajih_pokok',
                'insentif',
                'tunjangan',
                'JKK',
                'JK',
                'kesehatan',
                'insentif_produksi_pph21',
            ],
            'item_pengurang_pkp' => [
                'biaya_jabatan',
                'JHT',
                'iuran_pensiun'
            ],
            'item_pengurang_pendapatan' => [
                'payment_debt',
                'deduction_other',
                'cut_alpa_loan',
                'cut_absen_loan',
                'pph21',
                'bpjs_ketenagakerjaan',
                'bpjs_kesehatan',
                'bpjs_pensiun',
            ],
            'pay_premies' => [],
            'hour_meter_item' => [],
            'rute_hauling' => [],
            // 'percent_bpjs_ketenagakerjaan' => 2,
        ];
        $item_pajak = [];
        foreach ($data_database['data_atribut_sizes']['tax_status'] as $item_db_pajak) {
            $item_pajak[$item_db_pajak->uuid] = $item_db_pajak->value_atribut;
        }
        foreach($data_premis as $item_premi){
            $database_payrol['pay_premies'][] = 'pay_premi_'.$item_premi->uuid;
        }

        foreach($data_database['data_atribut_sizes']['hour_meter_price'] as $item_hour_meter){
            $database_payrol['hour_meter_item'][] = $item_hour_meter->uuid;
        }

        foreach($data_database['data_coal_froms'] as $item_rute_hauling){
            $database_payrol['rute_hauling'][] = $item_rute_hauling->uuid;
            $database_payrol['name_rute_hauling_'.$item_rute_hauling->uuid] = $item_rute_hauling->coal_from;
        }

        $database_payrol['tax_status'] = $item_pajak;

        // ==========================================  SETUP FORMULA POTONGAN
            $formulas = Formula::all();

            foreach ($formulas as $f) {
                $group_formulas = GroupFormula::where('formula_uuid', $f->uuid)->get();

                foreach ($group_formulas as $gf) {
                    $cut_izin_formula = VariableCount::join('variables', 'variables.uuid', 'variable_counts.variable_uuid')
                        ->orderBy('variable_counts.order_number', 'asc')
                        ->where('variable_counts.group_formula_uuid', $gf->uuid)
                        ->get([
                            'variables.*',
                            'variable_counts.*'
                        ]);
                    $gf->variable_counts = $cut_izin_formula;
                }
                $f->group_formula =  $group_formulas;
            }
        // ==========================================  END SETUP FORMULA POTONGAN

        // return ResponseFormatter::toJson($formulas, '$formulas');








        $latest_date_this_month = ResponseFormatter::getEndDay($validateData['filter']['date']['year'] . '-' . $validateData['filter']['date']['month']);
        $latest_date_next_month = ResponseFormatter::getEndDay($validateData['filter']['date']['year'] . '-' . ((int)$validateData['filter']['date']['month'] + 1));
        $latest_date_this_month_date = $validateData['filter']['date']['year'] . '-' . $validateData['filter']['date']['month'] . '-' . $latest_date_this_month;
        $first_date_next_month_date = $validateData['filter']['date']['year'] . '-' . ((int)$validateData['filter']['date']['month'] + 1) . '-01';
        $first_date_next_month_date = ResponseFormatter::excelToDate($first_date_next_month_date);
        if (empty($validateData['filter']['arr_filter'])) {
            $validateData['filter']['arr_filter'] = $validateData['filter']['value_checkbox'];
        } else {
            if (empty($validateData['filter']['arr_filter']['company'])) {
                $validateData['filter']['arr_filter']['company'] = $validateData['filter']['value_checkbox']['company'];
            }
            if (empty($validateData['filter']['arr_filter']['site_uuid'])) {
                $validateData['filter']['arr_filter']['site_uuid'] = $validateData['filter']['value_checkbox']['site_uuid'];
            }
        }

        $filter_array = [];
        foreach ($validateData['filter']['arr_filter']['company'] as $item_company) {
            foreach ($validateData['filter']['arr_filter']['site_uuid'] as $item_site_uuid) {
                $filter_array[$item_company . '-' . $item_site_uuid] = ['detail'];
            }
        }

        $employee_this_month = Employee::where('employees.date_start', '<=', $latest_date_this_month_date)
            ->where('employees.date_start', '<=', $first_date_next_month_date)
            ->get();

        $employee_this_month_uuid = [];
        $employee_this_month_machine_uuid = [];
        $filtereee = [];

        foreach ($employee_this_month as $item_employee_this_month) {
            if(!empty($filter_array[$item_employee_this_month->company_uuid . '-' . $item_employee_this_month->site_uuid])){
                $filtereee[] = $item_employee_this_month;
                if (!empty($employee_this_month_uuid[$item_employee_this_month->nik_employee])) {
                    if ($item_employee_this_month->date_start  > $employee_this_month_uuid[$item_employee_this_month->nik_employee]->date_start) {
                        $employee_this_month_uuid[$item_employee_this_month->nik_employee] = $item_employee_this_month;
                        $employee_this_month_machine_uuid[$item_employee_this_month->machine_id] = $item_employee_this_month->nik_employee;
                    }
                } else {
                    $employee_this_month_uuid[$item_employee_this_month->nik_employee] = $item_employee_this_month;
    
                    $employee_this_month_machine_uuid[$item_employee_this_month->machine_id] = $item_employee_this_month->nik_employee;
                }
                $employee_this_month_uuid[$item_employee_this_month->nik_employee]['allowance'] = [
                    'gajih_pokok' => 0,
                    'tunjangan' => 0,
                    'insentif'  => 0
                ];
            }
          
        }
        
        // return ResponseFormatter::toJson($filtereee, $employee_this_month_uuid); 
        //========= SALARIES ======
            $employee_salary_this_month = EmployeeSalary::where('employee_salaries.date_start', '<=', $latest_date_this_month_date)
                ->where('employee_salaries.date_start', '<=', $first_date_next_month_date)
                ->get();
            $user_details = UserDetail::where('date_start', '<=', $latest_date_this_month_date)
            ->where('date_start', '<=', $first_date_next_month_date)
            ->get();
            $data_user_detail = [];
            foreach($user_details as $item_user_details){
                $data_user_detail[$item_user_details->uuid] = $item_user_details;
            }
            // return ResponseFormatter::toJson($data_user_detail, 's');
            $employee_salary_this_month_uuid = [];

            foreach ($employee_salary_this_month as $item_employee_salary_this_month) {
                if(!empty($employee_this_month_uuid[$item_employee_salary_this_month->employee_uuid])){
                    if (!empty($employee_salary_this_month_uuid[$item_employee_salary_this_month->employee_uuid])) {
                        if ($item_employee_salary_this_month->date_start  > $employee_salary_this_month_uuid[$item_employee_salary_this_month->employee_uuid]->date_start) {
                            $employee_salary_this_month_uuid[$item_employee_salary_this_month->employee_uuid] = $item_employee_salary_this_month;
                        }
                    } else {
                        $employee_salary_this_month_uuid[$item_employee_salary_this_month->employee_uuid] = $item_employee_salary_this_month;
                    }
                    $employee_this_month_uuid[$item_employee_salary_this_month->employee_uuid]['salaries'] = $employee_salary_this_month_uuid[$item_employee_salary_this_month->employee_uuid];
                }              
            }
        //========= SALARIES ======
            
        //========= PREMIS ======
            $employee_premis_this_month = EmployeePremi::where('employee_premis.date_start', '<=', $latest_date_this_month_date)
                ->where('employee_premis.date_start', '<=', $first_date_next_month_date)
                ->get();

            $employee_premis = [];
            foreach ($employee_premis_this_month as $item_employee_premis_this_month) {
                if (!empty($employee_this_month_uuid[$item_employee_premis_this_month->employee_uuid])) {
                    if (!empty($employee_premis[$item_employee_premis_this_month->employee_uuid][$item_employee_premis_this_month->premi_uuid])) {
                        if ($item_employee_premis_this_month->date_start  > $employee_premis[$item_employee_premis_this_month->employee_uuid][$item_employee_premis_this_month->premi_uuid]->date_start) {
                            $employee_premis[$item_employee_premis_this_month->employee_uuid][$item_employee_premis_this_month->premi_uuid] = $item_employee_premis_this_month;
                        }
                    } else {
                        $employee_premis[$item_employee_premis_this_month->employee_uuid][$item_employee_premis_this_month->premi_uuid] = $item_employee_premis_this_month;
                    }
                    $employee_this_month_uuid[$item_employee_premis_this_month->employee_uuid]['premies'] = $employee_premis[$item_employee_premis_this_month->employee_uuid];
                }
            }
        //========= PREMIS ======
  
        //========= ABSEN ======
            $absen = $this->countAbsen($employee_this_month_machine_uuid, $validateData['filter']['date']);

        //========= ABSEN ======
      
        $filter_count_payrol = $employee_this_month_uuid;
        $employee_this_month_uuid = [];
        //========= GAJIH POKOK ======
            foreach ($filter_count_payrol as $item_employee_this_month_uuid) {
                if (!empty($absen[$item_employee_this_month_uuid->nik_employee]['count_pay'])) {
                    if ($absen[$item_employee_this_month_uuid->nik_employee]['count_pay'] > 0) {
                        // $employee_this_month_uuid[$item_employee_this_month_uuid->nik_employee] = $item_employee_this_month_uuid;
                        $item_employee_this_month_uuid['allowance'] = [
                            'gajih_pokok'   => [
                                'value' =>  round($absen[$item_employee_this_month_uuid->nik_employee]['count_pay'] * $item_employee_this_month_uuid['salaries']['salary'] / $latest_date_this_month, 3),
                            ],
                            'tunjangan'   => [
                                'value' => round($absen[$item_employee_this_month_uuid->nik_employee]['count_pay'] * $item_employee_this_month_uuid['salaries']['tunjangan'] / $latest_date_this_month, 3)
                            ],
                            'insentif'   => [
                                'value' => round($absen[$item_employee_this_month_uuid->nik_employee]['count_pay'] * $item_employee_this_month_uuid['salaries']['insentif'] / $latest_date_this_month, 3)
                            ]
                        ];
                        
                        $item_employee_this_month_uuid['absensi'] = $absen[$item_employee_this_month_uuid->nik_employee];
                        $employee_this_month_uuid[$item_employee_this_month_uuid->nik_employee] = $item_employee_this_month_uuid;
                    }
                }
            }
        //========= GAJIH POKOK ======
        
        //========= HM ======
            $hour_meter_price = AtributSize::where('size', 'hour_meter_price')->get();
            $hour_meter_price_uuid = [];
            foreach ($hour_meter_price as $item_hour_meter_price) {
                $hour_meter_price_uuid[$item_hour_meter_price->uuid] = $item_hour_meter_price;
            }
            $hour_meter = $this->countHourMeter($validateData['filter']['date']);
            
            
            foreach ($hour_meter as $nik_employe => $item_hour_meter) {
                if (!empty($employee_this_month_uuid[$nik_employe])) {
                    $allowance = $employee_this_month_uuid[$nik_employe]['allowance'];
                    $allowance['hour_meter']['value'] = 0;
                    foreach ($item_hour_meter as $hm_price => $data_hour_meter) {
                        $pay_hour_meter = (float)$data_hour_meter['sum_hm_pay'] * (float)$hour_meter_price_uuid[$hm_price]['value_atribut'];
                        $allowance['hour_meter']['value'] = $allowance['hour_meter']['value'] + $pay_hour_meter;
                        $item_hour_meter[$hm_price]['value_pay'] = $pay_hour_meter;
                       
                    }
                    $allowance['hour_meter']['detail'] = $item_hour_meter;
                    $employee_this_month_uuid[$nik_employe]['allowance'] =  $allowance;
                }
              
            }
        //========= HM ======

        //========= TONASE ======
            $tonase_price = CoalFrom::join('companies', 'companies.uuid', 'coal_froms.company_uuid')->get([
                'companies.*',
                'coal_froms.*',
                'coal_froms.uuid as coal_from_uuid'
            ]);
            $tonase_price_uuid = [];
            foreach ($tonase_price as $item_tonase_price) {
                $tonase_price_uuid[$item_tonase_price->uuid] = $item_tonase_price;
            }
            $tonase = $this->countTonase($validateData['filter']['date']);
            foreach ($tonase as $nik_employe => $item_tonase) {
                if (!empty($employee_this_month_uuid[$nik_employe])) {
                    $allowance = $employee_this_month_uuid[$nik_employe]['allowance'];
                    $allowance['tonase']['value'] = 0;
                    foreach ($item_tonase as $tonase_price => $data_tonase) {
                        $pay_tonase = (float)$data_tonase['sum_tonase_pay'] * (float)$tonase_price_uuid[$tonase_price]['hauling_price'];
                        $allowance['tonase']['value'] = $allowance['tonase']['value'] + $pay_tonase;
                        $item_tonase[$tonase_price]['value_pay'] = $pay_tonase;
                    }
                    $allowance['tonase']['detail'] = $item_tonase;
                    $employee_this_month_uuid[$nik_employe]['allowance'] =  $allowance;
                }
            }
        //========= TONASE ======

        //========= PAYMENT ======
            $payment = $this->countPayment($validateData['filter']['date']);
            foreach ($payment as $nik_employe => $item_payment) {
                if (!empty($employee_this_month_uuid[$nik_employe])) {
                    $allowance = $employee_this_month_uuid[$nik_employe]['allowance'];
                    $allowance['payment']['value'] = 0;
                    foreach ($item_payment as $payment_price => $data_payment) {
                        $pay_payment = (float)$data_payment['sum_payment_pay'];
                        $allowance['payment']['value'] = $allowance['payment']['value'] + $pay_payment;
                    }
                    $allowance['payment']['detail'] = $item_payment;
                    $employee_this_month_uuid[$nik_employe]['allowance'] =  $allowance;
                }
            }
        //========= PAYMENT ======

        //========= PREMI ======
            $premi = $this->countPremi($validateData['filter']['date']);
            foreach ($employee_this_month_uuid as $item_premi_employee_this_month_uuid) {
                if (!empty($item_premi_employee_this_month_uuid['premies'])) {
                    $allowance = $item_premi_employee_this_month_uuid['allowance'];
                    $allowance['premi']['value'] = 0;
                    foreach($data_premis as $item_premis){
                        $pay_this_premi = 0;
                        if(!empty( $premi[$item_premis['uuid']]['value_production'])){
                            if(!empty($item_premi_employee_this_month_uuid['premies'][$item_premis['uuid']])){
                                $pay_this_premi =round( (float)$item_premi_employee_this_month_uuid['premies'][$item_premis['uuid']]['premi_value'] * (float)$premi[$item_premis['uuid']]['value_production']/1000,3);
                            }                            
                        }                       

                        $allowance['premi']['value'] = (float)$allowance['premi']['value'] +  $pay_this_premi;
                        $allowance['premi']['detail'][$item_premis['uuid']] = $pay_this_premi;
                    }
                    // foreach ($item_premi_employee_this_month_uuid['premies'] as $item_employee_premi_production) {
                    //     $pay_this_premi = (float)$item_employee_premi_production['premi_value'] * $premi[$item_employee_premi_production['premi_uuid']]['value_production'];
                    //     $allowance['premi']['value'] = (float)$allowance['premi']['value'] +  $pay_this_premi;
                    //     $allowance['premi']['detail'][$item_employee_premi_production['premi_uuid']] = $pay_this_premi;
                    // }
                    $item_premi_employee_this_month_uuid['allowance'] =  $allowance;
                }
            }
        //========= PREMI ======

        //========= PAYMENT OTHER ======
            $payment_other = $this->countPaymentOther($validateData['filter']['date']);
            foreach ($payment_other as $nik_employe => $item_payment_other) {
                if (!empty($employee_this_month_uuid[$nik_employe])) {
                    $allowance = $employee_this_month_uuid[$nik_employe]['allowance'];
                    $allowance['payment_other']['value'] = 0;
                    foreach ($item_payment_other as $payment_other_price => $data_payment_other) {
                        $pay_payment_other = (float)$data_payment_other['sum_payment_other_pay'];
                        $allowance['payment_other']['value'] = $allowance['payment_other']['value'] + $pay_payment_other;
                    }
                    $allowance['payment_other']['detail'] = $item_payment_other;
                    $employee_this_month_uuid[$nik_employe]['allowance'] =  $allowance;
                }
            }
        //========= PAYMENT OTHER ======

        //========= DEDUCTION DEBT ======
            $employee_payment_debt = $this->countDebt($validateData['filter']['date']);
            foreach ($employee_payment_debt as $nik_emp => $item_employee_payment_debt) {
                if (!empty($employee_this_month_uuid[$nik_emp])) {
                    if (empty($employee_this_month_uuid[$nik_emp]['deduction'])) {
                        $employee_this_month_uuid[$nik_emp]['deduction'] = [
                            'payment_debt' => [
                                'value' => 0
                            ]
                        ];
                    }    
                    $row_data_payment_debt = $employee_this_month_uuid[$nik_emp]['deduction'];
    
                    $row_data_payment_debt['payment_debt']['value'] = $item_employee_payment_debt['sum_payment_debt_pay'];
                    $employee_this_month_uuid[$nik_emp]['deduction'] = $row_data_payment_debt;
                }              
            }
        //========= DEDUCTION DEBT ======
        // return ResponseFormatter::toJson($filtereee, count($employee_this_month_uuid)); 
        //========= PAYMENT DEDUCTION ======
            $employee_deduction = $this->countDeduction($validateData['filter']['date']);
            foreach ($employee_deduction as $nik_employe => $item_deduction_other) {
                if (!empty($employee_this_month_uuid[$nik_employe])) {
                    $allowance = $employee_this_month_uuid[$nik_employe]['deduction'];
                    $allowance['deduction_other']['value'] = 0;
                    foreach ($item_deduction_other as $deduction_other_price => $data_deduction_other) {
                        $pay_deduction_other = (float)$data_deduction_other['sum_deduction_pay'];
                        $allowance['deduction_other']['value'] = $allowance['deduction_other']['value'] + $pay_deduction_other;
                    }
                    $allowance['deduction_other']['detail'] = $item_deduction_other;
                    $employee_this_month_uuid[$nik_employe]['deduction'] =  $allowance;
                }
            }
        //========= PAYMENT DEDUCTION ======

        // return ResponseFormatter::toJson($tonase, $employee_this_month_uuid); 

        //========= PAYROL ======
            foreach ($employee_this_month_uuid as $item_payrol_employee) {
                $gajih_kotor = 0;
                $item_payrol = [
                    'gajih_kotor' => 0,
                    'insentif_produksi' => 0,
                    'insentif_produksi_pph21' => 0,
                ];

                // ---- variable---
                    // $item_payrol['name'] = $item_payrol_employee['name'];
                    $item_payrol['name'] = $data_employees[$item_payrol_employee['nik_employee']]['name'];
                    $item_payrol['nik_employee'] = $item_payrol_employee['nik_employee'];
                    $item_payrol['position'] = $data_employees[$item_payrol_employee['nik_employee']]['position'];
                    $item_payrol['company'] = $data_database['data_company_obj'][$data_employees[$item_payrol_employee['nik_employee']]['company_uuid']]['long_company'];
                    $item_payrol['company_uuid'] = $data_employees[$item_payrol_employee['nik_employee']]['company_uuid'];
                    $item_payrol['site_uuid'] =  $data_employees[$item_payrol_employee['nik_employee']]['site_uuid'];
                    $item_payrol['site'] = $data_database['data_atribut_sizes']['site_uuid'][$item_payrol['site_uuid']]['name_atribut'];
                    $item_payrol['tmk'] = $data_employees[$item_payrol_employee['nik_employee']]['date_document_contract'];
                    $item_payrol['salary_basic'] = $item_payrol_employee['salaries']['salary'];
                    $item_payrol['insentif_basic'] = $item_payrol_employee['salaries']['insentif'];
                    $item_payrol['tunjangan_basic'] = $item_payrol_employee['salaries']['tunjangan'];
                    $item_payrol['tax_status'] = $data_database['data_atribut_sizes']['tax_status'][$item_payrol_employee['tax_status_uuid']]['name_atribut'];
                    $item_payrol['tax_year_value'] = $data_database['data_atribut_sizes']['tax_status'][$item_payrol_employee['tax_status_uuid']]['value_atribut'];
                    $item_payrol['no_bpjs_kesehatan'] = $data_user_detail[$item_payrol_employee['nik_employee']]['bpjs_kesehatan'];
                    $item_payrol['no_bpjs_ketenagakerjaan'] = $data_user_detail[$item_payrol_employee['nik_employee']]['bpjs_ketenagakerjaan'];
                    $item_payrol['salary'] = $item_payrol_employee['salaries']['salary'];
                    $item_payrol['salary'] = $item_payrol_employee['salaries']['salary'];
                    $item_payrol['salary'] = $item_payrol_employee['salaries']['salary'];
                    $item_payrol['salary'] = $item_payrol_employee['salaries']['salary'];
                    $item_payrol['day_month'] = $latest_date_this_month;            
                    $item_payrol['A_absen_count'] = $item_payrol_employee['absensi']['count_alpa'];
                    $item_payrol['cut_absen_count'] = $item_payrol_employee['absensi']['count_cut'];  
                    $item_payrol['count_pay'] = $item_payrol_employee['absensi']['count_pay'];            
                    $item_payrol['count_day_unwork'] = $item_payrol_employee['absensi']['count_cut'] + $item_payrol_employee['absensi']['count_alpa'];
                    foreach($data_premis as $item_premi){
                        $item_payrol['pay_premi_'.$item_premi->uuid] = 0;
                        $item_payrol['PREMI-'.$item_premi->uuid] = 0;
                        if(!empty($item_payrol_employee['allowance']['premi']['detail'][$item_premi->uuid])){
                            $item_payrol['pay_premi_'.$item_premi->uuid] = $item_payrol_employee['allowance']['premi']['detail'][$item_premi->uuid];
                            $item_payrol['PREMI-'.$item_premi->uuid] = $item_payrol_employee['allowance']['premi']['detail'][$item_premi->uuid];
                            $data_database['pay_premies']['pay_premi_'.$item_premi->uuid] = $item_payrol_employee['allowance']['premi']['detail'][$item_premi->uuid];
                        }
                    }
                // ---- variable---
                // ---- gajih_kotor---
                    if (!empty($item_payrol_employee['allowance'])) {
                        foreach ($item_payrol_employee['allowance'] as $index_item_payrol => $item_allowance) {
                            $item_payrol[$index_item_payrol] = $item_allowance['value'];
                            $gajih_kotor = $gajih_kotor + $item_allowance['value'];
                        }
                        $item_payrol['insentif_produksi'] = $gajih_kotor - $item_payrol['gajih_pokok'] -$item_payrol['tunjangan']-$item_payrol['insentif'];
                        $item_payrol['insentif_produksi_pph21'] = round($item_payrol['insentif_produksi'] * 50 / 100,0);
                        if ($item_payrol['insentif_produksi']  < 0) {
                            $item_payrol['insentif_produksi'] = 0;
                            $item_payrol['insentif_produksi_pph21'] = 0;
                        }
                    }

                    if(!empty($item_payrol_employee['allowance']['hour_meter'])){
                        foreach($item_payrol_employee['allowance']['hour_meter']['detail'] as $index_hm=>$item_hour_meter_){
                            
                            $item_payrol['pay_'.$index_hm] =  $item_hour_meter_['value_pay'];                           
                            $item_payrol['hour_'.$index_hm] =  $item_hour_meter_['sum_hm_real'];
                            // return ResponseFormatter::toJson($item_payrol_employee, $item_payrol);
                        }                        
                    }

                    if(!empty($item_payrol_employee['allowance']['tonase'])){
                        foreach($item_payrol_employee['allowance']['tonase']['detail'] as $index_hm=>$item_tonase_){
                            $item_payrol['pay_'.$index_hm] =  $item_tonase_['value_pay'];                           
                            $item_payrol['much_'.$index_hm] =  $item_tonase_['sum_tonase_pay'];
                            // return ResponseFormatter::toJson($item_payrol_employee, $item_payrol);
                        }                        
                    }

                    $item_payrol['gajih_kotor'] = $gajih_kotor;
                // ---- gajih_kotor---


                // ---- deduction---
                    $deduction = 0;
                    if (!empty($item_payrol_employee['deduction'])) {
                        foreach ($item_payrol_employee['deduction'] as $index_item_payrol_deduction => $item_deduction) {
                            $item_payrol[$index_item_payrol_deduction] = $item_deduction['value'];
                        }
                    }
                // ---- deduction---

                // ---- potongan---
                //-is_bpjs_ketenagakerjaan-
                    $item_payrol['bpjs_ketenagakerjaan'] = 0;
                    $item_payrol['JKK'] = 0;
                    $item_payrol['JK'] = 0;
                    $item_payrol['kesehatan'] = 0;
                    if (!empty($item_payrol_employee['is_bpjs_ketenagakerjaan'])) {
                        if ($item_payrol_employee['is_bpjs_ketenagakerjaan'] == 'Ya') {
                            $item_payrol['bpjs_ketenagakerjaan'] = round($database_payrol['percent_bpjs_ketenagakerjaan'] *  $item_payrol_employee['salaries']['salary'] / 100, 0);
                            $item_payrol['JKK'] = round($database_payrol['percent_JKK'] * $item_payrol['bpjs_ketenagakerjaan'] * 50 / 100, 0);
                            $item_payrol['JK'] =  round($database_payrol['percent_JK'] * $item_payrol['bpjs_ketenagakerjaan'] * 50 / 100, 0);
                            $item_payrol['kesehatan'] =  round($database_payrol['percent_kesehatan'] * $item_payrol['bpjs_ketenagakerjaan'] * 50 / 100, 0);
                            $item_payrol['JHT'] = round($database_payrol['percent_JHT'] *  $item_payrol_employee['salaries']['salary'] / 100, 0);
                            $item_payrol['iuran_pensiun'] = round($database_payrol['percent_iuran_pensiun'] *  $item_payrol_employee['salaries']['salary'] / 100, 0);
                    
                        }
                    }
                //-is_bpjs_ketenagakerjaan-
                //  --------------------------------------
                //-bpjs_kesehatan-
                    $item_payrol['bpjs_kesehatan'] = 0;
                    if (!empty($item_payrol_employee['is_bpjs_kesehatan'])) {
                        if ($item_payrol_employee['is_bpjs_kesehatan'] == 'Ya') {
                            $item_payrol['bpjs_kesehatan'] = round($database_payrol['percent_bpjs_kesehatan'] *  $item_payrol_employee['salaries']['salary'] / 100, 0);
                        }
                    }
                //-bpjs_kesehatan-
                //  --------------------------------------
                //-bpjs_pensiun-
                    $item_payrol['bpjs_pensiun'] = 0;
                    if (!empty($item_payrol_employee['is_bpjs_pensiun'])) {
                        if ($item_payrol_employee['is_bpjs_pensiun'] == 'Ya') {
                            $item_payrol['bpjs_pensiun'] = round($database_payrol['percent_bpjs_pensiun'] *  $item_payrol_employee['salaries']['salary'] / 100, 0);
                        }
                    }
                //-bpjs_pensiun-

                //-brutto_this_month-
                    $item_payrol['brutto_this_month'] = 0;
                    $brutto_this_month = 0;
                    foreach ($database_payrol['item_brutto_this_month'] as $item_brutto) {
                        if (!empty($item_payrol[$item_brutto])) {
                            $brutto_this_month = $brutto_this_month + $item_payrol[$item_brutto];
                        }
                    }
                    $item_payrol['brutto_this_month'] = $brutto_this_month;
                    $item_payrol['biaya_jabatan'] = round($item_payrol['brutto_this_month'] * $database_payrol['percent_jabatan']/100, 0);
                    if ($item_payrol['biaya_jabatan'] >= (int)$database_payrol['max_biaya_jabatan']) {
                        $item_payrol['biaya_jabatan'] = (int)$database_payrol['max_biaya_jabatan'];
                    }
                //-brutto_this_month-

                //-pengurang_pkp
                    $pengurang_pkp_this_month = 0;
                    $item_payrol['pengurang_pkp_this_month'] = $pengurang_pkp_this_month;
                    foreach ($database_payrol['item_pengurang_pkp'] as $item_pengurang_pkp) {
                        if (!empty($item_payrol[$item_pengurang_pkp])) {
                            $pengurang_pkp_this_month = $pengurang_pkp_this_month + $item_payrol[$item_pengurang_pkp];
                        }
                    }
                    $item_payrol['pengurang_pkp_this_month'] = $pengurang_pkp_this_month;
                //-pengurang_pkp

                //-netto
                    $item_payrol['netto_this_month_pph21'] = $item_payrol['brutto_this_month'] -  $item_payrol['pengurang_pkp_this_month'];
                    if (empty($item_payrol['payment_other'])) {
                        $item_payrol['payment_other'] = 0;
                    }
                    $item_payrol['netto_this_year'] = ($item_payrol['netto_this_month_pph21'] * 12) - ($item_payrol['payment_other'] * 12);
                //-netto

                //-ptkp
                    $item_payrol['pkp_this_year'] =  $item_payrol['netto_this_year'] - (int)$database_payrol['tax_status'][$item_payrol_employee['tax_status_uuid']];
                    if ($item_payrol['pkp_this_year'] < 0) {
                        $item_payrol['pkp_this_year'] = 0;
                    }
                //-ptkp

                //-pph21
                    $item_payrol['pph21'] =  round($item_payrol['pkp_this_year'] * $database_payrol['percent_pph21'] / 12 / 100,0);
                //-pph21        
                //------------------       
                //-cut_loan
                    if ($item_payrol['count_day_unwork'] > 0) {
                        $hasil_sebelum = 0;
                        $hasil_grup = 0;

                        //$dataaaa = [];
                        foreach ($formulas as $fml) {
                            $hasil_sebelum = 0;
                            $hasil_grup = 0;
                            //$dataaaa['uuid'] = $fml->uuid;
                            $izin = ($fml->uuid == 'IZIN') ? true : false;
                            $alpa = ($fml->uuid == 'ALPA') ? true : false;

                            $day_alpa = ((int)$item_payrol['A_absen_count'] > 0) ? true : false;
                            $day_izin = ((int)$item_payrol['cut_absen_count'] > 0) ? true : false;
                            if ($izin == $day_izin) {
                                $is_formula = true;
                            } elseif ($alpa == $day_alpa) {
                                $is_formula = true;
                            } else {
                                $is_formula = false;
                            }
                            
                            if ($is_formula == true) {
                                foreach ($fml->group_formula as $g_fml) {
                                    if ($g_fml->group_formula_order == 1) {
                                        foreach ($g_fml->variable_counts as $variable_count_formula) {
                                            $nama_col =  $variable_count_formula->variable_code;
                                            $symbol = $variable_count_formula->symbol_count;
                                            if ($variable_count_formula->order_number == 1) {
                                                $hasil_sebelum = $item_payrol[$nama_col];
                                            } else {
                                                if ($variable_count_formula->variable_uuid == 'NILAI') {
                                                    $hasil_sebelum = AllowanceController::Maths($hasil_sebelum,  $variable_count_formula->value_value_variable, $symbol);
                                                } else {
                                                    $hasil_sebelum = AllowanceController::Maths($hasil_sebelum,  $item_payrol[$nama_col], $symbol);
                                                }
                                            }
                                        }
                                    } else {
                                        $hasil_grup = $hasil_sebelum;
                                        foreach ($g_fml->variable_counts as $variable_count_formula) {
                                            $nama_col =  $variable_count_formula->variable_code;
                                            $symbol = $variable_count_formula->symbol_count;
                                            if ($variable_count_formula->order_number == 1) {
                                                $hasil_sebelum = $item_payrol[$nama_col];
                                            } else {
                                                if ($variable_count_formula->variable_uuid == 'NILAI') {
                                                    $hasil_sebelum = AllowanceController::Maths($hasil_sebelum,  $variable_count_formula->value_value_variable, $symbol);
                                                } else {
                                                    $hasil_sebelum = AllowanceController::Maths($hasil_sebelum,  $item_payrol[$nama_col], $symbol);
                                                }
                                            }
                                        }
                                        $symbol = $g_fml->group_formula_symbol;
                                        $hasil_sebelum = AllowanceController::Maths($hasil_grup,  $hasil_sebelum, $symbol);
                                    }                                    
                                    // return ResponseFormatter::toJson($hasil_sebelum, 'true');
                                }
                            }
                            
                            // return ResponseFormatter::toJson($izin, 'else');

                            if ($fml->uuid == 'IZIN') {
                                $item_payrol['cut_absen_loan'] =  round($hasil_sebelum,0);
                            } else {
                                $item_payrol['cut_alpa_loan'] =  round($hasil_sebelum,0);
                            }
                        }
                    }
                //-cut_loan
                    
                $pengurang_pendapatan= 0;
                foreach($database_payrol['item_pengurang_pendapatan'] as $item_pengurang_pendapatan){
                    
                    if(!empty($item_payrol[$item_pengurang_pendapatan])){                       
                        $pengurang_pendapatan = $pengurang_pendapatan + $item_payrol[$item_pengurang_pendapatan];
                    }
                }
                // return ResponseFormatter::toJson($item_payrol[$item_pengurang_pendapatan], $item_pengurang_pendapatan);
                $item_payrol['pengurang_pendapatan'] = $pengurang_pendapatan;

                $item_payrol['gajih_bersih_full'] = $item_payrol['gajih_kotor'] - $item_payrol['pengurang_pendapatan'] ;

                $pembulat = round($item_payrol['gajih_bersih_full'] /1000,0);
                $item_payrol['gajih_bersih'] = $pembulat * 1000;
                $item_payrol['pembulatan'] = round($item_payrol['gajih_bersih_full'] - $item_payrol['gajih_bersih'],0);
                if((float)$item_payrol['pembulatan'] >0){
                    $item_payrol['pembulatan'] = '+'.$item_payrol['pembulatan'];
                }
                
                $item_payrol_employee['item_payrol'] = $item_payrol;
                // ---- potongan---
            }

        //========= PAYROL ======





        $data = [
            // 'employee_this_month' => $employee_this_month,
            // 'hour_meter' => $hour_meter,
            // 'employee_premis_this_month' => $employee_premis,
            'employee_this_month_uuid' => $employee_this_month_uuid,
            // 'first_date_next_month_date' => $first_date_next_month_date,
            // 'employee_this_month_machine_uuid' => $employee_this_month_machine_uuid,
            // 'absen' => $absen,
            // 'tonase'    => $tonase,            
            // 'premi'    => $premi,            
            // 'payment'    => $payment,

            // 'paymentOther'    => $payment_other,
            'item_payrol' => $item_payrol,
            // 'employee_deduction'    => $employee_deduction,
            'database_payrol'    => $database_payrol,   
            'request'   => $validateData
        ];


        return ResponseFormatter::toJson($data, 'count-payrol');
    }

    public static function countAbsen($employee_data, $date)
    {
        //employee_uuid = machine_id
        // $latest_day_month = ResponseFormatter::getEndDay($date['year'].'-'.$date['month']);
        $employee_absen = EmployeeAbsen::join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
            ->whereYear('date', $date['year'])
            ->whereMonth('date', $date['month'])
            ->get([
                'status_absens.*',
                'employee_absens.*'
            ]);
        $data_absen_uuid = [];
        foreach ($employee_absen as $item_employee_absen) {
            $data_absen_uuid[$item_employee_absen->nik_employee] = $item_employee_absen;
        }
        $status_absens = StatusAbsen::all();

        $data_absen = [];

        foreach ($employee_data as $item_employee_data) {
            $data_absen_x = [];
            foreach ($status_absens as $item_status_absens) {
                $data_absen_x['count_' . $item_status_absens->math] = 0;
                $data_absen_x['count_' . $item_status_absens->uuid] = 0;
            }
            $data_absen[$item_employee_data] = $data_absen_x;
        }


        foreach ($employee_absen as $item_employee_absen) {
            if (!empty($employee_data[$item_employee_absen->employee_uuid])) {
                if (empty($data_absen[$employee_data[$item_employee_absen->employee_uuid]]['data'])) {
                    foreach ($status_absens as $item_status_absens) {
                        $data_absen[$employee_data[$item_employee_absen->employee_uuid]]['count_' . $item_status_absens->math] = 0;
                        $data_absen[$employee_data[$item_employee_absen->employee_uuid]]['count_' . $item_status_absens->uuid] = 0;
                    }
                }
                $data_absen[$employee_data[$item_employee_absen->employee_uuid]]['count_' . $item_employee_absen->math]++;
                $data_absen[$employee_data[$item_employee_absen->employee_uuid]]['count_' . $item_employee_absen->status_absen_uuid]++;
                $data_absen[$employee_data[$item_employee_absen->employee_uuid]]['data'][$item_employee_absen->date] = $item_employee_absen;
            }
        }
        return $data_absen;
    }

    public static function countHourMeter($date)
    {
        $employee_hour_meter = EmployeeHourMeterDay::whereYear('date', $date['year'])
            ->whereMonth('date', $date['month'])
            ->get();
        $data_formula_bonus_hm = EmployeeHourMeterBonus::orderBy('min_hm', 'asc')->get();
        //hm bonus belum




        $data_employee_hour_meter = [];
        foreach ($employee_hour_meter as $item_employee_hour_meter) {
            if (!empty($item_employee_hour_meter['is_bonus'])) {
                $item_employee_hour_meter['full_value'] =  $item_employee_hour_meter->value;
                foreach ($data_formula_bonus_hm as $item_bonus_hm) {
                    if ($item_employee_hour_meter['value'] >= $item_bonus_hm->min_hm) {
                        $item_employee_hour_meter['full_value'] = $item_employee_hour_meter['value'] + ($item_employee_hour_meter['value'] * $item_bonus_hm->percent_hm / 100);
                    }
                }
                $sum_hm_pay = $item_employee_hour_meter['full_value'];
            } else {
                $sum_hm_pay =  $item_employee_hour_meter->value;
            }

            if (empty($data_employee_hour_meter[$item_employee_hour_meter->employee_uuid][$item_employee_hour_meter->hour_meter_price_uuid]['sum_hm_real'])) {
                $data_employee_hour_meter[$item_employee_hour_meter->employee_uuid][$item_employee_hour_meter->hour_meter_price_uuid]['sum_hm_real'] = 0;
                $data_employee_hour_meter[$item_employee_hour_meter->employee_uuid][$item_employee_hour_meter->hour_meter_price_uuid]['sum_hm_pay'] = 0;
            }
            $data_employee_hour_meter[$item_employee_hour_meter->employee_uuid][$item_employee_hour_meter->hour_meter_price_uuid]['sum_hm_real'] =  $data_employee_hour_meter[$item_employee_hour_meter->employee_uuid][$item_employee_hour_meter->hour_meter_price_uuid]['sum_hm_real'] + $item_employee_hour_meter->value;
            $data_employee_hour_meter[$item_employee_hour_meter->employee_uuid][$item_employee_hour_meter->hour_meter_price_uuid]['sum_hm_pay'] = $data_employee_hour_meter[$item_employee_hour_meter->employee_uuid][$item_employee_hour_meter->hour_meter_price_uuid]['sum_hm_pay'] + $sum_hm_pay;
        }

        return $data_employee_hour_meter;
    }

    public static function countTonase($date)
    {
        $employee_tonase = EmployeeTonase::whereYear('date', $date['year'])
            ->whereMonth('date', $date['month'])
            ->get();

        //hm bonus belum



        $data_employee_tonase = [];
        foreach ($employee_tonase as $item_employee_tonase) {
            if (!empty($item_employee_tonase->is_bonus)) {
                $sum_tonase_pay =  $item_employee_tonase->tonase_value;
            } else {
                $sum_tonase_pay =  $item_employee_tonase->tonase_value;
            }

            if (empty($data_employee_tonase[$item_employee_tonase->employee_uuid][$item_employee_tonase->coal_from_uuid]['sum_tonase_real'])) {
                $data_employee_tonase[$item_employee_tonase->employee_uuid][$item_employee_tonase->coal_from_uuid]['sum_tonase_real'] = 0;
                $data_employee_tonase[$item_employee_tonase->employee_uuid][$item_employee_tonase->coal_from_uuid]['sum_tonase_pay'] = 0;
            }
            $data_employee_tonase[$item_employee_tonase->employee_uuid][$item_employee_tonase->coal_from_uuid]['sum_tonase_real'] =  $data_employee_tonase[$item_employee_tonase->employee_uuid][$item_employee_tonase->coal_from_uuid]['sum_tonase_real'] + $item_employee_tonase->tonase_value;
            $data_employee_tonase[$item_employee_tonase->employee_uuid][$item_employee_tonase->coal_from_uuid]['sum_tonase_pay'] = $data_employee_tonase[$item_employee_tonase->employee_uuid][$item_employee_tonase->coal_from_uuid]['sum_tonase_pay'] + $sum_tonase_pay;
        }

        return $data_employee_tonase;
    }

    public static function countPayment($date)
    {
        $employee_payment = EmployeePayment::join('payments', 'payments.uuid', 'employee_payments.payment_uuid')
            ->whereYear('payments.date', $date['year'])
            ->whereMonth('payments.date', $date['month'])
            ->get();
        $data_employee_payment = [];
        foreach ($employee_payment as $item_employee_payment) {
            if (empty($data_employee_payment[$item_employee_payment->employee_uuid][$item_employee_payment->payment_group_uuid]['sum_payment_pay'])) {
                $data_employee_payment[$item_employee_payment->employee_uuid][$item_employee_payment->payment_group_uuid]['sum_payment_pay'] = 0;
                $data_employee_payment[$item_employee_payment->employee_uuid][$item_employee_payment->payment_group_uuid]['count_payment_pay'] = 0;
            }
            $data_employee_payment[$item_employee_payment->employee_uuid][$item_employee_payment->payment_group_uuid]['count_payment_pay']++;
            $data_employee_payment[$item_employee_payment->employee_uuid][$item_employee_payment->payment_group_uuid]['sum_payment_pay'] = $data_employee_payment[$item_employee_payment->employee_uuid][$item_employee_payment->payment_group_uuid]['sum_payment_pay'] + (float)$item_employee_payment->value;
        }

        return  $data_employee_payment;
    }

    public static function countPremi($date)
    {
        $employee_premi = Production::whereYear('date_production', $date['year'])
            ->whereMonth('date_production', $date['month'])
            ->get();

        $data_production = [];
        $data_premis = Premi::all();
        // foreach($data_premis as $item_premis){
        //     $data_production[$item_premis->uuid] = 0;
        // }

        foreach ($employee_premi as $item_employee_premi) {
            $data_production[$item_employee_premi->premi_uuid] = $item_employee_premi;
        }
        return $data_production;
    }

    public static function countPaymentOther($date)
    {
        $employee_payment_other = EmployeePaymentOther::whereYear('payment_other_date', $date['year'])
            ->whereMonth('payment_other_date', $date['month'])
            ->get();
        $data_employee_payment = [];

        foreach ($employee_payment_other as $item_employee_payment_other) {
            if (empty($data_employee_payment[$item_employee_payment_other->employee_uuid][$item_employee_payment_other->payment_other_uuid]['sum_payment_other_pay'])) {
                $data_employee_payment[$item_employee_payment_other->employee_uuid][$item_employee_payment_other->payment_other_uuid]['sum_payment_other_pay'] = 0;
                $data_employee_payment[$item_employee_payment_other->employee_uuid][$item_employee_payment_other->payment_other_uuid]['count_payment_other_pay'] = 0;
            }
            $pay_this_payment_other = (float)$item_employee_payment_other->payment_other_value * (float)$item_employee_payment_other->payment_other_much;
            $data_employee_payment[$item_employee_payment_other->employee_uuid][$item_employee_payment_other->payment_other_uuid]['count_payment_other_pay']++;
            $data_employee_payment[$item_employee_payment_other->employee_uuid][$item_employee_payment_other->payment_other_uuid]['sum_payment_other_pay'] = $data_employee_payment[$item_employee_payment_other->employee_uuid][$item_employee_payment_other->payment_other_uuid]['sum_payment_other_pay'] + $pay_this_payment_other;
        }
        return $data_employee_payment;
    }

    public static function countDebt($date)
    {
        $employee_payment_debt = EmployeePaymentDebt::whereYear('date_payment_debt', $date['year'])
            ->whereMonth('date_payment_debt', $date['month'])
            ->get();

        $data_employee_payment_debt = [];
        foreach ($employee_payment_debt as $item_data_employee_payment_debt) {
            if (empty($data_employee_payment_debt[$item_data_employee_payment_debt->employee_uuid]['sum_payment_debt_pay'])) {
                $data_employee_payment_debt[$item_data_employee_payment_debt->employee_uuid]['sum_payment_debt_pay'] = 0;
            }
            $data_employee_payment_debt[$item_data_employee_payment_debt->employee_uuid]['sum_payment_debt_pay'] = (float)$data_employee_payment_debt[$item_data_employee_payment_debt->employee_uuid]['sum_payment_debt_pay'] + (float)$item_data_employee_payment_debt->value_payment_debt;
        }
        return $data_employee_payment_debt;
    }

    public static function countDeduction($date)
    {
        $employee_deduction = EmployeeDeduction::whereYear('date_employee_deduction', $date['year'])
            ->whereMonth('date_employee_deduction', $date['month'])
            ->get();

        $data_employee_payment = [];

        foreach ($employee_deduction as $item_employee_deduction) {
            if (empty($data_employee_payment[$item_employee_deduction->employee_uuid][$item_employee_deduction->group_deduction_uuid]['sum_deduction_pay'])) {
                $data_employee_payment[$item_employee_deduction->employee_uuid][$item_employee_deduction->group_deduction_uuid]['sum_deduction_pay'] = 0;
                $data_employee_payment[$item_employee_deduction->employee_uuid][$item_employee_deduction->group_deduction_uuid]['count_deduction_pay'] = 0;
            }
            $pay_this_deduction = (float)$item_employee_deduction->value_employee_deduction;
            $data_employee_payment[$item_employee_deduction->employee_uuid][$item_employee_deduction->group_deduction_uuid]['count_deduction_pay']++;
            $data_employee_payment[$item_employee_deduction->employee_uuid][$item_employee_deduction->group_deduction_uuid]['sum_deduction_pay'] = $data_employee_payment[$item_employee_deduction->employee_uuid][$item_employee_deduction->group_deduction_uuid]['sum_deduction_pay'] + $pay_this_deduction;
        }
        return $data_employee_payment;
    }


    public function indexPayrol($year_month)
    {
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $employees = Identity::join('employees', 'employees.uuid', 'identities.employee_uuid')
            ->leftJoin('employee_absen_totals', 'employee_absen_totals.nik_employee', 'employees.nik_employee')
            ->where('employee_absen_totals.year_month', $year . '-' . $month)
            ->get([
                'identities.id',
                'identities.name',
                // 'employees.nik_employee',
                'employees.date_start_contract',
                // 'employee_absen_totals.pay',
                // 'employee_absen_totals.*',
                // 'employees.*',

                'employees.uuid as employee_uuid',
                'employees.file_path as hm',
            ]);


        $employee_hm =  Identity::join('employees', 'employees.uuid', 'identities.employee_uuid')
            ->leftJoin('employee_hour_meter_days', 'employee_hour_meter_days.employee_uuid', 'employees.uuid')
            ->whereYear('employee_hour_meter_days.date', $year)
            ->whereMonth('employee_hour_meter_days.date', $month)
            ->groupBy(
                'identities.id',
                'identities.name',
                'employee_hour_meter_days.employee_uuid',

            )
            ->select(
                'identities.id',
                'identities.name',
                'employee_hour_meter_days.employee_uuid',
                DB::raw("SUM(employee_hour_meter_days.value) as hour_meter_value"),

            )
            ->get();

        $hms = array();
        foreach ($employee_hm as $hm) {
            $hms[$hm->employee_uuid] = $hm;
        }


        // dd($hms['MBLE-0219120106']->hour_meter_value);

        return view('datatableshow', ['data'         => $hms]);

        return $year;
    }

    public static function AveragePosition($year_month)
    {
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
    }

    public static function Maths($data_1 = 0, $data_2 = 0, $symbol_math)
    {
        if ($symbol_math == '-') {
            return $data_1 - $data_2;
        }
        if ($symbol_math == '+') {
            return $data_1 + $data_2;
        }
        if ($symbol_math == '/') {
            return $data_1 / $data_2;
        }
        if ($symbol_math == 'x') {
            return $data_1 * $data_2;
        }
    }
}
