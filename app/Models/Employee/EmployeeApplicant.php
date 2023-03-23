<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeApplicant extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
