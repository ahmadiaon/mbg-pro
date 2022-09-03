<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{
    public function index()
    {
        $subadmin = Admin::query()->orderBy('created_at', 'DESC')->get();
        $meta = [
            'message' => "List all admin",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $subadmin
        ];
        return response()->json($response, 200);
    }

    public function show($id)
    {
        $subadmin = Admin::query()->where('id', $id)->get();
        $meta = [
            'message'   => "Show subadmin",
            'code'      => 200,
            'status'    => "success"
        ];

        $data = [
            'admin' => $subadmin
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $data
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id'        => 'required',
            'full_name'         => 'required',
            'email'             => 'required|email',
            'password'          => 'required',
            'position'          => 'required',
        ]);
        try {
            if ($avatar = $request->file('avatar')) {
                $uploadAvatar = 'subadmin/avatar/';
                $profileImage = date('YmdHis') . "." . $avatar->getClientOriginalExtension();
                $avatar->move($uploadAvatar, $profileImage);
                $request->avatar = '/' . $uploadAvatar . $profileImage;
            } else {
                return response()->json(422);
            }
            $subadmin = Admin::create([
                'full_name'   => $request->full_name,
                'company_id'  => $request->company_id,
                'email'       => $request->email,
                'password'    => Hash::make($request->password),
                'position'    => $request->position,
                'avatar'      => $request->avatar,
                'phone'       => $request->phone,
                'birth_date'  => $request->birth_date,
                'address'     => $request->address,
            ]);

            $meta = [
                'message'   => "Admin has been created",
                'code'      => 201,
                'status'    => "success"
            ];

            $data = [
                'admin' => $subadmin,
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'company_id'        => 'required',
            'full_name'         => 'required',
            'email'             => 'required|email',
            'password'          => 'required',
            'position'          => 'required',
            'avatar'            => 'image',
        ]);

        try {
            $subadmin = Admin::findOrFail($id);
            if ($request->password == "") {
                if ($request->file('avatar') == "") {
                    $subadmin->update([
                        'full_name'   => $request->full_name,
                        'company_id'  => $request->company_id,
                        'email'       => $request->email,
                        'position'    => $request->position,
                        'phone'       => $request->phone,
                        'birth_date'  => $request->birth_date,
                        'address'     => $request->address,
                    ]);
                } else {
                    if ($avatar = $request->file('avatar')) {
                        $uploadAvatar = 'subadmin/avatar/';
                        $profileImage = date('YmdHis') . "." . $avatar->getClientOriginalExtension();
                        $avatar->move($uploadAvatar, $profileImage);
                        $request->avatar = '/' . $uploadAvatar . $profileImage;
                    } else {
                        return response()->json(422);
                    }
                    $subadmin->update([
                        'full_name'   => $request->full_name,
                        'company_id'  => $request->company_id,
                        'email'       => $request->email,
                        'position'    => $request->position,
                        'avatar'      => $request->avatar,
                        'phone'       => $request->phone,
                        'birth_date'  => $request->birth_date,
                        'address'     => $request->address,
                    ]);
                }
            } else {
                if ($request->file('avatar') == "") {
                    $subadmin->update([
                        'full_name'   => $request->full_name,
                        'company_id'  => $request->company_id,
                        'email'       => $request->email,
                        'password'    => Hash::make($request->password),
                        'position'    => $request->position,
                        'phone'       => $request->phone,
                        'birth_date'  => $request->birth_date,
                        'address'     => $request->address,
                    ]);
                } else {
                    if ($avatar = $request->file('avatar')) {
                        $uploadAvatar = 'subadmin/avatar/';
                        $profileImage = date('YmdHis') . "." . $avatar->getClientOriginalExtension();
                        $avatar->move($uploadAvatar, $profileImage);
                        $request->avatar = '/' . $uploadAvatar . $profileImage;
                    } else {
                        return response()->json(422);
                    }
                    $subadmin->update([
                        'full_name'   => $request->full_name,
                        'company_id'  => $request->company_id,
                        'email'       => $request->email,
                        'password'    => Hash::make($request->password),
                        'position'    => $request->position,
                        'avatar'      => $request->avatar,
                        'phone'       => $request->phone,
                        'birth_date'  => $request->birth_date,
                        'address'     => $request->address,
                    ]);
                }
            }

            $meta = [
                'message'   => "Admin has been updated",
                'code'      => 200,
                'status'    => "success"
            ];

            $data = [
                'admin' => $subadmin,
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

    public function destroy($id)
    {
        $subadmin = Admin::findOrFail($id);
        try {
            $subadmin->delete();
            $meta = [
                'message' => "Admin has been deleted",
                'code'  => 200,
                'status'  => "success"
            ];

            $response = [
                'meta'  => $meta
            ];

            return response()->json($response, 200);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed ' . $e->errorInfo
            ]);
        }
    }
}
