<?php

namespace App\Models;

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
}
