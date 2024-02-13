<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebHaulingController extends Controller
{
    public function index(){
        // dd(session()->all());
        return view('app.pendapatan.hauling.index');
    }
}
