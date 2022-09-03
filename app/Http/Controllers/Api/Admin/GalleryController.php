<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::query()->orderBy('created_at', 'DESC')->get();
        $meta = [
            'message' => "List all gallery",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $gallery
        ];
        return response()->json($response, 200);
    }

    public function show($id)
    {
        $gallery = Gallery::query()->where('uuid', $id)->first();
        $meta = [
            'message'   => "Show gallery",
            'code'      => 200,
            'status'    => "success"
        ];

        $data = [
            'gallery' => $gallery
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
            'name'              => 'required',
            // 'is_url'            => 'required',
            // 'url'               => 'required',
            'path'              => 'required',
            // 'mime_type'         => 'required',
            // 'status'            => 'required',
        ]);
        try {
            if ($image = $request->file('path')) {
                $uploadImage = 'images/media/' . $image->getClientOriginalName();
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($uploadImage, $profileImage);
                $request->path = '/' . $uploadImage . $profileImage;
            } else {
                return response()->json(422);
            }

            $uuid = Str::uuid();
            $gallery = Gallery::create([
                'uuid'          => $uuid,
                'name'          => $request->name,
                'is_url'        => 1,
                'url'           => '',
                'path'          => $request->path,
                'mime_type'     => 'image',
                'status'        => 1,
            ]);

            $meta = [
                'message'   => "gallery has been created",
                'code'      => 201,
                'status'    => "success"
            ];

            $data = [
                'gallery' => $gallery,
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
            'name'              => 'required',
            // 'is_url'            => 'required',
            // 'url'               => 'required',
            'path'              => 'required',
            // 'mime_type'         => 'required',
            // 'status'            => 'required',
        ]);

        try {
            $gallery = Gallery::query()->where('uuid', $id)->first();
            if ($request->file('path') == "") {
                $gallery->update([
                    'name'          => $request->name,
                    'is_url'        => 1,
                    'url'           => '',
                    'mime_type'     => 'image',
                    'status'        => 1,
                ]);
            } else {
                if ($image = $request->file('path')) {
                    $uploadImage = 'images/med';
                    $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                    $image->move($uploadImage, $profileImage);
                    $request->path = '/' . $uploadImage . $profileImage;
                } else {
                    return response()->json(422);
                }
                $gallery->update([
                    'name'          => $request->name,
                    'is_url'        => 1,
                    'url'           => '',
                    'path'          => $request->path,
                    'mime_type'     => 'image',
                    'status'        => 1,
                ]);
            }

            $meta = [
                'message'   => "Gallery has been updated",
                'code'      => 200,
                'status'    => "success"
            ];

            $data = [
                'gallery' => $gallery,
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
        $gallery = Gallery::query()->where('uuid', $id)->first();
        try {
            $gallery->delete();
            $meta = [
                'message' => "Gallery has been deleted",
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
