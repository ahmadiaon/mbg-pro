<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OverBurdenFlit;

class OverBurdenFlitController extends Controller
{
    public function store(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'over_burden_id'      => 'required',
            'excavator_employee_id'      => 'required',
            'excavator_vehicle_id'      => 'required',
            'ex_capacity'      => 'required'
        ]);
        $validatedData['capacity'] = $request->ex_capacity;
        $created = OverBurdenFlit::create($validatedData);
        return redirect('/admin-ob/hour-meter/'.$request->over_burden_id)->with('success', 'Flit Added!');

    }
}
