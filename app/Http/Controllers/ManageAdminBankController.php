<?php

namespace App\Http\Controllers;

use App\Models\FinancialService;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class ManageAdminBankController extends Controller
{
    public function index()
    {
        // return User::join('financial_services', 'financial_services.uuid', '=', 'users.role')
        //             ->get();
        
        return view('dashboard.manage.bankadmin.index', [
            'title'         => 'Bank Admin',
        ]);
    }

    public function anyData()
    {

        return Datatables::of(User::join('financial_services', 'financial_services.uuid', '=', 'users.role')->get(["users.name as name", "users.*","financial_services.name as bank"]))
            ->addColumn('action', function ($model) {
                $aaa = "a";
                return '<a class="text-decoration-none" href="/admin-bank/' . $model->id . '/edit"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>
                <button onclick="myFunction(' . $model->id . ')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
            })
            ->addColumn('image', function ($model) {
                return '
                <div class="user-info-dropdown">
                    <a class="dropdown-toggle" >
                        <span class="user-icon">
                            <img src="/images/reviews/satu.png" alt="">
                        </span>
                    </a>
                </div>
                ';
            })
            ->escapeColumns('image')

            ->make(true);
    }
    public function create()
    {
        $financials = FinancialService::latest()->get();
        // return $financials;
        return view('dashboard.manage.bankadmin.create', [
            'title'     => 'Create',
            'financials'    => $financials
        ]);
    }

 
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'         => 'required|max:255',
            'phone_number'          => 'required|unique:users',
            'email'     => 'required|email:dns|unique:users',
            'role'         => '',
            'password' => 'required'
        ]);

        $validatedData['password'] =  Hash::make($validatedData['password']);
        $validatedData['uuid']  = Str::uuid();
        User::create($validatedData);
        return redirect('/admin-bank')->with('success', 'New Post Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }
    public function edit( $id)
    {
          
         $user = User::latest()->where('users.id',$id)->get()->first();
         $financials = FinancialService::latest()->get();
        return view('dashboard.manage.bankadmin.edit', [
            'title'     => 'Edit',
            'user'      => $user,
            'financials'    => $financials
        ]);
    }

    public function update(Request $request, $id)
    {

        $user = $user = User::latest()->where('users.id',$id)->get()->first();
        $rules = [
            'name'          => 'required|max:255',
            'email'         => 'required|email:dns',
            'role'         => '',
        ];

        if ($request->phone_number != $user->phone_number) {
            $rules['phone_number'] =  'required|unique:users';
        }

        $validateData =  $request->validate($rules);

        if ($request->password == null) {
            unset($validateData['password']);
        } else {
            $validateData['password'] =  Hash::make($request->password);
        }

        User::where('id', $user->id)->update($validateData);
        return redirect('/admin-bank')->with('success', 'Admin Updated Inserted!');
    }


    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/admin-bank')->with('success', 'Admin has been Deleted!');
    }
}
