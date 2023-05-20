<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(){
        return Unit::get();
    }

    public function store(Request $request){

        // $request->validate([
        //     'name' => 'required | unique:unit',
        // ]);

        $unit_name = $request->input('unit_name');
        $status = $request->input('status');
        $remarks = $request->input('remarks');

        $unit = new Unit();

        $unit->name = $unit_name;
        $unit->remarks = $remarks;
        $unit->status = $status;

        $unit->save();
        return response()->json($unit);
    }

    public function edit($id){
        $single_unit = Unit::where('id',$id)->first();
        return response()->json($single_unit);
    }

    public function update($id, Request $request){

        $unit = Unit::find($id);

        $unit->name = $request->input('unit_name');
        $unit->remarks = $request->input('status');
        $unit->status = $request->input('remarks');

        $unit->save();
        return response()->json($unit);

    }

    public function destroy($id){
        $unit = Unit::find($id);
        $unit->delete();
        return response()->json($unit);
    }
}
