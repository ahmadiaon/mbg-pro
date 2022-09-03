<?php

namespace App\Http\Controllers\Api\User;

use App\Models\youtube;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery;

class YoutubeController extends Controller
{
    public function listSlide()
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
