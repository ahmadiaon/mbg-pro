<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    // Show Gallery By Id
    public function showGalleryById($id)
    {
        $gallery = Gallery::where('uuid', '=', $id)->firstOrFail();
        if ($gallery) {
            $meta = [
                'message' => "Show gallery by id",
                'code'  => 200,
                'status'  => "success"
            ];
            $response = [
                'meta'  => $meta,
                'data'  => $gallery
            ];
            return response()->json($response, 200);
        } else {
            $meta = [
                'message' => "Gallery not found",
                'code'  => 404,
                'status'  => "failed"
            ];
            $response = [
                'meta'  => $meta,
                'data'  => null
            ];
            return response()->json($response, 404);
        }
    }
}
