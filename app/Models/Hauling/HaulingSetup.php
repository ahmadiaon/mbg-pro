<?php

namespace App\Models\Hauling;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HaulingSetup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getAll(){
        return HaulingSetup::join('employees as shift_1', 'shift_1.uuid', '=', 'hauling_setups.shift_1_employee_uuid')
        ->join('user_details as user_shift_1','user_shift_1.uuid','=','shift_1.user_detail_uuid' )
        ->join('employees as shift_2', 'shift_2.uuid', '=', 'hauling_setups.shift_2_employee_uuid')
        ->join('user_details as user_shift_2','user_shift_2.uuid','=','shift_2.user_detail_uuid')
        ->join('mines','mines.uuid','=','hauling_setups.mine_uuid')
        ->join('coal_types','coal_types.uuid','=','hauling_setups.coal_type_uuid')
        ->get([
            'hauling_setups.date',
            'mines.mine_name',
            'mines.owner',
            // 'coal_types.type_name',
            'shift_1.nik_employee as NIK_employe_1',
            'user_shift_1.name as name_1',
            'shift_2.nik_employee as NIK_employe_2',
            'user_shift_2.name as name_2',
        ]);
    }

}
