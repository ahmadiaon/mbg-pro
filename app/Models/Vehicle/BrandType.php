<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getAll(){
        return BrandType::join('brands','brands.uuid','=','brand_types.brand_uuid')
        ->get(
            [
                'brand_types.uuid',
                'brand_types.type',
                'brands.brand'
            ]);
    }
}
