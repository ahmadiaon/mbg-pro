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

    public function slipManage(){
        return view('app.manage.slip.index', [
            'title'         => 'Slip'
        ]);
    }

    public function manageIndex(){
        $TES = "DSA/SAD";

        dd($TES);


        return view('app.manage.absensi.index', [
            'title'         => 'Slip'
        ]);
    }
}
