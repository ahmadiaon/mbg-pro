<?php

namespace App\Http\Controllers;

use App\Models\youtube;
use App\Models\Gallery;
use App\Models\User;
use App\Models\Slide;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class ManageYoutubeController extends Controller
{
    public function index()
    {
        return view('dashboard.manage.youtube.index', [
            'title'         => 'Slide',
        ]);
    }
    public function anyData()
    {

        return Datatables::of(youtube::latest()->get())
            ->addColumn('action', function ($model) {
                return '<a class="text-decoration-none" href="/youtube/' . $model->id . '/edit"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>
                <button onclick="myFunction(' . $model->id . ')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
            })
            ->make(true);
    }
    public function create()
    {
        return view('dashboard.manage.youtube.create', [
            'title'     => 'Create',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'         => 'required|max:255',
            'url'         => 'required|max:255',
            'status'    => 'required'
        ]);
        $validatedData['uuid']  = Str::uuid();
        youtube::create($validatedData);
        return redirect('/youtube')->with('success', 'New Youtube Inserted!');
    }


    public function show(youtube $youtube)
    {
        return "edit";
        return view('dashboard.manage.youtube.edit', [
            'title'     => 'Edit',
            'youtube'      => $youtube,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function edit(youtube $youtube)
    {
        return view('dashboard.manage.youtube.edit', [
            'title'     => 'Edit',
            'youtube'      => $youtube,
        ]);
    }


    public function update(Request $request, youtube $youtube)
    {
        $validatedData = $request->validate([
            'name'         => 'required|max:255',
            'url'         => 'required|max:255',
            'status'    => 'required'
        ]);
        youtube::where('id', $youtube->id)->update($validatedData);
        return redirect('/youtube')->with('success', 'Youtube Edited!');
    }

    
    public function destroy(youtube $youtube)
    {
        youtube::destroy($youtube->id);
        return redirect('/youtube')->with('success', 'Youtube has been Deleted!');
    }
}
