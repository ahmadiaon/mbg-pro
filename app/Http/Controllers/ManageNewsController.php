<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class ManageNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.manage.news.index', [
            'title'         => 'Slide',

            // 'users'         => User::get()
            // 'users'         => User::select('name', 'email', 'phone_number')->get()->paginate(7)->withQueryString()
        ]);
    }
    public function anyData()
    {
        return Datatables::of(News::latest())
            ->addColumn('action', function ($model) {
                return '<a class="text-decoration-none" href="/news/' . $model->id . '/edit"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>
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
        return view('dashboard.manage.news.create', [
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
            'title'         => 'required|max:255',
            'content'       => 'required',
            'image_path'    => 'required',
            'status'        => 'required'

        ]);
        $myArray = explode(',', $validatedData['image_path']);
        $validatedData['image_path'] = "";
        foreach ($myArray as $value) {
            $validatedData['image_path'] = $validatedData['image_path'] . ',"' . $value . '"';
        }
        $str = ltrim($validatedData['image_path'], ',');
        $validatedData['image_path'] = '[' . $str . ']';

        $validatedData['uuid']  = Str::uuid();

        News::create($validatedData);
        return redirect('/news')->with('success', 'New Slide Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $str = ltrim($news->image_path, '[');
        $str1 = substr($str, 0, -1);
        $myArray = explode(',', $str1);
        return view('dashboard.manage.news.edit', [
            'title'     => 'Edit',
            'galleries' => Gallery::latest()->get(),
            'news'      => $news,
            'image_paths' => $myArray
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $validatedData = $request->validate([
            'title'         => 'required|max:255',
            'content'       => 'required',
            'image_path'    => 'required',
            'status'        => 'required'

        ]);
        $myArray = explode(',', $validatedData['image_path']);
        $validatedData['image_path'] = "";
        foreach ($myArray as $value) {
            $validatedData['image_path'] = $validatedData['image_path'] . ',"' . $value . '"';
        }
        $str = ltrim($validatedData['image_path'], ',');
        $validatedData['image_path'] = '[' . $str . ']';

        News::where('id', $news->id)->update($validatedData);
        return redirect('/news')->with('success', 'News Edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        News::destroy($news->id);
        return redirect('/news/')->with('success', 'Slide has been Deleted!');
    }
}
