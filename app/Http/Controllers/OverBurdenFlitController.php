<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OverBurdenFlit;

class OverBurdenFlitController extends Controller
{
    public function store(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'over_burden_uuid'      => 'required',
            'excavator_employee_uuid'      => 'required',
            'excavator_vehicle_uuid'      => 'required',
            'ex_capacity'      => 'required'
        ]);
        $validatedData['capacity'] = $request->ex_capacity;
        $validatedData['uuid'] = 'flits-'.Str::uuid();
        $validatedData['contract_employee_uuid'] = $request->ex_capacity;
        $created = OverBurdenFlit::create($validatedData);
        return redirect('/admin-ob/hour-meter/'.$request->over_burden_uuid)->with('success', 'Flit Added!');
    }
}
