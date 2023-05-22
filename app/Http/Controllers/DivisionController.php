<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index(){
        return Division::get();
    }

    public function store(Request $request){

        $division = new Division();
        $division->name = $request->input('division');

        $division->save();
        return response()->json($division);
    }

    public function edit($id){
        $single_division = Division::where('id',$id)->first();
        return response()->json($single_division);
    }

    public function update($id, Request $request){

        $division = Division::find($id);

        $division->name = $request->input('division');
        $division->save();
        return response()->json($division);

    }

    public function destroy($id){
        $division = Division::find($id);
        $division->delete();
        return response()->json($division);
    }
}
