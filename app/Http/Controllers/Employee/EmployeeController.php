<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use Illuminate\Http\Request;
use App\Models\Poh;
use App\Models\Religion;
use App\Models\Department;
use App\Models\Position;
use App\Models\Company;
use App\Models\Dictionary;
use App\Models\Employee\EmployeeCompany;
use App\Models\Employee\EmployeeOut;
use App\Models\Employee\EmployeePremi;
use App\Models\Employee\EmployeeRoaster;
use App\Models\Employee\EmployeeSalary;
use App\Models\Premi;
use App\Models\Privilege\UserPrivilege;
use App\Models\Roaster;
use App\Models\User;
use App\Models\UserDetail\UserAddress;
use App\Models\UserDetail\UserDependent;
use App\Models\UserDetail\UserDetail;
use App\Models\UserDetail\UserEducation;
use App\Models\UserDetail\UserHealth;
use App\Models\UserDetail\UserLicense;
use App\Models\UserDetail\UserReligion;
use App\Models\Variable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class EmployeeController extends Controller
{

    public function test(){
        $data = Employee::get_employee_all();
        return view('datatableshow', [ 'data'         => $data]);
    }
    public function anyDataOne($uuid){
        $data = Employee::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_employee');
    }

    public function index(){
        // return Employee::getAll();
        $religions = Religion::all();
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => false,
            'active'                        => 'employees-index'
        ];
        return view('employee.index', [
            'title'         => 'Daftar Karyawan',
            'layout'    => $layout,
            'religions' => $religions
        ]);
    }

    public function indexResign(){
        // return Employee::getAll();
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => false,
            'active'                        => 'employees-index'
        ];
        return view('employee.resign.index', [
            'title'         => 'Daftar Karyawan Resign',
            'nik_employee' => '',
            'layout'    => $layout,
            
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
        ]);
    }

    

    

    public function import(Request $request){
        // return 'aaa';
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $rows = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
            $no_row=0;

            $dictionaries = Dictionary::all();
            $dictionaries = $dictionaries->keyBy(function ($item) {
                return strval($item->excel);
            });

            $arr_index = [];

            
            while($sheet->getCell($rows[$no_row].'2')->getValue() != null){
                $arr_index[$dictionaries[$sheet->getCell($rows[$no_row].'2')->getValue()]->database] = [
                    'index' => $rows[$no_row],
                    'database' => $dictionaries[$sheet->getCell($rows[$no_row].'2')->getValue()]->database,                    
                    'excel' => $dictionaries[$sheet->getCell($rows[$no_row].'2')->getValue()]->excel,
                    'data_type' => $dictionaries[$sheet->getCell($rows[$no_row].'2')->getValue()]->data_type,
                ];
                $no_row++;
            }
            // dd($arr_index);

            $no_employee = 3;
            $employees = [];

            $employee_data = Employee::whereNull('employees.date_end')->get();
            $employee_data = $employee_data->keyBy(function ($item) {
                return strval($item->uuid);
            });
            $premis = Premi::all();

            $get_all_employee_premis = EmployeePremi::whereNull('date_end')->get();
            $get_all_employee_premis = $get_all_employee_premis->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_employee_salaries = EmployeeSalary::whereNull('date_end')->get();
            $get_all_employee_salaries = $get_all_employee_salaries->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_user_details = UserDetail::whereNull('date_end')->get();
            $get_all_user_details = $get_all_user_details->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_employee_companies = EmployeeCompany::whereNull('date_end')->get();
            $get_all_employee_companies = $get_all_employee_companies->keyBy(function ($item) {
                return strval($item->uuid);
            });

            $get_all_employee_roasters = EmployeeRoaster::whereNull('date_end')->get();
            $get_all_employee_roasters = $get_all_employee_roasters->keyBy(function ($item) {
                return strval($item->employee_uuid);
            });                       

            $month = $sheet->getCell( 'D1')->getValue();
            $year = $sheet->getCell( 'F1')->getValue();
            
            $this_date = $year.'-'.$month.'-'.'01';
            $date = Carbon::createFromFormat('Y-m-d', $this_date );
            $date_prev = Carbon::createFromFormat('Y-m-d', $this_date );
            $this_date_end_prev = $date_prev->subDays(1);


            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                $date_row = 3;
                $nik_employee = $sheet->getCell( 'B'.$no_employee)->getValue();
                $nik_employee = ResponseFormatter::toUUID($nik_employee);                
                  
                if(!empty($employee_data[$nik_employee])){                    
                    $data_old = $employee_data_one = $employee_data[$nik_employee]->toArray();                                
                }

                if(!empty($get_all_user_details[$nik_employee])){
                    $data_old_user_detail = $get_all_user_details[$nik_employee]->toArray(); 
                    $data_old = array_merge($data_old, $data_old_user_detail );  
                }

                if(!empty($get_all_employee_salaries[$nik_employee])){
                    $data_old_employee_salary = $get_all_employee_salaries[$nik_employee]->toArray(); 
                    $data_old = array_merge($data_old, $data_old_employee_salary );  
                }

                if(!empty($get_all_employee_roasters[$nik_employee])){
                    $data_old_employee_roaster = $get_all_employee_roasters[$nik_employee]->toArray(); 
                    $data_old = array_merge($data_old, $data_old_employee_roaster );  
                }

                if(!empty($get_all_employee_companies[$nik_employee])){
                    $data_old_employee_company = $get_all_employee_companies[$nik_employee]->toArray(); 
                    $data_old = array_merge($data_old, $data_old_employee_company );  
                }

                

                foreach($arr_index as $item_index){
                    if(!empty($sheet->getCell( $item_index['index'].$no_employee)->getValue())){
                        switch($item_index['data_type']){
                            case 'uuid':
                                $employee_data_one[$item_index['database'].'_uuid'] = ResponseFormatter::toUUID($sheet->getCell( $item_index['index'].$no_employee)->getValue());
                                $employee_data_one[$item_index['database']] = $sheet->getCell( $item_index['index'].$no_employee)->getValue();
                                break;
                            case 'date':
                                $employee_data_one[$item_index['database']] = ResponseFormatter::excelToDate($sheet->getCell( $item_index['index'].$no_employee)->getValue());
                                break;
                            default:
                            $employee_data_one[$item_index['database']] = $sheet->getCell( $item_index['index'].$no_employee)->getValue();
                        }
                    }
                    
                }  
                   

                Position::updateOrCreate(['uuid' => $employee_data_one['position_uuid']], ['position' => $employee_data_one['position']] );
                Department::updateOrCreate(['uuid' => $employee_data_one['department_uuid']], ['position' => $employee_data_one['department']] );
                // Company::updateOrCreate(['uuid' => $employee_data_one['company_uuid']], $employee_data_one );                

                if(!empty($employee_data_one['bpjs_ketenagakerjaan'])){
                    $employee_data_one['is_bpjs_kesehatan'] = 'Ya';
                    $employee_data_one['is_bpjs_pensiun'] = 'Ya';
                }else{
                    $employee_data_one['is_bpjs_kesehatan'] = 'Tidak';
                    $employee_data_one['is_bpjs_pensiun'] = 'Tidak';
                }
                if(!empty($employee_data_one['bpjs_kesehatan'])){
                    $employee_data_one['is_bpjs_ketenagakerjaan'] = 'Ya';
                }else{
                    $employee_data_one['is_bpjs_ketenagakerjaan'] = 'Tidak';
                }
                $employee_data_one['uuid'] = $employee_data_one['nik_employee'];
                $employee_data_one['employee_uuid'] = $employee_data_one['uuid'];
               

                if(!empty($employee_data_one['contract_number_full'])){
                    $contract_number= explode('/',$employee_data_one['contract_number_full']);
                    $employee_data_one['contract_number'] = (int)$contract_number[0];
                }

                if(!empty($employee_data_one['hour_meter_prices'])){
                    $employee_data_one['hour_meter_price_uuid'] ='hm-'.$employee_data_one['hour_meter_prices'];
                }
                
                $employee_data_one['date_start'] = $employee_data_one['date_start_effective'];
                $employee_data_one['user_detail_uuid'] = $employee_data_one['nik_employee'];
                    
                if(!empty($data_old)){
                    if($data_old['date_start'] > $employee_data_one['date_start']){
                        if(empty($employee_data_one['date_end_effective'])){
                            $employee_data_one['date_end'] = $data_old['date_start'];
                        }else{
                            $employee_data_one['date_end'] = $employee_data_one['date_end_effective'];
                        }
                        $storeEmployee = Employee::create($employee_data_one); 
                    }elseif($data_old['date_start'] == $employee_data_one['date_start']){
                        $storeEmployee = Employee::updateOrCreate(['id'   => $data_old['id']], $employee_data_one); 
                    }else{
                        $storeEmployee = Employee::updateOrCreate(['id'   => $data_old['id']], ['date_end'=>$employee_data_one['date_start']]); 
                        $storeEmployee = Employee::create($employee_data_one); 
                    }
                }else{
                    $storeEmployee = Employee::create($employee_data_one); 
                }

                
                // user
                $employee_data_one['role'] = 'employee';               
                $employee_data_one['password'] = Hash::make('password');
                $storeUser = User::updateOrCreate(['uuid'    =>  $employee_data_one['uuid']], $employee_data_one);
                // end user

                //user detail

                if(!empty($data_old_user_detail)){
                    if($data_old_user_detail['date_start'] > $employee_data_one['date_start']){
                        if(empty($employee_data_one['date_end_effective'])){
                            $employee_data_one['date_end'] = $data_old_user_detail['date_start'];
                        }else{
                            $employee_data_one['date_end'] = $employee_data_one['date_end_effective'];
                        }
                        $storeEmployee = UserDetail::create($employee_data_one); 
                        return 'a';
                    }elseif($data_old_user_detail['date_start'] == $employee_data_one['date_start']){
                        $storeEmployee = UserDetail::updateOrCreate(['id'   => $data_old_user_detail['id']], $employee_data_one); 
                      
                    }else{
                        $storeEmployee = UserDetail::updateOrCreate(['id'   => $data_old_user_detail['id']], ['date_end'=>$employee_data_one['date_start']]); 
                        $storeEmployee = UserDetail::create($employee_data_one); 
                        return 'c';
                    }
                }else{
                    return 'd';
                    $storeEmployee = UserDetail::create($employee_data_one); 
                }
                // return 'z';
                if(!empty($data_old_employee_salary)){
                    if($data_old_employee_salary['date_start'] > $employee_data_one['date_start']){
                        if(empty($employee_data_one['date_end_effective'])){
                            $employee_data_one['date_end'] = $data_old_employee_salary['date_start'];
                        }else{
                            $employee_data_one['date_end'] = $employee_data_one['date_end_effective'];
                        }
                        $storeEmployee = EmployeeSalary::create($employee_data_one); 
                    }elseif($data_old_employee_salary['date_start'] == $employee_data_one['date_start']){
                        $storeEmployee = EmployeeSalary::updateOrCreate(['id'   => $data_old_employee_salary['id']], $employee_data_one); 
                    }else{
                        $storeEmployee = EmployeeSalary::updateOrCreate(['id'   => $data_old_employee_salary['id']], ['date_end'=>$employee_data_one['date_start']]); 
                        $storeEmployee = EmployeeSalary::create($employee_data_one); 
                    }
                }else{
                    $storeEmployee = EmployeeSalary::create($employee_data_one); 
                }

                if(!empty($data_old_employee_roaster)){
                    if($data_old_employee_roaster['date_start'] > $employee_data_one['date_start']){
                        if(empty($employee_data_one['date_end_effective'])){
                            $employee_data_one['date_end'] = $data_old_employee_roaster['date_start'];
                        }else{
                            $employee_data_one['date_end'] = $employee_data_one['date_end_effective'];
                        }
                        $storeEmployee = EmployeeRoaster::create($employee_data_one); 
                    }elseif($data_old_employee_roaster['date_start'] == $employee_data_one['date_start']){
                        $storeEmployee = EmployeeRoaster::updateOrCreate(['id'   => $data_old_employee_roaster['id']], $employee_data_one); 
                    }else{
                        $storeEmployee = EmployeeRoaster::updateOrCreate(['id'   => $data_old_employee_roaster['id']], ['date_end'=>$employee_data_one['date_start']]); 
                        $storeEmployee = EmployeeRoaster::create($employee_data_one); 
                    }
                }else{
                    $storeEmployee = EmployeeRoaster::create($employee_data_one); 
                }

                if(!empty($data_old_employee_company)){
                    if($data_old_employee_company['date_start'] > $employee_data_one['date_start']){
                        if(empty($employee_data_one['date_end_effective'])){
                            $employee_data_one['date_end'] = $data_old_employee_company['date_start'];
                        }else{
                            $employee_data_one['date_end'] = $employee_data_one['date_end_effective'];
                        }
                        $storeEmployee = EmployeeCompany::create($employee_data_one); 
                    }elseif($data_old_employee_company['date_start'] == $employee_data_one['date_start']){
                        $storeEmployee = EmployeeCompany::updateOrCreate(['id'   => $data_old_employee_company['id']], $employee_data_one); 
                    }else{
                        $storeEmployee = EmployeeCompany::updateOrCreate(['id'   => $data_old_employee_company['id']], ['date_end'=>$employee_data_one['date_start']]); 
                        $storeEmployee = EmployeeCompany::create($employee_data_one); 
                    }
                }else{
                    $storeEmployee = EmployeeCompany::create($employee_data_one); 
                }

                // dd($premis); 



                
                foreach($premis as $premi){
                    // dd($nik_employee.'-'.$premi->uuid);
                   

                    if(!empty($employee_data_one[$premi->uuid])){
                        $employee_data_one['premi_value'] = $employee_data_one[$premi->uuid];
                        $employee_data_one['premi_uuid'] = $premi->uuid;
                        $employee_data_one['uuid'] = $nik_employee.'-'.$premi->uuid;
                        $premi_value = $employee_data_one[$premi->uuid];

                        if(!empty($get_all_employee_premis[$nik_employee.'-'.$premi->uuid])){
                            $data_old_premi[$premi->uuid] = $get_all_employee_premis[$nik_employee.'-'.$premi->uuid]->toArray(); 
                            $employee_data_one['premi_value'] = $employee_data_one[$premi->uuid];

                            if($data_old_premi[$premi->uuid]['date_start'] >  $employee_data_one['date_start']){
                                if(empty($employee_data_one['date_end_effective'])){
                                    $employee_data_one['date_end'] = $data_old_premi[$premi->uuid]['date_start'];
                                }else{
                                    $employee_data_one['date_end'] = $employee_data_one['date_end_effective'];
                                }
                                $storeEmployee = EmployeePremi::create($employee_data_one); 
                            }elseif($data_old_premi[$premi->uuid]['date_start']  == $employee_data_one['date_start']){
                                $storeEmployee = EmployeePremi::updateOrCreate(['id'   => $data_old_employee_roaster['id']], $employee_data_one); 
                            }else{
                                $storeEmployee = EmployeePremi::updateOrCreate(['id'   => $data_old_employee_roaster['id']], ['date_end'=>$employee_data_one['date_start']]); 
                                $storeEmployee = EmployeePremi::create($employee_data_one); 
                            }
                        }else{
                            $storeEmployee = EmployeePremi::create($employee_data_one); 
                        }
                        // dd($storeEmployee);
                    }
                }
                $no_employee++;
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();
    }

    public function exportSimple(){
        $row = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        // $date = Car
        $year_month = Carbon::today()->isoFormat('Y-M');
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $variables = Dictionary::all();

        $variables = $variables->keyBy(function ($item) {
            return strval($item->database);
        });

        // foreach($variables as $variable){
        //     Dictionary::updateOrCreate(['database'   => $variable->variable_code], ['excel'=> $variable->variable_name]);
        // }

        
        $arr_exports = [
            'no',
            'nik_employee',
            'name' ,            
            'machine_id',     
            'position',
            'department',
            'contract_status',
            'date_document_contract',   
            'date_start_contract',   
            'long_contract',          
            'date_end_contract',
            'tax_status',
            'financial_number',
            'financial_name',
            'bpjs_ketenagakerjaan',
            'bpjs_kesehatan',
            'nik_number',
            'npwp_number',
            'salary',
            'insentif',
            'tunjangan',
            'hour_meter_prices',
            'company',
            'roaster',
            'contract_number_full',     
        ];
        

        // return $arr_exports;

        $premis = Premi::all();
        foreach($premis as $premi){
            $arr_exports[] = $premi->uuid;           
        }
        $arr_exports[] ='date_start_effective';
        $arr_exports[] = 'date_end_effective';
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Import Data Karyawan Simpel');
        $createSheet->setCellValue('C1', 'Bulan');
        $createSheet->setCellValue('D1', $month);
        $createSheet->setCellValue('E1', 'Tahun');
        $createSheet->setCellValue('F1', $year);
        $no_col = 0;
        foreach($arr_exports as $item_export){
            $createSheet->setCellValue($row[$no_col].'2', $variables[$item_export]->excel);
            $no_col++;
        }
        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/Template Penambahan Karyawan -'.rand(99,9999).'file.xls';
        $crateWriter->save($name);

        return response()->download($name);
    }

    public function cekNikEmployee(Request $request){
        $data = Employee::where('nik_employee', $request->nik_employee)->get()->first();
        
        return ResponseFormatter::toJson($data, 'data nik');
    }

    

    public function storeFile(Request $request){
        $validatedData = $request->validate([
            'nik_employee_file' => '',
        ]);
        // return ResponseFormatter::toJson($validatedData, 'da');
        if($request->file('user_file')) {
            $imageName =   $validatedData['nik_employee_file']. '.'.$request->user_file->getClientOriginalExtension();
            $name = 'file/user/'.$imageName;
            if(file_exists($name)){
                $name = mt_rand(5, 99985) .'-'.$imageName;
                $name = 'file/user/'.$imageName;
            }
            
            $isMoved = $request->user_file->move('file/user/',$name);

            if($isMoved){
                $validatedData['file_path'] = $imageName;
            }
            $store = Employee::updateOrCreate(['nik_employee' => $validatedData['nik_employee_file']], $validatedData);
        }
      
        
        return ResponseFormatter::toJson($validatedData, 'file store');
    }
    public function store(Request $request){
        $validateData = $request->all();
        $user_detail_uuid = $validateData['user_detail_uuid'];
        if(empty($validateData['uuid'])){
            $validateData['uuid'] = $validateData['nik_employee'];
            $validateData['user_detail_uuid'] = $validateData['nik_employee'];
        }


        $number_contract = explode('/', $validateData['contract_number_full']);
        
        $validateData['contract_number'] =$number_contract[0];

        $storeEmployee = Employee::updateOrCreate(['uuid' => $validateData['uuid']], $validateData);

        $updateUserDetail = UserDetail::updateOrCreate(['uuid' => $user_detail_uuid],['date_start' => $validateData['date_start'],'uuid' => $validateData['uuid']]);
        $updateUserReligion = UserReligion::updateOrCreate(['uuid' => $user_detail_uuid],['date_start' => $validateData['date_start'],'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserHealth = UserHealth::updateOrCreate(['uuid' => $user_detail_uuid],['date_start' => $validateData['date_start'],'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserEducation = UserEducation::updateOrCreate(['uuid' => $user_detail_uuid],['date_start' => $validateData['date_start'],'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);  
        $updateUserDependent = UserDependent::updateOrCreate(['uuid' => $user_detail_uuid],['date_start' => $validateData['date_start'],'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserAddress = UserAddress::updateOrCreate(['uuid' => $user_detail_uuid],['date_start' => $validateData['date_start'],'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
        $updateUserAddress = UserLicense::updateOrCreate(['uuid' => $user_detail_uuid],['date_start' => $validateData['date_start'],'uuid' => $validateData['uuid'], 'user_detail_uuid' => $validateData['uuid']]);
       
        $updateUserCompany = EmployeeCompany::updateOrCreate(['uuid' => $validateData['uuid']], ['date_start' => $validateData['date_start'],'employee_uuid' => $storeEmployee->uuid,'company_uuid'=>$validateData['company_uuid']]);
        $updateUserRoaster = EmployeeRoaster::updateOrCreate(['uuid' => $validateData['uuid']], ['date_start' => $validateData['date_start'],'employee_uuid' => $storeEmployee->uuid,'roaster_uuid'=>$validateData['roaster_uuid']]);

        

        $validateDataUser['uuid'] =$storeEmployee->uuid;
        $validateDataUser['employee_uuid'] =   $validateData['uuid'];
        $validateDataUser['role'] = 'employee';
        $validateDataUser['nik_employee'] = $validateData['nik_employee'];;
        $validateDataUser['password'] = Hash::make('password');

        $updateUser = User::updateOrCreate(['uuid' => $validateDataUser['uuid']], $validateDataUser );

        $abc = [
            'validateDataUser' => $validateDataUser,
            'validateData' => $validateData,
            'updateUserDetail' => $updateUserDetail,
            'updateUserReligion' => $updateUserReligion,
            'updateUserHealth' => $updateUserHealth,
            'updateUserEducation' => $updateUserEducation,
            'updateUserDependent' => $updateUserDependent,
            'updateUserAddress' => $updateUserAddress,
            'updateUserCompany' => $updateUserCompany,
            
            'updateUserRoaster' => $updateUserRoaster,
            'updateUser' => $updateUser,
        ];

        return ResponseFormatter::toJson($storeEmployee, 'data store employee');
        return redirect()->intended('/user')->with('success',"Karyawan Ditambahkan");
    }

    public function show(Request $request){
        $data = Employee::where_employee_nik_employee_nullable($request->uuid);
        $userPrivileges = UserPrivilege::where('nik_employee', $request->uuid)->get();
        if(!empty($userPrivileges)){
            $data->user_privileges = $userPrivileges;
        }
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    public function profile($nik_employee){
        
        $data =Employee::noGet_employeeAll_detail()->where('employees.uuid', $nik_employee)->first();
         
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-profile'
        ];
        return view('employee.show', [
            'title'         => 'Profile Karyawan',
            'data'  => $data,
            'layout'    => $layout,
        ]);
    }
    public function anyData(){

        $data = Employee::join('user_details','user_details.uuid','=','employees.user_detail_uuid')
        ->join('positions','positions.uuid','=','employees.position_uuid')
        ->get([
            'user_details.name',
            'user_details.photo_path',
            'positions.position',
            'employees.employee_status',
            'employees.uuid',
            'employees.machine_id',
            'employees.nik_employee'
        ]);
        // return view('datatableshow', [ 'data'         => $data]);
        return Datatables::of($data)     
        ->make(true);
    }



    public function anyMoreData(Request $request){
        $data = Employee::noGet_employeeAll_detail()->get();
        // return $data;
        $datas = $data->keyBy(function ($item) {
            return strval($item->employee_uuid);
        });


        $employee_premis= EmployeePremi::all();

        foreach($employee_premis as $employee_premi){
            if(!empty($datas[$employee_premi->employee_uuid])){
                $name_col = $employee_premi->premi_uuid;
                $employee_uuid = $employee_premi->employee_uuid;
                $datas[$employee_uuid]->$name_col = $employee_premi->premi_value; 
            }
           
        }
        return ResponseFormatter::toJson($data, $datas);
        return Datatables::of($data)     
        ->make(true);
    }    
}
