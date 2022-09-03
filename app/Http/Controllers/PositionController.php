<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Yajra\Datatables\Datatables;
use App\Models\People;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function anyData()
    {
        return Datatables::of(Position::query())
        ->addColumn('action', function ($model) {
            $url = "/admin/position/";
            $url_edit = "'".$url.$model->id."'";
            $url_delete = "'".$url."delete/'";
            return '<input type="hidden" value="'. $model->id .'"><button id="'.$model->id .'" onclick="runEditPosition(' . $model->id . ','.$url_edit.')"  class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button>
            <button onclick="isDeletePosition(' . $model->id . ','.$url_delete.')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
        })

        ->make(true);
            
    }

    public function index()
    {
        // return People::all();
        $peoples = People::query()->orderBy('created_at', 'DESC')->get();
        // $peoples = Datatables::of(People::query())->make(true);

        return view('admin.position.index', [
            'title'         => 'People',
            'peoples'       => $peoples
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.position.create', [
            'title'         => 'Add People',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePositionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'position'      => 'required',
        ]);

        
        $positions = Position::updateOrCreate(['id' => $request->id], [
            'position' => $request->position
          ]);

        
        return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $positions], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show($position)
    {
        $positions = Position::find($position);

        return response()->json($positions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePositionRequest  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy($position)
    {
        $data = Position::where('id', $position)->first();
        $post= Position::find($position)->delete();
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $data], 200);

    }
}
