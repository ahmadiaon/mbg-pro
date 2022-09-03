<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\CommunityCategory;
use App\Models\Gallery;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function listCommunityCategories()
    {
        $communities_categories = CommunityCategory::join('galleries', 'community_categories.gallery_uuid', '=', 'galleries.uuid')
            ->get(['community_categories.*', 'galleries.path']);

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
    public function listCommunity()
    {
        $communities = Community::join('galleries', 'communities.logo_path', '=', 'galleries.uuid')
            ->get(['communities.*', 'galleries.path']);
        
        foreach ($communities as $tour) {
            $str = ltrim($tour->image_path, '[');
            $str1 = substr($str, 0, -1);
            $myArray = explode(',', $str1);
            $image = ltrim($myArray[0], '"');
            $image = substr($image, 0, -1);
            $galery = Gallery::where('uuid', $image)->first();
            if($galery){
                $tour->image_path =  $galery->path;
            }else{
                $tour->image_path = 'images/media/no images.png';
            }
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
    public function DetailCommunity($id)
    {
        $validatedData['image_path'] = "";
        $tour = Community::join('galleries', 'communities.logo_path', '=', 'galleries.uuid')
            ->where('communities.uuid', $id)
            ->get(['communities.*', 'galleries.path'])
            ->first();
        
        
            $str = ltrim($tour->image_path, '[');
            $str1 = substr($str, 0, -1);
            $myArray = explode(',', $str1);
            // ddd($myArray);
            foreach($myArray as $dataArray){
                $image = ltrim($dataArray, '"');
                $image = substr($image, 0, -1);
                $galery = Gallery::where('uuid', $image)->first();
                $validatedData['image_path'] = $validatedData['image_path'] . ',"' . $galery->path.'"' ;
                $images[] = $galery->path;
            }
            // $validatedData['image_path'] = substr($validatedData['image_path'], 0, -1);
            // $images = ltrim($validatedData['image_path'], ',');
            // $images = '['.$images.']';
            
            // $tour->image_path = $validatedData['image_path'];
            $tour->image_path = $images;
    
        
        
        $meta = [
            'message' => "List all communities",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $tour
        ];
        return response()->json($response, 200);
    }
}
