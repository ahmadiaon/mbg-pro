<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use App\Models\People;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    // Show User Profile By Id
    public function showProfile($id)
    {
        $user = User::where('uuid', '=', $id)->firstOrFail();
        $meta = [
            'message' => "Show user profile",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $user
        ];
        return response()->json($response, 200);
    }

    // Update User Profile By Id
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required',
            'phone_number'  => 'required',
            'email'         => 'required|email',
            // 'avatar'    => 'required',
        ]);

        try {
            $user = User::where('uuid', '=', $id)->firstOrFail();
            if ($request->file('avatar') == "") {
                $user->update([
                    'name'          => $request->name,
                    'phone_number'  => $request->phone_number,
                    'email'         => $request->email,
                    // 'photo_path'    => $request->avatar,
                ]);
            } else {
                if ($avatar = $request->file('avatar')) {
                    $uploadAvatar = 'images/profile/';
                    $profileImage = date('YmdHis') . "." . $avatar->getClientOriginalExtension();
                    $avatar->move($uploadAvatar, $profileImage);
                    $request->avatar = '/' . $uploadAvatar . $profileImage;
                } else {
                    return response()->json(422);
                }
                $user->update([
                    'name'          => $request->name,
                    'phone_number'  => $request->phone_number,
                    'email'         => $request->email,
                    'photo_path'    => $request->avatar,
                ]);
            }

            $meta = [
                'message'   => "User has been updated",
                'code'      => 200,
                'status'    => "success"
            ];

            $data = [
                'user' => $user,
            ];

            $response = [
                'meta'  => $meta,
                'data'  => $data,
            ];
            return response()->json($response, 201);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed' . $e->errorInfo
            ]);
        }
    }
    public function manageUser(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'listEmployee'
        ];
        return view('superadmin.users', [
            'title'         => 'Beranda Superadmin',
            'layout'        => $layout
        ]);
    }
    public function showLevelEmployeeUser($id){
        $employee = DB::table('users')
        ->join('employees', 'employees.id', '=',  'users.employee_id')
        ->join('people', 'people.id', '=',  'employees.people_id')
        ->where('employees.nik_employee', $id)
        ->get(['employees.nik_employee', 'people.nik_number', 'employees.id', 'people.name', 'users.group'])
        ->first();
        // dd($employee);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'listEmployee'
        ];
        return view('superadmin.changeLevelEmployee', [
            'title'         => 'Beranda Superadmin',
            'layout'        => $layout
        ]);
    }

    public function anyData(){
        return Datatables::of(DB::table('users')
        ->join('employees', 'employees.id', '=',  'users.employee_id')
        ->join('people', 'people.id', '=',  'employees.people_id')
        ->get(['employees.nik_employee', 'people.nik_number', 'employees.id', 'people.name', 'users.group']))
        ->addColumn('action', function ($model) {
            $id = $model->nik_employee;
         
            // $textId = "'".$id."'";
            return '
            <a href="/superadmin/manage-user/'.$id.'">
                <button class="btn btn-warning py-1 px-2 mr-1">
                    <i class="icon-copy dw dw-pencil"></i>
                </button>
            </a>';
        })
        ->addColumn('name', function ($model) {
            return '<div class="name-avatar d-flex align-items-center">
            <div class="avatar mr-2 flex-shrink-0">
                <img src="http://mb-center.test/vendors/images/photo8.jpg" class="border-radius-100 shadow" width="40" height="40" alt="">
            </div>
            <div class="txt">
                <div class="weight-600">'.$model->name.'</div>
            </div>
        </div>';
        })
        ->addColumn('statusPass', function($model){
        return '<td>
                         <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7"
                            style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">Default</span>
                     </td>';
        })
        ->escapeColumns('name')
        ->make(true);
    }
    
}
