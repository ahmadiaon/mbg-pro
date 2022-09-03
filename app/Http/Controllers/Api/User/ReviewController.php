<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class ReviewController extends Controller
{
    public function listReviewByBusiness($id)
    {
        $reviews = Review::join('users', 'reviews.user_uuid', '=', 'users.uuid')
            ->where('reviews.business_uuid', '=', $id)
            ->get(['reviews.*', 'users.name', 'users.photo_path']);

        $meta = [
            'message'   => "List all reviews",
            'code'      => 200,
            'status'    => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $reviews
        ];
        return response()->json($response, 200);
    }
    public function lisLimitReviewByBusiness($id)
    {
        $reviews = Review::join('users', 'reviews.user_uuid', '=', 'users.uuid')
            ->where('reviews.business_uuid', '=', $id)
            ->limit(3)
            ->latest()
            ->get(['reviews.*', 'users.name', 'users.photo_path']);

        $meta = [
            'message'   => "List all reviews",
            'code'      => 200,
            'status'    => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $reviews
        ];
        return response()->json($response, 200);
    }

    public function createReview(Request $request, $id)
    {
        $request->validate([
            'user_uuid'         => 'required',
            'value'             => 'required',
            'image_path'        => '',
            'description'       => 'required',
        ]);

        // DB::beginTransaction();
        // try {
        if ($image = $request->file('image_path')) {
            $random = Str::random(16);
            $uploadImage = 'images/review/';
            $profileImage = $random . "." . $image->getClientOriginalExtension();
            $image->move($uploadImage, $profileImage);
            $request->image_path = '/' . $uploadImage . $profileImage;
        } else {
            $request->image_path = "";
        }

        $uuid = Str::uuid()->toString();
        $review = Review::create([
            'uuid'          => $uuid,
            'business_uuid' => $id,
            'user_uuid'     => $request->user_uuid,
            'value'         => $request->value,
            'image_path'    => $request->image_path,
            'description'   => $request->description,
        ]);
        $meta = [
            'message'   => "Create review",
            'code'      => 200,
            'status'    => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $review
        ];
        // DB::commit();

        return response()->json($response, 200);
        // } catch (QueryException $e) {
        //     DB::rollback();
        //     $meta = [
        //         'message'   => "Failed to create review",
        //         'code'      => 400,
        //         'status'    => "failed"
        //     ];
        //     $response = [
        //         'meta'  => $meta,
        //         'data'  => null
        //     ];
        //     return response()->json($response, 400);
        // }
    }
}
