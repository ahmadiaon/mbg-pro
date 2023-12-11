<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeDocument;
use App\Models\Safety\AtributSize;
use Illuminate\Http\Request;

class EmployeeDocumentController extends Controller
{
    public function create()
    {
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'user-document',
        ];
        return view('employee.document.create', [
            'title'         => 'Tambah Karyawan',
            'layout'    => $layout
        ]);
    }

    public function store(Request $request)
    {

        $validateData = $request->all();
        $data = session('recruitment-user');
        if (empty($validateData['date_start'])) {
            $validateData['date_start'] = $data['detail']['date_start'];
        }
        if (empty($validateData['user_detail_uuid'])) {
            $validateData['user_detail_uuid'] = $validateData['uuid'];
        }
        if ($request->file('ktpfile')) {
            $validateData['ktpfile'] = 'adada';
        } else {
            $validateData['ktpfile'] = 'tidak adada';
        }

        $data_requirment = AtributSize::where('size', 'requirment')->get();
        foreach ($data_requirment as $item) {          
            
            if ($request->file($item->uuid) ) {
                $file_kind = $item->uuid;              
                $name =  ResponseFormatter::toUuidLower($validateData['uuid'].'_'.$item->uuid). '.' . $request->$file_kind->getClientOriginalExtension();
                if((int)$request->$file_kind->getSize() > 100){
                    if($request->$file_kind->getClientOriginalExtension() == 'pdf'){
                        if(!empty($request->$file_kind->getClientOriginalExtension())){                    
                            $imageName = 'file/document/employee/' . $name;
                            if (file_exists($imageName)) {
                                $name = mt_rand(5, 99985) . $name;
                                $imageName = 'file/document/employee/' . $name;
                            }
                            $isMoved = $request->$file_kind->move('file/document/employee/', $name);
                            if ($isMoved) {
                                $validatedData[$item->uuid] = $name;
                            }
                            $documents =[
                                'uuid'=>$validateData['uuid'].'-'.$item->uuid,
                                'employee_uuid' =>  $validateData['uuid'],
                                'document_table_name' => $item->uuid,
                                'document_path' => $name,                        
                                'date_start' =>$validateData['date_start'],
                            ];                           
                            EmployeeDocument::updateOrCreate(['uuid' => $documents['uuid']], $documents);        
                        }  
                    }
                }           
            }
        }
        $data_store = Employee::showWhereNik_employee($validateData['uuid']);
        $data['detail'] = $data_store;
        session()->put('recruitment-user', $data);       


        return ResponseFormatter::toJson($data, 'Data Store User Document');
    }
}
