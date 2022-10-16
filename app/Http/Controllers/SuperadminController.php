<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function index(){
        // return 'aa';
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'database'
        ];
        return view('database.index', [
            'title'         => 'Purchase Order',
            'layout'    => $layout,
        ]);
    }

    
}
