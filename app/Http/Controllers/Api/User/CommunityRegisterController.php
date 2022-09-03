<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CommunityRegister;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class CommunityRegisterController extends Controller
{
    public function registerCommunityMember(Request $request, $id)
    {
        $request->validate([
            'community_uuid' => 'required',
            'name'           => 'required',
            'email'          => 'required|email',
        ]);

        DB::beginTransaction();
        try {
            $uuid = Str::uuid()->toString();
            $member = CommunityRegister::create([
                'uuid'              => $uuid,
                'community_uuid'    => $request->community_uuid,
                'user_uuid'         => $id,
                'name'              => $request->name,
                'email'             => $request->email,
                'age'               => $request->age,
                'phone_number'      => $request->phone_number,
                'facebook'          => $request->facebook,
                'instagram'         => $request->instagram,
                'check1'            => 1,
                'check2'            => 1,
                'status'            => 1,
            ]);

            $meta = [
                'message' => "Community register has been success",
                'code'  => 201,
                'status'  => "success"
            ];

            $response = [
                'meta'  => $meta,
                'data'  => $member,
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
}
