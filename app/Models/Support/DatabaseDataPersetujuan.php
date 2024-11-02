<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabaseDataPersetujuan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getDataPersetujuan($code_form = null, $NRP = null)
    {
        $Q_data_persetujuan = null;
        if ($code_form) {
            $Q_data_persetujuan = DatabaseDataPersetujuan::where('code_form', $code_form);
        }

        if ($NRP) {// ini untuk menampilkan dia sebagai atasan 
            $Q_data_persetujuan = DatabaseDataPersetujuan::where('nrp', $code_form);
        }

        
        $Q_data_persetujuan = $Q_data_persetujuan->get();

        $data_persetujuan = [];

        foreach ($Q_data_persetujuan as $I_data_persetujuan) {
            $data_persetujuan[$I_data_persetujuan->code_data][$I_data_persetujuan->level] = $I_data_persetujuan;
        }
        return $data_persetujuan;
    }
}


/*

kalau punya dia sudah di filter berdasarkan code_data sih harusnya makai like,
yang dia yang menyetujui
bagaimana caranya ya,tapi 1 di ambil semua di ambil,


*/