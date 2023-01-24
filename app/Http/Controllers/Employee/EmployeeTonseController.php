<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\CoalFrom;
use App\Models\Company;

use Yajra\Datatables\Datatables;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeTonase;
use App\Models\Identity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use File;

class EmployeeTonseController extends Controller
{
    public function index(){
        $companies = Company::where('uuid','!=','MBLE' )->get();
        foreach($companies as $item){
            $item->coal_froms = CoalFrom::where('company_uuid', $item->uuid)->get();
        }

        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-tonase'
        ];
        return view('employee_tonase.index', [
            'title'         => 'Tonase',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'companies' => $companies,
            'nik_employee' => ''
        ]);
    }

    public function template($year_month){
        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $day_month = ResponseFormatter::getEndDay($year_month);

        $arr_coal_from = CoalFrom::join('companies','companies.uuid', 'coal_froms.company_uuid')->get([
            'companies.*',
            'coal_froms.*',
            'coal_froms.uuid as coal_from_uuid'
        ]);

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Tonase');
        
        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B2', 'Perusahaan');
        $createSheet->setCellValue('D2', 'Harga');
        
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);
        $createSheet->setCellValue('A5', 'No');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');

        for($i = 1; $i <= $day_month; $i++){  
            $first = $i + 3;
            $second = $first+1 + $day_month;
            $third = $second +1 + $day_month;
            $createSheet->setCellValue($abjads[$first].'5', $i);
            $createSheet->setCellValue($abjads[$second].'5', $i);
            $createSheet->setCellValue($abjads[$third].'5', $i);
        }

        $zip = new ZipArchive;
        $fileName = 'file/absensi/Tonase '.$year_month.'-'.rand(99,9999).'file.zip';
        if($zip->open($fileName, ZipArchive::CREATE) === TRUE){
            

            foreach($arr_coal_from as $coal_from){
                 $createSheet->setCellValue('D3', $coal_from->hauling_price);
                 $createSheet->setCellValue('C2', $coal_from->company_uuid);
                 $createSheet->setCellValue('E2', 'Asal Batu');
                 $createSheet->setCellValue('E3', $coal_from->coal_from);
                 $createSheet->setCellValue('F2', 'Kode Asal Batu');
                 $createSheet->setCellValue('F3', $coal_from->coal_from_uuid);

                $crateWriter = new Xls($createSpreadsheet);
                $name = 'file/absensi/Tonase -'.$coal_from->company_uuid.'-'.$coal_from->coal_from.'-'.$year_month.'-'.rand(99,9999).'file.xls';
                $crateWriter->save($name);
                $zip->addFile($name, $coal_from->company_uuid.'-'.$coal_from->coal_from.'-'.$year_month.'-'.rand(99,9999).'.xls.');
            }
        }
        $zip->close();
        return response()->download(public_path($fileName));
    }

    // butuh export untuk data
    public function export($year_month){
        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $datetime = Carbon::createFromFormat('Y-m', $year.'-'.$month);
        $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');

        
        $companies = Company::join('coal_froms', 'coal_froms.uuid', 'companies.uuid')
        ->get([
            'coal_froms.*'
        ]);

        $arr_coal_from = CoalFrom::join('companies','companies.uuid', 'coal_froms.company_uuid')->get([
            'companies.*',
            'coal_froms.*',
            'coal_froms.uuid as coal_from_uuid'
        ]);

        // dd($arr_coal_from);
  
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Tonase');
        
        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B2', 'Perusahaan');
        $createSheet->setCellValue('D2', 'Harga');
        
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);
        $createSheet->setCellValue('A5', 'No');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');

        $employees = Employee::noGet_employeeAll_detail()
        ->get();

        $arr_employee = Employee::noGet_employeeAll_detail()
        ->get();

        
        for($i = 1; $i <= $day_month; $i++){  
            $first = $i * 3 - 2;
            $second = $first+1;
            $third = $second + 1;
            $createSheet->setCellValue($abjads[$first+3].'5', $i); 
            $createSheet->setCellValue($abjads[$first+3].'4', 'rit');
            $createSheet->setCellValue($abjads[$second+3].'5', $i);            
            $createSheet->setCellValue($abjads[$second+3].'4', 'ton');
            $createSheet->setCellValue($abjads[$third+3].'5', $i);
            $createSheet->setCellValue($abjads[$third+3].'4', 'full');
        }

        $employee_row = 6;
        $no = 1;
            

               

        $zip = new ZipArchive;
        $fileName = 'file/absensi/Tonase '.$year_month.'-'.rand(99,9999).'file.zip';
        $arr_tonase_employee = Employee::noGet_employeeAll_detail()->join('employee_tonases','employee_tonases.employee_uuid', 'employees.uuid')
            ->whereYear('employee_tonases.date', $year)
            ->whereMonth('employee_tonases.date', $month)
            ->groupBy(
                'employee_tonases.employee_uuid',
                'employee_tonases.coal_from_uuid',
                'employee_tonases.date',
            )
            ->select( 
                'employee_tonases.coal_from_uuid',
                'employee_tonases.date', 
                'employee_tonases.employee_uuid',
                DB::raw("count(employee_tonases.tonase_value) as tonase_count"),
                DB::raw("sum(employee_tonases.tonase_value) as tonase_value"),                    
                DB::raw("sum(employee_tonases.tonase_full_value) as tonase_full_value"),
            )
            ->get();

        $arr_data = [];
        
        foreach($arr_tonase_employee as $tonase_employee){
            $arr_data[$tonase_employee->coal_from_uuid][$tonase_employee->employee_uuid][$tonase_employee->date] = [
                'ritase'    => $tonase_employee->tonase_count,
                'tonase_value'  => round($tonase_employee->tonase_value,2),
                'tonase_full_value' => round($tonase_employee->tonase_full_value, 2)
            ] ;
        }

        
        if($zip->open($fileName, ZipArchive::CREATE) === TRUE){
            for($i = 1; $i <= $day_month; $i++){  
                $first = $i * 3 - 2;
                $second = $first+1;
                $third = $second + 1;
                $createSheet->setCellValue($abjads[$first+3].'5', $i);
                $createSheet->setCellValue($abjads[$second+3].'5', $i);
                $createSheet->setCellValue($abjads[$third+3].'5', $i);
            }

            foreach($arr_coal_from as $coal_from){
                 $createSheet->setCellValue('D3', $coal_from->hauling_price);
                 $createSheet->setCellValue('C2', $coal_from->company_uuid);
                 $createSheet->setCellValue('E2', 'Asal Batu');
                 $createSheet->setCellValue('E3', $coal_from->coal_from);
                 $createSheet->setCellValue('F2', 'Kode Asal Batu');
                 $createSheet->setCellValue('F3', $coal_from->coal_from_uuid);

                $crateWriter = new Xls($createSpreadsheet);
                $name = 'file/absensi/Tonase -'.$coal_from->company_uuid.'-'.$coal_from->coal_from.'-'.$year_month.'-'.rand(99,9999).'file.xls';
                // ob_end_clean();

                $crateWriter->save($name);
                $zip->addFile($name, $coal_from->company_uuid.'-'.$coal_from->coal_from.'-'.$year_month.'-'.rand(99,9999).'.xls.');

            }


            // foreach($companies as $company){ 
            //     for($i = 1; $i <= $day_month; $i++){  
            //         $first = $i * 3 - 2;
            //         $second = $first+1;
            //         $third = $second + 1;
            //         $createSheet->setCellValue($abjads[$first+3].'5', $i);
            //         $createSheet->setCellValue($abjads[$second+3].'5', $i);
            //         $createSheet->setCellValue($abjads[$third+3].'5', $i);
            //     }
            //     $employee_row = 6;
            //     $no = 1;

                

            //     foreach($employees as $item){
            //         $createSheet->setCellValue( $abjads[0].$employee_row, $no);
            //         $createSheet->setCellValue( $abjads[1].$employee_row, $item->nik_employee);
            //         $createSheet->setCellValue( $abjads[2].$employee_row, $item->name);
            //         $createSheet->setCellValue( $abjads[3].$employee_row, $item->position);

            //         $data_tonase_employee = Employee::leftJoin('employee_tonases','employee_tonases.employee_uuid', 'employees.uuid')
            //         ->where('employee_tonases.employee_uuid', $item->employee_uuid)
                    
            //         ->where('employee_tonases.coal_from_uuid', $company->uuid)
            //         ->whereYear('employee_tonases.date', $year)->whereMonth('employee_tonases.date', $month)
            //         ->orderBy('employee_tonases.date', 'asc')
            //         ->groupBy(
            //             'employee_tonases.employee_uuid',
            //             'employee_tonases.date',
            //         )
            //         ->select( 
            //             'employee_tonases.date', 
            //             'employee_tonases.employee_uuid',
            //             DB::raw("count(employee_tonases.tonase_value) as tonase_count"),
            //             DB::raw("sum(employee_tonases.tonase_value) as tonase_value"),
            //         )
            //         ->get();
                    
            //         $item->data_tonase_employee = $data_tonase_employee;                
                

            //         for($i = 1; $i <= $day_month; $i++){  
            //             $first = $i * 3 - 2;
            //             $second = $first+1;
            //             $third = $second + 1;
            //             $cel_for = $abjads[$second+3].$employee_row;
            //             $formula = '=IF('.$abjads[$first+3].$employee_row.'>4,'.$cel_for.'*0.15+'.$cel_for.','.$cel_for.')';
            //             $createSheet->setCellValue($abjads[$first+3].$employee_row, '0');
            //             $createSheet->setCellValue($abjads[$second+3].$employee_row, '0');
            //             $createSheet->setCellValue($abjads[$third+3].$employee_row, $formula);
            //         }

            //         foreach($data_tonase_employee as $tonase){
            //             $date = $tonase->date;
            //             $date = explode('-', $date);
            //             $date_day = (int)$date[2];
            //             $first = $date_day * 3 - 2;
            //             $second = $first+1;
            //             $third = $second + 1;
                        
            //             if(!empty($tonase->tonase_count)){
            //                 $count = $tonase->tonase_count;
            //                 $value = $tonase->tonase_value;
            //             }else{
            //                 $count = 0;
            //                 $value = 0;
            //             }
            //             $createSheet->setCellValue($abjads[$first+3].$employee_row, $count);
            //             $createSheet->setCellValue($abjads[$second+3].$employee_row, $value);
            //         }
            //         $employee_row++;
            //         $no++;    

            //     }
            //     // dd($company);
            //     $createSheet->setCellValue('D3', $company->hauling_price);
            //     $createSheet->setCellValue('C2', $company->uuid);

            //     $crateWriter = new Xls($createSpreadsheet);
            //     $name = 'file/absensi/Tonase Perusahaan '.$company->uuid.'-'.$year_month.'-'.rand(99,9999).'file.xls';
            //     // ob_end_clean();

            //     $crateWriter->save($name);
            //     $zip->addFile($name, $company->uuid.'.xls.');
            // }
        }
        $zip->close();
        return response()->download(public_path($fileName));
    }

    //used good
    public static function funcStore($validatedData){
        $percent_bonus = 15;
        $ritase_bonus =5;        

        if($validatedData['ritase'] ){
            $tonase_each_ritase = $validatedData['tonase_value'] / $validatedData['ritase'];
            $tonase_each_ritase = round( $tonase_each_ritase,3);
            $sisa = round($validatedData['tonase_value']  - ($tonase_each_ritase * $validatedData['ritase']),3);

            if($validatedData['ritase'] >= $ritase_bonus){
                $tonase_full_bonus = $validatedData['tonase_full_value'] ;
                $each_tonase_full_bonus = round( $validatedData['tonase_full_value']/ $validatedData['ritase'],3);
                $sisa_bonus = round( $tonase_full_bonus - (round($each_tonase_full_bonus * $validatedData['ritase'] ,3) ));
            }else{
                $tonase_full_bonus = $tonase_each_ritase;
                $sisa_bonus  = 0;
            }

            
            $validatedData['employee_uuid'] =  $validatedData['nik_employee'];
            $validatedData['coal_from_uuid'] =  $validatedData['coal_from_uuid'];
            $validatedData['uuid'] = $validatedData['date'].'-'.$validatedData['company_uuid'].'-'.$validatedData['nik_employee'];
            $dd=[];
           
            for($i = 0; $i < $validatedData['ritase']; $i++){
                if($validatedData['ritase'] >= $ritase_bonus){
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                    $validatedData['tonase_full_value'] = $tonase_each_ritase + $tonase_each_ritase * $percent_bonus /100;  
                    $validatedData['tonase_full_value'] = round( $validatedData['tonase_full_value'],3);
                    
                }else{
                    $validatedData['tonase_full_value'] = $tonase_each_ritase;
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                }
                
                if($i == $validatedData['ritase'] - 1){
                    if($validatedData['ritase'] >=$ritase_bonus){
                      
                        $validatedData['tonase_value'] = $tonase_each_ritase + $sisa;
                        $validatedData['tonase_full_value_real'] = $validatedData['tonase_full_value'] = round($tonase_each_ritase + $tonase_each_ritase * $percent_bonus /100,3);  
                        $validatedData['tonase_full_value'] = round( $validatedData['tonase_full_value'],3) + $sisa_bonus;
                    }else{
                        $validatedData['tonase_full_value'] = $tonase_each_ritase+ $sisa;
                        $validatedData['tonase_value'] = $tonase_each_ritase+ $sisa;
                    }
                }
                
                $store = EmployeeTonase::create($validatedData);
                $dd[] = $validatedData;
            }    
        }
    }

    // used good
    public function import(Request $request){
        $the_file = $request->file('uploaded_file');
        
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
            // DESCRIPTION
            $month_hm =  $sheet->getCell( 'C3')->getValue();
            $year_hm = $sheet->getCell( 'C4')->getValue();
            $datetime = Carbon::createFromFormat('Y-m', $year_hm.'-'.$month_hm);
            $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');

            $price_code = $sheet->getCell( 'D3')->getValue();
            $company_uuid = $sheet->getCell( 'C2')->getValue();
            $coal_from_uuid = $sheet->getCell( 'f3')->getValue();

            $no_employee = 6;
            $employees = [];
            if($sheet->getCell( 'E'.'5')->getValue() == $sheet->getCell( 'F'.'5')->getValue()  ){
                
                while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                    $date_row = 3;
                    $nik_employee = ResponseFormatter::toUUID($sheet->getCell( 'B'.$no_employee)->getValue());

                    for($day =1; $day <= $day_month; $day++){//hm biasa

                        $first = $day * 3 - 2;
                        $second = $first+1;
                        $third = $second + 1;
                        
                        $cell_ritase = $abjads[$first+3].$no_employee;
                        $cell_tonase = $abjads[$second+3].$no_employee;
                        
                        if($sheet->getCell($cell_ritase)->getValue() != null){
                            $data_each_day = [
                                'nik_employee'  => $nik_employee,
                                'date'  => $year_hm.'-'.$month_hm.'-'.$day,
                                'ritase'       => $sheet->getCell($cell_ritase)->getValue(),
                                'tonase_value' => $sheet->getCell($cell_tonase)->getValue(),                    
                                'coal_from_uuid'  => $coal_from_uuid,                                
                                'price_code'  => $price_code,
                                'company_uuid'  => $company_uuid,
                            ];

                           
                            EmployeeTonseController::funcStore($data_each_day);
                            $employees[$day] = $data_each_day;    
                        }
                    } 
                    dd( $employees);
                    $no_employee++;
                }
            }else{
                while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                    $date_row = 3;
                    $nik_employee = ResponseFormatter::toUUID($sheet->getCell( 'B'.$no_employee)->getValue());

                    for($day =1; $day <= $day_month; $day++){//hm biasa
                        $cell_ritase = $abjads[$date_row+$day].$no_employee;
                        $cell_tonase = $abjads[$date_row+$day_month+$day+1].$no_employee;                        
                        $cell_full_tonase = $abjads[$date_row+$day_month+$day+1+$day_month+1].$no_employee;
                         
                        if($sheet->getCell($cell_ritase)->getValue() != null){
                            
                            $data_each_day = [
                                'nik_employee'  => $nik_employee,
                                'date'  => $year_hm.'-'.$month_hm.'-'.$day,
                                'ritase'       => $sheet->getCell($cell_ritase)->getValue(),
                                'tonase_value' => $sheet->getCell($cell_tonase)->getValue(),
                                'tonase_full_value' =>   $sheet->getCell($cell_full_tonase)->getValue(),
                                'coal_from_uuid'  => $coal_from_uuid,          
                                'price_code'  => $price_code,
                                'company_uuid'  => $company_uuid,
                            ];
                            // dd($data_each_day);
                            EmployeeTonase::where('employee_uuid', $nik_employee)->where('date', $data_each_day['date'])->where('coal_from_uuid',$coal_from_uuid)->delete();
                            EmployeeTonase::where('employee_uuid', $nik_employee)->where('date', $data_each_day['date'])->where('company_uuid',$company_uuid)->delete();
                            EmployeeTonseController::funcStore($data_each_day);
                            
                            $employees[$day] = $data_each_day;
                        }
    
                    }
                    $no_employee++;
                }
            }
            
            return back();
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function indexForEmployee($nik_employee){
        $employee = Employee::where('nik_employee',$nik_employee)->get()->first();
        $companies = Company::where('uuid','!=','MBLE' )->get();
        foreach($companies as $item){
            $item->coal_froms = CoalFrom::where('company_uuid', $item->uuid)->get();
        }
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'tonase-employee-me'
        ];
        return view('employee_tonase.employee.index', [
            'title'         => 'Tonase',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'companies' => $companies,
            'nik_employee' => $nik_employee
        ]);
    }

    public function showEmployeeMonth($nik_employee, $year_month){
        $arr_date = explode('-', $year_month);
        $month = $arr_date[1];
        $year = $arr_date[0];
        $employees = Employee::get_employee_all_latest();

        //coal from
            $companies = Company::where('uuid', '!=','MBLE')->get();
            $arr_coal_from = Company::join('coal_froms','coal_froms.company_uuid','companies.uuid')->get();

        
                foreach($companies as $item){
                    $item->coal_from = CoalFrom::where('company_uuid', $item->uuid)->get();
                }
                $arr_company = [];
                foreach($companies as $company){
                    $arr_company[$company->uuid]['detail'] =  $company;
                }
                foreach($arr_coal_from as $coal_from){
                    $arr_company[$coal_from->company_uuid]['coal_from'][$coal_from->uuid] =  $coal_from;
                }
        //coal from

        // count employee rit
            $count_rit_employee = EmployeeTonase::groupBy('employee_uuid','date')
            ->select( 
                'employee_uuid',
                'date',
                DB::raw("count(employee_uuid) as count_ritase")
            )
            ->get();

            $arr_count_rit_employee = [];
            foreach($count_rit_employee as $rit_employee){
                $arr_date= explode('-',$rit_employee->date);
                $arr_count_rit_employee[$rit_employee->employee_uuid][$arr_date[0]][(int)$arr_date[1]][(int)$arr_date[2]] =$rit_employee->count_ritase;
            }
        //end count employee rit

  
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-tonase'
        ];
        return view('employee_tonase.create', [
            'title'         => 'Tonase',
            'arr_company'   => $arr_company,
            'employees' => $employees,
            'arr_count_rit_employee' => $arr_count_rit_employee,
            'month' => $month,
            'year' => $year,
            'nik_employee'  =>$nik_employee,
            'layout'    => $layout
        ]);
    }
    public function create(){
        $month = null;
        $year = null;
        $nik_employee = null;
        $employees = Employee::get_employee_all_latest();

        //coal from
            $companies = Company::where('uuid', '!=','MBLE')->get();
            $arr_coal_from = Company::join('coal_froms','coal_froms.company_uuid','companies.uuid')->get();

        
                foreach($companies as $item){
                    $item->coal_from = CoalFrom::where('company_uuid', $item->uuid)->get();
                }
                $arr_company = [];
                foreach($companies as $company){
                    $arr_company[$company->uuid]['detail'] =  $company;
                }
                foreach($arr_coal_from as $coal_from){
                    $arr_company[$coal_from->company_uuid]['coal_from'][$coal_from->uuid] =  $coal_from;
                }
        //coal from

        // count employee rit
            $count_rit_employee = EmployeeTonase::groupBy('employee_uuid','date')
            ->select( 
                'employee_uuid',
                'date',
                DB::raw("count(employee_uuid) as count_ritase")
            )
            ->get();

            $arr_count_rit_employee = [];
            foreach($count_rit_employee as $rit_employee){
                $arr_date= explode('-',$rit_employee->date);
                $arr_count_rit_employee[$rit_employee->employee_uuid][$arr_date[0]][(int)$arr_date[1]][(int)$arr_date[2]] =$rit_employee->count_ritase;
            }
        //end count employee rit

  
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-tonase'
        ];
        return view('employee_tonase.create', [
            'title'         => 'Tonase',
            'arr_company'   => $arr_company,
            'employees' => $employees,
            'arr_count_rit_employee' => $arr_count_rit_employee,
            'month' => $month,
            'year' => $year,
            'nik_employee'  =>$nik_employee,
            'layout'    => $layout
        ]);
    }

    public function detail($nik_employee, $time){
        $date = explode("-", $time);
        $year = $date[0];
        $month = $date[1];
        $day = null;
        $year_month_day = null;
        $year_month = null;

        if(!empty($date[2])){
            $day = $date[2];
            $year_month_day = $time;
        }else{
            $year_month = $time;
        }

        $employees = Employee::getAll();
        $companies = Company::where('uuid', '!=','MBLE')->get();
        foreach($companies as $item){
            $item->coal_from = CoalFrom::where('company_uuid', $item->uuid)->get();
        }
        //  dd($companies);
        // return Carbon::today()->isoFormat('Y-M-D');
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-tonase'
        ];
        return view('employee_tonase.create', [
            'title'         => 'Tonase',
            'employees' => $employees,
            'companies' => $companies,
            'year_month_day' => $year_month_day,
            'year_month' => $year_month,
            'nik_employee'  =>$nik_employee,
            'today'        => '',
            'layout'    => $layout
        ]);
    }

    public function show(Request $request){
        // return ResponseFormatter::toJson($request->all(), 'edit');
        // $data = EmployeeTonase::where('uuid', $request->uuid)->get();
        $base =  EmployeeTonase::leftJoin('employees','employees.uuid','employee_tonases.employee_uuid')
                ->join('coal_froms', 'coal_froms.uuid','employee_tonases.coal_from_uuid')
                ->leftJoin('companies','companies.uuid','coal_froms.company_uuid')
                ->where('employee_tonases.uuid', $request->uuid)                
                ->whereNull('employees.date_end')
                ->groupBy( 
                    'companies.uuid',
                    'employee_tonases.uuid',
                    'employee_tonases.employee_uuid',
                    'employee_tonases.coal_from_uuid',
                    'employee_tonases.tonase_value',
                    'employee_tonases.tonase_full_value',
                    'employee_tonases.date',
                    'employee_tonases.shift',
                    )
                ->select( 
                    'employee_tonases.uuid',
                    'companies.uuid as company_uuid',
                    'employee_tonases.employee_uuid',
                    'employee_tonases.coal_from_uuid',
                    'employee_tonases.tonase_value',
                    'employee_tonases.tonase_full_value',
                    'employee_tonases.date',
                    'employee_tonases.shift',
                    DB::raw("count(employee_tonases.uuid) as amount_ritase"),
                    DB::raw("SUM(employee_tonases.tonase_value) as total_tonase_value"),
                    DB::raw("SUM(employee_tonases.tonase_full_value) as total_tonase_full_value"),
                )->get()->first();
        return ResponseFormatter::toJson($base, 'edit');
    }

    public function store(Request $request){
        
        $validatedData = $request->all();
        // return ResponseFormatter::toJson('Ada data lama',$validatedData);
        $arr_employee_tonase = EmployeeTonase::where('employee_uuid', $validatedData['employee_uuid'])
        ->where('date', $validatedData['date'])
        ->get();
        
        $arr_count = $arr_employee_tonase->count();

        if(empty($validatedData['uuid'])){
            if($validatedData['ritase'] == 1){
                $inddex = 0;
                $validatedData['uuid'] = $validatedData['employee_uuid'].'-'.$validatedData['date'].'-'.$inddex;
                if($arr_employee_tonase->count() > 0 ){
                    $arr_employee_tonase = ResponseFormatter::createIndexArray($arr_employee_tonase, 'uuid');                   
                    while(!empty($arr_employee_tonase[$validatedData['uuid']])){
                        // return ResponseFormatter::toJson('Data lama',$arr_employee_tonase[$validatedData['uuid']]);
                        $inddex++;
                        $validatedData['uuid'] = $validatedData['employee_uuid'].'-'.$validatedData['date'].'-'.$inddex;
                    }                    
                    $store = EmployeeTonase::create($validatedData);
                    return ResponseFormatter::toJson('Ada data lama',$store);
                }
                $store = EmployeeTonase::create($validatedData);
                return ResponseFormatter::toJson('Tidak ada data lama', $store);
            }
        }else{
            // return ResponseFormatter::toJson('Ada data lama',$validatedData);
            $store = EmployeeTonase::updateOrCreate(['uuid' => $validatedData['uuid']] , $validatedData);
            return ResponseFormatter::toJson('Tidak ada data lama', $store);
        }


        return ResponseFormatter::toJson('faild', $validatedData);
        $tonase_each_ritase = $validatedData['tonase_value'] / $validatedData['ritase'] ;
        $tonase_each_ritase = round( $tonase_each_ritase,3);
        //======================================== ritase ke 5 keatas dapat bonus
        // if(empty($validatedData['uuid'])){
        //     for($i = 0; $i < $validatedData['ritase']; $i++){
        //         if($i >3){
        //             $validatedData['tonase_value'] = $tonase_each_ritase;
        //             $validatedData['tonase_full_value'] = $tonase_each_ritase + $tonase_each_ritase * 0.15;  
        //         }else{
        //             $validatedData['tonase_full_value'] = $tonase_each_ritase;
        //             $validatedData['tonase_value'] = $tonase_each_ritase;
        //         }
                
                
                
        //         if(empty($validatedData['uuid'])){
        //             $validatedData['uuid'] = "tonase-".$validatedData['date'].'-'.$validatedData['shift'].'-'.$validatedData['employee_uuid'].'-'.rand(99,999);
        //         }
        //         $store = EmployeeTonase::create($validatedData);
                
        //     }
           
        // }
       

        if(empty($validatedData['uuid'])){
            $validatedData['company_uuid'] = $validatedData['company'];
           
            for($i = 0; $i < $validatedData['ritase']; $i++){
                if($validatedData['ritase'] >3){
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                    $validatedData['tonase_full_value'] = $tonase_each_ritase + $tonase_each_ritase * 0.15;  
                }else{
                    $validatedData['tonase_full_value'] = $tonase_each_ritase;
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                }
                        
                if(empty($validatedData['uuid'])){
                    $validatedData['uuid'] = $validatedData['date'].'-'.$validatedData['coal_from_uuid'].'-'.$validatedData['employee_uuid'];
                }
                // return ResponseFormatter::toJson($validatedData , 'Data Stored');
                
                $store = EmployeeTonase::create($validatedData);
                
            }
            return ResponseFormatter::toJson('aaaa', 'Data Stored');
        }else{
            EmployeeTonase::where('uuid', $validatedData['uuid'])->delete();
            for($i = 0; $i < $validatedData['ritase']; $i++){
                if($validatedData['ritase'] >3){
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                    $validatedData['tonase_full_value'] = $tonase_each_ritase + $tonase_each_ritase * 0.15;  
                }else{
                    $validatedData['tonase_full_value'] = $tonase_each_ritase;
                    $validatedData['tonase_value'] = $tonase_each_ritase;
                }                
                if(empty($validatedData['uuid'])){
                    $validatedData['uuid'] = $validatedData['date'].'-'.$validatedData['coal_from_uuid'].'-'.$validatedData['employee_uuid'];
                }
                $store = EmployeeTonase::create($validatedData);
            }
        }

        return ResponseFormatter::toJson($validatedData, 'Data Stored');
    }

    
  

    public function anyDataCreate(Request $request){

        $arr_data_employee_tonase = EmployeeTonase::join('employees','employees.uuid', 'employee_tonases.employee_uuid')
        ->join('user_details','user_details.uuid', 'employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid', 'employees.position_uuid')
        ->join('coal_froms', 'coal_froms.uuid', 'employee_tonases.coal_from_uuid');
        if(!empty($request->year)){
            $arr_data_employee_tonase = $arr_data_employee_tonase->whereYear('employee_tonases.date', $request->year);
            $arr_data_employee_tonase = $arr_data_employee_tonase->whereMonth('employee_tonases.date', $request->month);
           
        }
        if(!empty($request->nik_employee)){
            $arr_data_employee_tonase = $arr_data_employee_tonase->where('employee_tonases.employee_uuid', $request->nik_employee);
        }

        $arr_data_employee_tonase = $arr_data_employee_tonase->groupBy( 
            'employee_tonases.id',
            'employee_tonases.uuid',
            'user_details.photo_path',
            'employees.nik_employee',
            'positions.position',
            'user_details.name',
            'employees.user_detail_uuid',
            'employee_tonases.employee_uuid',
            'coal_froms.uuid',
            'coal_froms.coal_from',
            'employee_tonases.updated_at',
            'employee_tonases.date',
            'employee_tonases.uuid'
            )
        ->orderBy('employee_tonases.created_at' , 'desc')
        ->limit(40)
        ->get([
            'employee_tonases.id',
            'employee_tonases.uuid',
            'user_details.photo_path',
            'employees.nik_employee',
            'positions.position',
            'user_details.name',
            'employees.user_detail_uuid',
            'employee_tonases.employee_uuid',
            'coal_froms.uuid',
            'coal_froms.coal_from',
            'employee_tonases.updated_at',
            'employee_tonases.date',
            'employee_tonases.uuid',
            'employee_tonases.tonase_value',
            'employee_tonases.tonase_full_value'
        ]);

        // return ResponseFormatter::toJson($arr_data_employee_tonase,'bbb');

        
        return Datatables::of($arr_data_employee_tonase)
        ->make(true);
    }

    //used on index
    public function anyDataMonthFilter(Request $request){        
        $arr_data = [];
        $arr_data_send = [];
        $filter_arr_coal_from = [];
        $validateData = $request->all();


        $arr_coal_from = CoalFrom::all();

        if(empty($request->filter['arr_coal_from'])){
            foreach($arr_coal_from as $coal_from){
                $filter_arr_coal_from[]= $coal_from->uuid;
            }
        }else{
            $filter_arr_coal_from = $request->filter['arr_coal_from'];
        }
        $validateData['filter']['arr_coal_from'] = $filter_arr_coal_from;
       
        if(!empty($validateData['filter']['arr_coal_from'])){
            foreach($validateData['filter']['arr_coal_from'] as $coal_from){
                $data =EmployeeTonase::join('employees','employees.uuid', 'employee_tonases.employee_uuid')
                ->join('user_details','user_details.uuid', 'employees.user_detail_uuid')
                ->leftJoin('positions','positions.uuid', 'employees.position_uuid')
                ->join('coal_froms', 'coal_froms.uuid', 'employee_tonases.coal_from_uuid')
                ->whereNull('employees.date_end')
                ->whereNull('user_details.date_end')
                ->whereYear('employee_tonases.date', $request->year)
                ->whereMonth('employee_tonases.date', $request->month);

                if(!empty($request->day)){
                    $data = $data->whereDay('employee_tonases.date', $request->day);
                }
                $data = $data->where('employee_tonases.coal_from_uuid',$coal_from)
                ->groupBy(     
                    'employee_tonases.coal_from_uuid',                
                    'user_details.photo_path',
                    'employees.nik_employee',
                    'positions.position',
                    'user_details.name',
                    'employees.user_detail_uuid',
                    'employee_tonases.employee_uuid',
                    )
                ->select( 
                    'employee_tonases.coal_from_uuid',      
                    'employee_tonases.employee_uuid',
                    'employees.user_detail_uuid',
                    'employees.nik_employee',
                    'user_details.photo_path',
                    'user_details.name',
                    'positions.position',
                    DB::raw("count(tonase_value) as ritase"),
                    DB::raw("SUM(tonase_value) as sum_tonase_value"),
                    DB::raw("SUM(tonase_full_value) as sum_tonase_full_value"),
                )
                ->get();
               
                if(!empty($data)){
                    foreach($data as $item){
                        $arr_data[$coal_from][$item->employee_uuid] = $item;
                    }   
                }                                            
            }
            
            if($request->filter['is_combined'] == "false"){
                foreach($validateData['filter']['arr_coal_from'] as $coal_from_uuid){
                    if(!empty($arr_data[$coal_from_uuid])){
                        foreach($arr_data[$coal_from_uuid] as $item_data){
                            $arr_data_send[] = $item_data;
                        }  
                    }                                 
                }
            }else{
                foreach($validateData['filter']['arr_coal_from'] as $coal_from_uuid){
                    if(!empty($arr_data[$coal_from_uuid])){
                        foreach($arr_data[$coal_from_uuid] as $item_data){
                            if(!empty($arr_data_send[$item_data->employee_uuid])){
                                $arr_data_send[$item_data->employee_uuid]->ritase = $arr_data_send[$item_data->employee_uuid]->ritase + $item_data->ritase;
                                $arr_data_send[$item_data->employee_uuid]->sum_tonase_value = $arr_data_send[$item_data->employee_uuid]->sum_tonase_value + $item_data->sum_tonase_value;
                                $arr_data_send[$item_data->employee_uuid]->sum_tonase_full_value = $arr_data_send[$item_data->employee_uuid]->sum_tonase_full_value + $item_data->sum_tonase_full_value;
                            }else{
                                $arr_data_send[$item_data->employee_uuid] = $item_data;
                            }                        
                        }  
                    }                                
                }
            }
        }
        return Datatables::of($arr_data_send)
        ->make(true);
    }
}
