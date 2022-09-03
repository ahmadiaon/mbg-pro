<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommunityCategory;
use Illuminate\Database\QueryException;

class CommunityCategoryController extends Controller
{
    public function index()
    {
        $communityCategory = CommunityCategory::query()->orderBy('created_at', 'DESC')->get();
        $meta = [
            'message' => "List all category",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $communityCategory
        ];
        return response()->json($response, 200);
    }

    public function show($id)
    {
        $communityCategory = CommunityCategory::query()->where('uuid', $id)->first();
        $meta = [
            'message'   => "Show category",
            'code'      => 200,
            'status'    => "success"
        ];

        $data = [
            'category' => $communityCategory
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $data
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'gallery_uuid' => 'required',
            'category' => 'required|string|max:255',
            'order_number' => 'required|integer',
            // 'status' => 'required|integer',
        ]);
        try {
            $uuid = Str::uuid();
            $communityCategory = CommunityCategory::create([
                'uuid' => $uuid,
                'gallery_uuid' => $request->gallery_uuid,
                'category' => $request->category,
                'order_number' => $request->order_number,
                'status' => 1,
            ]);

            $meta = [
                'message'   => "category has been created",
                'code'      => 201,
                'status'    => "success"
            ];

            $data = [
                'category' => $communityCategory,
            ];

            $response = [
                'meta'  => $meta,
                'data'  => $data,
            ];
            return response()->json($response, 201);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed' . $e->errorInfo
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gallery_uuid' => 'required',
            'category' => 'required|string|max:255',
            'order_number' => 'required|integer',
            // 'status' => 'required|integer',
        ]);

        try {
            $communityCategory = CommunityCategory::query()->where('uuid', $id)->first();
            $communityCategory->update([
                'gallery_uuid' => $request->gallery_uuid,
                'category' => $request->category,
                'order_number' => $request->order_number,
                'status' => 1,
            ]);

            $meta = [
                'message'   => "category has been updated",
                'code'      => 200,
                'status'    => "success"
            ];

            $data = [
                'category' => $communityCategory,
            ];

            $response = [
                'meta'  => $meta,
                'data'  => $data,
            ];
            return response()->json($response, 201);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed' . $e->errorInfo
            ]);
        }
    }

    public function destroy($id)
    {
        $communityCategory = CommunityCategory::query()->where('uuid', $id)->first();
        try {
            $communityCategory->delete();
            $meta = [
                'message' => "category has been deleted",
                'code'  => 200,
                'status'  => "success"
            ];

            $response = [
                'meta'  => $meta
            ];

            return response()->json($response, 200);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed ' . $e->errorInfo
            ]);
        }
    }
}
