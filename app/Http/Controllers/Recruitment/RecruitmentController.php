<?php

namespace App\Http\Controllers\Recruitment;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Recruitment\Recruitment;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    //

    public function store(Request $request)
    {
        // return ResponseFormatter::ResponseJson($request->all(), 'store data recruitment', 200);
        if(!empty($request->id_lamaran)){
                $Q_store = Recruitment::updateOrCreate(
                    [
                        'id' => $request->id_lamaran
                    ],
                    [
                        'status' =>$request->val_lamaran
                    ]
                );
                if($Q_store){
                    return ResponseFormatter::ResponseJson('Success', 'Success store data recruitment', 200);
                }
                return ResponseFormatter::ResponseJson('failed', 'Gagal Store data recruitment', 200);
        }

        $parent_path = 'file/recruitment/';
        $validate_data = [
            'address_description' => (!empty($request->address_description)) ? $request->address_description : null,
            'provinsi' => (!empty($request->text_provinsi)) ? $request->text_provinsi : null,
            'kabupaten' => (!empty($request->text_kabupaten)) ? $request->text_kabupaten : null,
            'position' => (!empty($request->position)) ? $request->position : null,
            'status' => (!empty($request->status)) ? $request->status : "Diajukan",
            'email' => (!empty($request->email)) ? $request->email : null,
            'kecamatan' => (!empty($request->text_kecamatan)) ? $request->text_kecamatan : null,
            'file' => (!empty($request->file)) ? $request->file : null,
            'position' => (!empty($request->position)) ? $request->position : null,
            'phone_number' => (!empty($request->phone_number)) ? $request->phone_number : null,
            'full_name' => (!empty($request->full_name)) ? $request->full_name : null,
            'file'  => null,
            'nik_ktp' =>  (!empty($request->nik_ktp)) ? $request->nik_ktp : null,
            'time_propose' => Carbon::now()->format('Y-m-d'),
        ];
        
        $validate_data = array_filter($validate_data);
       
        if (!empty($request->file())) {
            $the_file = $request->file('uploaded_file');

            // return ResponseFormatter::ResponseJson($the_file, 'store data recruitment', 200);
            $file_extension = $the_file->getClientOriginalExtension();
            $file_name_change = ResponseFormatter::toUUID($request->nik_ktp) . "." . $file_extension;
            $the_file->move($parent_path, $file_name_change);
            $validate_data['file'] = $file_name_change;
        }
        if (!empty($validate_data['id']) || !empty($validate_data['file'])) {
            $Q_store = Recruitment::updateOrCreate(
                [
                    'nik_ktp' => $validate_data['nik_ktp']
                ],
                $validate_data
            );
        }


        return ResponseFormatter::ResponseJson($request->all(), 'store data recruitment', 200);
    }

    public function getDataRecruitment(Request $request){
        $Q_get_data = Recruitment::where('nik_ktp', $request->nik_ktp)->get();


        if(!empty($Q_get_data)){
            return ResponseFormatter::ResponseJson($Q_get_data, 'Get Data '.$request->nik_ktp, 200);
        }
        return ResponseFormatter::ResponseJson(null, 'Get Data '.$request->nik_ktp, 200);

    }

    public function getData(Request $request)
    {
        $Q_get_data = Recruitment::orderBy('time_propose', 'DESC')->get();
        $array_data = [];
        foreach ($Q_get_data as $get_data) {
            $array_data[$get_data->id] = $get_data;
        }
        return ResponseFormatter::ResponseJson($array_data, 'Get Data Recruitments', 200);
    }

    public function manageIndex()
    {
        return view('app.recruitment.admin.index', [
            'title'         => 'Kelola Recruitment'
        ]);
    }
}
