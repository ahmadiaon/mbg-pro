<?php

namespace App\Models\Employee;

use App\Models\Privilege\UserPrivilege;
use App\Models\Safety\SafetyEmployee;
use App\Models\UserDetail\UserAddress;
use App\Models\UserDetail\UserDependent;
use App\Models\UserDetail\UserDetail;
use App\Models\UserDetail\UserEducation;
use App\Models\UserDetail\UserExperience;
use App\Models\UserDetail\UserHealth;
use App\Models\UserDetail\UserLicense;
use App\Models\UserDetail\UserReligion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getAll(){
        return Employee::join('user_details','user_details.uuid','=','employees.user_detail_uuid')
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
    }
    public static function where_uuid($employee_uuid){
        return Employee::where('uuid', $employee_uuid)->get('nik_employee')->first();
    }
    public static function where_employee_uuid($employee_uuid){
        return Employee::join('user_details','user_details.uuid','=','employees.user_detail_uuid')
        ->join('positions','positions.uuid','=','employees.position_uuid')
        ->where('employees.uuid', $employee_uuid)
        ->get([
            'user_details.name',
            'positions.position',
            'user_details.photo_path',
            'employees.uuid',
            'employees.employee_status',
            'employees.nik_employee'
        ])
        ->first();
    }
    public static function where_employee_nik_employee($employee_uuid){
        $data = Employee::where('employees.nik_employee', $employee_uuid)
        ->get([
            'employees.uuid as employee_uuid',
            'employees.*',
        ])
        ->first();

        $data = Employee::join('user_details','user_details.uuid','=','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','=','employees.position_uuid')
        ->leftJoin('user_religions','user_religions.user_detail_uuid','=','user_details.uuid')
        ->leftJoin('religions','religions.uuid','=','user_religions.religion_uuid')
        ->leftJoin('departments','departments.uuid','=','employees.department_uuid')
        ->leftJoin('user_addresses','user_addresses.user_detail_uuid','user_details.uuid')
        ->leftJoin('user_dependents','user_dependents.user_detail_uuid','user_details.uuid')
        ->leftJoin('user_education','user_education.user_detail_uuid','user_details.uuid')
        ->leftJoin('user_licenses','user_licenses.user_detail_uuid','user_details.uuid')
        ->leftJoin('user_healths','user_healths.user_detail_uuid','user_details.uuid')
        ->where('employees.nik_employee', $employee_uuid)
        ->orWhere('user_healths.data_status', 1)
        ->get([
            'religions.religion',
            'user_licenses.*',
            'user_healths.*',
            'user_healths.long as long_health',
            'user_healths.uuid as user_health_uuid',
            'user_licenses.uuid as user_license_uuid',
            'positions.position',
            'departments.department',
            'user_addresses.*',
            'user_addresses.uuid as user_address_uuid',
            'user_details.*',
            'user_details.status as merrid',
            'user_details.uuid as user_detail_uuid',
            'user_religions.uuid as user_religion_uuid',
            'employees.uuid',
            'employees.uuid as employee_uuid',
            'employees.*',
            'user_dependents.*',
            'user_education.uuid as user_education_uuid',
            'user_education.*'
        ])
        ->first();
        if(!empty($data)){
            $user_experiences = UserExperience::where('user_detail_uuid', $data->user_detail_uuid)->get();
            $i = 0;
            foreach($user_experiences as $item){
                $item->index = $i;
                $i++;
            }
            $user_privileges = UserPrivilege::where('nik_employee', $data->nik_employee)->get();
            // dd($user_privileges);
            if(!empty($user_privileges)){
                foreach($user_privileges as $item){
                    // dd($item->privilege_uuid);
                    $varri = $item->privilege_uuid;
                    $data->$varri = 1;
                }
    
                // $data->user_privileges = $user_privileges;
            }
            if(!empty($user_experiences)){
                $data->user_experiences = $user_experiences;
            }
        }
        return $data;
    }

    public  static function where_employee_nik_employee_nullable($employee_uuid){
        $data = Employee::leftJoin('positions','positions.uuid','=','employees.position_uuid')
        ->leftJoin('departments','departments.uuid','=','employees.department_uuid')
        ->where('employees.nik_employee', $employee_uuid)
        ->get([
            'positions.position',
            'departments.department',
            'employees.uuid as employee_uuid',
            'employees.*',
        ])
        ->first();

        $data->user_details = $dataUserDetail = UserDetail::where_user_detail_uuid($data->user_detail_uuid);
        $data->user_addresses =$dataUserAddress = UserAddress::where_user_detail_uuid($data->user_detail_uuid);
        $data->user_religions =$dataUserReligion = UserReligion::where_user_detail_uuid($data->user_detail_uuid);
        $data->user_education =$dataUserEducation = UserEducation::where_user_detail_uuid($data->user_detail_uuid);
        $data->user_licenses =$dataUserLicense = UserLicense::where_user_detail_uuid($data->user_detail_uuid);
        $data->user_healths =$dataUserHealth = UserHealth::where_user_detail_uuid($data->user_detail_uuid);
        $data->user_dependents =$dataUserDependent = UserDependent::where_user_detail_uuid($data->user_detail_uuid);
        $data->user_privileges =$dataUserPrivilege = UserPrivilege::where_nik_employee($employee_uuid);
        $data->employee_salaries =$dataEmployeeSalary = EmployeeSalary::where_nik_employee($employee_uuid);
        
        
        // dd($data);
      
        return $data;

    }
    public  static function all_nullable(){
        $employees = Employee::all();

        foreach($employees as $item){
            $item->user_details = $dataUserDetail = UserDetail::where_user_detail_uuid($item->user_detail_uuid);
            $item->user_addresses =$dataUserAddress = UserAddress::where_user_detail_uuid($item->user_detail_uuid);
            $item->user_religions =$dataUserReligion = UserReligion::where_user_detail_uuid($item->user_detail_uuid);
            $item->user_education =$dataUserEducation = UserEducation::where_user_detail_uuid($item->user_detail_uuid);
            $item->user_licenses =$dataUserLicense = UserLicense::where_user_detail_uuid($item->user_detail_uuid);
            $item->user_healths =$dataUserHealth = UserHealth::where_user_detail_uuid($item->user_detail_uuid);
            $item->user_dependents =$dataUserDependent = UserDependent::where_user_detail_uuid($item->user_detail_uuid);
            $item->user_privileges =$dataUserPrivilege = UserPrivilege::where_nik_employee($item->uuid);
            $item->employee_salaries =$dataEmployeeSalary = EmployeeSalary::where_nik_employee($item->uuid);
            $item->user_safety = SafetyEmployee::where('employee_uuid',$item->uuid)->get()->first();
        }
        return $employees;

    }
}
