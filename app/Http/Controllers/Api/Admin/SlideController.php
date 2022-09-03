<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Slide;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class SlideController extends Controller
{
    public function index()
    {
        $slide = Slide::query()->orderBy('created_at', 'DESC')->get();
        $meta = [
            'message' => "List all slide",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $slide
        ];
        return response()->json($response, 200);
    }

    public function show($id)
    {
        $slide = Slide::query()->where('uuid', $id)->first();
        $meta = [
            'message'   => "Show slide",
            'code'      => 200,
            'status'    => "success"
        ];

        $data = [
            'slide' => $slide
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
            'gallery_uuid'        => 'required',
            'admin_uuid'          => 'required',
            'title'               => 'required',
            // 'status'              => 'required',
        ]);
        try {
            $uuid = Str::uuid();
            $slide = Slide::create([
                'uuid'          => $uuid,
                'gallery_uuid'  => $request->gallery_uuid,
                'admin_uuid'    => $request->admin_uuid,
                'title'         => $request->title,
                'status'        => 1,
            ]);

            $meta = [
                'message'   => "Slide has been created",
                'code'      => 201,
                'status'    => "success"
            ];

            $data = [
                'slide' => $slide,
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
            'gallery_uuid'        => 'required',
            'admin_uuid'          => 'required',
            'title'               => 'required',
            // 'status'              => 'required',
        ]);

        try {
            $slide = Slide::query()->where('uuid', $id)->first();
            $slide->update([
                'gallery_uuid'  => $request->gallery_uuid,
                'admin_uuid'    => $request->admin_uuid,
                'title'         => $request->title,
                'status'        => 1,
            ]);

            $meta = [
                'message'   => "Slide has been updated",
                'code'      => 200,
                'status'    => "success"
            ];

            $data = [
                'slide' => $slide,
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
        $slide = Slide::query()->where('uuid', $id)->first();
        try {
            $slide->delete();
            $meta = [
                'message' => "Slide has been deleted",
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
