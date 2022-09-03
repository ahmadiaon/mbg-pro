<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FinancialService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\FinancialServiceRegister;
use App\Models\FinancialServiceSubmission;
use App\Models\Gallery;
use Validator;
use PDF;

class FinancialServicesController extends Controller
{
    // list all financial services
    public function listFinancialServicesUsers()
    {
        // $financial_services = FinancialService::all();
        $financial_services = FinancialService::join('galleries', 'financial_services.logo_path', '=', 'galleries.uuid')
            ->get(['financial_services.*', 'galleries.path']);

        $meta = [
            'message' => "List all financial services",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $financial_services
        ];
        return response()->json($response, 200);
    }
    public function listFinancialServicesUser()
    {
        $businesses = FinancialService::join('galleries', 'financial_services.logo_path', '=', 'galleries.uuid')
                        ->get(['financial_services.*', 'galleries.path']);
        
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
    public function editFinancial(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'address'      => 'required',
            // 'city'         => 'required',
            // 'province'     => 'required',
            'description'  => 'required',
            'location'     => 'required',
            'facebook'     => 'required',
            'instagram'    => 'required',
            'youtube'      => ''

        ]);
        if ($validator->fails()) {
            $errorss = $validator->errors();
            $meta = [
                'message' => "Edit Failed",
                'code'  => 201,
                'status'  => "errors"
            ];
            $response = [
                'meta'  => $meta,
                'errors'  => $errorss,
               
            ];
            return response()->json($response, 201);
        }
        $tour = FinancialService::latest()
            ->where('financial_services.uuid', $id)
            ->get()
            ->first();
        if($tour){
            DB::beginTransaction();
            try {
                $validatedData['name'] = $request->name;
                $validatedData['address'] = $request->address;
                // $validatedData['city'] = $request->city;
                // $validatedData['province'] = $request->province;
                $validatedData['description'] = $request->description;
                $validatedData['location'] = $request->location;
                $validatedData['facebook'] = $request->facebook;
                $validatedData['instagram'] = $request->instagram;
                $validatedData['youtube'] = $request->youtube;
                $register = FinancialService::where('uuid', $id)->update($validatedData);
                $register = FinancialService::latest()
                ->where('financial_services.uuid', $id)
                ->get()
                ->first();
                $meta = [
                    'message' => "Financial service update has been success",
                    'code'  => 201,
                    'status'  => "success"
                ];

                $response = [
                    'meta'  => $meta,
                    'data'  => $register,
                ];
                DB::commit();
                return response()->json($response, 201);
            } catch (QueryException $e) {
                DB::rollback();
                return response()->json([
                    'message' => 'Failed' . $e->errorInfo
                ]);
            }
        }else{
            $meta = [
                'message' => "Error Update",
                'code'  => 200,
                'status'  => "error"
            ];
            $response = [
                'meta'  => $meta,
            ];
            return response()->json($response, 200);
        }

        
        
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
    public function DetailFinancial($id)
    {
        $tour = FinancialService::latest()
            ->where('financial_services.uuid', $id)
            ->get('image_path')
            ->first();
            $str = ltrim($tour->image_path, '[');
            $str1 = substr($str, 0, -1);
            $myArray = explode(',', $str1);
            foreach($myArray as $dataArray){
                $image = ltrim($dataArray, '"');
                $image = substr($image, 0, -1);
                $galery = Gallery::where('uuid', $image)->first();
                $images[] = $galery->path;
            }
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
    public function DetailDataFinancial($id)
    {
        $tour = FinancialService::latest()
            ->where('financial_services.uuid', $id)
            ->get()
            ->first();
            
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
    public function listRegistersFinancial($id)
    {
        $tour = FinancialServiceRegister::join('financial_services', 'financial_services.uuid', '=', 'financial_service_registers.financial_service_uuid')
            ->where('financial_services.uuid', $id)
            ->latest("financial_service_registers.updated_at")
            ->get(["financial_service_registers.*","financial_services.name as pdf"]);
        // $tour->download="images/pdf/ujang.pdf";
        foreach($tour as $t){
            $t->pdf = 'images/pdf/'.$t->name.'.pdf';
        }
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
    public function listSubmissionFinancial($id)
    {
        $tour = FinancialServiceSubmission::join('financial_services', 'financial_services.uuid', '=', 'financial_service_submissions.financial_service_uuid')
            ->where('financial_services.uuid', $id)
            ->latest("financial_service_submissions.updated_at")
            ->get(["financial_service_submissions.name as name_submission","financial_service_submissions.*","financial_services.name as financial","financial_services.name as pdf"]);
        foreach($tour as $t){
            $t->pdf = 'images/pdf/'.$t->name.'.pdf';
        }
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

    public function ListSlideFinancial($id)
    {
        $tour = FinancialService::latest()
            ->where('financial_services.uuid', $id)
            ->get()
            ->first();
            $str = ltrim($tour->image_path, '[');
            $str1 = substr($str, 0, -1);
            $myArray = explode(',', $str1);
            foreach($myArray as $dataArray){
                $image = ltrim($dataArray, '"');
                $image = substr($image, 0, -1);
                $galery = Gallery::where('uuid', $image)->first();
                $images[] = $galery;
            }
        $tour->image_path = $images;
        $meta = [
            'message' => "List Detail",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $images
        ];
        return response()->json($response, 200);
    }
    
    public function createSlideFinancial(Request $request, $id)
    {
        $request->validate([
            'name'                     => 'required',
            'image'                    => 'required|image',
        ]);

        // DB::beginTransaction();
        // try {
        if ($image = $request->file('image')) {
            $random = Str::random(16);
            $uploadImage = 'images/media/';
            $profileImage = $random . "." . $image->getClientOriginalExtension();
            $image->move($uploadImage, $profileImage);
            $request->image_path = $uploadImage . $profileImage;
        } else {
            return response()->json(422);
        }

            
        $validateData['uuid']  = Str::uuid();
        $validateData['name']  = $request->name;
        $validateData['is_url']  = 0;
        $validateData['url']  = "";
        $validateData['path']  = $request->image_path;
        $validateData['mime_type']  = "image";
        $validateData['status']  =  "1";

        $gallery = Gallery::create($validateData);

        $tour = FinancialService::latest()
            ->where('financial_services.uuid', $id)
            ->get()
            ->first();
        $a = true;
        if($tour->image_path =="[]"){
            $a = true;
            $str1 = substr($tour->image_path, 0, -1);
            $validatedData['image_path'] = $str1. '"' . $gallery->uuid . '"';
            $validatedData['image_path'] =  $validatedData['image_path'] . ']';
        }else{
            $a = false;
            $str1 = substr($tour->image_path, 0, -1);
            $validatedData['image_path'] = $str1. ',"' . $gallery->uuid . '"';
            $validatedData['image_path'] =  $validatedData['image_path'] . ']';
        }
            

        FinancialService::where('uuid', $id)->update($validatedData);

        $meta = [
            'message'   => "Create review",
            'code'      => 200,
            'status'    => $a
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $gallery,
            'image' => $tour
        ];
        return response()->json($response, 200);
    }

    public function deleteSlideFinancial(Request $request, $id)
    {
        $request->validate([
            'gallery_uuid' => 'required',
        ]);
        $id_image = '"'.$request->gallery_uuid.'"';
        $validatedData['image_path'] = "";
        $tour = FinancialService::latest()
            ->where('financial_services.uuid', $id)
            ->get()
            ->first();
            $str = ltrim($tour->image_path, '[');
            $str1 = substr($str, 0, -1);
            $myArray = explode(',', $str1);
            foreach($myArray as $dataArray){
                if($dataArray == $id_image){
                    
                }else{
                    
                    $validatedData['image_path'] = $validatedData['image_path'] . ',' . $dataArray ;
                }
               
            }
            $val = ltrim($validatedData['image_path'], ',');
            $validatedData['image_path'] = '[' . $val. ']';
            $tour->image_path = $validatedData['image_path'];
            FinancialService::where('uuid', $id)->update($validatedData);
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

    public function registerFinancialServicesUser(Request $request, $id)
    {
        $request->validate([
            'financial_service_uuid' => 'required',
            'name'           => 'required',
            'address'        => 'required',
            'phone_number'   => 'required',
            'email'          => 'required|email',
            'profession'     => 'required',
            // 'status'         => 'required',
        ]);

        DB::beginTransaction();
        try {
            $uuid = Str::uuid()->toString();
            $register = FinancialServiceRegister::create([
                'uuid'              => $uuid,
                'financial_service_uuid'    => $request->financial_service_uuid,
                'user_uuid'         => $id,
                'name'              => $request->name,
                'address'           => $request->address,
                'phone_number'      => $request->phone_number,
                'email'             => $request->email,
                'profession'        => $request->profession,
                // 'status'            => $request->status,
            ]);
            $data["data_surat"] = FinancialServiceRegister::join('users','users.uuid', '=','financial_service_registers.user_uuid')
            ->join('financial_services','financial_services.uuid','=','financial_service_registers.financial_service_uuid')
            ->where('financial_service_registers.uuid', $register->uuid)
            ->get(['financial_service_registers.*','financial_service_registers.name as name','users.phone_number as phone_number','users.email as email','financial_services.name as financial']);
            
            $pdf = PDF::loadView('reportMail', $data);
            
            $pdfName = $register->name.'.pdf';
            $pdf->save('images/pdf/' . $pdfName);
            $pdfLink = 'images/pdf/'.$pdfName;


            $meta = [
                'message' => "Financial service register has been success",
                'code'  => 201,
                'status'  => "success"
            ];

            $response = [
                'meta'  => $meta,
                'data'  => $register,
                'pdf_link' => $pdfLink
            ];
            DB::commit();
          

            return response()->json($response, 201);
        } catch (QueryException $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Failed' . $e->errorInfo
            ]);
        }
    }

    // financial service submission
    public function submissionFinancialServicesUser(Request $request, $id)
    {
        // return $request->all();
        $request->validate([
            'financial_service_uuid' => 'required',
            'name'              => 'required',
            'address'           => 'required',
            'business_name'     => 'required',
            'business_address'  => 'required',
            'income'            => 'required',
            'loan_estimate'     => 'required',
            'purpose'           => 'required',
            'identity_card'     => 'required',
        ]);

        DB::beginTransaction();
        try {

            if ($image = $request->file('identity_card')) {
                $random = Str::random(16);
                $uploadImage = 'images/identitiy-card/';
                $profileImage = $random . "." . $image->getClientOriginalExtension();
                $image->move($uploadImage, $profileImage);
                $request->identity_card = '/' . $uploadImage . $profileImage;
            } else {
                return response()->json(422);
            }

            $uuid = Str::uuid()->toString();
            $submission = FinancialServiceSubmission::create([
                'uuid'              => $uuid,
                'financial_service_uuid'    => $request->financial_service_uuid,
                'user_uuid'         => $id,
                'name'              => $request->name,
                'address'           => $request->address,
                'business_name'     => $request->business_name,
                'business_address'  => $request->business_address,
                'income'            => $request->income,
                'loan_estimate'     => $request->loan_estimate,
                'purpose'           => $request->purpose,
                'identity_card'     => $request->identity_card,
            ]);

            $meta = [
                'message' => "Financial service submission has been success",
                'code'  => 201,
                'status'  => "success"
            ];
            
            $data["data_surat"] = FinancialServiceSubmission::join('users','users.uuid', '=','financial_service_submissions.user_uuid')
            ->join('financial_services','financial_services.uuid','=','financial_service_submissions.financial_service_uuid')
            ->where('financial_service_submissions.uuid', $submission->uuid)
            ->get(['financial_service_submissions.*','financial_service_submissions.name as name','users.phone_number as phone_number','users.email as email','financial_services.name as financial']);
            $pdf = PDF::loadView('submissionPDF', $data);
            
            $pdfName = $submission->name.'.pdf';
            $pdf->save('images/pdf/' . $pdfName);
            $pdfLink = 'images/pdf/'.$pdfName;
            FinancialServiceSubmission::join('users','users.uuid', '=','financial_service_submissions.user_uuid')
            ->join('financial_services','financial_services.uuid','=','financial_service_submissions.financial_service_uuid')
            ->where('financial_service_submissions.uuid', $submission->uuid)
            ->get(['financial_service_submissions.*','financial_service_submissions.name as name','users.email as email']);
            // dd($submission);
            $response = [
                'meta'  => $meta,
                'data'  => $data["data_surat"],
                'pdf_link' => $pdfLink
            ];
            DB::commit();            
            
            return response()->json($response, 201);
        } catch (QueryException $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Failed' . $e->errorInfo
            ]);
        }

    }
    public function downloadRegister(Request $request, $id)
    {
        

        // $from =  date('Y-m-d', strtotime($request->date_start));
        // $to = date('Y-m-d', strtotime($request->date_end));
        $from =  $request->date_start;
        $to = $request->date_end;

        $data["data_surat"] = FinancialServiceRegister::whereBetween('updated_at', [$from, $to])->get();

        // $data_surat = FinancialServiceRegister::join('financial_services', 'financial_services.uuid', '=', 'financial_service_registers.financial_service_uuid')
        //     ->where('financial_service_registers.uuid', $id)
        //     ->get(['financial_service_registers.*'])
        //     ->first();

        $pdf = PDF::loadView('reportMail', $data);
        $pdfName = date("Y-m-d-H-i-s").'-Bank-Kalteng.pdf';
        $pdf->save('images/pdf/' . $pdfName);
        $pdfLink = 'images/pdf/'.$pdfName;
        $meta = [
            'message' => "List Detail",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $pdfLink,
            // 'link'  =>
        ];
        return response()->json($response, 200);
    }
}
