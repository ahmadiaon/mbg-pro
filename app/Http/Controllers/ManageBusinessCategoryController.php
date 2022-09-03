<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class ManageBusinessCategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.manage.businesscategory.index', [
            'title'         => 'Category',
        ]);
    }
    public function anyData()
    {
        return Datatables::of(BusinessCategory::join('galleries', 'galleries.uuid', '=', 'business_categories.gallery_uuid')->get(['business_categories.*', 'galleries.path']))
            ->addColumn('action', function ($model) {
                return '<a class="text-decoration-none" href="/business-category/' . $model->id . '/edit"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>
                <button onclick="myFunction(' . $model->id . ')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
            })
            ->addColumn('image', function ($model) {
                return '
                <div class="user-info-dropdown">
                    <a class="dropdown-toggle" >
                        <span class="icon">
                        <img src="'.env("APP_URL").'/'.$model->path.'" alt="">
                        </span>
                    </a>
                </div>
                ';
            })
            ->escapeColumns('image')

            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.manage.businesscategory.create', [
            'title'     => 'Create',
            'galleries' => Gallery::latest()->get()
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
            'category'         => 'required|max:255',
            'gallery_uuid'   => 'exists:galleries,uuid',
            'status'    => 'required'
        ]);
        $validatedData['uuid']  = Str::uuid();
        BusinessCategory::create($validatedData);
        return redirect('/business-category')->with('success', 'New Category Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessCategory  $businessCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessCategory $businessCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessCategory  $businessCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessCategory $businessCategory)
    {
        return view('dashboard.manage.businesscategory.edit', [
            'title'     => 'Edit',
            'category'      => $businessCategory,
            'galleries' => Gallery::latest()->get()
            // 'users'         => User::get()
            // 'users'         => User::select('name', 'email', 'phone_number')->get()->paginate(7)->withQueryString()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessCategory  $businessCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessCategory $businessCategory)
    {
        $validatedData = $request->validate([
            'category'         => 'required|max:255',
            'gallery_uuid'   => 'exists:galleries,uuid',
            'status'    => 'required'
        ]);
        BusinessCategory::where('id', $businessCategory->id)->update($validatedData);
        return redirect('/business-category')->with('success', 'Category Edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessCategory  $businessCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessCategory $businessCategory)
    {
        BusinessCategory::destroy($businessCategory->id);
        return redirect('/business-category/')->with('success', 'Category has been Deleted!');
    }
}
