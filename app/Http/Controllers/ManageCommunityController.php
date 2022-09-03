<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Gallery;
use App\Models\Community;
use App\Models\CommunityCategory;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ManageCommunityController extends Controller
{
    public function index()
    {
        // $tours = Community::join('community_categories', 'community_categories.uuid', '=', 'communities.community_category_uuid')->get(['communities.*', 'community_categories.category']);


        // foreach ($tours as $tour) {
        //     $str = ltrim($tour->image_path, '[');
        //     $str1 = substr($str, 0, -1);
        //     $myArray = explode(',', $str1);
        //     $image = ltrim($myArray[0], '"');
        //     $image = substr($image, 0, -1);
        //     $galery = Gallery::where('uuid', $image)->first();
        //     if($galery){
        //         $tour->image_path =  $galery->path;
        //     }else{
        //         $tour->image_path = 'images/media/no images.png';
        //     }
        // }
        // return $tours;
        return view('dashboard.manage.community.index', [
            'title'         => 'Community',
        ]);
    }
    public function anyData()
    {
        return Datatables::of(Community::join('community_categories', 'community_categories.uuid', '=', 'communities.community_category_uuid')->get(['communities.*', 'community_categories.category']))
            ->addColumn('action', function ($model) {
                return '<a class="text-decoration-none" href="/community/' . $model->id . '/edit"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>
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
        return view('dashboard.manage.community.create', [
            'title'     => 'Create',
            'categories' => CommunityCategory::latest()->get(),
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
            'community_category_uuid'    => 'required|exists:community_categories,uuid',
            'logo_path'                 => 'required',
            'description'               => 'required',
            'address'                   => 'required',
            'city'                      => 'required',
            'province'                  => 'required',
            'location'                  => 'required',
            'instagram'                 => 'required',
            'facebook'                  => '',
            'youtube'                   => '',
            'image_path'                => 'required',
            'status'                    => 'required'
        ]);
        $myArray = explode(',', $validatedData['image_path']);
        $validatedData['image_path'] = "";
        foreach ($myArray as $value) {
            $validatedData['image_path'] = $validatedData['image_path'] . ',"' . $value . '"';
        }
        $str = ltrim($validatedData['image_path'], ',');
        $validatedData['image_path'] = '[' . $str . ']';
        $validatedData['uuid']  = Str::uuid();

        Community::create($validatedData);
        return redirect('/community')->with('success', 'New Community Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        $str = ltrim($community->image_path, '[');
        $str1 = substr($str, 0, -1);
        $myArray = explode(',', $str1);
        return view('dashboard.manage.community.edit', [
            'title'     => 'Edit',
            'galleries' => Gallery::latest()->get(),
            'community'      => $community,
            'categories' => CommunityCategory::latest()->get(),
            'image_paths' => $myArray
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Community $community)
    {
        $validatedData = $request->validate([
            'name'                      => 'required|max:255',
            'community_category_uuid'    => 'required|exists:community_categories,uuid',
            'description'               => 'required',
            'address'                   => 'required',
            'instagram'                 => '',
            'youtube'                   => '',
            'facebook'                  => '',
            'location'                  => '',
            'youtube'                   => '',
            'logo_path'                 => '',
            'city'                      => 'required',
            'province'                  => 'required',
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

        Community::where('id', $community->id)->update($validatedData);
        return redirect('/community')->with('success', 'News Edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        Community::destroy($community->id);
        return redirect('/community/')->with('success', 'Community has been Deleted!');
    }
    public function listCommunities()
    {
        $communitiesSingle = Community::join('galleries', 'communities.logo_path', '=', 'galleries.uuid')
        ->where('communities.uuid', '0819b7bb-5429-499a-89ac-b894e0f9407a')
        ->get(['communities.*', 'galleries.path'])
        ->first();
        $communitiesArray = Community::join('galleries', 'communities.logo_path', '=', 'galleries.uuid')
        ->where('communities.uuid', '0819b7bb-5429-499a-89ac-b894e0f9407a')
        ->get(['communities.*', 'galleries.path']);
        $communities = Community::join('galleries', 'communities.logo_path', '=', 'galleries.uuid')
        ->get(['communities.*', 'galleries.path']);

        return $communities;

        // no loop
        // foreach ($communities as $tour) {
        //     $str = ltrim($tour->image_path, '[');
        //     $str1 = substr($str, 0, -1);
        //     $myArray = explode(',', $str1);
        //     $image = ltrim($myArray[0], '"');
        //     $image = substr($image, 0, -1);
        //     $galery = Gallery::where('uuid', $image)->first();
        //     if($galery){
        //         $tour->image_path =  $galery->path;
        //     }else{
        //         $tour->image_path = 'images/media/no images.png';
        //     }
        // }

        // with loop
        foreach ($communities as $tour) {
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
        $meta = [
            'message' => "List all communities",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $communities
        ];
        return response()->json($response, 200);
    }
}
