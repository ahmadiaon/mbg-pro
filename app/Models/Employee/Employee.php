<?php

namespace App\Models\Employee;

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
            'positions.position',
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
            'employees.uuid',
            'employees.nik_employee'
        ])
        ->first();
    }
}
