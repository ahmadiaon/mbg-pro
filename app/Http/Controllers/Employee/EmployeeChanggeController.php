<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\Dictionary;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeCompany;
use App\Models\Employee\EmployeePremi;
use App\Models\Employee\EmployeeRoaster;
use App\Models\Employee\EmployeeSalary;
use App\Models\Position;
use App\Models\Premi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class EmployeeChanggeController extends Controller
{
    public function index(){
        $employees = Employee::data_employee();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-changge'
        ];
        return view('employee.changge.index', [
            'title'         => 'Perubahan Karyawan',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'employees' => $employees,
            'nik_employee' => ''
        ]);
    }
    public function create(){
        $employees = Employee::getAll();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-changge'
        ];
        return view('employee.changge.create', [
            'title'         => 'Perubahan Karyawan',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'employees' => $employees,
            'nik_employee' => ''
        ]);
    }

    public function export($year_month){
        $day_month = ResponseFormatter::getEndDay($year_month);
        // $employees = Employee::get_employee_active_year_month($year_month);
        // $employees = Employee::get_employee_all_latest_full_data();
        // return view('datatableshow', [ 'data'         => $employees]);

        $arr_position = Position::all();        
        $arr_position = ResponseFormatter::createIndexArray($arr_position,'uuid');

        $arr_department = Department::all();
        $arr_department = ResponseFormatter::createIndexArray($arr_department,'uuid');

        $arr_company = Company::all();
        $arr_company = ResponseFormatter::createIndexArray($arr_company,'uuid');



        $arr_employee = Employee::leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('companies','companies.uuid','employees.company_uuid')
        ->whereNull('employees.date_end')
        ->get([
            'user_details.name',
            'user_details.bpjs_ketenagakerjaan',
            'user_details.bpjs_kesehatan',
            'companies.company',
            'employees.*'
        ]);

        $arr_employee_roaster = EmployeeRoaster::whereNull('date_end')->get();
        $arr_employee_roaster = ResponseFormatter::createIndexArray($arr_employee_roaster,'uuid');

        $arr_employee_salary = EmployeeSalary::whereNull('date_end')->get();
        $arr_employee_salary = ResponseFormatter::createIndexArray($arr_employee_salary,'uuid');

        $arr_employee_premi = EmployeePremi::whereNull('date_end')->get();


        // dd($arr_employee);
        $arr_employee = ResponseFormatter::createIndexArray($arr_employee, 'uuid');

        foreach($arr_employee as $employee){
            $employee->position = $arr_position[$employee->position_uuid]->position;
            $employee->department = $arr_department[$employee->department_uuid]->department;
            if(!empty($arr_employee_roaster[$employee->nik_employee])){
                $employee->roaster_uuid = $arr_employee_roaster[$employee->nik_employee]->roaster_uuid;
            }
            if(!empty($arr_employee_salary[$employee->nik_employee])){
                $employee->salary = $arr_employee_salary[$employee->nik_employee]->salary;
                $employee->tunjangan = $arr_employee_salary[$employee->nik_employee]->tunjangan;
                $employee->insentif = $arr_employee_salary[$employee->nik_employee]->insentif;
                $employee->hour_meter_price_uuid = $arr_employee_salary[$employee->nik_employee]->hour_meter_price_uuid;
            }            
        }

        foreach($arr_employee_premi as $employee_premi){
            $col_name = $employee_premi->premi_uuid;
            if(!empty($arr_employee[$employee_premi->employee_uuid])){
                $arr_employee[$employee_premi->employee_uuid]->$col_name = $employee_premi->premi_value;
            }            
        }

      

        // var_dump($arr_employee);die;

        // masukan ke table atribut size
       

        $row = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        $colomn = [
            'no'=>'No.',
            'nik_employee~one'=>'NIK',
            'name~one'=>'Nama',
            'position~old'=>'Jabatan Lama',
            'position~new'=>'Jabatan Baru',
            'department~old'=>'Department Lama',
            'department~new'=>'Department Baru',	
            'company~old'=>'Site Lama',
            'company~new'=>'Site Baru',	
            'contract_status~old'=>'Kontrak Status Lama',	
            'contract_status~new'=>'Kontrak Status Baru',	
            'employee_status~old'=>'Status Karyawan Lama',	
            'employee_status~new'=>'Status Karyawan Baru',	
            'roaster_uuid~old'=>'Roaster Lama',	
            'roaster_uuid~new'=>'Roaster Baru',	
            'salary~old'=>'Gaji Pokok Lama',
            'salary~new'=>'Gaji Pokok Baru',	
            'insentif~old'=>'Insentif Lama',	
            'insentif~new'=>'Insentif Baru',	
            'tunjangan~old'=>'Tunjangan Lama',	
            'tunjangan~new'=>'Tunajangan Baru',	
            'tax_status_uuid~old'=>'Status Pajak Lama',	
            'tax_status_uuid~new'=>'Status Pajak Baru',	
            
            'bpjs_kesehatan~old'=>'BPJS Kesehatan Lama',	
            'bpjs_kesehatan~new'=>'BPJS Kesehatan Baru',	
            'bpjs_ketenagakerjaan~old'=>'BPJS Ketenagakerjaan Lama',	
            'bpjs_ketenagakerjaan~new'=>'BPJS Ketenagakerjaan Baru',	
            'tax_status_uuid~old'=>'Status Pajak Lama',	
            'tax_status_uuid~new'=>'Status Pajak Baru',	
            'hour_meter_price_uuid~old'=>'Hm Lama',
            'hour_meter_price_uuid~new'=>'HM BAru'
        ];
        $premis = Premi::all();
        $col = [];
        foreach($premis as $premi){
            $colomn[$premi->uuid.'~old'] = $premi->uuid.' Lama';
            $colomn[$premi->uuid.'~new'] = $premi->uuid.' Baru';
        }
        $colomn['date_start~efektif'] =  'Tanggal Mulai Efektif';
        $colomn['tanggal~1'] =  'Tanggal diajukan';
        $colomn['tanggal~2'] =  'Jenis Perubahan';
        $colomn['tanggal~3'] =  'Tanggal diproses';
        $colomn['tanggal~4'] =  'Status Perubahan';
       
        $new_column = $colomn;
        // dd($new_column);
        $col_ = 5;
        $row_ = 0;
        $last_col = 0;
        
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        foreach($new_column as $index_col=>$column_excel){
            $createSheet->setCellValue($row[$row_].$col_, $column_excel);
            $last_col = $row_;
            Dictionary::updateOrCreate(['database'=>$index_col ],['excel' => $column_excel]);
            $row_++;
        }

        $col_ = 15;
        foreach($arr_employee as $employee){
            $row_ = 0;
            foreach($new_column as $index=>$column){
                $arr_index = explode('~',$index);
                if(!empty($arr_index[1])){
                    $createSheet->setCellValue($row[$row_].$col_,$employee[$arr_index[0]]);
                }
                $row_++;
            }
            $col_++;
        }
        $last_col = $last_col - 2;

        $status_changges = [
            'ROTASI',
            'MUTASI',
            'DEMOSI',
            'PROMOSI',
            'S-PHK',
            'PENGAJUAN'
        ];
        $col_ = 15;
        foreach($status_changges as $status){
            $createSheet->setCellValue($row[$last_col].$col_, $status);
            $col_++;
        }
       

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/karyawan_perubahan/Template Karyawan Perubahan -'.'-'.rand(99,9999).'file.xls';
        $crateWriter->save($name);

        return response()->download($name);
    }
    public function import(Request $request){
        // return 'aaa';
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $arr_dictionary = Dictionary::all();
        $arr_dictionary = ResponseFormatter::createIndexArray($arr_dictionary,'excel');

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $employee_data = Employee::whereNull('employees.date_end')->get();
            $employee_data = $employee_data->keyBy(function ($item) {
                return strval($item->uuid);
            });
            $get_all_employee_salaries = EmployeeSalary::whereNull('date_end')->get();
            $get_all_employee_salaries = $get_all_employee_salaries->keyBy(function ($item) {
                return strval($item->uuid);
            });
            $premis = Premi::all();
            $get_all_employee_premis = EmployeePremi::whereNull('date_end')->get();
            $get_all_employee_premis = $get_all_employee_premis->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $rows = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
            $row_name_col = 0;
            $arr_name_col = [];
            while($sheet->getCell( $rows[$row_name_col].'5')->getValue() != null){
                $arr_name_col[$rows[$row_name_col]] = [
                    'label_excel'=>$sheet->getCell( $rows[$row_name_col].'5')->getValue()
                ];
                $row_name_col++;
            }

            foreach($arr_name_col as $index__row=>$name_col){
                $arr_name_col[$index__row]['dictionary'] = $arr_dictionary[$name_col['label_excel']];
            }
            $no_employee = 6;
            $employees = [];            

            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                $data_employee_new = [];
                $employee_uuid = ResponseFormatter::toUUID($sheet->getCell( 'B'.$no_employee)->getValue());

                if(!empty($employee_data[$employee_uuid])){                    
                    $data_old = $data_employee_new = $employee_data[$employee_uuid]->toArray();  
                    unset($data_employee_new['id']);
                }
                if(!empty($get_all_employee_salaries[$employee_uuid])){
                    $data_old_employee_salary = $get_all_employee_salaries[$employee_uuid]->toArray(); 
                    $data_employee_new = array_merge($data_old, $data_old_employee_salary ); 
                    unset($data_employee_new['id']); 
                }

                // dd($data_employee_new);
                


                foreach($arr_name_col as $index_row_col=>$data_row_col){
                    $value_excel = $sheet->getCell($index_row_col.$no_employee)->getValue();
                    $index_arr = $data_row_col['dictionary']->database;
                    $arr_index_arr = explode('~',$index_arr);

                    if(!empty($value_excel)){
                        if(!empty($data_row_col['dictionary']->data_type)){
                            if($data_row_col['dictionary']->data_type == 'uuid'){
                                $value_excel = ResponseFormatter::toUUID($value_excel);
                                $data_employee_new[$arr_index_arr[0].'_uuid'] = $value_excel;
                            }elseif($data_row_col['dictionary']->data_type == 'date'){
                                $value_excel = ResponseFormatter::excelToDate($value_excel);
                            }
                        }
                    }              
                    $data_employee_new[$index_arr] = $value_excel;     
                    $data_employee_new[$arr_index_arr[0]] = $value_excel;
                }

               

                if(!empty($data_employee_new['bpjs_ketenagakerjaan'])){
                    $data_employee_new['is_bpjs_kesehatan'] = 'Ya';
                    $data_employee_new['is_bpjs_pensiun'] = 'Ya';
                }else{
                    $data_employee_new['is_bpjs_kesehatan'] = 'Tidak';
                    $data_employee_new['is_bpjs_pensiun'] = 'Tidak';
                }
                if(!empty($data_employee_new['bpjs_kesehatan'])){
                    $data_employee_new['is_bpjs_ketenagakerjaan'] = 'Ya';
                }else{
                    $data_employee_new['is_bpjs_ketenagakerjaan'] = 'Tidak';
                }
                // dd($data_employee_new);   

                if(!empty($data_old)){
                    if($data_old['date_start'] > $data_employee_new['date_start']){
                        if(empty($data_employee_new['date_end_effective'])){
                            $data_employee_new['date_end'] = $data_old['date_start'];
                        }else{
                            $data_employee_new['date_end'] = $data_employee_new['date_end_effective'];
                        }
                        $storeEmployee = Employee::create($data_employee_new); 
                    }elseif($data_old['date_start'] == $data_employee_new['date_start']){
                        $storeEmployee = Employee::updateOrCreate(['id'   => $data_old['id']], $data_employee_new); 
                    }else{
                        $storeEmployee = Employee::updateOrCreate(['id'   => $data_old['id']], ['date_end'=>$data_employee_new['date_start']]); 
                        $storeEmployee = Employee::create($data_employee_new); 
                    }
                }else{
                    $storeEmployee = Employee::updateOrCreate(['uuid'=> $data_employee_new['nik_employee']], $data_employee_new);
                }   

                if(!empty($data_old_employee_salary)){
                    if($data_old_employee_salary['date_start'] > $data_employee_new['date_start']){
                        if(empty($data_employee_new['date_end_effective'])){
                            $data_employee_new['date_end'] = $data_old_employee_salary['date_start'];
                        }else{
                            $data_employee_new['date_end'] = $data_employee_new['date_end_effective'];
                        }
                        $storeEmployee = EmployeeSalary::create($data_employee_new); 
                    }elseif($data_old_employee_salary['date_start'] == $data_employee_new['date_start']){
                        $storeEmployee = EmployeeSalary::updateOrCreate(['id'   => $data_old_employee_salary['id']], $data_employee_new); 
                    }else{
                        $storeEmployee = EmployeeSalary::updateOrCreate(['id'   => $data_old_employee_salary['id']], ['date_end'=>$data_employee_new['date_start']]); 
                        $storeEmployee = EmployeeSalary::create($data_employee_new); 
                    }
                }else{
                    $storeEmployee = EmployeeSalary::create($data_employee_new); 
                }

                foreach($premis as $premi){                  

                    if(!empty($data_employee_new[$premi->uuid])){
                        $data_employee_new['premi_value'] = $data_employee_new[$premi->uuid];
                        $data_employee_new['premi_uuid'] = $premi->uuid;
                        $data_employee_new['uuid'] = $employee_uuid.'-'.$premi->uuid;
                        $premi_value = $data_employee_new[$premi->uuid];

                        if(!empty($get_all_employee_premis[$employee_uuid.'-'.$premi->uuid])){
                            $data_old_premi[$premi->uuid] = $get_all_employee_premis[$employee_uuid.'-'.$premi->uuid]->toArray(); 
                            $data_employee_new['premi_value'] = $data_employee_new[$premi->uuid];

                            if($data_old_premi[$premi->uuid]['date_start'] >  $data_employee_new['date_start']){
                                if(empty($data_employee_new['date_end_effective'])){
                                    $data_employee_new['date_end'] = $data_old_premi[$premi->uuid]['date_start'];
                                }else{
                                    $data_employee_new['date_end'] = $data_employee_new['date_end_effective'];
                                }
                                $storeEmployee = EmployeePremi::create($data_employee_new); 
                            }elseif($data_old_premi[$premi->uuid]['date_start']  == $data_employee_new['date_start']){
                                $storeEmployee = EmployeePremi::updateOrCreate(['id'   => $data_old_premi[$premi->uuid]['id']], $data_employee_new); 
                            }else{
                                $storeEmployee = EmployeePremi::updateOrCreate(['id'   => $data_old_premi[$premi->uuid]['id']], ['date_end'=>$data_employee_new['date_start']]); 
                                $storeEmployee = EmployeePremi::create($data_employee_new); 
                            }
                        }else{
                            $storeEmployee = EmployeePremi::create($data_employee_new); 
                        }
                        // dd($storeEmployee);
                    }
                }

                // dd($storeEmployee);
                $no_employee++;
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();
    }
}
