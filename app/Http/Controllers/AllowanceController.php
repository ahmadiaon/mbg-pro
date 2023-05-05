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
        $companies = Company::join('coal_froms', 'coal_froms.company_uuid', 'companies.uuid')
            ->get([
                'coal_froms.*'
            ]);

        $premis = Premi::all();


        // dd($premis);

        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => false,
            'active'                        => 'employee-allowance'
        ];
        return view('allowance.index', [
            'title'         => 'Pendapatan Karyawan',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'hour_meter_prices'        => HourMeterPrice::all(),
            'layout'    => $layout,
            'companies' => $companies,
            'premis'    => $premis
        ]);
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
            'item_brutto_this_month' => [
                'gajih_pokok',
                'insentif',
                'tunjangan',
                'JKK',
                'JK',
                'kesehatan',
                'insentif_produksi_pph21',
                'payment_other',
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
            // 'percent_bpjs_ketenagakerjaan' => 2,
        ];
        $item_pajak = [];
        foreach ($data_database['data_atribut_sizes']['tax_status'] as $item_db_pajak) {
            $item_pajak[$item_db_pajak->uuid] = $item_db_pajak->value_atribut;
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


        foreach ($employee_this_month as $item_employee_this_month) {
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

        //========= SALARIES ======
            $employee_salary_this_month = EmployeeSalary::where('employee_salaries.date_start', '<=', $latest_date_this_month_date)
                ->where('employee_salaries.date_start', '<=', $first_date_next_month_date)
                ->get();
            // return ResponseFormatter::toJson($employee_this_month_uuid, 's');
            $employee_salary_this_month_uuid = [];

            foreach ($employee_salary_this_month as $item_employee_salary_this_month) {
                if (!empty($employee_salary_this_month_uuid[$item_employee_salary_this_month->employee_uuid])) {
                    if ($item_employee_salary_this_month->date_start  > $employee_salary_this_month_uuid[$item_employee_salary_this_month->employee_uuid]->date_start) {
                        $employee_salary_this_month_uuid[$item_employee_salary_this_month->employee_uuid] = $item_employee_salary_this_month;
                    }
                } else {
                    $employee_salary_this_month_uuid[$item_employee_salary_this_month->employee_uuid] = $item_employee_salary_this_month;
                }
                $employee_this_month_uuid[$item_employee_salary_this_month->employee_uuid]['salaries'] = $employee_salary_this_month_uuid[$item_employee_salary_this_month->employee_uuid];
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

        //========= GAJIH POKOK ======
            foreach ($employee_this_month_uuid as $item_employee_this_month_uuid) {
                if (!empty($absen[$item_employee_this_month_uuid->nik_employee])) {
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
                $allowance = $employee_this_month_uuid[$nik_employe]['allowance'];
                $allowance['hour_meter']['value'] = 0;
                foreach ($item_hour_meter as $hm_price => $data_hour_meter) {
                    $pay_hour_meter = (float)$data_hour_meter['sum_hm_pay'] * (float)$hour_meter_price_uuid[$hm_price]['value_atribut'];
                    $allowance['hour_meter']['value'] = $allowance['hour_meter']['value'] + $pay_hour_meter;
                }
                $allowance['hour_meter']['detail'] = $item_hour_meter;
                $employee_this_month_uuid[$nik_employe]['allowance'] =  $allowance;
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
                    foreach ($item_premi_employee_this_month_uuid['premies'] as $item_employee_premi_production) {
                        $pay_this_premi = (float)$item_employee_premi_production['premi_value'] * $premi[$item_employee_premi_production['premi_uuid']]['value_production'];
                        $allowance['premi']['value'] = (float)$allowance['premi']['value'] +  $pay_this_premi;
                        $allowance['premi']['detail'][$item_employee_premi_production['premi_uuid']] = $pay_this_premi;
                    }
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
                if (!empty($employee_this_month_uuid[$nik_emp]['deduction'])) {
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
        //========= DEDUCTION DEBT ======

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



        //========= PAYROL ======
            foreach ($employee_this_month_uuid as $item_payrol_employee) {
                $gajih_kotor = 0;
                $item_payrol = [
                    'gajih_kotor' => 0,
                    'insentif_produksi' => 0,
                    'insentif_produksi_pph21' => 0,
                ];

                // ---- variable---
                    $item_payrol['salary'] = $item_payrol_employee['salaries']['salary'];
                    $item_payrol['day_month'] = $latest_date_this_month;            
                    $item_payrol['A_absen_count'] = $item_payrol_employee['absensi']['count_alpa'];
                    $item_payrol['cut_absen_count'] = $item_payrol_employee['absensi']['count_cut'];            
                    $item_payrol['count_day_unwork'] = $item_payrol_employee['absensi']['count_cut'] + $item_payrol_employee['absensi']['count_alpa'];
                    foreach($data_premis as $item_premi){
                        $item_payrol['pay_premi_'.$item_premi->uuid] = 0;
                        $item_payrol['PREMI-'.$item_premi->uuid] = 0;
                        if(!empty($item_payrol_employee['allowance']['premi']['detail'][$item_premi->uuid])){
                            $item_payrol['pay_premi_'.$item_premi->uuid] = $item_payrol_employee['allowance']['premi']['detail'][$item_premi->uuid];
                            $item_payrol['PREMI-'.$item_premi->uuid] = $item_payrol_employee['allowance']['premi']['detail'][$item_premi->uuid];
                        }
                    }
                // ---- variable---
                // ---- gajih_kotor---
                    if (!empty($item_payrol_employee['allowance'])) {
                        foreach ($item_payrol_employee['allowance'] as $index_item_payrol => $item_allowance) {
                            $item_payrol[$index_item_payrol] = $item_allowance['value'];
                            $gajih_kotor = $gajih_kotor + $item_allowance['value'];
                        }
                        $item_payrol['insentif_produksi'] = $gajih_kotor - $item_payrol['gajih_pokok'];
                        $item_payrol['insentif_produksi_pph21'] = $item_payrol['insentif_produksi'] * 50 / 100;
                        if ($item_payrol['insentif_produksi']  < 0) {
                            $item_payrol['insentif_produksi'] = 0;
                            $item_payrol['insentif_produksi_pph21'] = 0;
                        }
                        $item_payrol['JHT'] = round($database_payrol['percent_JHT'] *  $item_payrol_employee['salaries']['salary'] / 100, 0);
                        $item_payrol['iuran_pensiun'] = round($database_payrol['percent_iuran_pensiun'] *  $item_payrol_employee['salaries']['salary'] / 100, 0);
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
                    $item_payrol['biaya_jabatan'] = round($item_payrol['brutto_this_month'] * $database_payrol['percent_jabatan'], 0);
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
                    $item_payrol['pph21'] =  $item_payrol['pkp_this_year'] * $database_payrol['percent_pph21'] / 12 / 100;
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

            'paymentOther'    => $payment_other,
            'database_payrol' => $database_payrol,
            'employee_deduction'    => $employee_deduction,
            // 'employee_payment_debt'    => $employee_payment_debt,   
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

        //hm bonus belum



        $data_employee_hour_meter = [];
        foreach ($employee_hour_meter as $item_employee_hour_meter) {
            if (!empty($item_employee_hour_meter->is_bonus)) {
                $sum_hm_pay =  $item_employee_hour_meter->value;
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

    public function anyData(Request $request)
    {
        $date = explode("-", $request->year_month);
        $year = $date[0];
        $month = $date[1];

        $hour_meter_prices = HourMeterPrice::all();

        $data_hm = [];

        foreach ($hour_meter_prices as $item) {
            $employee_hm =  Identity::join('employees', 'employees.uuid', 'identities.employee_uuid')
                ->leftJoin('employee_hour_meter_days', 'employee_hour_meter_days.employee_uuid', 'employees.uuid')
                ->where('hour_meter_price_uuid', $item->uuid)
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
                    DB::raw("SUM(employee_hour_meter_days.value) as hour_meter_value")
                )
                ->get();

            $data = $employee_hm->keyBy(function ($item) {
                return strval($item->employee_uuid);
            });

            $data_hm[$item->uuid] = $data;
        }

        // return ResponseFormatter::getEndDay($year_month);

        $employees = Identity::join('employees', 'employees.uuid', 'identities.employee_uuid')
            ->leftJoin('employee_absen_totals', 'employee_absen_totals.nik_employee', 'employees.nik_employee')
            ->leftJoin('employee_salaries', 'employee_salaries.employee_uuid', 'employees.uuid')
            ->where('employee_absen_totals.year_month', $year . '-' . $month)
            ->get([
                'identities.*',
                'employees.nik_employee',
                'employees.date_start_contract',
                'employee_absen_totals.pay',
                'employee_absen_totals.*',
                'employees.*',
                'employee_salaries.salary'
            ]);

        $data = [];
        foreach ($employees as $employee) {
            foreach ($hour_meter_prices as $item) {
                $name = $item->uuid;
                if (empty($data_hm[$item->uuid][$employee->uuid]->hour_meter_value)) {
                    $employee->$name = null;
                } else {
                    $employee->$name = $data_hm[$item->uuid][$employee->uuid]->hour_meter_value;
                }
            }
            $data[] = $employee;
        }

        // return view('datatableshow', [ 'data'         => $data]);

        return Datatables::of($employees)
            ->make(true);
    }

    public static function AveragePosition($year_month)
    {
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
    }

    // public function moreAnyData($year_month){
    //     $date = explode("-", $year_month);
    //     $day_month = ResponseFormatter::getEndDay($year_month);
    public function moreAnyData(Request $request)
    {
        $date = explode("-", $request->year_month);
        $year_month = $request->year_month;
        $day_month = ResponseFormatter::getEndDay($year_month);


        $date_day_month_end = $year_month . '-' . $day_month;
        $arr_setup_employee = [];

        $arr_position = Position::all();
        $arr_position = ResponseFormatter::createIndexArray($arr_position, 'uuid');

        $arr_department = Department::all();
        $arr_department = ResponseFormatter::createIndexArray($arr_department, 'uuid');

        $arr_company = Company::all();
        $arr_company = ResponseFormatter::createIndexArray($arr_company, 'uuid');
        $arr_coal_from = CoalFrom::all();
        $arr_coal_from = ResponseFormatter::createIndexArray($arr_coal_from, 'uuid');

        $arr_user_detail = UserDetail::where('date_start', '<=', $date_day_month_end)->orderBy('date_end', 'desc')
            ->get();
        $arr_setup_user_detail = [];

        foreach ($arr_user_detail as $user_detail) {
            if (empty($arr_setup_user_detail[$user_detail->uuid])) {
                $arr_setup_user_detail[$user_detail->uuid] = $user_detail;
            }
        }
        // return view('datatableshow', [ 'data'         => $arr_setup_user_detail]);

        $arr_employee = Employee::where('date_start', '<=', $date_day_month_end)
            ->whereNotNull('tax_status_uuid')->orderBy('date_end', 'desc')
            ->get();

        $arr_employee_for_absen = ResponseFormatter::createIndexArray($arr_employee, 'machine_id');
        // dd($arr_employee_for_absen);

        //setup employee
        foreach ($arr_employee as $employee) {
            $employee->company = null;
            $employee->name = null;
            $employee->employee_uuid = $employee->uuid;

            $employee->date_start_join = $employee->date_document_contract;

            if (empty($arr_setup_employee[$employee->nik_employee])) {
                if (!empty($employee->position_uuid)) {
                    $employee->position = $arr_position[$employee->position_uuid]->position;
                }
                if (!empty($employee->department_uuid)) {
                    $employee->department = $arr_department[$employee->department_uuid]->department;
                }
                if (!empty($arr_setup_user_detail[$employee->user_detail_uuid])) {
                    $employee->name = $arr_setup_user_detail[$employee->user_detail_uuid]->name;
                    $employee->bpjs_ketenagakerjaan = $arr_setup_user_detail[$employee->user_detail_uuid]->bpjs_ketenagakerjaan;
                    $employee->bpjs_kesehatan = $arr_setup_user_detail[$employee->user_detail_uuid]->bpjs_kesehatan;
                    $employee->name = $arr_setup_user_detail[$employee->user_detail_uuid]->name;
                }
                $arr_setup_employee[$employee->nik_employee] = $employee;
            }
        }

        $arr_employee_premi = EmployeePremi::where('date_start', '<=', $date_day_month_end)->orderBy('date_end', 'desc')
            ->get();
        // return view('datatableshow', [ 'data'         => $arr_employee_premi]);
        foreach ($arr_employee_premi as $employee_premi) {
            $col_name = 'premi_value_' . $employee_premi->premi_uuid;
            if (!empty($arr_setup_employee[$employee_premi->employee_uuid])) {
                $arr_setup_employee[$employee_premi->employee_uuid]->$col_name = $employee_premi->premi_value;
            }
        }

        // salary
        $arr_employee_salary = EmployeeSalary::where('date_start', '<=', $date_day_month_end)->orderBy('employee_uuid', 'desc')
            ->get();
        foreach ($arr_employee_salary as $employee_salary) {
            if (!empty($arr_setup_employee[$employee_salary->employee_uuid])) {
                if (empty($arr_setup_employee[$employee_salary->employee_uuid]->salary)) {
                    $arr_setup_employee[$employee_salary->employee_uuid]->salary = $employee_salary->salary;
                    $arr_setup_employee[$employee_salary->employee_uuid]->insentif = $employee_salary->insentif;
                    $arr_setup_employee[$employee_salary->employee_uuid]->tunjangan = $employee_salary->tunjangan;
                }
            }
        }

        //company
        $arr_employee_company = EmployeeCompany::join('companies', 'companies.uuid', 'employee_companies.company_uuid')
            ->where('date_start', '<=', $date_day_month_end)
            ->orderBy('employee_uuid', 'desc')
            ->get([
                'employee_companies.*',
                'companies.*'
            ]);

        foreach ($arr_employee_company as $employee_company) {
            if (!empty($arr_setup_employee[$employee_company->employee_uuid])) {
                if (empty($arr_setup_employee[$employee_company->employee_uuid]->company)) {
                    $arr_setup_employee[$employee_company->employee_uuid]->company = $employee_company->company;
                }
            }
        }

        $averagge = array();
        $year = $date[0];
        $month = $date[1];
        $bpjs_kesehatan_percent = 1;
        $bpjs_ketenagakerjaan_percent = 2;
        $jkk_percent = 1.74;
        $jk_percent = 0.3;
        $jht_percent = 2;
        $kes_percent = 4;
        $pensiun_percent = 1;
        $position_percent = 5;
        $percent_pph21 = 5;
        $bpjs_pensiun_percent = 1;

        $hour_meter_prices = HourMeterPrice::all();
        $status_absens = StatusAbsen::all();
        $status_absen_math = StatusAbsen::groupBy('math')->get('math');
        $premis = Premi::all();
        $companies = Company::join('coal_froms', 'coal_froms.company_uuid', 'companies.uuid')
            ->get([
                'coal_froms.*'
            ]);



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



        // ==========================================  SETUP PRODUCTION
        $premi_production = Premi::all();
        $premi_production = ResponseFormatter::createIndexArray($premi_production, 'uuid');


        $productions = Premi::leftJoin('productions', 'productions.premi_uuid', 'premis.uuid')
            ->whereYear('productions.date_production', $year)
            ->whereMonth('productions.date_production', $month)
            ->groupBy(
                'premis.uuid',
                'productions.premi_uuid',
            )
            ->select(
                'premis.uuid',
                DB::raw("SUM(productions.value_production) as value_production")
            )
            ->get();


        $productions = $productions->keyBy(function ($item) {
            return strval($item->uuid);
        });

        foreach ($premi_production as $production) {
            if (!empty($productions[$production->uuid])) {
                $production->value_production = $productions[$production->uuid]->value_production;
            } else {
                $production->value_production = 0;
            }
        }

        $productions = $premi_production;

        // ==========================================  END SETUP PRODUCTION

        // ==========================================  SETUP TAX STATUS
        $tax_status_uuid = TaxStatus::all();
        $tax_status_uuides = $tax_status_uuid->keyBy(function ($item) {
            return $item->uuid;
        });

        // dd($tax_status_uuides);
        // ==========================================  END SETUP TAX STATUS


        // ==========================================  SETUP EMPLOYEES

        $employees = $arr_setup_employee;

        // ==========================================  END SETUP EMPLOYEES



        // ==========================================  FIRST SETUP EMPLOYEES
        foreach ($employees as $employee) {

            foreach ($status_absen_math as $status_absen_m) {
                $col_name = $status_absen_m->math . '_absen_count';
                $employee->$col_name = 0;
                $employee->$col_name = 0;
            }
            foreach ($hour_meter_prices as $item) {
                $hm_uuid = $item->uuid;
                $hm_uui_pay = 'pay_' . $item->uuid;
                $employee->$hm_uuid = 0;
                $employee->$hm_uui_pay = 0;
            }

            foreach ($companies as $company) {
                $tonase_uuid = 'tonase_' . $company->uuid;
                $tonase_uui_pay = 'pay_tonase_' . $company->uuid;

                $employee->$tonase_uuid = 0;
                $employee->$tonase_uui_pay = 0;
            }

            foreach ($premis as $premi) {
                $name_premi_pay = 'pay_premi_' . $premi->uuid;
                $employee->$name_premi_pay = 0;
            }

            for ($status_absen_day = 1; $status_absen_day <= $day_month; $status_absen_day++) {
                $name_day = 'status_absen_day_' . $status_absen_day;
                $employee->$name_day = null;
            }


            if ($employee->is_bpjs_kesehatan == 'Ya') {
                $employee->is_bpjs_kesehatan_pay = round($bpjs_kesehatan_percent * $employee->salary / 100, 0);
            } else {
                $employee->is_bpjs_kesehatan_pay = 0;
            }
            if ($employee->is_bpjs_ketenagakerjaan == 'Ya') {
                $employee->is_bpjs_ketenagakerjaan_pay = round($bpjs_ketenagakerjaan_percent * $employee->salary / 100, 0);
            } else {
                $employee->is_bpjs_ketenagakerjaan_pay = 0;
            }
            if ($employee->is_bpjs_pensiun == 'Ya') {
                $employee->is_bpjs_pensiun_pay = round($bpjs_pensiun_percent * $employee->salary / 100, 0);
            } else {
                $employee->is_bpjs_pensiun_pay = 0;
            }
            if (!empty($employee->company_uuid)) {
                $employee->company = $employee->company_uuid;
            }

            $employee->salary_payed = 0;
            $employee->insentif_pay = 0;
            $employee->tunjangan_pay = 0;

            $employee->salary_netto_adjust = 0;
            $employee->salary_netto_before_cut_debt = 0;
            $employee->cut_debt = 0;

            $employee->brutto_slip = 0;
            $employee->total_bpjs = 0;

            $employee->hm_pay_total = 0;
            $employee->tonase_pay_total = 0;
            $employee->premi_pay_total = 0;
            $employee->payment_pay_total = 0;

            $employee->payment_other_pay_total = 0;
            $employee->value_payment_debt = 0;


            $employee->cut_absen = 0;
            $employee->cut_absen_loan = 0; //izin
            $employee->cut_alpa_loan = 0; //alpa
            $employee->pay_absen = 0;
            $employee->unpay_absen = 0;
            $employee->cutted_total = 0;

            $employee->day_month = $day_month;

            $employee->count_day_unwork = 0;

            $employee->A_day = 0;
            $employee->cut_day = 0;
            $employee->pay_day = 0;
            $employee->unpay_day = 0;

            foreach ($status_absens as $status_absen) {
                $col_name = $status_absen->uuid;
                $employee->$col_name = 0;
            }
        }

        // ==========================================  END FIRST SETUP EMPLOYEES

        // ==========================================  DAY WORK EMPLOYEE
        /*
        TO GET count status absen => by status_absen.math
        [
            pay_absen,
            unpay_absen,
            cut_absen,
            A_absen
        ]

        */

        $employee_day_works =  EmployeeAbsen::join('employees', 'employees.machine_id', 'employee_absens.employee_uuid')
            ->join('status_absens', 'status_absens.uuid', 'employee_absens.status_absen_uuid')
            ->whereYear('employee_absens.date', $year)
            ->whereMonth('employee_absens.date', $month)
            ->groupBy(
                'employees.uuid',
                'employee_absens.employee_uuid',
                'status_absens.math',
            )
            ->select(
                'employee_absens.employee_uuid as machine_id',
                'employees.uuid as employee_uuid',
                'status_absens.math',
                DB::raw("count(status_absens.math) as count_math_status_absen")
            )
            ->get();



        foreach ($employee_day_works as $employee_day_work) {
            $name_col = $employee_day_work->math . '_absen_count';
            $name_col_new = $employee_day_work->math . '_day';
            if (!empty($employees[$employee_day_work->employee_uuid])) {
                $employees[$employee_day_work->employee_uuid]->$name_col = $employee_day_work->count_math_status_absen;
                $employees[$employee_day_work->employee_uuid]->$name_col_new = $employee_day_work->count_math_status_absen;
            }
        }
        // return view('datatableshow', [ 'data'         => $employees]);
        // dd($employee_day_works->first());
        // ==========================================  END DAY WORK EMPLOYEE

        // ==========================================  DAY WORK EMPLOYEE status absen
        $employee_absen_status_absen =  EmployeeAbsen::join('employees', 'employees.machine_id', 'employee_absens.employee_uuid')
            ->whereYear('employee_absens.date', $year)
            ->whereMonth('employee_absens.date', $month)
            ->groupBy(
                'employees.uuid',
                'employee_absens.employee_uuid',
                'employee_absens.status_absen_uuid',
            )
            ->select(
                'employee_absens.employee_uuid as machine_id',
                'employees.uuid as employee_uuid',
                'employee_absens.status_absen_uuid',
                DB::raw("count(employee_absens.status_absen_uuid) as count_status_absen_uuid")
            )
            ->get();
        // return view('datatableshow', [ 'data'         => $employee_absen_status_absen]);
        foreach ($employee_absen_status_absen as $employees_absen) {
            $name_col = $employees_absen->status_absen_uuid;
            if (!empty($employees[$employees_absen->employee_uuid])) {
                $employees[$employees_absen->employee_uuid]->$name_col = $employees_absen->count_status_absen_uuid;
            }
        }
        // ==========================================  END DAY WORK EMPLOYEE status absen


        // ==========================================  HOUR METER EMPLOYEE
        // TO GET count hm each price each employee
        /* the data
        [
            price_hm
        ]
        */
        foreach ($hour_meter_prices as $item) {
            $employee_hms =  EmployeeHourMeterDay::where('hour_meter_price_uuid', $item->uuid)
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->groupBy(
                    'employee_uuid',
                )
                ->select(
                    'employee_uuid',
                    DB::raw("SUM(employee_hour_meter_days.full_value) as hour_meter_value")
                )
                ->get();

            $hm_uuid = $item->uuid;
            $hm_uui_pay = 'pay_' . $item->uuid;

            foreach ($employee_hms as $employee_hm) {
                $pay = $item->hour_meter_value * $employee_hm->hour_meter_value;
                $employees[$employee_hm->employee_uuid]->$hm_uuid = $employee_hm->hour_meter_value;
                $employees[$employee_hm->employee_uuid]->hm_pay_total = $employees[$employee_hm->employee_uuid]->hm_pay_total + $pay;
                $employees[$employee_hm->employee_uuid]->$hm_uui_pay =  $pay;
            }
        }

        // return view('datatableshow', [ 'data'         => $employees]);
        // dd($employee_day_works->first());

        // ==========================================  END HOUR METER EMPLOYEE

        // ==========================================  HAULING EMPLOYEE
        $employee_tonases = EmployeeTonase::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->groupBy(
                'employee_uuid',
                'coal_from_uuid'
            )
            ->select(
                'employee_uuid',
                'coal_from_uuid',
                DB::raw("SUM(employee_tonases.tonase_full_value) as tonase_full_value")
            )
            ->get();




        foreach ($employee_tonases as $employee_tonase) {
            if (!empty($employees[$employee_tonase->employee_uuid])) {
                $tonase_uuid = 'tonase_' . $employee_tonase->coal_from_uuid;
                $tonase_uui_pay = 'pay_tonase_' . $employee_tonase->coal_from_uuid;
                $employees[$employee_tonase->employee_uuid]->$tonase_uuid = round($employee_tonase->tonase_full_value, 3);

                $pay_ton = round($arr_coal_from[$employee_tonase->coal_from_uuid]->hauling_price * $employee_tonase->tonase_full_value, 3);
                $employees[$employee_tonase->employee_uuid]->tonase_pay_total = $employees[$employee_tonase->employee_uuid]->tonase_pay_total + $pay_ton;
                $employees[$employee_tonase->employee_uuid]->$tonase_uui_pay =  $pay_ton;
            }
            // if(empty($employees[$employee_tonase->employee_uuid]->tonase_pay_total)){
            //     $employees[$employee_tonase->employee_uuid]->tonase_pay_total = 0;
            // }

        }

        // dd($employees['MB-PL-120054']);
        // return view('datatableshow', [ 'data'         => $employees]);
        // dd($employee_day_works->first());


        // ==========================================  END HAULING EMPLOYEE

        // ==========================================  STATUS ABSEN EACH DAY
        $arr_employee_absen = EmployeeAbsen::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        foreach ($arr_employee_absen as $employee_absen) {

            if (!empty($arr_employee_for_absen[$employee_absen->employee_uuid])) {
                $arr_date_absen = explode('-', $employee_absen->date);
                $the_date = (int)$arr_date_absen[2];
                $col_name_date = 'status_absen_day_' . $the_date;
                $employees[$arr_employee_for_absen[$employee_absen->employee_uuid]->nik_employee]->$col_name_date = $employee_absen->status_absen_uuid;
            }
        }
        // return view('datatableshow', [ 'data'         => $arr_employee_absen]);






        // dd($employees['MB-PL-120054']);
        // return view('datatableshow', [ 'data'         => $employees]);
        // dd($employee_day_works->first());


        // ==========================================  END STATUS ABSEN EACH DAY


        // ==========================================  PREMI EMPLOYEE
        foreach ($arr_employee_premi as $employee_premi) {
            $premi_uuid = $employee_premi->premi_uuid;
            $col_name = 'premi_value_' . $employee_premi->premi_uuid;
            if (!empty($productions[$premi_uuid])) {
                if (!empty($employees[$employee_premi->employee_uuid])) {
                    $employees[$employee_premi->employee_uuid]->$col_name = $employee_premi->premi_value;
                    $name_premi_pay = 'pay_premi_' . $employee_premi->premi_uuid;
                    $production_premi = (float)$productions[$premi_uuid]->value_production;
                    $premi_pay = $employee_premi->premi_value * $production_premi;
                    $employees[$employee_premi->employee_uuid]->$name_premi_pay = $premi_pay;
                    $employees[$employee_premi->employee_uuid]->$name_premi_pay = $premi_pay;
                    $employees[$employee_premi->employee_uuid]->premi_pay_total =  $employees[$employee_premi->employee_uuid]->premi_pay_total + $premi_pay;
                }
            }
        }



        // ==========================================  END PREMI EMPLOYEE



        // ==========================================  PAYMENT EMPLOYEE
        $payments = EmployeePayment::join('payments', 'payments.uuid', 'employee_payments.payment_uuid')
            ->whereYear('payments.date', $year)
            ->whereMonth('payments.date', $month)
            ->groupBy(
                'employee_payments.employee_uuid',
            )
            ->select(
                'employee_payments.employee_uuid',
                DB::raw("SUM(employee_payments.value) as payment_pay")
            )
            ->get();

        foreach ($payments as $payment) {
            // dd($payment->payment_pay_total);
            $employees[$payment->employee_uuid]->payment_pay_total = $payment->payment_pay;
        }
        // ==========================================  END PAYMENT EMPLOYEE

        // ==========================================  PAYMENT OTHER EMPLOYEE
        $EmployeePaymentOther = EmployeePaymentOther::whereYear('employee_payment_others.payment_other_date', $year)
            ->whereMonth('employee_payment_others.payment_other_date', $month)
            ->groupBy(
                'employee_payment_others.employee_uuid',
            )
            ->select(
                'employee_payment_others.employee_uuid',
                DB::raw("SUM(employee_payment_others.payment_other_total) as payment_other_total")
            )
            ->get();

        foreach ($EmployeePaymentOther as $payment_other_pay_total) {
            $employees[$payment_other_pay_total->employee_uuid]->payment_other_pay_total = $payment_other_pay_total->payment_other_total;
        }


        // dd($employees['MBLE-220666']);
        // ==========================================  END PAYMENT OTHER EMPLOYEE

        // ==========================================  DEBT Payment
        $employee_payment_debts = EmployeePaymentDebt::whereYear('employee_payment_debts.date_payment_debt', $year)
            ->whereMonth('employee_payment_debts.date_payment_debt', $month)
            ->get(
                [
                    'employee_payment_debts.employee_uuid',
                    'employee_payment_debts.value_payment_debt',
                ]
            );
        // dd($employee_payment_debts);

        foreach ($employee_payment_debts as $employee_pay_debt) {
            if (!empty($employees[$employee_pay_debt->employee_uuid])) {
                $employees[$employee_pay_debt->employee_uuid]->value_payment_debt = $employee_pay_debt->value_payment_debt;
            }
        }
        // ==========================================  END DEBT Payment
        // dd($employees['MBLE-12234-2301004']);
        // return view('datatableshow', [ 'data'         => $employees['RJ-BMR-2301222']]);
        $data_count = [];
        $arr_data_allowance = [];
        foreach ($employees as $employee) {
            //echo $employee->nik_employee;
            // COUNT SALARY PAY
            $date_start_contract = $employee->date_start_contract;
            $date2 = $year_month . '-' . $day_month;
            $date1 = $date_start_contract;
            $employee->long_work = ResponseFormatter::countMonthLongWork($date1, $date2);
            // $employee->pay_day = round(ResponseFormatter::countDayLongWork($date1,$date2));
            //echo ':'; //echo $employee->date_start_contract;

            if ($employee->long_work == 0) {
                $employee->salary_payed = round($employee->pay_day * $employee->salary / $day_month, 3);
                $employee->insentif_pay = round($employee->pay_day * $employee->insentif / $day_month, 3);
                $employee->tunjangan_pay = round($employee->pay_day * $employee->tunjangan / $day_month, 3);
            } else {
                $employee->salary_payed = $employee->salary;
                $employee->insentif_pay = $employee->insentif;
                $employee->tunjangan_pay = $employee->tunjangan;
            }
            if ($employee->unpay_absen_count > 0) {
                $employee->salary_payed = round(($employee->pay_absen_count + $employee->cut_absen_count + $employee->A_count) * $employee->salary / $day_month, 3);
                $employee->insentif_pay = round(($employee->pay_absen_count + $employee->cut_absen_count + $employee->A_count)  * $employee->insentif / $day_month, 3);
                $employee->tunjangan_pay = round(($employee->pay_absen_count + $employee->cut_absen_count + $employee->A_count)  * $employee->tunjangan / $day_month, 3);
            }
            $employee->count_day_unwork = $employee->A_absen_count + $employee->cut_absen_count;

            //echo ':'; //echo $employee->count_day_unwork;

            $employee->gaji_kotor = round(
                $employee->payment_other_pay_total +
                    $employee->payment_pay_total +
                    $employee->tunjangan_pay +
                    $employee->insentif_pay +
                    $employee->salary_payed +
                    $employee->hm_pay_total +
                    $employee->tonase_pay_total +
                    $employee->premi_pay_total,
                3
            );

            $employee->extra_salary = round(
                $employee->payment_pay_total +
                    $employee->hm_pay_total +
                    $employee->tonase_pay_total +
                    $employee->premi_pay_total,
                3
            );


            $employee->half_extra_salary = round($employee->extra_salary / 2, 3);

            $employee->main_salary =  round(
                $employee->tunjangan_pay +
                    $employee->insentif_pay +
                    $employee->salary_payed,
                3
            );

            $employee->jkk_pay =  round($employee->is_bpjs_ketenagakerjaan_pay * 50 * $jkk_percent / 100, 0);
            $employee->jk_pay =  round($employee->is_bpjs_ketenagakerjaan_pay * 50 * $jk_percent / 100, 0);
            $employee->kes_pay =  round($employee->is_bpjs_ketenagakerjaan_pay * 50 * $kes_percent / 100, 0);
            //untuk pph 21
            $employee->brutto_salary = round(
                $employee->main_salary +
                    $employee->jkk_pay +
                    $employee->half_extra_salary +
                    $employee->kes_pay +
                    $employee->jk_pay +
                    $employee->payment_other_pay_total,
                3
            );

            $employee->jht_pay =  round($employee->is_bpjs_ketenagakerjaan_pay, 2);
            $employee->pensiun_pay =  round($employee->salary_payed * $pensiun_percent / 100, 2);

            $employee->total_bpjs = $employee->is_bpjs_kesehatan_pay + $employee->is_bpjs_ketenagakerjaan_pay + $employee->is_bpjs_pensiun_pay;


            $employee->position_percent = round($employee->brutto_salary * $position_percent / 100, 0);

            if ($employee->position_percent > 500000) {
                $employee->position_percent = 500000;
            }

            $employee->jht_pay =  round($employee->is_bpjs_ketenagakerjaan_pay, 2);
            $employee->pensiun_pay =  round($employee->salary_payed * $pensiun_percent / 100, 2);

            $employee->netto_month =  round(
                $employee->brutto_salary -
                    $employee->position_percent -
                    $employee->jht_pay -
                    $employee->pensiun_pay,
                0
            );

            $employee->netto_year = ($employee->netto_month * 12) - ($employee->payment_other_pay_total * 11);
            $tax_status_uuid = ResponseFormatter::toUUID($employee->tax_status_uuid);
            //echo ':'; //echo $employee->tax_status_uuid;
            $employee->pph21_month = $employee->netto_year - $tax_status_uuides[$tax_status_uuid]->tax_status_value;

            $employee->pph21 = round($employee->pph21_month * $percent_pph21 / 100 / 12, 0);

            if ($employee->pph21 < 0) {
                $employee->pph21 = 0;
            }

            // potongan alpa dan izin
            if ($employee->count_day_unwork > 0) {
                $hasil_sebelum = 0;
                $hasil_grup = 0;

                //$dataaaa = [];
                foreach ($formulas as $fml) {
                    $hasil_sebelum = 0;
                    $hasil_grup = 0;
                    //$dataaaa['uuid'] = $fml->uuid;
                    $izin = ($fml->uuid == 'IZIN') ? true : false;
                    $alpa = ($fml->uuid == 'ALPA') ? true : false;

                    $day_alpa = ($employee->A_absen_count > 0) ? true : false;
                    $day_izin = ($employee->cut_absen_count > 0) ? true : false;

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
                                        $hasil_sebelum = $employee->$nama_col;
                                    } else {
                                        if ($variable_count_formula->variable_uuid == 'NILAI') {
                                            $hasil_sebelum = AllowanceController::Maths($hasil_sebelum,  $variable_count_formula->value_value_variable, $symbol);
                                        } else {
                                            $hasil_sebelum = AllowanceController::Maths($hasil_sebelum,  $employee->$nama_col, $symbol);
                                        }
                                    }
                                }
                            } else {
                                $hasil_grup = $hasil_sebelum;
                                foreach ($g_fml->variable_counts as $variable_count_formula) {
                                    $nama_col =  $variable_count_formula->variable_code;
                                    $symbol = $variable_count_formula->symbol_count;
                                    if ($variable_count_formula->order_number == 1) {
                                        $hasil_sebelum = $employee->$nama_col;
                                    } else {
                                        if ($variable_count_formula->variable_uuid == 'NILAI') {
                                            $hasil_sebelum = AllowanceController::Maths($hasil_sebelum,  $variable_count_formula->value_value_variable, $symbol);
                                        } else {
                                            $hasil_sebelum = AllowanceController::Maths($hasil_sebelum,  $employee->$nama_col, $symbol);
                                        }
                                    }
                                }
                                $symbol = $g_fml->group_formula_symbol;
                                $hasil_sebelum = AllowanceController::Maths($hasil_grup,  $hasil_sebelum, $symbol);
                            }
                        }
                    }

                    if ($fml->uuid == 'IZIN') {
                        $employee->cut_absen_loan =  $hasil_sebelum;
                    } else {
                        $employee->cut_alpa_loan =  $hasil_sebelum;
                    }
                }
            }
            // end potongan alpa dan izin


            /*

            - BPJS Naker = Gajih Pokok x 2% 



            - PPH21
            PPh21 bulan ini = PKP / 12 x 5%
            PKP = Penghasilan Netto Setahun - PTKP
            Penghasilan Netto Setahun = (Penghasilan Netto Sebulan x 12) - (kekurangan bulan lalu * 12)
            Penghasilan Netto Sebulan = Penghasilan Brutto Sebulan - Faktor Pengurang PKP
            { Penghasilan Brutto Sebulan = Tunjangan Kehadiran + Insentif Produksi + Kekurangan Bulan Lalu + Gajih Pokok + Insentif + Tunjangan + JKK 1,74% + JK 0,3 % + kes 4%
                - Tunjangan Kehadiran 
                - Kekurangan Bulan Lalu 
                - Gajih Pokok 
                - Insentif 
                - Tunjangan 
                - JKK 1,74%  = BPJS Naker x 50 x 1,74 %
                - JK 0,3 % = BPJS Naker x 50 x 0,3 %
                - kes 4% = BPJS Naker x 50 x 4 %
                
                -  { Insentif Produksi = (Hauling + HM + Premi) x 50%

                    }
            }
            
            { Faktor Pengurang PKP = Biaya Jabatan(5%) + Iuran JHT(2%) + Iuran Pensiun(1%)
                - Biaya Jabatan(5%) = Penghasilan Brutto Sebulan 5% (maks Rp. 500.000)
                - Iuran JHT(2%) = Gajih Pokok 2%
                - Iuran Pensiun(1%) = Gajih Pokok 1%
            }



            */

            $employee->cutted_total = $employee->pph21 + $employee->is_bpjs_ketenagakerjaan_pay + $employee->is_bpjs_kesehatan_pay + $employee->is_bpjs_pensiun_pay + $employee->cut_alpa_loan + $employee->cut_absen_loan;

            $employee->salary_netto = $employee->salary_netto_before_cut_debt = round($employee->gaji_kotor - $employee->cutted_total, 0);

            if ($employee->value_payment_debt > 0) {
                $employee->salary_netto = round($employee->salary_netto_before_cut_debt - $employee->value_payment_debt, 0);
            }

            if ($employee->salary_netto < 0) {
                $employee->salary_netto = 0;
            }


            $employee->salary_netto_adjust_moded = round($employee->salary_netto / 1000, 0);
            $employee->salary_netto_adjust = round($employee->salary_netto_adjust_moded * 1000, 0);

            $employee->salary_netto_before_cut_debt =  $employee->salary_netto_adjust;
            $employee->salary_netto_adjust_mod = $employee->salary_netto - $employee->salary_netto_adjust;

            //echo '</br>';
            $data_count[$employee->nik_employee] = [
                'name'  => [
                    'value' => $employee->name,
                    'name' => 'Nama'
                ],
                'nik_employee'  => [
                    'value' => $employee->nik_employee,
                    'name' => 'NIK Karyawan'
                ],
                'count_pay_day'  => [
                    'value' => $employee->pay_day,
                    'name' => 'Total Hari Dibayar'
                ],
                'no_bpjs_ketenagakerjaan'  => [
                    'value' => $employee->bpjs_ketenagakerjaan,
                    'name' => 'BPJS Naker'
                ],
                'no_bpjs_kesehatana'  => [
                    'value' => $employee->bpjs_kesehatana,
                    'name' => 'BPJS Kes'
                ],

                'date_start_contract'  => [
                    'value' => $employee->date_start_contract,
                    'name' => 'Awal Kontrak'
                ],
                'position'  => [
                    'value' => $employee->position,
                    'name' => 'Jabatan'
                ],
                'tax_status'  => [
                    'value' => $employee->tax_status_uuid,
                    'name' => 'Status Pajak'
                ],
                'long_work' => [
                    'value' => $employee->long_work,
                    'name' => 'Lama Bekerja'
                ],
                'total_hari_tidak_bekerja' => [
                    'value' => $employee->count_day_unwork,
                    'name' => 'Total Hari Tidak Bekerja'
                ],
                'salary'    => [
                    'value' => $employee->salary,
                    'name' => 'Gajih Pokok'
                ],
                'salary_payed'  => [
                    'value' =>    $employee->salary_payed,
                    'name' => 'Gajih Pokok Dibayar'
                ],
                'insentif'  => [
                    'value' =>    $employee->insentif,
                    'name' => 'Insentif'
                ],
                'insentif_pay'  => [
                    'value' =>    $employee->insentif_pay,
                    'name' => 'Insentif Dibayar'
                ],
                'tunjangan'  => [
                    'value' =>    $employee->tunjangan,
                    'name' => 'Tunjangan'
                ],
                'tunjangan_pay'  => [
                    'value' =>    $employee->tunjangan_pay,
                    'name' => 'Tunjangan Dibayar'
                ],
                'total_hasil_hm'  => [
                    'value' => $employee->hm_pay_total,
                    'name' => 'Total Uang HM'
                ],
                'total_hasil_hauling'  => [
                    'value' => $employee->tonase_pay_total,
                    'name' => 'Total Uang Hauling'
                ],
                'total_hasil_premi'  => [
                    'value' => $employee->premi_pay_total,
                    'name' => 'Total Uanf Premi'
                ],
                'total_hasil_pembayaran'  => [
                    'value' => $employee->payment_pay_total,
                    'name' => 'Total Uang Pembayaran'
                ],
                'total_pendapatan_tambahan'  => [
                    'value' => $employee->extra_salary,
                    'name' => 'Total Uang Pendapatan Lainnya'
                ],
                'total_gajih_kotor'  => [
                    'value' => $employee->gaji_kotor,
                    'name' => 'Total Gajih Kotor'
                ],
                'bpjs_kesehatan'  => [
                    'value' => $employee->is_bpjs_kesehatan_pay,
                    'name' => 'Uang BPJS Kesehatan'
                ],
                'bpjs_pensiun'  => [
                    'value' => $employee->is_bpjs_pensiun_pay,
                    'name' => 'Uang BPJS Pensiun'
                ],
                'bpjs_ketenagakerjaan'  => [
                    'value' => $employee->is_bpjs_ketenagakerjaan_pay,
                    'name' => 'Uang BPJS Naker'
                ],
                'total_bpjs'    => [
                    'value' => $employee->total_bpjs,
                    'name' => 'Total BPJS'
                ],
                'pph21' => [
                    'value' => $employee->pph21,
                    'name' => 'Total PPH21'
                ],
                'total_potongan_izin' => [
                    'value' => $employee->cut_absen_loan,
                    'name' => 'Uang Potongan Izin'
                ],
                'total_potongan_alpa' => [
                    'value' => $employee->cut_alpa_loan,
                    'name' => 'Uang Potongan Alpa'
                ],
                'total_pembayaran_hutang' => [
                    'value' => $employee->value_payment_debt,
                    'name' => 'Uang Potongan Hutang'
                ],

                'A_absen_count' => [
                    'value' => $employee->A_absen_count,
                    'name' => 'Jumlah Alpa'
                ],
                'cut_absen_count' => [
                    'value' => $employee->cut_absen_count,
                    'name' => 'Jumlah Absen'
                ],
                'pay_absen_count' => [
                    'value' => $employee->pay_absen_count,
                    'name' => 'Jumlah Hari Masuk'
                ],
                'unpay_absen_count' => [
                    'value' => $employee->unpay_day,
                    'name' => 'Jumlah Hari Belum Bergabung'
                ],

                'total_gajih_bersih_sebelum_potong_hutang'  => [
                    'value' => $employee->salary_netto_before_cut_debt,
                    'name' => 'Gajih Bersih Sebelum dipotong hutang'
                ],
                'total_gajih_bersih_sebelum_dibulatkan'  => [
                    'value' => $employee->salary_netto,
                    'name' => 'Gajih Bersih sebelum dibulatkan'
                ],
                'total_pembulat'  => [
                    'value' => $employee->salary_netto_adjust_mod * (-1),
                    'name' => 'Pembulatan'
                ],
                'total_gajih_bersih_bulat'  => [
                    'value' => $employee->salary_netto_adjust,
                    'name' => 'Gajih Bersih Setelah Dibulatkan'
                ],
            ];

            $arr_data_allowance[] = $employee;
        }
        // dd($arr_data_allowance);
        //   dd($employees['RJ-BMR-2301222']);

        if ($request->from == 'export') {
            // if('d' == 'export'){
            $createSpreadsheet = new spreadsheet();
            $createSheet = $createSpreadsheet->getActiveSheet();
            $createSheet->setCellValue('B1', 'Template HM');

            $createSheet->setCellValue('C1', 'Excel');
            $createSheet->setCellValue('B2', 'Perusahaan');
            $createSheet->setCellValue('B3', 'Bulan');
            $createSheet->setCellValue('B4', 'Tahun');
            $abjads = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ'];


            $is_first = true;
            $baris = 5;
            foreach ($data_count as $dt_excel) {
                $koloms = 1;
                if ($is_first) {
                    foreach ($dt_excel as $excel) {
                        $createSheet->setCellValue($abjads[$koloms] . $baris, $excel['name']);
                        $next_baris = $baris + 1;
                        $createSheet->setCellValue($abjads[$koloms] . $next_baris, $excel['value']);
                        $koloms++;
                    }
                    $baris = $baris + 2;
                    $is_first = false;
                } else {
                    foreach ($dt_excel as $excel) {
                        $createSheet->setCellValue($abjads[$koloms] . $baris, $excel['value']);
                        $koloms++;
                    }
                }
                $baris++;
            }


            $crateWriter = new Xls($createSpreadsheet);
            $name = 'file/absensi/file-hm-bulan-' . $year_month . '-' . rand(99, 9999) . 'file.xls';
            $crateWriter->save($name);

            // return 'aaa';
            return response()->download($name);
        }


        return ResponseFormatter::toJson($arr_data_allowance, $data_count);




        // dd($employees['MB-FO-180154']);

        // return view('datatableshow', [ 'data'         => $arr_data_allowance]);


        foreach ($employees as $avg) {
            // $position = $avg->position;
            if ($avg->salary_netto_adjust > 0) {
                if (empty($averagge[$avg->position_uuid])) {
                    $averagge[$avg->position_uuid] = [
                        'value' => $avg->salary_netto_adjust,
                        'position' => $avg->position,
                        'count' => 1
                    ];
                    // $averagge[$averagge[$avg->position_uuid]] = $avg->salary_netto_adjust;
                } else {
                    $averagge[$avg->position_uuid] = [
                        'value' => $averagge[$avg->position_uuid]['value'] + $avg->salary_netto_adjust,
                        'position' => $avg->position,
                        'count' => $averagge[$avg->position_uuid]['count'] + 1
                    ];
                }
            }
        }

        foreach ($averagge as $avg => $val) {
            $av =  $averagge[$avg]['value'] / $averagge[$avg]['count'];
            $averagge[$avg]['avg'] =  $av;
        }
        // return view('datatableshow', [ 'data'         => $employees]);

        // if($request->from == 'index'){
        //     return ResponseFormatter::toJson($averagge, 'Data Averagge');
        // }


        return Datatables::of($employees)
            ->make(true);
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
