<?php

namespace App\Models\Privilege;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPrivilege extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function where_nik_employee($nik_employee){
        $user_privileges = [];

        $data = UserPrivilege::where('nik_employee', $nik_employee)->get();
        $privileges = Privilege::all();

        foreach($privileges as $privilege){
                $name_index = $privilege->uuid;
                $user_privileges[$name_index] = null;
        }
        
        if($data->count() > 0){   
            foreach($data as $item){
                $user_privileges[$item->privilege_uuid] = true;
            }    
            return $user_privileges;
        }else{
            return $user_privileges;
        }
        return $user_privileges;
    }
}
