<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Models\CommunityCategory;
use App\Http\Controllers\Controller;

class CommunityCategoryController extends Controller
{
    public function index()
    {
        $communities_categories = Community::join('galleries', 'communities_categories.gallery_uuid', '=', 'galleries.uuid')
            ->get(['communities_categories.*', 'galleries.path']);

        $meta = [
            'message' => "List all categories",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $communities_categories
        ];
        return response()->json($response, 200);
    }
}
