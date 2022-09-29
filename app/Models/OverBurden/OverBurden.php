<?php

namespace App\Models\OverBurden;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverBurden extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public static function getOverBurden($id){
        return OverBurden::where('id', $id)->first();
    }
    public static function getOverBurdenUuid($id){
        return OverBurden::where('uuid', $id)->first();
    }

    public static function OverBurdenShow($over_burden_uuid){
        return OverBurden::join('over_burden_notes', 'over_burden_notes.over_burden_uuid', '=', 'over_burdens.uuid')
        ->where('over_burdens.uuid', $over_burden_uuid)
        ->get([
            'over_burdens.*',
            'over_burden_notes.id as id_note',
            'over_burden_notes.note'
        ])
        ->first();
    }
}
