<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    //
    public function index()
    {
        return session('dataUser')->group;

        $nik = 1212;
        $people = DB::table('employees')
        ->join('positions', 'employees.position_id', '=', 'positions.id')
        ->join('people', 'employees.people_id', '=', 'people.id')
        ->join('departments', 'employees.department_id', '=', 'departments.id')
        ->where('people.nik_number', $nik)
        ->get()
        ->first();

        return view('public.index', [
            'title'         => 'Beranda',
            'people'=> $people
        ]);
    }

}
