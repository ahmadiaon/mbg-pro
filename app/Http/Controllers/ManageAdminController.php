<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\FinancialService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class ManageAdminController extends Controller
{
    public function index()
    {
        // $data = Admin::leftjoin('financial_services', 'admins.role', '=', 'financial_services.uuid')->get(['admins.*','admins.password', 'financial_services.name as admins']);
        // $data = Admin::all();
        // return $data;
        
        return view('dashboard.manage.admin.index', [
            'title'         => 'Admin',
        ]);
    }
    public function anyData()
    {
        return Datatables::of(Admin::leftjoin('financial_services', 'admins.role', '=', 'financial_services.uuid')->get(['admins.*', 'financial_services.name as admin']))
            ->addColumn('action', function ($model) {
                return '<a class="text-decoration-none" href="/admin/' . $model->id . '/edit"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>
                <button onclick="myFunction(' . $model->id . ')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
            })

            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $financials = FinancialService::latest()->get();
        // return $financials;
        return view('dashboard.manage.admin.create', [
            'title'     => 'Create',
            'financials'    => $financials
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'         => 'required|max:255',
            'phone'        => 'required|unique:admins',
            'status'       => 'required',
            'email'        => 'required|email:dns|unique:admins',
            'password'     => 'required'
        ]);
        $validatedData['password'] =  Hash::make($validatedData['password']);
        $validatedData['uuid']  = Str::uuid();
        $validatedData['phone'] = $request->phone;
        // return $validatedData;
        Admin::create($validatedData);
        return redirect('/admin')->with('success', 'New Admin Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('dashboard.manage.admin.edit', [
            'title'     => 'Edit',
            'admin'      => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $rules = [
            'name'         => 'required|max:255',
            'status'       => 'required',
        ];


        if ($request->email != $admin->email) {
            $rules['email'] =  'required|email:dns|unique:admins';
        }
        if ($request->phone != $admin->phone) {
            $rules['phone'] =  'required|unique:admins';
        }

        $validateData =  $request->validate($rules);
        // $validatedData = $request->except('_method', '_token');
        if ($request->password == null) {
            unset($validateData['password']);
        } else {
            $validateData['password'] =  Hash::make($request->password);
        }
        Admin::where('id', $admin->id)->update($validateData);
        return redirect('/admin')->with('success', 'New Post Inserted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        Admin::destroy($admin->id);
        return redirect('/admin/')->with('success', 'Post has been Deleted!');
    }
}
