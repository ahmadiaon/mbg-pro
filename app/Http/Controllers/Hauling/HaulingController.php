<?php

namespace App\Http\Controllers\Hauling;

use Illuminate\Http\Request;
use App\Models\Hauling\Hauling;
use App\Http\Controllers\Controller;

class HaulingController extends Controller
{
    //udin
    public function index(){
        return Hauling::all();
    }
}
