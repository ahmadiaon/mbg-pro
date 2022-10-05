<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TotalController extends Controller
{
    //
    public function indexPayrol($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        // return $year_month;

        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'payrol-total',
        ];
        return view('total.payrol.index', [
            'title'         => 'Employee',
            'month'     => $year_month,
            'layout'    => $layout
        ]);
    }
}
