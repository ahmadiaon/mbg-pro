<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getAll(){
        return Status::get(
            [
                'statuses.uuid',
                'statuses.status'
            ]);
    }
}
