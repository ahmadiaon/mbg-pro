<?php

namespace App\Http\Controllers;

use App\Models\CommunityCategory;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use App\Models\Gallery;


class ManageCommunityCategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.manage.communitycategory.index', [
            'title'         => 'Category',
        ]);
    }
    public function anyData()
    {
        return Datatables::of(CommunityCategory::latest())
            ->addColumn('action', function ($model) {
                return '<a class="text-decoration-none" href="/community-category/' . $model->id . '/edit"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.manage.communitycategory.create', [
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
        CommunityCategory::create($validatedData);
        return redirect('/community-category')->with('success', 'New Category Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityCategory  $communityCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityCategory $communityCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityCategory  $communityCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityCategory $communityCategory)
    {
        return view('dashboard.manage.communitycategory.edit', [
            'title'     => 'Edit',
            'category'      => $communityCategory,
            'galleries' => Gallery::latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommunityCategory  $communityCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunityCategory $communityCategory)
    {
        $validatedData = $request->validate([
            'category'         => 'required|max:255',
            'gallery_uuid'   => 'exists:galleries,uuid',
            'status'    => 'required'
        ]);
        CommunityCategory::where('id', $communityCategory->id)->update($validatedData);
        return redirect('/community-category')->with('success', 'Category Edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityCategory  $communityCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityCategory $communityCategory)
    {
        CommunityCategory::destroy($communityCategory->id);
        return redirect('/community-category/')->with('success', 'Category has been Deleted!');
    }
}
