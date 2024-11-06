<?php

namespace App\Models\Support;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabaseDataKehadiran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getData($filter)
    {
        
        $Q_data_kehadiran = DatabaseDataKehadiran::where('tanggal_mulai', '>=',  $filter['date_start'])
        ->where('tanggal_mulai', '<=',  $filter['date_end']);
        

        //1. JIKA USER SENDIRI
        if (!empty($filter['from'])) {
            $Q_data_kehadiran = $Q_data_kehadiran->where('nrp', $filter['nik_employee']);
        }

        
        $Q_data_kehadiran = $Q_data_kehadiran->get();


      
        $data_kehadiran = [];

        foreach ($Q_data_kehadiran as $I_data_kehadiran) {
            $data_kehadiran[$I_data_kehadiran->nrp][$I_data_kehadiran->code_data] = $I_data_kehadiran;
        }

        return $data_kehadiran;
    }
}
