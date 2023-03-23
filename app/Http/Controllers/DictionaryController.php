<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Dictionary;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class DictionaryController extends Controller
{
    //

    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'dictionary'
        ];

        return view('dictionary.index', [
            'title'         => 'Kamus',
            'layout'    => $layout
        ]);
    }

    public function delete(Request $request)
    {
         $store = Dictionary::where('uuid',$request->uuid)->delete(); 
         return ResponseFormatter::toJson($store, 'Data Deleted');
    }

    public function anyData(){
        $data = Dictionary::all();
        return DataTables::of($data)    
        ->make(true);
    }
}
