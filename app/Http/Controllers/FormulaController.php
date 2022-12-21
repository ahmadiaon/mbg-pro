<?php

namespace App\Http\Controllers;

use App\Models\Formula;
use App\Models\GroupFormula;
use App\Models\Variable;
use App\Models\VariableCount;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FormulaController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'formula'
        ];
        return view('formula.index', [
            'title'         => 'Formula Potongan',
            'layout'    => $layout
        ]);
    }
    
    public function create(){
        $variables = Variable::all();
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'formula'
        ];
        return view('formula.create', [
            'title'         => 'Formula Potongan',
            'variables' => $variables,
            'layout'    => $layout
        ]);
    }
    public function anyData(){
        $data = Formula::all();
        return DataTables::of($data)    
        ->make(true);
    }
    public function show(Request $request){
        $data = Formula::where('uuid', $request->uuid)->get()->first();

        $group_formulas = GroupFormula::where('formula_uuid', $data->uuid)->get();
        foreach($group_formulas as $item){
            $item->variable_counts = VariableCount::where('group_formula_uuid', $item->uuid)->get();
        }
        
        $variables = Variable::all();
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'formula'
        ];
        return view('formula.create', [
            'title'         => 'Formula Potongan',
            'variables' => $variables,
            'formula'   => $data,
            'group_formulas' => $group_formulas,
            'layout'    => $layout
        ]);
       
    }

    public function store(Request $request){
        // VariableCount::updateOrCreate();
        // 
        // dd($request->all());

       
        $group_formulaa = GroupFormula::where('formula_uuid', $request->uuid)->get();
        foreach($group_formulaa as $group_f){
            VariableCount::where('group_formula_uuid', $group_f->uuid)->delete();
        }
         GroupFormula::where('formula_uuid', $request->uuid)->delete();
        //  return 'delete';
        $groups = [];
        $variables = [];
        $group_formula_count = 1;
        $variable = 1;
        $col_name = 'variable_uuid-'.$group_formula_count.'-'.$variable;
        while(!empty($request->$col_name)){
            $variable = 1;
            $group_formula_symbol_name = 'group_symbol-'.$group_formula_count;
            $col_name = 'variable_uuid-'.$group_formula_count.'-'.$variable;
            $group_formula = [
                'uuid'  => $request->uuid.'-'.$group_formula_count,
                'group_formula_order'   => $group_formula_count,
                'formula_uuid'  => $request->uuid,
                'group_formula_symbol' => $request->$group_formula_symbol_name
            ];
            // $groups[]= $group_formula;
            $groups[]= $store_group_formula = GroupFormula::updateOrCreate(['uuid'=> $group_formula['uuid']], $group_formula);
            while(!empty($request->$col_name)){
                $variable_col_name = 'variable_uuid-'.$group_formula_count.'-'.$variable;
                $symbol_count_col_name = 'symbol_count-'.$group_formula_count.'-'.$variable;
                $value_value_variable_name = 'value_value_variable-'.$group_formula_count.'-'.$variable;

                $variable_counts = [
                    'uuid'  =>$group_formula['uuid'].'-'.$variable,
                    'group_formula_uuid' => $request->uuid.'-'.$group_formula_count,
                    'variable_uuid' => $request->$variable_col_name,
                    'order_number'  => $variable,
                    'symbol_count' => $request->$symbol_count_col_name,
                    'value_value_variable' => $request->$value_value_variable_name,
                ];
                // $variables[]= $variable_counts;
                $variables[]= $store_variable_count = VariableCount::updateOrCreate(['uuid'=> $variable_counts['uuid']], $variable_counts);
                $variable++;
                $col_name = 'variable_uuid-'.$group_formula_count.'-'.$variable;
                // $variables[]= $group_formula;
            }
            $variable = 1;
            $group_formula_count++;
            $col_name = 'variable_uuid-'.$group_formula_count.'-'.$variable;
        }

        // dd($variables);
        // return $request->uuid;
        return redirect('/database/formula/show/'.$request->uuid);
        // dd($group_formula);
    }
}
