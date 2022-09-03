<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class ManageReviewController extends Controller
{
    public function index()
    {
        $shares = Review::join('users', 'users.uuid', '=', 'reviews.user_uuid')
        ->join('businesses', 'businesses.uuid', '=', 'reviews.business_uuid')
        ->get(['businesses.name','reviews.*','users.name as user']);
        // return $shares;
        return view('dashboard.manage.review.index', [
            'title'         => 'Review',
        ]);
    }
    public function anyData()
    {
        return Datatables::of(Review::join('users', 'users.uuid', '=', 'reviews.user_uuid')
        ->join('businesses', 'businesses.uuid', '=', 'reviews.business_uuid')
        ->get(['businesses.name','reviews.*','users.name as user']))
            ->addColumn('action', function ($model) {
                return '<a class="text-decoration-none" href="/review/' . $model->id . '/edit"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>';
            })
            ->make(true);
    }
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        $reviews = Review::join('users', 'users.uuid', '=', 'reviews.user_uuid')
        ->join('businesses', 'businesses.uuid', '=', 'reviews.business_uuid')
        ->where('reviews.id', $review->id)
        ->get(['businesses.name','reviews.*','users.name as user'])->first();
        // return $reviews;
        return view('dashboard.manage.review.edit', [
            'title'         => 'Edit',
            'review'        => $reviews
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {

        $rules = [
            'status'        => 'required'
        ];
        $validateData =  $request->validate($rules);
        $validatedData['status'] = $request->status;
        Review::where('id', $review->id)->update($validatedData);
        return redirect('/review')->with('success', 'Edit  Success!');
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
