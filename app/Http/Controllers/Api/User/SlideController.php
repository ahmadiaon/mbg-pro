<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Slide;
use App\Models\youtube;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery;

class SlideController extends Controller
{
    public function listSlide()
    {
        $slides = Slide::join('galleries', 'slides.gallery_uuid', '=', 'galleries.uuid')
            ->where('slides.status','1')
            ->get(['slides.*', 'galleries.path']);

        $meta = [
            'message' => "List all slide",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $slides
        ];
        return response()->json($response, 200);
    }
    public function listYoutube()
    {
        $slides = youtube::latest()
            ->where('youtubes.status','1')
            ->get();

        $meta = [
            'message' => "List all youtube",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $slides
        ];
        return response()->json($response, 200);
    }
}
