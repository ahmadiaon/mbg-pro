<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function where_nik_employee($employee_uuid){
        $data = EmployeeSalary::where('employee_uuid', $employee_uuid)
        ->get()
        ->first();
        if(!empty($data)){
            return $data;
        }else{
            return $data = null;
        }

    }
}
