<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\People;
use App\Models\Vehicle;
use App\Models\Employee;
use App\Models\OverBurden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ObAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "admin-ob";
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'listEmployee'
        ];

        return view('ob.index', [
            'title'         => 'Over Burden',
            'layout'       => $layout
        ]);
    }
    
    

}
