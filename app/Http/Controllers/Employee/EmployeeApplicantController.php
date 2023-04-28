<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeApplicant;
use App\Models\UserDetail\UserDetail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class EmployeeApplicantController extends Controller
{
    public function index(){        
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'applicant-index'
        ];

        return view('employee.applicant.index', [
            'title'         => 'Pelamar',
            'layout'    => $layout
        ]);
    }

    public function delete(Request $request)
    {
         $store = EmployeeApplicant::where('uuid',$request->uuid)->delete(); 
         return ResponseFormatter::toJson($store, 'Data EmployeeApplicant deleted');
    }

    public function indexRecruitment(){        
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'applicant-index'
        ];

        return view('employee.applicant.indexRecruitment', [
            'title'         => 'Pelamar',
            'layout'    => $layout
        ]);
    }

    public function anyData(Request $request){
        $employeeee = EmployeeApplicant::whereNull('recruitment_uuid')->get();

        $employee_talent = UserDetail::join('employees', 'employees.user_detail_uuid', 'user_details.uuid')
        ->leftJoin('user_healths', 'user_healths.user_detail_uuid', 'user_details.uuid')
        ->leftJoin('user_addresses', 'user_addresses.user_detail_uuid', 'user_details.uuid')
        ->leftJoin('user_education', 'user_education.user_detail_uuid', 'user_details.uuid')
        ->leftJoin('user_licenses', 'user_licenses.user_detail_uuid', 'user_details.uuid')
        ->leftJoin('user_dependents', 'user_dependents.user_detail_uuid', 'user_details.uuid')
        ->where('employees.employee_status', 'talent')
        ->get();
        

        $arr_employee_talent = [];

        foreach($employee_talent as $item){
            $arr_employee_talent[$item->nik_employee]  = $item;
        }

        $employee_document = Employee::join('employee_documents', 'employee_documents.employee_uuid', 'employees.nik_employee')
        ->where('employees.employee_status', 'talent')
        ->get('employee_documents.*');

       
        foreach($employee_document as $item){
            $name_col = $item->document_table_name;
            $arr_employee_talent[$item->employee_uuid]->$name_col = $item->document_path;
        }

        $database = session('database');
        $database['data']['data_employee_talent'] = $arr_employee_talent;

        session()->put('database', $database);

        // dd($arr_employee_talent);

        $employeeee_not_null = EmployeeApplicant::join('employees','employees.nik_employee', 'employee_applicants.employee_uuid')
        ->join('recruitments','recruitments.uuid', 'employee_applicants.recruitment_uuid');
        if(!empty($request->employee_uuid)){
            $employeeee_not_null = $employeeee_not_null->where('employee_applicants.employee_uuid', $request->employee_uuid);
        }
       $employeeee_not_null = $employeeee_not_null->get([
            'employee_applicants.*',
            'recruitments.position_uuid'
        ]);
        // return ResponseFormatter::toJson($employeeee_not_null, 'bbb');
        $employeeee = $employeeee->merge($employeeee_not_null);

        return DataTables::of($employeeee)    
        ->make(true);

        return ResponseFormatter::toJson($employeeee, 'bbb');
    }

    public static function data_employee_talent(){
        $employee_talent = UserDetail::join('employees', 'employees.user_detail_uuid', 'user_details.uuid')
        ->leftJoin('user_healths', 'user_healths.user_detail_uuid', 'user_details.uuid')
        ->leftJoin('user_addresses', 'user_addresses.user_detail_uuid', 'user_details.uuid')
        ->leftJoin('user_education', 'user_education.user_detail_uuid', 'user_details.uuid')
        ->leftJoin('user_licenses', 'user_licenses.user_detail_uuid', 'user_details.uuid')
        ->leftJoin('user_dependents', 'user_dependents.user_detail_uuid', 'user_details.uuid')
        ->where('employees.employee_status', 'talent')
        ->get();

        $arr_employee_talent = [];

        foreach($employee_talent as $item){
            $arr_employee_talent[$item->nik_employee]  = $item;
        }

        $employee_document = Employee::join('employee_documents', 'employee_documents.employee_uuid', 'employees.nik_employee')
        ->where('employees.employee_status', 'talent')
        ->get('employee_documents.*');

        foreach($employee_document as $item){
            $name_col = $item->document_table_name;
            $arr_employee_talent[$item->employee_uuid]->$name_col = $item->document_path;
        }

        return $arr_employee_talent;
    }


    public function store(Request $request)
    {

        $validateData = $request->all();
        // return ResponseFormatter::toJson($validateData, 'Data Store User Apply');
   
        $data = session('recruitment-user');
        if (empty($validateData['date_start'])) {
            $validateData['date_start'] = ResponseFormatter::getDateToday();
        }
        if (empty($validateData['date_applicant'])) {
            $validateData['date_applicant'] = ResponseFormatter::getDateToday();
        }
        if (empty($validateData['status_applicant'])) {
            $validateData['status_applicant'] = 'apply';
        }

        if (empty($validateData['uuid'])) {
            $validateData['uuid'] = $data['detail']['uuid'].'-';
            if(!empty($validateData['position_uuid'])){
                $validateData['uuid'] = $validateData['uuid'].$validateData['position_uuid'];
            }else{
                $validateData['uuid'] = $validateData['uuid'].$validateData['recruitment_uuid'];
            }
        }

        $store = EmployeeApplicant::updateOrCreate(['uuid'=> $validateData['uuid']], $validateData);
        ResponseFormatter::setAllSession();
        return ResponseFormatter::toJson($store, 'Data Store User Apply');
   


          


        return ResponseFormatter::toJson($data, 'Data Store User Document');
    }
}