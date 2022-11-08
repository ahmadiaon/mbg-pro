<?php

namespace App\Http\Controllers;

use App\Models\EmployeeCompany;
use App\Http\Requests\StoreEmployeeCompanyRequest;
use App\Http\Requests\UpdateEmployeeCompanyRequest;

class EmployeeCompanyController extends Controller
{
    public function index(){
        return true;
    }

}