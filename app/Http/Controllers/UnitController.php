<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function anyData()
    {

        return Datatables::of(Unit::query())
        ->addColumn('action', function ($model) {
            $url = "/admin/unit/";
            $url_edit = "'".$url.$model->id."'";
            $url_delete = "'".$url."delete/'";
            return '<input type="hidden" value="'. $model->id .'"><button id="'.$model->id .'" onclick="runEditUnit(' . $model->id . ','.$url_edit.')"  class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button>
            <button onclick="isDeleteUnit(' . $model->id . ','.$url_delete.')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
        })
        ->make(true);
    }
    public function index()
    {
        //
        return "aaa";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit'      => 'required',
        ]);
        $units = Unit::updateOrCreate(['id' => $request->id], [
            'unit' => $request->unit
          ]);
        return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $units], 200);

    }

    
    public function show($unit)
    {
        $units = Unit::find($unit);

        return response()->json($units);
    }


    public function allData()
    {
        
        $units = Unit::all();
        

        return response()->json(['code'=>200, 'message'=>'Data deleted successfully', 'units' => $units], 200);
    
    }

    
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnitRequest  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($unit)
    {
        //
        $data = Unit::where('id', $unit)->first();
        $post= Unit::find($unit)->delete();
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $data], 200);

    }
}
