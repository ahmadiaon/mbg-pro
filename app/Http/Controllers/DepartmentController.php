<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\People;
use App\Models\Unit;
use App\Models\Position;
use Facade\FlareClient\Http\Response;

class DepartmentController extends Controller
{
    public function anyData()
    {

        return Datatables::of(Department::query())
        ->addColumn('action', function ($model) {
            $url = "/admin/department/";
            $url_edit = "'".$url.$model->id."'";
            $url_delete = "'".$url."delete/'";
            return '<input type="hidden" value="'. $model->id .'"><button id="'.$model->id .'" onclick="runEdit(' . $model->id . ','.$url_edit.')"  class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button>
            <button onclick="isDelete(' . $model->id . ','.$url_delete.',departmentTable)"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
        })

        ->make(true);
            
    }
    public function index()
    {
        return view('admin.department.index', [
            'title'         => 'Department',
        ]);
    }


    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'department'      => 'required',
        ]);

        
        $departments = Department::updateOrCreate(['id' => $request->id], [
            'department' => $request->department
          ]);

        
        return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $departments], 200);



    }

  
    public function show($department)
    {
        $departments = Department::find($department);

        return response()->json($departments);
    }

  
 
    public function destroy($department)
    {
        $data = Department::where('id', $department)->first();
        $post= Department::find($department)->delete();
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $data], 200);

    }
}
