<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\News;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class ManageTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.manage.tour.index', [
            'title'         => 'Wisata',

            // 'users'         => User::get()
            // 'users'         => User::select('name', 'email', 'phone_number')->get()->paginate(7)->withQueryString()
        ]);
    }
    public function anyData()
    {
        return Datatables::of(Tour::latest())
            ->addColumn('action', function ($model) {
                return '<a class="text-decoration-none" href="/tour/' . $model->id . '/edit"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>
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
        return view('dashboard.manage.tour.create', [
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
            'name'                      => 'required|max:255',
            'description'               => 'required',
            'address'                   => 'required',
            'city'                      => 'required',
            'province'                  => 'required',
            'location'                  => 'required',
            'instagram'                 => '',
            'facebook'                  => '',
            'youtube'                   => '',
            'image_path'                => '',
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

        Tour::create($validatedData);
        return redirect('/tour')->with('success', 'New Tour Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        $str = ltrim($tour->image_path, '[');
        $str1 = substr($str, 0, -1);
        $myArray = explode(',', $str1);
        return view('dashboard.manage.tour.edit', [
            'title'     => 'Edit',
            'galleries' => Gallery::latest()->get(),
            'tour'      => $tour,
            'image_paths' => $myArray
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
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
            'status'                    => 'required',
        ]);
        $myArray = explode(',', $validatedData['image_path']);
        $validatedData['image_path'] = "";
        foreach ($myArray as $value) {
            $validatedData['image_path'] = $validatedData['image_path'] . ',"' . $value . '"';
        }
        $str = ltrim($validatedData['image_path'], ',');
        $validatedData['image_path'] = '[' . $str . ']';

        Tour::where('id', $tour->id)->update($validatedData);
        return redirect('/tour')->with('success', 'Tour Edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        Tour::destroy($tour->id);
        return redirect('/tour/')->with('success', 'Tour has been Deleted!');
    }






    public function listTourUser()
    {
        $tours = Tour::latest()->get();
        // list news
        $news = News::latest()
        ->where('status','0')
        ->get();
        $images;

        foreach ($news as $tour) {
            $str = ltrim($tour->image_path, '[');
            $str1 = substr($str, 0, -1);

            $myArray = explode(',', $str1);
           
            foreach($myArray as $dataArray){
                $image = ltrim($dataArray, '"');
                $image = substr($image, 0, -1);
                $galery = Gallery::where('uuid', $image)->first();
                $images[] = $galery->path;
            }
            $tour->image_path =  $images;            
        }
        return $news;


        $validatedData['image_path'] = "";
        $images = [];
        // ddd($tours);
        foreach ($tours as $tour) {
            $str = ltrim($tour->image_path, '[');
            $str1 = substr($str, 0, -1);
            $myArray = explode(',', $str1);
            // ddd($myArray);
            foreach($myArray as $dataArray){
                $image = ltrim($dataArray, '"');
                $image = substr($image, 0, -1);
                $galery = Gallery::where('uuid', $image)->first();
                // $validatedData['image_path'] = $validatedData['image_path'] . ',"' . $galery->path . '"';
                $images[] = $galery->path;
            }

            $tour->image_path = $images;
        }
        dd($tours);

        $meta = [
            'message' => "List all tours",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $tours
        ];
        return response()->json($response, 200);
    }
}
