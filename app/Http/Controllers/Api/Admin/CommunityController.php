<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Community;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class CommunityController extends Controller
{
    public function index()
    {
        $community = Community::query()->orderBy('created_at', 'DESC')->get();
        $meta = [
            'message' => "List all community",
            'code'  => 200,
            'status'  => "success"
        ];
        $response = [
            'meta'  => $meta,
            'data'  => $community
        ];
        return response()->json($response, 200);
    }

    public function show($id)
    {
        $community = Community::query()->where('id', $id)->get();
        $meta = [
            'message'   => "Show community",
            'code'      => 200,
            'status'    => "success"
        ];

        $data = [
            'admin' => $community
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
            // 'community_category_uuid'       => 'required',
            // 'name'                          => 'required',
            // 'logo_path'                     => 'required',
            // 'address'                       => 'required',
            // 'city'                          => 'required',
            // 'province'                      => 'required',
            // 'description'                   => 'required',
            // 'image_path'                    => 'required',
            // 'location'                      => 'required',
            // 'facebook'                      => 'required',
            // 'instagram'                     => 'required',
            // 'youtube'                       => 'required',
            // 'status'                        => 'required',

        ]);
        try {
            // if ($avatar = $request->file('avatar')) {
            //     $uploadAvatar = 'subadmin/avatar/';
            //     $profileImage = date('YmdHis') . "." . $avatar->getClientOriginalExtension();
            //     $avatar->move($uploadAvatar, $profileImage);
            //     $request->avatar = '/' . $uploadAvatar . $profileImage;
            // } else {
            //     return response()->json(422);
            // }
            $community = Community::create([
                'uuid'                          => Str::uuid(),
                'community_category_uuid'       => $request->community_category_uuid,
                'name'                          => $request->name,
                'logo_path'                     => $request->logo_path,
                'address'                       => $request->address,
                'city'                          => $request->city,
                'province'                      => $request->province,
                'description'                   => $request->description,
                'image_path'                    => $request->image_path,
                'location'                      => $request->location,
                'facebook'                      => $request->facebook,
                'instagram'                     => $request->instagram,
                'youtube'                       => $request->youtube,
                'status'                        => $request->status,
            ]);

            $meta = [
                'message'   => "Community has been created",
                'code'      => 201,
                'status'    => "success"
            ];

            $data = [
                'community' => $community,
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
            $community = Community::findOrFail($id);
            if ($request->password == "") {
                if ($request->file('avatar') == "") {
                    $community->update([
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
                    $community->update([
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
                    $community->update([]);
                } else {
                    if ($avatar = $request->file('avatar')) {
                        $uploadAvatar = 'subadmin/avatar/';
                        $profileImage = date('YmdHis') . "." . $avatar->getClientOriginalExtension();
                        $avatar->move($uploadAvatar, $profileImage);
                        $request->avatar = '/' . $uploadAvatar . $profileImage;
                    } else {
                        return response()->json(422);
                    }
                    $community->update([]);
                }
            }

            $meta = [
                'message'   => "Admin has been updated",
                'code'      => 200,
                'status'    => "success"
            ];

            $data = [
                'admin' => $community,
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
        $community = Community::findOrFail($id);
        try {
            $community->delete();
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
