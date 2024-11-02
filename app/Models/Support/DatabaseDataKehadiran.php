<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabaseDataKehadiran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getData($NRP = null){
        
        if($NRP){
            $Q_data_kehadiran = DatabaseDataKehadiran::where('nrp', $NRP)->get();
        }else{
            $Q_data_kehadiran = DatabaseDataKehadiran::get();
        }
        $data_kehadiran = [];

        foreach($Q_data_kehadiran as $I_data_kehadiran){
            $data_kehadiran[$I_data_kehadiran->nrp][$I_data_kehadiran->code_data] = $I_data_kehadiran; 
        }

        return $data_kehadiran;
    }
}
