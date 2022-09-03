<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\User;
use App\Models\Community;
use App\Models\Business;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;
use PDF;

class DashboardController extends Controller
{
    public function index()
    {
        return "aaa";
        $user = User::count();
        $community = Community::count();
        $bussines = Business::count();
        $tour = Tour::count();
        if(!session('admin')){
            return redirect()->intended('/login-admin');
        }else{
            session('admin')['name'];
        }

        return view('dashboard.index', [
            'title'         => 'Dashboard',
            'user'          => $user,
            'community'     => $community,
            'business'     => $bussines,
            'tour'          => $tour


        ]);
    }
    public function anyData()
    {
        return Datatables::of(User::query())->make(true);
    }
}
