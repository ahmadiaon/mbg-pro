<?php

namespace App\Http\Controllers\UserDetail;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserLicenseController extends Controller
{
    public function create(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'admin-hr-employees'
        ];
        
        return view('hr.user.experience.create', [
            'title'         => 'Add People',
            'user_detail_uuid' => session('user_detail_uuid'),
            'layout'    => $layout
        ]);
    }
}
