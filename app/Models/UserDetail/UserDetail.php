<?php

namespace App\Models\UserDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getAll(){
        $data = DB::select(
            'select DISTINCT(user_details.name), user_details.uuid, user_addresses.desa, employees.uuid as employee_uuid, employees.nik_employee, positions.position, employees.employee_status from user_details inner join employees on employees.user_detail_uuid = user_details.uuid inner join user_addresses on user_addresses.user_detail_uuid = user_details.uuid left join positions on positions.uuid = employees.position_uuid'
            );
        $userModels = UserDetail::hydrate($data);
        return $userModels;
    }
}

// $data = DB::select(
//     'select DISTINCT(user_details.name), user_addresses.desa, employees.nik_employee, positions.position, employees.employee_status from user_details inner join employees on employees.user_detail_uuid = user_details.uuid inner join user_addresses on user_addresses.user_detail_uuid = user_details.uuid left join positions on positions.uuid = employees.position_uuid'
//     );
