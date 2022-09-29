<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogisticController extends Controller
{
    public function index(){
        
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'logistic'
        ];
        return view('logistic.unit.index',[
            'title'         => 'Home - Logistic',
            'layout'    => $layout
        ]);
    }
}
