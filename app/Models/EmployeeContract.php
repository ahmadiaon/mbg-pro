<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeContract extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getEmployee(){
        $data = DB::table('employee_contracts')
        ->join('employees', 'employees.uuid', '=', 'employee_contracts.employee_uuid')
        ->join('people', 'people.uuid', '=', 'employees.people_uuid')
        ->join('positions', 'positions.uuid', '=', 'employee_contracts.position_uuid')
        ->get([ 
            'people.name',
            'employee_contracts.uuid',
            'employees.id as  employee_id',
            'employees.nik_employee',
            'positions.position',
        ]);

        return $data;
    }
}
