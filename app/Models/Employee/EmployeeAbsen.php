<?php

namespace App\Models\Employee;

use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAbsen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public static function storeAbsen($data){
        $period = CarbonPeriod::create($data['date_start'], $data['date_end']);
                
        foreach ($period as $date) {
            $store_employee_absen = EmployeeAbsen::updateOrCreate(
                [
                    'employee_uuid'  => $data['NRP'],
                    'date' => $date->toDateString() . PHP_EOL,
                ],
                [
                    'uuid' => $date->toDateString() . PHP_EOL . '-' . $data['NRP'],
                    'status_absen_uuid'     => $data['status_absen_uuid'],
                ]
            );
        }
    }
}
