<?php

namespace App\Models\UserDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReligion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function where_user_detail_uuid($user_detail_uuid){
        $data = UserReligion::Join('religions', 'religions.uuid', 'user_religions.religion_uuid')->where('user_detail_uuid', $user_detail_uuid)
        ->get([           
            'religions.*',
            'user_religions.*',
        ])
        ->first();
        if(!empty($data)){
            return $data;
        }else{
            return $data = null;
        }

    }
}
