<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\People;


class AdminController extends Controller
{
    public function index()
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'listEmployee'
        ];

        return view('superadmin.index', [
            'title'         => 'Beranda',
            'layout'        => $layout
        ]);
    }
    public function indexHR()
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'listEmployee'
        ];
        return view('hr.index', [
            'title'         => 'Beranda HR',
            'layout'        => $layout
        ]);
    }

    public function listEmployee()
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => false,
            'javascript_form'       => false,
            'active'                        => 'listEmployee'
        ];

        return view('hr.listEmployee', [
            'title'         => 'List Employee',
            'layout'       => $layout
        ]);
    }

}
