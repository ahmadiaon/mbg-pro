<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle\Brand;
use Illuminate\Support\Facades\DB;
class BrandController extends Controller
{
    public function index()
    {
        $store = Brand::create([
            'brand' => 'baru'
        ]);
        $data = DB::table('brands')->get();
        dd($data);
    }
}
