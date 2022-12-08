<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Company;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\Employee\EmployeePayment;
use App\Models\Employee\EmployeePaymentOther;
use App\Models\Employee\EmployeePremi;
use App\Models\Employee\EmployeeTonase;
use App\Models\HourMeterPrice;
use App\Models\Identity;
use App\Models\Premi;
use App\Models\Production;
use App\Models\TaxStatus;
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
        
     
        dd($hms['MBLE-0219120106']->hour_meter_value);

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

    public function moreAnyData($year_month){
        $date = explode("-", $year_month);

    // public function moreAnyData(Request $request){
    //     $year_month = $request->year_month;
    //     $date = explode("-", $request->year_month);
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
        $companies = Company::join('coal_froms', 'coal_froms.company_uuid', 'companies.uuid')
        ->get([
            'coal_froms.*'
        ]);

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

        $tax_status = TaxStatus::all();
        $tax_statuses = $tax_status->keyBy(function ($item) {
            return strval(str_replace('-','/',$item->uuid));
        });

        $last_day = ResponseFormatter::getEndDay($year_month);

        $datas = Employee::leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->leftJoin('employee_salaries','employee_salaries.employee_uuid','employees.uuid')
        ->get([
            'employees.is_bpjs_kesehatan',
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
        $premis = Premi::all();

        foreach($employees as $employee){
            
            foreach($hour_meter_prices as $item){
                $hm_uuid = $item->uuid;
                $hm_uui_pay = 'pay_'.$item->uuid;
                $employee->$hm_uuid = 0;
                $employee->$hm_uui_pay = 0;
                $employee->hm_pay_total= 0;
            }
            foreach($companies as $company){
                $tonase_uuid = 'tonase_'.$company->uuid;
                $tonase_uui_pay = 'pay_'.$company->uuid;

                $employee->$tonase_uuid = 0;
                $employee->$tonase_uui_pay = 0;
                $employee->tonase_pay_total= 0;
            }
            // dd($premis);
            foreach($premis as $premi){
                $name_premi = $premi->uuid ;
                $name_premi_pay = 'pay_premi_'.$premi->uuid ;
                $employee->$name_premi = 0;
                $employee->$name_premi_pay = 0;
            }

            $date_start_contract = $employee->date_start_contract;
            $date2 = $year_month.'-'.$last_day;
            $date1 = $date_start_contract;
            $employee->long_work = ResponseFormatter::countMonthLongWork($date1,$date2);
            if($employee->long_work == 0){
                $employee->salary_payed = round(ResponseFormatter::countDayLongWork($date1,$date2) * $employee->salary/$last_day, 2);
                $employee->insentif_pay = round(ResponseFormatter::countDayLongWork($date1,$date2) * $employee->insentif/$last_day, 2);
                $employee->tunjangan_pay = round(ResponseFormatter::countDayLongWork($date1,$date2) * $employee->tunjangan/$last_day, 2);
               
            }else{
                $employee->salary_payed = $employee->salary;
                $employee->insentif_pay = $employee->insentif;
                $employee->tunjangan_pay = $employee->tunjangan;
            }
            // return $employee->is_bpjs_kesehatan;
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

            $employee->premi_total_pay = 0;
            $employee->payment_pay = 0;
            $employee->payment_other_total = 0;
        }

        foreach($hour_meter_prices as $item){
            $employee_hms =  EmployeeHourMeterDay::where('hour_meter_price_uuid', $item->uuid)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->groupBy(
                'employee_uuid',
            )
            ->select( 
                'employee_uuid',
                DB::raw("SUM(employee_hour_meter_days.value) as hour_meter_value")
            )
            ->get();

            $hm_uuid = $item->uuid;
            $hm_uui_pay = 'pay_'.$item->uuid;
            foreach($employee_hms as $employee_hm){
                if(empty($employees[$employee_hm->employee_uuid]->hm_pay_total)){
                    $employees[$employee_hm->employee_uuid]->hm_pay_total = 0;
                }
                $pay = $item->value * $employee_hm->hour_meter_value;
                $employees[$employee_hm->employee_uuid]->$hm_uuid = $employee_hm->hour_meter_value;
                $employees[$employee_hm->employee_uuid]->hm_pay_total = $employees[$employee_hm->employee_uuid]->hm_pay_total + $pay;
                $employees[$employee_hm->employee_uuid]->$hm_uui_pay =  $pay ;
            }
        }

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
            $tonase_uui_pay = 'pay_'.$company->uuid;
            foreach($employee_tonases as $employee_tonase){
                if(empty($employees[$employee_tonase->employee_uuid]->tonase_pay_total)){
                    $employees[$employee_tonase->employee_uuid]->tonase_pay_total = 0;
                }
                $employees[$employee_tonase->employee_uuid]->$tonase_uuid = round($employee_tonase->tonase_full_value, 2);
                $pay_ton = round($company->hauling_price * $employee_tonase->tonase_full_value,2);
                $employees[$employee_tonase->employee_uuid]->tonase_pay_total = $employees[$employee_tonase->employee_uuid]->tonase_pay_total + $pay_ton;
                $employees[$employee_tonase->employee_uuid]->$tonase_uui_pay =  $pay_ton;
            }
        }

        foreach($premis as $premi){
            $employee_premis = EmployeePremi::where('premi_uuid', $premi->uuid)
            ->get();

            $name_premi = $premi->uuid ;
            $name_premi_pay = 'pay_premi_'.$premi->uuid ;

            // $production_premi = ;

            if(empty($productions[$premi->uuid]->value_production)){
                $production_premi = 0;
            }else{
                $production_premi = (float)$productions[$premi->uuid]->value_production;
            }

            foreach($employee_premis as $emp_premi){
                $employees[$emp_premi->employee_uuid]->$name_premi = $emp_premi->premi_value;
                $premi_pay = $emp_premi->premi_value * $production_premi;
                
                $employees[$emp_premi->employee_uuid]->premi_total_pay =  $employees[$emp_premi->employee_uuid]->premi_total_pay+ $premi_pay;
                $employees[$emp_premi->employee_uuid]->$name_premi_pay =  $premi_pay ;
            }
        }

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

        foreach($EmployeePaymentOther as $payment_other_total){
            $employees[$payment_other_total->employee_uuid]->payment_other_total= $payment_other_total->payment_other_total;
        }


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
            $employees[$payment->employee_uuid]->payment_pay= $payment->payment_pay;
        }

        

        foreach($employees as $employee){
            $employee->gaji_kotor = round($employee->payment_other_total+$employee->payment_pay+$employee->tunjangan_pay+$employee->insentif_pay+$employee->salary_payed + $employee->hm_pay_total + $employee->tonase_pay_total + $employee->premi_total_pay);
            $employee->extra_salary = round($employee->payment_pay+$employee->hm_pay_total + $employee->tonase_pay_total + $employee->premi_total_pay, 2);
            $employee->half_extra_salary = round($employee->extra_salary/2,2);
            $employee->main_salary =  round($employee->tunjangan_pay+$employee->insentif_pay+$employee->salary_payed , 2);
            $employee->jkk_pay =  round($employee->is_bpjs_ketenagakerjaan_pay *50 * $jkk_percent / 100,0);
            $employee->jk_pay =  round($employee->is_bpjs_ketenagakerjaan_pay *50 * $jk_percent / 100,0);
            $employee->kes_pay =  round($employee->is_bpjs_ketenagakerjaan_pay *50 * $kes_percent /100,0);
            $employee->brutto_salary = $employee->main_salary + $employee->jkk_pay + $employee->half_extra_salary + $employee->kes_pay + $employee->jk_pay;
          
           
            $employee->position_percent = round($employee->brutto_salary * $position_percent /100, 0);

            $employee->jht_pay =  round($employee->is_bpjs_ketenagakerjaan_pay,2) ;
            $employee->pensiun_pay =  round($employee->salary_payed * $pensiun_percent /100,2) ;
            $employee->netto_month =  round($employee->brutto_salary - $employee->position_percent -$employee->jht_pay-$employee->pensiun_pay,0);
            $employee->netto_year = ($employee->netto_month * 12) - ($employee->payment_other_total *11);
            
            $employee->pph21_month = $employee->netto_year - $tax_statuses[strtoupper($employee->tax_status)]->tax_status_value;
            if($employee->pph21_month > 0){
                $employee->pph21_month = round($employee->pph21_month * $percent_pph21 /100 / 12,0);
            }else{
                $employee->pph21_month = 0;
            }

            $employee->salary_netto = round($employee->gaji_kotor - $employee->pph21_month - $employee->is_bpjs_ketenagakerjaan_pay -$employee->is_bpjs_kesehatan_pay- $employee->is_bpjs_pensiun_pay,0);
            $employee->salary_netto_adjust_moded = round($employee->salary_netto / 1000,0);
            
            $employee->salary_netto_adjust = round($employee->salary_netto_adjust_moded * 1000,0);
            $employee->salary_netto_adjust_mod = $employee->salary_netto -$employee->salary_netto_adjust ;


        }
        // var_dump($employees);die;
        // ddd($employees);
        

        return view('datatableshow', [ 'data'         => $employees]);


        return Datatables::of($employees)
        ->make(true);
    }
}
