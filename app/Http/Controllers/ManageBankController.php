<?php

namespace App\Http\Controllers;

use App\Models\FinancialService;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;


class ManageBankController extends Controller
{
    public function index()
    {
        return view('dashboard.manage.financial.index', [
            'title'         => 'Financial',
        ]);
    }
    public function anyData()
    {
        return Datatables::of(FinancialService::latest())
            ->addColumn('action', function ($model) {
                return '<a class="text-decoration-none" href="/bank/edit/' . $model->id . '"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>
                <button onclick="myFunction(' . $model->id . ')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
            })
            ->addColumn('image', function ($model) {
                return '
                <div class="user-info-dropdown">
                    <a class="dropdown-toggle" >
                        <span class="user-icon">
                            <img src="/vendors/images/photo1.jpg" alt="">
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
        return view('dashboard.manage.financial.create', [
            'title'         => 'Create Financial',
            'galleries' => Gallery::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'                      => 'required|max:255',
            'description'               => 'required',
            'address'                   => 'required',
            'city'                      => 'required',
            'province'                  => 'required',
            'location'                  => 'required',
            'instagram'                 => '',
            'facebook'                  => '',
            'youtube'                   => '',
            'image_path'                => 'required',
            'logo_path'                 => 'required',
            'status'                    => 'required',
        ]);
        $myArray = explode(',', $validatedData['image_path']);
        $validatedData['image_path'] = "";
        foreach ($myArray as $value) {
            $validatedData['image_path'] = $validatedData['image_path'] . ',"' . $value . '"';
        }
        $str = ltrim($validatedData['image_path'], ',');
        $validatedData['image_path'] = '[' . $str . ']';
        $validatedData['uuid']  = Str::uuid();
        FinancialService::create($validatedData);
        return redirect('/bank')->with('success', 'New Financial Inserted!');
    }

    public function show(FinancialService $financialService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FinancialService  $financialService
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialService $financialService)
    {

        $str = ltrim($financialService->image_path, '[');
        $str1 = substr($str, 0, -1);
        $myArray = explode(',', $str1);
        return view('dashboard.manage.financial.edit', [
            'title'     => 'Edit',
            'galleries' => Gallery::latest()->get(),
            'financial'      => $financialService,
            'image_paths' => $myArray
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FinancialService  $financialService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinancialService $financialService)
    {
        $validatedData = $request->validate([
            'name'                      => 'required|max:255',
            'description'               => 'required',
            'address'                   => 'required',
            'city'                      => 'required',
            'province'                  => 'required',
            'location'                  => 'required',
            'instagram'                 => 'required',
            'facebook'                  => 'required',
            'youtube'                   => 'required',
            'image_path'                => 'required',
            'status'                    => 'required',
            'logo_path'                    => 'required',
        ]);
        $myArray = explode(',', $validatedData['image_path']);
        $validatedData['image_path'] = "";
        foreach ($myArray as $value) {
            $validatedData['image_path'] = $validatedData['image_path'] . ',"' . $value . '"';
        }
        $str = ltrim($validatedData['image_path'], ',');
        $validatedData['image_path'] = '[' . $str . ']';

        FinancialService::where('id', $financialService->id)->update($validatedData);
        return redirect('/bank')->with('success', 'Financial Edited!');
    }


    public function destroy(FinancialService $financialService)
    {
        FinancialService::destroy($financialService->id);
        return redirect('/bank/')->with('success', 'Financial has been Deleted!');
    }
}
