<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeTotalHmMonth;
use App\Models\HourMeterPrice;
use App\Models\StatusAbsen;
use App\Models\UserDetail\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\Storage;

use File;

use Response;


class EmployeeAbsenController extends Controller
{
    public function indexPayrol($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'absensi'
        ];
        return view('payrol.absensi.index', [
            'title'         => 'Add People',
            'month'     => $year.'-'.$month,
            'layout'    => $layout
        ]);
   }
   public function exportPayrol($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        return response()->download('7.xlsx');

    $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH'];
    $createSpreadsheet = new spreadsheet();
    $createSheet = $createSpreadsheet->getActiveSheet();
    $createSheet->setCellValue('A1', 'nama');

    $data = EmployeeTotalHmMonth::join('employees','employees.uuid','employee_total_hm_months.employee_uuid')
    ->join('user_details','user_details.uuid','employees.user_detail_uuid')
    ->join('positions','positions.uuid','employees.position_uuid')
    ->join('hour_meter_prices','hour_meter_prices.uuid', 'employee_total_hm_months.hour_meter_price_uuid')
    ->where('employee_total_hm_months.month', 9)
    ->orderBy('user_details.name')
    ->get([
        'user_details.name',
        'hour_meter_prices.uuid as name_hm',
        'employee_total_hm_months.value',
        'employees.nik_employee as nik_employee',
        'positions.position',
        'employees.uuid as employee_uuid'
    ]);
    $hour_meter_priceses = HourMeterPrice::all();
    $count = $data->count()/$hour_meter_priceses->count();
    
    $dataHM= array();

    $j = 0;
    for($i=0; $i< $count;$i++){
        foreach($hour_meter_priceses as $prices){
            $d[$data[$j]->name_hm]= $data[$j]->value;
            $j++;
         }
         $dataHM[]=[
            'name'  => $data[$j-1]->name,
            'employee_uuid' => $data[$j-1]->employee_uuid,
            'position'  =>$data[$j-1]->position,
            'nik_employee'=> $data[$j-1]->nik_employee,
            'hm'    => $d,
         ];

    }
    // dd($dataHM);
        $createSheet->setCellValue('A1', 'NIK');
        $createSheet->setCellValue('B1', 'NAMA');
        $createSheet->setCellValue('C1', 'JABATAN');
        $i = 3;
        foreach($hour_meter_priceses as $p){
            $createSheet->setCellValue($abjads[$i++].'1', $p->name);
        }
        
        $j = 2;
        foreach($dataHM as $d){
            
            $createSheet->setCellValue($abjads[0].$j, $d['nik_employee']);
            $createSheet->setCellValue($abjads[1].$j, $d['name']);
            $createSheet->setCellValue($abjads[2].$j, $d['position']);
            $i = 4;
            // dd($d['hm']);
            foreach($hour_meter_priceses as $p){
                $createSheet->setCellValue($abjads[$i++].$j, $d['hm'][$p->uuid]);
            }
            $j++;
        }

        $crateWriter = new Xls($createSpreadsheet);
        $crateWriter->save('7.xlsx');
    return "done";

}
   public function importPayrol(Request $request, $year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

    $this->validate($request, [
        'uploaded_file' => 'required'
    ]);
    $the_file = $request->file('uploaded_file');
    
   
    try{
        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet        = $spreadsheet->getActiveSheet();
        $row_limit    = $sheet->getHighestDataRow(); //283
        $column_limit = $sheet->getHighestDataColumn();//M

        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH'];

        $numColumn = ResponseFormatter::getNumArray($column_limit, $abjads);

        // get key_excell get all date
        for($i=4; $i<=$numColumn; $i++){
            $key_excel[] = $sheet->getCell( $abjads[$i] . 1 )->getValue();
        }

        $up = array();
        $errors = array();
        $updside = array();
        // alll employee
        for($i=2; $i <= $row_limit; $i++){
            $nik_employee = $sheet->getCell( 'A' . $i )->getValue();
            
            $day = 1;
            foreach($key_excel as $k_excel){
                $employee =  [
                    'uuid'  => 'absensi-'.$year.'-'.$month.'-'.$day.'-'.$nik_employee,
                    'employee_uuid'  => 'employee-'.$nik_employee,
                    'date' => $year.'-'.$month.'-'.$day,
                    'status_absen_uuid'=> $sheet->getCell( $abjads[$day+3]. $i )->getValue(),
                ];
                $up[] = $employee;
                $store = EmployeeAbsen::create($employee);
                if(!$store){
                    $errors[] = $employee;
                }
                $day++;
            }
        }
        return $up;
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
   }
   public function dataEmployeeAbsen($year_month){

        $status_absen = StatusAbsen::all();
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $employees = Employee::getAll();
            foreach($employees as $employee){
                $starus_absen = array();
               
                    $data = EmployeeAbsen::whereYear('employee_absens.date', $year)
                    ->whereMonth('employee_absens.date', $month)
                    ->where('employee_absens.employee_uuid', $employee->uuid)
                    ->where('employee_absens.status_absen_uuid', "DS")
                    ->count();
                    $uud ="DS";
                    $employee->$uud = $data;
                    $employee->date = $year_month;
            }
            return Datatables::of($employees)
            ->addColumn('action', function ($model) {
                $url = "/payrol/absensi/month/".$model['date']."/".$model['uuid'];
               
                return '<a class="text-decoration-none" href="'.$url.'">
                                <button class="btn btn-secondary py-1 px-2 mr-1">
                                    <i class="icon-copy bi bi-eye-fill"></i>
                                </button>
                            </a>
                ';
            })        
            ->addColumn('names', function ($model) {
               
                return '<h6>'.$model->name.'</br>'.$model->position.'</h6>
                ';
            }) 
            ->escapeColumns('names')
            ->make(true);
   }
   
   public function showPayrol($year_month, $employee_uuid){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $datetime = Carbon::createFromFormat('Y-m', $year.'-'.$month);

        $lastDay = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');

        for($i=1; $i <= $lastDay; $i++){

            $dateGet =$year.'-'.$month.'-'.$i;
            $data_absen_day = EmployeeAbsen::join('status_absens','status_absens.uuid','employee_absens.status_absen_uuid')
            ->where('employee_uuid', $employee_uuid)
            ->where('date', $dateGet)->get([
                'status_absens.status_absen_code',
                'employee_absens.*'
            ])->first();
           
            // dd($data_absen_day);
            
            if(!$data_absen_day){
                $data_absen_day =collect([
                    'date'=> $dateGet,
                    'cek_log'=> '',
                    'status_absen_code'=> 'NULL'
                ]) ;
            }else{
                if($data_absen_day['cek_log'] == ''){
                    $data_absen_day['cek_log'] = "NULL";
                }
            }
            

            $data_absens[] = $data_absen_day;

        }
        // dd($data_absens);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => false,
            'javascript_form'       => false,
            'active'                        => 'admin-hr-absensi'
        ];
        return view('employee_absen.payrol.edit', [
            'title'         => 'Absensi HR',
            'absens'    => $data_absens,
            'month'     => $year_month,
            'nik_employee'     => $employee_uuid,
            'layout'        => $layout
        ]);
    // dd($data_absens);
    // $data_absens = EmployeeAbsen::where('employee_uuid', $employee_uuid)->get();
    // ->whereYear('payments.date', $year)
    // ->whereMonth('payments.date', $month)
    // return $data_absens;
   }

}
