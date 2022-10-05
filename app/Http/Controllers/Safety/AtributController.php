<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AtributController extends Controller
{
    public function index(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'manage'
        ];
        return view('safety.atribut.index', [
            'title'         => 'Add People',
            'layout'    => $layout
        ]);
    }
}
