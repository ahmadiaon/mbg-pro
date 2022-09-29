<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getAll(){
        return Location::get(
            [
                'locations.uuid',
                'locations.location'
            ]);
        }      
}
