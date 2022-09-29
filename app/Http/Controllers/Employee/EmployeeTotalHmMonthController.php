<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\EmployeeTotalHmMonth;
use App\Models\HourMeterPrice;
use App\Models\UserDetail\UserDetail;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class EmployeeTotalHmMonthController extends Controller
{
    public function indexPayrol($month){
        $date = explode('-', $month);

        $hour_meter_pricees = HourMeterPrice::all();
        $users = UserDetail::getAll();    
        
        // $month = 9;
        // foreach($users as $u){
        //     foreach($hour_meter_pricees as $hm){
        //         $store = EmployeeTotalHmMonth::create([
        //             'uuid' => $month.'-'.$u->employee_uuid.'-'.$hm->uuid,
        //             'employee_uuid' => $u->employee_uuid,
        //             'hour_meter_price_uuid' => $hm->uuid,
        //             'month' =>'2022-'.$month.'-28'
        //         ]);
        //     }
        // }
        // $month = 10;
        // foreach($users as $u){
        //     foreach($hour_meter_pricees as $hm){
        //         $store = EmployeeTotalHmMonth::create([
        //             'uuid' => $month.'-'.$u->employee_uuid.'-'.$hm->uuid,
        //             'employee_uuid' => $u->employee_uuid,
        //             'hour_meter_price_uuid' => $hm->uuid,
        //             'month' => '2022-'.$month.'-28'
        //         ]);
        //     }
        // }
        // $month = 11;
        // foreach($users as $u){
        //     foreach($hour_meter_pricees as $hm){
        //         $store = EmployeeTotalHmMonth::create([
        //             'uuid' => $month.'-'.$u->employee_uuid.'-'.$hm->uuid,
        //             'employee_uuid' => $u->employee_uuid,
        //             'hour_meter_price_uuid' => $hm->uuid,
        //             'month' =>'2022-'.$month.'-28'
        //         ]);
        //     }
        // }
        // $month = 12;
        // foreach($users as $u){
        //     foreach($hour_meter_pricees as $hm){
        //         $store = EmployeeTotalHmMonth::create([
        //             'uuid' => $month.'-'.$u->employee_uuid.'-'.$hm->uuid,
        //             'employee_uuid' => $u->employee_uuid,
        //             'hour_meter_price_uuid' => $hm->uuid,
        //             'month' =>'2022-'.$month.'-28'
        //         ]);
        //     }
        // }
        // return 'udin';
        // $hour_meter_pricees = HourMeterPrice::all()->groupBy('month');
        // dd($hour_meter_pricees);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'admin-hr',
            'active-sub'                        => 'employee'
        ];
        return view('payrol.hour_meter.index', [
            'title'         => 'Employee',
            'month'     => $month,
            'hour_meter_pricees' => $hour_meter_pricees,
            'layout'    => $layout
        ]);
    }

    public function exportPayrol($month){
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

   public function importPayrol(Request $request){
    // return 'aa';
    // dd($request);
    $month ="2022-09-28";
    $key_excell =array();
    $this->validate($request, [
        'uploaded_file' => 'required'
    ]);
    $the_file = $request->file('uploaded_file');
    // dd($the_file);
    $hour_meter_prices = HourMeterPrice::all();
    $p =array();
    foreach($hour_meter_prices as $price){
        $p[$price->name] = $price->uuid;
    }
   
    try{
        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet        = $spreadsheet->getActiveSheet();
        $row_limit    = $sheet->getHighestDataRow(); //283
        $column_limit = $sheet->getHighestDataColumn();//M

        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH'];

        $numColumn = ResponseFormatter::getNumArray($column_limit, $abjads);

        // get key_excell
        for($i=3; $i<=$numColumn; $i++){
            $key_excel[] = $sheet->getCell( $abjads[$i] . 1 )->getValue();
        }

        $up = array();
        $updside = array();

        for($i=2; $i <= $row_limit; $i++){
            $nik_employee = $sheet->getCell( 'A' . $i )->getValue();
            $no = 3;
            foreach($key_excel as $k_excel){
                $up[] = [
                    'uuid'  => 'employee-'.$nik_employee,
                    'nik_employee'  => $nik_employee,
                    'hour_meter_price_uuid' => $p[$k_excel],
                    'month' => $month,
                    'value'=> $sheet->getCell( $abjads[$no]. $i )->getValue(),
                    'i' => $i,
                    'abjad' => $abjads[$no],
                ];
                $updside[] =$up;
                $store = EmployeeTotalHmMonth::where('employee_uuid', 'employee-'.$nik_employee)
                ->where('hour_meter_price_uuid', $p[$k_excel])
                ->where('month', $month)
                ->update([
                    'value'=> $sheet->getCell( $abjads[$no]. $i )->getValue(),
                ]);
                $no++;
            }
        }
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
   }


    public function storePayrol(Request $request){
         $validatedData = $request->validate([
            'employee_uuid'      => '',
            'hour_meter_price_uuid'      => '',
            'month'      => '',
            'value'      => ''
        ]);
        $uuid = $validatedData['month'].'-'.$validatedData['employee_uuid'].'-'.$validatedData['hour_meter_price_uuid'];
        $store = EmployeeTotalHmMonth::updateOrCreate(['uuid' => $uuid], $validatedData );
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $store], 200);
    }
    public function dataHourMeterMonth($dt){
        $date = explode('-', $dt);
        $year = $date[0];
        $month = $date[1];
        $dataAny =  UserDetail::getAll();
        
        $data = EmployeeTotalHmMonth::join('employees','employees.uuid','employee_total_hm_months.employee_uuid')
        ->join('user_details','user_details.uuid','employees.user_detail_uuid')
        ->join('positions','positions.uuid','employees.position_uuid')
        ->join('hour_meter_prices','hour_meter_prices.uuid', 'employee_total_hm_months.hour_meter_price_uuid')
        ->whereMonth('employee_total_hm_months.month', $month)
        ->whereYear('employee_total_hm_months.month', $year)
        ->orderBy('user_details.name')
        ->get([
            'user_details.name',
            'employee_total_hm_months.month',
            'hour_meter_prices.uuid as name_hm',
            'employee_total_hm_months.value',
            'employees.nik_employee as nik_employee',
            'positions.position',
            'employees.uuid as employee_uuid'
        ]);
        // return $data;
        // dd($data);
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
        
        // return $data;
        
       
        return Datatables::of($dataHM)
        ->addColumn('action', function ($model) {
            $url = "/admin/vehicle/";
            $url_edit = "'".$url.$model['employee_uuid']."'";
            $url_delete = "'".$url."delete/'";
            return '<a class="text-decoration-none" href="/admin-hr/employees/contract/show/' . $model['nik_employee']. '">
                            <button class="btn btn-secondary py-1 px-2 mr-1">
                                <i class="icon-copy bi bi-eye-fill"></i>
                            </button>
                        </a>
            ';
        })
        ->addColumn('input', function ($model) {
            $url = "/admin/vehicle/";
            $url_edit = "'".$url.$model['employee_uuid']."'";
            $url_delete = "'".$url."delete/'";
            $hour_meter_priceses = HourMeterPrice::all();
            $element = '';
            $url = "'/payrol/store/'";
            $div = "'";
            foreach($hour_meter_priceses as $prices){
                $element = $element.'
                    <input  name="'.$model['employee_uuid'].$prices->uuid.'" 
                                id="'.$model['employee_uuid'].$prices->uuid.'" 
                                onchange="createPost('.$div.$model['employee_uuid'].$div.','.$div.$prices->uuid.$div.')"  
                                class="col-md-1 mr-1 form-control" 
                                value="'.$model['hm'][$prices->uuid].'" >
                ';
            }
            $element  = '
            <form id="'.$model['employee_uuid'].'" method="POST" action="/payrol/store" class="form-inline">
                '
                    .$element.
            '</form>';
            return $element;
        })
        ->escapeColumns('input')
        ->make(true);
    }
}
