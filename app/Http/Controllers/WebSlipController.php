<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Slip;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\PdfToImage\Pdf;

class WebSlipController extends Controller
{
    //
    public function slipStore(Request $request){

        $request->validate([
            'file' => '',
        ]);
        $files_file = $request->file('file');

        $pdf = new Pdf($files_file[0]->path());
        // $imagePath = public_path('pdf-image.jpg');
        // $pdf->saveImage($imagePath);

        
        // return ResponseFormatter::ResponseJson($files_file[0]->getClientOriginalName(),'success', 200);
        

        $files = [];
        $split_year_month = explode(" ",$request['month-year']);
        $month = ResponseFormatter::monthSort($split_year_month[0]);
        $year   = $split_year_month[1];
        
        $to_store = [];

        $parent_path = 'file/slips/';
        foreach($files_file as $item_file){
            $file_name_original = $item_file->getClientOriginalName();
            $file_extension =$item_file->getClientOriginalExtension();
            $filenameWithoutExtension = pathinfo($file_name_original, PATHINFO_FILENAME);
            $file_name_change = Str::uuid().".".$file_extension;
            $employee_uuid = ResponseFormatter::toUUID($filenameWithoutExtension);
            $to_store[$file_name_original] = $file_name_change;
            $item_file->move($parent_path, $file_name_change);     

            $imageName = $employee_uuid."-".$year."-".$month;
            
            $data_for_store = [
                'employee_uuid' => $employee_uuid,
                'code_file' => $imageName, 
                'year'  => $year,
                'month' => $month,
                'original_file'  => $file_name_change
            ];
            $files[] = $data_for_store;
            Slip::updateOrCreate(['code_file'=>$data_for_store['code_file']],$data_for_store);
        }

        return ResponseFormatter::ResponseJson($files,'success', 200);
    }
}
