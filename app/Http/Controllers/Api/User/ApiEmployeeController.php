<?php

namespace App\Http\Controllers\Api\User;

use App\Models\people;
use App\Models\Gallery;
use App\Models\Business;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\BusinessCategory;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class ApiEmployeeController extends Controller
{
    public function employees(){
        $data = Employee::latest()->get();
        return response()->json($data, 200);
        return ResponseFormatter::success($data, 'All data employee');
    }

    
    public function listBusiness()
    {
        $businesses = Business::join('business_categories', 'business_categories.uuid', '=', 'businesses.business_category_uuid')->get(['businesses.*', 'business_categories.category as category']);
        
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
            'message' => "List all communities",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $businesses
        ];
        return response()->json($response, 200);
    }

    public function DetailBusiness($id)
    {
        $validatedData['image_path'] = "";
        $tour = Business::join('business_categories', 'business_categories.uuid', '=', 'businesses.business_category_uuid')
            ->where('businesses.uuid', $id)
            // ->get(['businesses.*', 'business_categories.category'])
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
