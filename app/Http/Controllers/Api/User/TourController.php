<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Tour;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TourController extends Controller
{
    // list all tours
    // public function listTourUser()
    // {
    //     $tours = Tour::all();
    //     // $tours = Tour::join('galleries', 'tours.image_path', '=', 'galleries.uuid')
    //     //     ->get(['tours.*', 'galleries.path']);
    //     $meta = [
    //         'message' => "List all tours",
    //         'code'  => 200,
    //         'status'  => "success"
    //     ];
    //     $response = [
    //         'meta'  => $meta,
    //         'data'  => $tours
    //     ];
    //     return response()->json($response, 200);
    // }
    public function listTourUser()
    {
        $businesses = Tour::latest()->get();
        
        foreach ($businesses as $tour) {
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
            'message' => "List all tour",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $businesses
        ];
        return response()->json($response, 200);
    }
    public function DetailTour($id)
    {
        $tour = Tour::latest()
            ->where('tours.uuid', $id)
            ->get('image_path')
            ->first();
        
        
            $str = ltrim($tour->image_path, '[');
            $str1 = substr($str, 0, -1);
            $myArray = explode(',', $str1);
            // ddd($myArray);
            foreach($myArray as $dataArray){
                $image = ltrim($dataArray, '"');
                $image = substr($image, 0, -1);
                $galery = Gallery::where('uuid', $image)->first();
                $images[] = $galery->path;
            }
            // $validatedData['image_path'] = substr($validatedData['image_path'], 0, -1);
            // $images = ltrim($validatedData['image_path'], ',');
            // $images = '['.$images.']';
            
            // $tour->image_path = $validatedData['image_path'];
            $tour->image_path = $images;
    
        
        
        $meta = [
            'message' => "List Detail",
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
