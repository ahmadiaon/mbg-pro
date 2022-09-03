<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\User;
use App\Models\Slide;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;



class ManageSlideController extends Controller
{

    public function index()
    {
        return view('dashboard.manage.slide.index', [
            'title'         => 'Slide',
        ]);
    }
    public function anyData()
    {

        return Datatables::of(Slide::join('galleries', 'galleries.uuid', '=', 'slides.gallery_uuid')->get(['slides.*', 'galleries.path']))
            ->addColumn('action', function ($model) {
                return '<a class="text-decoration-none" href="/slides/' . $model->id . '/edit"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>
                <button onclick="myFunction(' . $model->id . ')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
            })
            ->addColumn('image', function ($model) {
                return '
                <div class="user-info-dropdown">
                    <a class="dropdown-toggle" >
                        <span class="user">
                            <img src="'.env("APP_URL").'/'.$model->path.'" alt="">
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
        return view('dashboard.manage.slide.create', [
            'title'     => 'Create',
            'galleries' => Gallery::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'         => 'required|max:255',
            'gallery_uuid'   => 'exists:galleries,uuid',
            'status'    => 'required'
        ]);
        $validatedData['uuid']  = Str::uuid();
        Slide::create($validatedData);
        return redirect('/slides')->with('success', 'New Slide Inserted!');
    }

    public function show(Slide $slide)
    {
        //
    }

    public function edit(Slide $slide)
    {
        return view('dashboard.manage.slide.edit', [
            'title'     => 'Edit',
            'slide'      => $slide,
            'galleries' => Gallery::latest()->get()
        ]);
    }

    public function update(Request $request, Slide $slide)
    {
        $validatedData = $request->validate([
            'title'         => 'required|max:255',
            'gallery_uuid'   => 'exists:galleries,uuid',
            'status'    => 'required'
        ]);
        Slide::where('id', $slide->id)->update($validatedData);
        return redirect('/slides')->with('success', 'Slide Edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        Slide::destroy($slide->id);
        return redirect('/slides')->with('success', 'Slide has been Deleted!');
    }
}
