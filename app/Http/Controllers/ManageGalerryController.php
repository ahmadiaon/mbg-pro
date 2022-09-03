<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use File;


class ManageGalerryController extends Controller
{
    public function index()
    {
        return view('dashboard.manage.gallery.index', [
            'title'         => 'Gallery',
            'galleries'     => Gallery::latest()->filter()->paginate(9)
        ]);
    }
    public function anyData()
    {
        return Datatables::of(Gallery::latest())
            ->addColumn('action', function ($model) {
                return '<a class="text-decoration-none" href="/users/' . $model->id . '/edit"><i class="btn icon-copy dw dw-pencil"></i></a>
                <form action="/users/' . $model->id . '" method="post" id="delete-data" class="d-inline">' . csrf_field() .
                    method_field('delete') . '<button   onclick="JSconfirm()" type="submit" class="btn btn-outline-none text-decoration-none"><span data-feather="x-circle"><i class="icon-copy dw dw-trash"></i></span></button>
                </form>';
            })
            ->addColumn('path', function ($model) {
                return '<img src="/' . $model->path . '" class="img-fluid" alt="...">';
            })
            ->rawColumns(['path', 'action'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.manage.gallery.create', [
            'title'     => 'Create'
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
        $validateData = $request->validate([
            'name'         => 'required|max:255',
            'content'         => 'required|image|file|max:1024',
            'status'        => 'required'
        ]);

        $imageName = $request->name . '.' . $request->content->extension();

        $request->content->move('images/media/', $imageName);
        $validateData['uuid']  = Str::uuid();
        $validateData['name']  = $request->name;
        $validateData['is_url']  = 0;
        $validateData['url']  = "";
        $validateData['path']  = "images/media/" . $imageName;
        $validateData['mime_type']  = "image";
        $validateData['status']  =  $request->status;


        Gallery::create($validateData);
        return redirect('/galleries')->with('success', 'New Gallery Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('dashboard.manage.gallery.edit', [
            'title'         => 'Edit',
            'gallery'        => $gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        /*
            name,
            status,
            content
        */

        $validatedData = [];
        $rules = [
            'name'         => 'required|max:255',
            'content'         => 'image|file|max:1024',
            'status'        => 'required'
        ];
        $validateData =  $request->validate($rules);
        if ($request->file('content')) {
            if ($request->oldImage) {
                $oldImage = $gallery->path;
                
              
            }
           
            $imageName = date("Y-m-d- h").$request->name . '.' . $request->content->extension();
            // dd($imageName);
            $request->content->move('images/media', $imageName);
            $validatedData['path']  = "images/media/" . $imageName;
        }
        $validatedData['status'] = $request->status;
        $validatedData['name'] = $request->name;
        Gallery::where('id', $gallery->id)->update($validatedData);
        return redirect('/galleries')->with('success', 'Proses Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        Gallery::destroy($gallery->id);
        return redirect('/galleries/')->with('success', 'Post has been Deleted!');
    }
}
