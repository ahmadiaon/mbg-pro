<?php

namespace App\Http\Controllers\Api\User;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery;

class NewsController extends Controller
{
    // list all news
    public function listNewsUser()
    {

        $news = News::latest()
        ->where('status','1')
        ->get();
        $images;

        foreach ($news as $tour) {
            $str = ltrim($tour->image_path, '[');
            $str1 = substr($str, 0, -1);

            $myArray = explode(',', $str1);
           
            foreach($myArray as $dataArray){
                $image = ltrim($dataArray, '"');
                $image = substr($image, 0, -1);
                $galery = Gallery::where('uuid', $image)->first();
                $images[] = $galery->path;
            }
            $tour->image_path =  $images;            
        }

        $meta = [
            'message' => "List all news",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $news
        ];
        return response()->json($response, 200);
    }
    public function listNewsUserSingle()
    {

        $news = News::latest()
        ->where('status','1')
        ->get();
        $images;

        foreach ($news as $tour) {
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
            'message' => "List all news",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $news
        ];
        return response()->json($response, 200);
    }
    public function DetailNews($id)
    {
        $news = News::latest()
        ->where('uuid',$id)
        ->get('image_path')
        ->first();
        $images;

   
            $str = ltrim($news->image_path, '[');
            $str1 = substr($str, 0, -1);
            $myArray = explode(',', $str1);
           
            foreach($myArray as $dataArray){
                $image = ltrim($dataArray, '"');
                $image = substr($image, 0, -1);
                $galery = Gallery::where('uuid', $image)->first();
                $images[] = $galery->path;
            }
            $news->image_path =  $images;            
        

        $meta = [
            'message' => "List all news",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $news
        ];
        return response()->json($response, 200);
    }
}
