<?php

namespace App\Models\UserDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function where_user_detail_uuid($user_detail_uuid){
        $data = UserAddress::Join('pohs', 'pohs.uuid', 'user_addresses.poh_uuid')->where('user_detail_uuid', $user_detail_uuid)
        ->get([           
            'pohs.*',
            'user_addresses.*',
        ])
        ->first();
        if(!empty($data)){
            return $data;
        }else{
            return $data = null;
        }

    }
}


