<?php

namespace App\Models\Employee;

use App\Models\UserDetail\UserExperience;
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
            'employees.nik_employee'
        ]);
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
        $data = Employee::join('user_details','user_details.uuid','=','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','=','employees.position_uuid')
        ->leftJoin('departments','departments.uuid','=','employees.department_uuid')
        ->leftJoin('user_addresses','user_addresses.user_detail_uuid','user_details.uuid')
        ->leftJoin('user_dependents','user_dependents.user_detail_uuid','user_details.uuid')
        ->leftJoin('user_education','user_education.user_detail_uuid','user_details.uuid')
        ->where('employees.nik_employee', $employee_uuid)
        ->get([
            'positions.position',
            'departments.department',
            'user_addresses.*',
            'user_details.*',
            'user_details.status as merrid',
            'user_details.uuid as user_details_uuid',
            'employees.uuid',
            'employees.uuid as employee_uuid',
            'employees.*',
            'user_dependents.*',
            'user_education.*'
        ])
        ->first();
        $user_experiences = UserExperience::where('user_detail_uuid', $data->user_detail_uuid)->get();

        $data->user_experiences = $user_experiences;

        return $data;
    }
}
