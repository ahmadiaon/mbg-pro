<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebAbsensiController extends Controller
{
    public function index(){
        return view('app.pendapatan.absensi.index', [
            'title'         => 'Absensi'
        ]);
    }

    public function slip(){
        return view('app.pendapatan.slip.index', [
            'title'         => 'Slip'
        ]);
    }
}