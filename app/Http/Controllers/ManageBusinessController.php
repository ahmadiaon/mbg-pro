<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ManageBusinessController extends Controller
{
    public function index()
    {

        return view('dashboard.manage.business.index', [
            'title'         => 'Business',

            // 'users'         => User::get()
            // 'users'         => User::select('name', 'email', 'phone_number')->get()->paginate(7)->withQueryString()
        ]);
    }
    public function anyData()
    {
        return Datatables::of(Business::join('business_categories', 'business_categories.uuid', '=', 'businesses.business_category_uuid')->get(['businesses.*', 'business_categories.category']))
            ->addColumn('action', function ($model) {
                return '<a class="text-decoration-none" href="/business/' . $model->id . '/edit"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>
                <button onclick="myFunction(' . $model->id . ')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
            })
            ->addColumn('image', function ($model) {
                return '
                <div class="user-info-dropdown">
                    <a class="dropdown-toggle" >
                        <span class="user-icon">
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
        return view('dashboard.manage.business.create', [
            'title'     => 'Create',
            'categories' => BusinessCategory::latest()->get(),
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
            'name'                      => 'required|max:255',
            'business_category_uuid'    => 'required|exists:business_categories,uuid',
            'description'               => 'required',
            'address'                   => 'required',
            'city'                      => 'required',
            'province'                  => 'required',
            'location'                  => 'required',
            'instagram'                 => '',
            'facebook'                  => '',
            'youtube'                   => '',
            'whatsapp'                  => 'required',
            'image_path'                => 'required',
            'status'                    => 'required',
            'content'                   => 'image|file|max:1024',

        ]);
        if ($request->file('content')) {
            $imageName = $request->name . '.' . $request->content->extension();
            $request->content->move('images/qr_code', $imageName);
            $validatedData['qr_code']  = "images/qr_code/" . $imageName;
        }


        $myArray = explode(',', $validatedData['image_path']);
        $validatedData['image_path'] = "";
        foreach ($myArray as $value) {
            $validatedData['image_path'] = $validatedData['image_path'] . ',"' . $value . '"';
        }
        $str = ltrim($validatedData['image_path'], ',');
        $validatedData['image_path'] = '[' . $str . ']';
        $validatedData['uuid']  = Str::uuid();

        Business::create($validatedData);
        return redirect('/business')->with('success', 'New Business Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        $str = ltrim($business->image_path, '[');
        $str1 = substr($str, 0, -1);
        $myArray = explode(',', $str1);
        return view('dashboard.manage.business.edit', [
            'title'     => 'Edit',
            'galleries' => Gallery::latest()->get(),
            'business'      => $business,
            'categories' => BusinessCategory::latest()->get(),
            'image_paths' => $myArray
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        // return $request;
        // ddd($request);
        $validatedData = $request->validate([
            'name'                      => 'required|max:255',
            'business_category_uuid'    => 'required|exists:business_categories,uuid',
            'description'               => 'required',
            'address'                   => 'required',
            'city'                      => 'required',
            'province'                  => 'required',
            'location'                  => 'required',
            'instagram'                 => '',
            'facebook'                  => '',
            'youtube'                   => '',
            'whatsapp'                  => 'required',
            'image_path'                => 'required',
            'status'                    => 'required',
            'content'                   => 'image|file|max:1024',

        ]);
        if ($request->file('content')) {
            if ($request->oldImage) {
                $oldImage = $business->qr_code;
                unlink($oldImage);
            }
            $imageName = $request->name . '.' . $request->content->extension();
            $request->content->move('images/qr_code', $imageName);
            $validatedData['qr_code']  = "images/qr_code/" . $imageName;
        }
        $myArray = explode(',', $validatedData['image_path']);
        $validatedData['image_path'] = "";
        foreach ($myArray as $value) {
            $validatedData['image_path'] = $validatedData['image_path'] . ',"' . $value . '"';
        }
        $str = ltrim($validatedData['image_path'], ',');
        $validatedData['image_path'] = '[' . $str . ']';
        unset($validatedData['content']);
        // ddd($validatedData);
        Business::where('id', $business->id)->update($validatedData);
        return redirect('/business')->with('success', 'UMKM Edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        Business::destroy($business->id);
        if ($business->qr_code) {
            $qr_code = $business->qr_code;
            unlink($qr_code);
        }
        return redirect('/business/')->with('success', 'Business has been Deleted!');
    }
}
