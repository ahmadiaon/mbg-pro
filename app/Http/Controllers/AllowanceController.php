<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Company;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeAbsenTotal;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\Employee\EmployeePayment;
use App\Models\Employee\EmployeePaymentDebt;
use App\Models\Employee\EmployeePaymentOther;
use App\Models\Employee\EmployeePremi;
use App\Models\Employee\EmployeeTonase;
use App\Models\Formula;
use App\Models\GroupFormula;
use App\Models\HourMeterPrice;
use App\Models\Identity;
use App\Models\Premi;
use App\Models\Production;
use App\Models\StatusAbsen;
use App\Models\TaxStatus;
use App\Models\VariableCount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class AllowanceController extends Controller
{
    public function index(){
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

    public function indexPayrol($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $employees = Identity::join('employees', 'employees.uuid', 'identities.employee_uuid')
        ->leftJoin('employee_absen_totals', 'employee_absen_totals.nik_employee', 'employees.nik_employee')
        ->where('employee_absen_totals.year_month', $year.'-'.$month)
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
        foreach($employee_hm as $hm){
            $hms[$hm->employee_uuid] = $hm;
        }
        
     
        // dd($hms['MBLE-0219120106']->hour_meter_value);

        return view('datatableshow', [ 'data'         => $hms]);

        return $year;
    }

    public function anyData(Request $request){
        $date = explode("-", $request->year_month);
        $year = $date[0];
        $month = $date[1];

        $hour_meter_prices = HourMeterPrice::all();

        $data_hm =[];

        foreach($hour_meter_prices as $item){
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
        ->where('employee_absen_totals.year_month', $year.'-'.$month)
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
        foreach( $employees as $employee){
            foreach($hour_meter_prices as $item){
                $name =$item->uuid;
                if(empty($data_hm[$item->uuid][$employee->uuid]->hour_meter_value)){
                    $employee->$name = null;
                }else{
                    $employee->$name = $data_hm[$item->uuid][$employee->uuid]->hour_meter_value;
                }
            }
            $data[] = $employee;
        }

        // return view('datatableshow', [ 'data'         => $data]);

        return Datatables::of($employees)
        ->make(true);
    }

    public static function AveragePosition($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];



    }

    // public function moreAnyData($year_month){
    //     $date = explode("-", $year_month);
    //     $day_month = ResponseFormatter::getEndDay($year_month);

    public function moreAnyData(Request $request){
        $year_month = $request->year_month;
        $day_month = ResponseFormatter::getEndDay($year_month);
        $date = explode("-", $request->year_month);
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

        foreach($formulas as $f){
            $group_formulas = GroupFormula::where('formula_uuid', $f->uuid)->get();

            foreach($group_formulas as $gf){
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
    // ==========================================  END SETUP PRODUCTION

    // ==========================================  SETUP TAX STATUS
        $tax_status = TaxStatus::all();
        $tax_statuses = $tax_status->keyBy(function ($item) {
            return strval(str_replace('-','/',$item->uuid));
        });
    // ==========================================  END SETUP TAX STATUS

    // ==========================================  SETUP EMPLOYEES
        $datas = Employee::leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->leftJoin('employee_salaries','employee_salaries.employee_uuid','employees.uuid')
        ->get([
            'employees.is_bpjs_kesehatan',
            'employees.position_uuid',
            'employees.tax_status',
            'employees.is_bpjs_ketenagakerjaan',
            'employees.is_bpjs_pensiun',
            'employee_salaries.*',
            'employees.uuid as employee_uuid',
            'user_details.name',
            'positions.position',
            'employees.date_start_contract'
        ]);

        $employees = $datas->keyBy(function ($item) {
            return strval($item->employee_uuid);
        });

        // dd($employees);
        /* 
        [ THE DATA
            "is_bpjs_kesehatan",
            "tax_status",
            "is_bpjs_ketenagakerjaan",
            "is_bpjs_pensiun",
            "id",
            "uuid",
            "employee_uuid",
            "salary",
            "insentif",
            "tunjangan",
            "hour_meter_price_uuid",
            "insentif_hm",
            "deposit_hm",
            "tonase",
            "date_start",
            "date_end",
            "created_at",
            "updated_at",
            "name",
            "position",
            "date_start_contract"
        ]
        */
    // ==========================================  END SETUP EMPLOYEES


        
    // ==========================================  FIRST SETUP EMPLOYEES
        foreach($employees as $employee){ 

            foreach($status_absen_math as $status_absen_m){
                $col_name = $status_absen_m->math.'_absen_count';
                $employee->$col_name = 0;
                $employee->$col_name = 0;
            }
            foreach($hour_meter_prices as $item){
                $hm_uuid = $item->uuid;
                $hm_uui_pay = 'pay_'.$item->uuid;
                $employee->$hm_uuid = 0;
                $employee->$hm_uui_pay = 0;
            }

            foreach($companies as $company){
                $tonase_uuid = 'tonase_'.$company->uuid;
                $tonase_uui_pay = 'pay_tonase_'.$company->uuid;

                $employee->$tonase_uuid = 0;
                $employee->$tonase_uui_pay = 0;
            }

            foreach($premis as $premi){
                $name_premi = $premi->uuid ;
                $name_premi_pay = 'pay_premi_'.$premi->uuid ;
                $employee->$name_premi = 0;
                $employee->$name_premi_pay = 0;
            }


            if($employee->is_bpjs_kesehatan == 'Ya'){
                $employee->is_bpjs_kesehatan_pay = round($bpjs_kesehatan_percent * $employee->salary /100,0);
            }else{
                $employee->is_bpjs_kesehatan_pay = 0;
            }
            if($employee->is_bpjs_ketenagakerjaan == 'Ya'){
                $employee->is_bpjs_ketenagakerjaan_pay = round($bpjs_ketenagakerjaan_percent * $employee->salary /100,0);
            }else{
                $employee->is_bpjs_ketenagakerjaan_pay = 0;
            }
            if($employee->is_bpjs_pensiun == 'Ya'){
                $employee->is_bpjs_pensiun_pay = round($bpjs_pensiun_percent * $employee->salary /100,0);
            }else{
                $employee->is_bpjs_pensiun_pay = 0;
            }

            $employee->salary_payed = 0;
            $employee->insentif_pay = 0;
            $employee->tunjangan_pay = 0;

            $employee->salary_netto_adjust = 0;
            $employee->salary_netto_before_cut_debt = 0;
            $employee->cut_debt = 0;
            
            $employee->brutto_slip = 0;
            $employee->total_bpjs = 0;

            $employee->hm_pay_total= 0;
            $employee->tonase_pay_total= 0;
            $employee->premi_pay_total= 0;
            $employee->payment_pay_total= 0;

            $employee->payment_other_pay_total = 0;
            
            $employee->cut_absen = 0;
            $employee->cut_absen_loan = 0;//izin
            $employee->cut_alpa_loan = 0;//alpa
            $employee->pay_absen = 0;
            $employee->unpay_absen = 0;
            $employee->cutted_total = 0;

            $employee->day_month = $day_month;

            $employee->count_day_unwork = 0;

            $employee->A_day = 0;
            $employee->cut_day = 0;
            $employee->pay_day = 0;
            $employee->unpay_day = 0;

            foreach($status_absens as $status_absen){
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

        $employee_day_works =  EmployeeAbsen::join('employees','employees.machine_id', 'employee_absens.employee_uuid')
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

        foreach($employee_day_works as $employee_day_work){
            $name_col = $employee_day_work->math.'_absen_count';
            $employees[$employee_day_work->employee_uuid]->$name_col = $employee_day_work->count_math_status_absen;
        }
    // ==========================================  END DAY WORK EMPLOYEE

    // ==========================================  DAY WORK EMPLOYEE status absen
        $employee_absen_status_absen =  EmployeeAbsen::join('employees','employees.machine_id', 'employee_absens.employee_uuid')
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

        foreach($employee_absen_status_absen as $employees_absen){
            $name_col = $employees_absen->status_absen_uuid;
            $employees[$employees_absen->employee_uuid]->$name_col = $employees_absen->count_status_absen_uuid;
        }
    // ==========================================  END DAY WORK EMPLOYEE status absen
    
    // ==========================================  HOUR METER EMPLOYEE
        // TO GET count hm each price each employee
        /* the data
        [
            price_hm
        ]
        */
        foreach($hour_meter_prices as $item){
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
            $hm_uui_pay = 'pay_'.$item->uuid;

            foreach($employee_hms as $employee_hm){
                $pay = $item->value * $employee_hm->hour_meter_value;
                $employees[$employee_hm->employee_uuid]->$hm_uuid = $employee_hm->hour_meter_value;
                $employees[$employee_hm->employee_uuid]->hm_pay_total = $employees[$employee_hm->employee_uuid]->hm_pay_total + $pay;
                $employees[$employee_hm->employee_uuid]->$hm_uui_pay =  $pay ;
            }
        }
    // ==========================================  END HOUR METER EMPLOYEE

    // ==========================================  HAULING EMPLOYEE
        foreach($companies as $company){
            $employee_tonases = EmployeeTonase::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->where('company_uuid', $company->uuid)
            ->groupBy(
                'employee_uuid',
            )
            ->select( 
                'employee_uuid',
                DB::raw("SUM(employee_tonases.tonase_full_value) as tonase_full_value")
            )
            ->get();

            $tonase_uuid = 'tonase_'.$company->uuid;
            $tonase_uui_pay = 'pay_tonase_'.$company->uuid;

            foreach($employee_tonases as $employee_tonase){
                // if(empty($employees[$employee_tonase->employee_uuid]->tonase_pay_total)){
                //     $employees[$employee_tonase->employee_uuid]->tonase_pay_total = 0;
                // }
                $employees[$employee_tonase->employee_uuid]->$tonase_uuid = round($employee_tonase->tonase_full_value, 3);
                $pay_ton = round($company->hauling_price * $employee_tonase->tonase_full_value, 3);
                $employees[$employee_tonase->employee_uuid]->tonase_pay_total = $employees[$employee_tonase->employee_uuid]->tonase_pay_total + $pay_ton;
                $employees[$employee_tonase->employee_uuid]->$tonase_uui_pay =  $pay_ton;
            }
        }
    // ==========================================  END HAULING EMPLOYEE

    // ==========================================  PREMI EMPLOYEE
        foreach($premis as $premi){
            $employee_premis = EmployeePremi::where('premi_uuid', $premi->uuid)
            ->get();

            $name_premi = $premi->uuid ;
            $name_premi_pay = 'pay_premi_'.$premi->uuid ;
            
            // return view('datatableshow', [ 'data'         => $employee_premis]);
            // dd($employee_premis);
            // $production_premi = ;
            
            if(empty($productions[$premi->uuid]->value_production)){
                $production_premi = 0;
            }else{
                $production_premi = (float)$productions[$premi->uuid]->value_production;
            }
            
            foreach($employee_premis as $emp_premi){
                $employees[$emp_premi->employee_uuid]->$name_premi = $emp_premi->premi_value;
                $premi_pay = $emp_premi->premi_value * $production_premi;
                
                $employees[$emp_premi->employee_uuid]->premi_pay_total =  $employees[$emp_premi->employee_uuid]->premi_pay_total+ $premi_pay;
                $employees[$emp_premi->employee_uuid]->$name_premi_pay =  $premi_pay ;
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

        foreach($payments as $payment){
            $employees[$payment->employee_uuid]->payment_pay_total = $payment->payment_pay_total;
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

        foreach($EmployeePaymentOther as $payment_other_pay_total){
            $employees[$payment_other_pay_total->employee_uuid]->payment_other_pay_total= $payment_other_pay_total->payment_other_pay_total;
        }
    // ==========================================  END PAYMENT OTHER EMPLOYEE


        // Employee::where('uuid', 'RJ-221267')->delete();

        foreach($employees as $employee){
            // COUNT SALARY PAY
            $date_start_contract = $employee->date_start_contract;
            $date2 = $year_month.'-'.$day_month;
            $date1 = $date_start_contract;
            $employee->long_work = ResponseFormatter::countMonthLongWork($date1,$date2);


            if($employee->long_work == 0){
                $employee->salary_payed = round(ResponseFormatter::countDayLongWork($date1,$date2) * $employee->salary/$day_month, 3);
                $employee->insentif_pay = round(ResponseFormatter::countDayLongWork($date1,$date2) * $employee->insentif/$day_month, 3);
                $employee->tunjangan_pay = round(ResponseFormatter::countDayLongWork($date1,$date2) * $employee->tunjangan/$day_month, 3);
            }else{
                    $employee->salary_payed = $employee->salary;
                    $employee->insentif_pay = $employee->insentif;
                    $employee->tunjangan_pay = $employee->tunjangan;
            }
            if($employee->unpay_absen_count > 0){
                $employee->salary_payed = round(($employee->pay_absen_count + $employee->cut_absen_count + $employee->A_count ) * $employee->salary/$day_month, 3);
                $employee->insentif_pay = round(($employee->pay_absen_count + $employee->cut_absen_count + $employee->A_count )  * $employee->insentif/$day_month, 3);
                $employee->tunjangan_pay = round(($employee->pay_absen_count + $employee->cut_absen_count + $employee->A_count )  * $employee->tunjangan/$day_month, 3);
            }

            $employee->count_day_unwork = $employee->A_absen_count + $employee->cut_absen_count;

            $employee->gaji_kotor = round($employee->payment_other_pay_total+$employee->payment_pay_total+$employee->tunjangan_pay+$employee->insentif_pay+$employee->salary_payed + $employee->hm_pay_total + $employee->tonase_pay_total + $employee->premi_pay_total);
            $employee->extra_salary = round($employee->payment_pay_total+$employee->hm_pay_total + $employee->tonase_pay_total + $employee->premi_pay_total, 3);
            $employee->half_extra_salary = round($employee->extra_salary/2, 3);
            $employee->main_salary =  round($employee->tunjangan_pay+$employee->insentif_pay+$employee->salary_payed , 3);
            $employee->jkk_pay =  round($employee->is_bpjs_ketenagakerjaan_pay *50 * $jkk_percent / 100,0);
            $employee->jk_pay =  round($employee->is_bpjs_ketenagakerjaan_pay *50 * $jk_percent / 100,0);
            $employee->kes_pay =  round($employee->is_bpjs_ketenagakerjaan_pay *50 * $kes_percent /100,0);
            $employee->brutto_salary = $employee->main_salary + $employee->jkk_pay + $employee->half_extra_salary + $employee->kes_pay + $employee->jk_pay + $employee->payment_other_pay_total;
          
           
            $employee->position_percent = round($employee->brutto_salary * $position_percent /100, 0);
            if($employee->position_percent > 500000){
                $employee->position_percent = 500000;
            }

            $employee->jht_pay =  round($employee->is_bpjs_ketenagakerjaan_pay,2) ;
            $employee->pensiun_pay =  round($employee->salary_payed * $pensiun_percent /100,2) ;
            $employee->netto_month =  round($employee->brutto_salary - $employee->position_percent -$employee->jht_pay-$employee->pensiun_pay,0);
            $employee->netto_year = ($employee->netto_month * 12) - ($employee->payment_other_pay_total *11);
            
            $employee->pph21_month = $employee->netto_year - $tax_statuses[strtoupper($employee->tax_status)]->tax_status_value;
            if($employee->pph21_month > 0){
                $employee->pph21_month = round($employee->pph21_month * $percent_pph21 /100 / 12,0);
            }else{
                $employee->pph21_month = 0;
            }

            $employee->salary_netto = round($employee->gaji_kotor - $employee->pph21_month - $employee->is_bpjs_ketenagakerjaan_pay -$employee->is_bpjs_kesehatan_pay- $employee->is_bpjs_pensiun_pay,0);
            $employee->cutted_total = $employee->pph21_month + $employee->is_bpjs_ketenagakerjaan_pay + $employee->is_bpjs_kesehatan_pay + $employee->is_bpjs_pensiun_pay;

            $employee->salary_netto_adjust_moded = round($employee->salary_netto / 1000,0);
            $employee->salary_netto_adjust = round($employee->salary_netto_adjust_moded * 1000,0);
            
            $employee->salary_netto_before_cut_debt =  $employee->salary_netto_adjust;
            $employee->salary_netto_adjust_mod = $employee->salary_netto -$employee->salary_netto_adjust ;
            $employee->total_bpjs =    $employee->is_bpjs_kesehatan_pay + $employee->is_bpjs_ketenagakerjaan_pay + $employee->is_bpjs_pensiun_pay ;
            $employee->brutto_slip =  $employee->total_bpjs + $employee->salary_netto_adjust +  $employee->pph21_month + $employee->is_bpjs_ketenagakerjaan_pay + $employee->is_bpjs_kesehatan_pay + $employee->is_bpjs_pensiun_pay + $employee->jkk_pay + $employee->jk_pay + $employee->kes_pay;
            $symbol = '-';
            $variabel_1 = 'salary';

            // hitung potongan
            if($employee->count_day_unwork > 0){
                $hasil_sebelum = 0;
                $hasil_grup = 0;
                
           
                //$dataaaa = [];
                foreach($formulas as $fml){
                    $hasil_sebelum = 0;
                    $hasil_grup = 0;
                    //$dataaaa['uuid'] = $fml->uuid;
                    $izin = ($fml->uuid =='IZIN')?true:false;
                    $alpa = ($fml->uuid =='ALPA')?true:false;

                    $day_alpa = ($employee->A_absen_count > 0)?true:false;
                    $day_izin = ($employee->cut_absen_count > 0)?true:false;

                    if($izin == $day_izin){
                        $is_formula = true;
                    }elseif($alpa == $day_alpa){
                        $is_formula = true;
                    }else{
                        $is_formula = false;
                    }
                    if($is_formula == true){
                        foreach($fml->group_formula as $g_fml){
                            if($g_fml->group_formula_order == 1){
                                foreach($g_fml->variable_counts as $variable_count_formula){
                                    $nama_col =  $variable_count_formula->variable_code;
                                    $symbol = $variable_count_formula->symbol_count;
                                    if($variable_count_formula->order_number == 1){
                                        $hasil_sebelum = $employee->$nama_col;
                                        //$dataaaa[$nama_col.$g_fml->group_formula_order.'-'.$variable_count_formula->order_number] = $hasil_sebelum;
                                        
                                    }else{
                                        if($variable_count_formula->variable_uuid == 'NILAI'){
                                            $hasil_sebelum = AllowanceController::Maths($hasil_sebelum,  $variable_count_formula->value_value_variable, $symbol);
                                            //$dataaaa[$nama_col.$g_fml->group_formula_order.'-'.$variable_count_formula->order_number]  = $variable_count_formula->value_value_variable;
                                            //$dataaaa['symbol-'.$nama_col.$g_fml->group_formula_order.'-'.$variable_count_formula->order_number]  = $symbol;
                                        }else{
                                            $hasil_sebelum = AllowanceController::Maths($hasil_sebelum,  $employee->$nama_col, $symbol);
                                            //$dataaaa[$nama_col.$g_fml->group_formula_order.'-'.$variable_count_formula->order_number]  =  $employee->$nama_col;
                                            //$dataaaa['symbol-'.$nama_col.$g_fml->group_formula_order.'-'.$variable_count_formula->order_number]  = $symbol;
                                        }
                                    }
                                }
                            }else{
                                $hasil_grup = $hasil_sebelum;
                                foreach($g_fml->variable_counts as $variable_count_formula){
                                    $nama_col =  $variable_count_formula->variable_code;
                                    $symbol = $variable_count_formula->symbol_count;
                                    if($variable_count_formula->order_number == 1){
                                        $hasil_sebelum = $employee->$nama_col;
                                        //$dataaaa[$nama_col.$g_fml->group_formula_order.'-'.$variable_count_formula->order_number]  = $hasil_sebelum;
                                    }else{
                                        if($variable_count_formula->variable_uuid == 'NILAI'){
                                            $hasil_sebelum = AllowanceController::Maths($hasil_sebelum,  $variable_count_formula->value_value_variable, $symbol);
                                            //$dataaaa[$nama_col.$g_fml->group_formula_order.'-'.$variable_count_formula->order_number] = $variable_count_formula->value_value_variable;
                                            //$dataaaa['symbol-'.$nama_col.$g_fml->group_formula_order.'-'.$variable_count_formula->order_number]  = $symbol;
                                        }else{
                                            $hasil_sebelum = AllowanceController::Maths($hasil_sebelum,  $employee->$nama_col, $symbol);
                                            //$dataaaa['symbol-'.$nama_col.$g_fml->group_formula_order.'-'.$variable_count_formula->order_number]  = $symbol;
                                            //$dataaaa[$nama_col.$g_fml->group_formula_order.'-'.$variable_count_formula->order_number] = $employee->$nama_col;
                                        }
                                    }
                                }
                                $symbol = $g_fml->group_formula_symbol;
                                $hasil_sebelum = AllowanceController::Maths($hasil_grup,  $hasil_sebelum, $symbol);
                               
                            }
                            //$dataaaa['hasil-group'.$g_fml->group_formula_order] = $hasil_sebelum;
                        }
                    }
                    
                    if($fml->uuid == 'IZIN'){
                        
                       
                        $employee->cut_absen_loan =  $hasil_sebelum;
                    }else{ 
                        $employee->cut_alpa_loan =  $hasil_sebelum;
                    }
                }
            }

        }

        // dd('here');
        $employee_payment_debts = EmployeePaymentDebt::join('employee_debts','employee_debts.uuid', 'employee_payment_debts.debt_uuid')
        ->whereYear('employee_payment_debts.date_payment_debt', $year)
        ->whereMonth('employee_payment_debts.date_payment_debt', $month)
        ->get([
            'employee_debts.employee_uuid',
            'employee_payment_debts.value_payment_debt',
            ]
        );

        foreach($employee_payment_debts as $employee_payment_debt){
            $employees[$employee_payment_debt->employee_uuid]->cut_debt =   $employee_payment_debt->value_payment_debt;
            $employees[$employee_payment_debt->employee_uuid]->salary_netto_adjust  = $employees[$employee_payment_debt->employee_uuid]->salary_netto_adjust - $employee_payment_debt->value_payment_debt;
        }

        foreach($employees as $avg){
            // $position = $avg->position;
            if($avg->salary_netto_adjust > 0){
                if(empty($averagge[$avg->position_uuid])){
                    $averagge[$avg->position_uuid] = [
                        'value' => $avg->salary_netto_adjust,
                        'position' => $avg->position,
                        'count' => 1
                    ];
                    // $averagge[$averagge[$avg->position_uuid]] = $avg->salary_netto_adjust;
                }else{
                    $averagge[$avg->position_uuid] = [
                        'value' => $averagge[$avg->position_uuid]['value'] +$avg->salary_netto_adjust,
                        'position' => $avg->position,
                        'count' => $averagge[$avg->position_uuid]['count'] +1
                    ];
                }
            }
          
        }

        foreach($averagge as $avg=>$val){
            $av=  $averagge[$avg]['value']/ $averagge[$avg]['count'];
            $averagge[$avg]['avg'] =  $av;
        }

        if($request->from == 'index'){
            return ResponseFormatter::toJson($averagge, 'Data Averagge');
        }
        
        // dd($employees['MBLE-130110']);
        // return view('datatableshow', [ 'data'         => $employees]);
        // return'a';
        return Datatables::of($employees)
        ->make(true);
    }

    public static function Maths($data_1 = 0, $data_2 = 0 , $symbol_math){
        if($symbol_math == '-'){
            return $data_1 - $data_2;
        }
        if($symbol_math == '+'){
            return $data_1 + $data_2;
        }
        if($symbol_math == '/'){
            return $data_1 / $data_2;
        }
        if($symbol_math == 'x'){ 
            return $data_1 * $data_2;
        }
    }    
}
