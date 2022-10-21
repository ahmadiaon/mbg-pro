<?php

namespace App\Models\Privilege;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPrivilege extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function where_nik_employee($nik_employee){
        $data = UserPrivilege::where('nik_employee', $nik_employee)->get();
       
        
        if($data->count() > 0){   
                    
            return $data;
            // $data->user_privileges = $user_privileges;
        }else{
            return $data = null;
        }
        return $data;
    }
}
