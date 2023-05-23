<?php

namespace App\Http\Controllers;

use App\Models\Union;
use Illuminate\Http\Request;

class UnionController extends Controller
{
    public function index(){
        $union =  Union::select('unions.id', 'unions.name AS union_name', 'thanas.name AS thana_name')->leftJoin('thanas', 'thanas.id', '=', 'unions.thana_id')->get();
        return response()->json($union);
    }

    public function store(Request $request){

        $union = new Union();
        $union->name = $request->input('union');
        $union->thana_id = $request->input('thana_id');

        $union->save();
        return response()->json($union);
    }

    public function edit($id){
        $single_union = Union::where('id',$id)->first();
        return response()->json($single_union);
    }

    public function update($id, Request $request){

        $union = Union::find($id);

        $union->name = $request->input('union');
        $union->thana_id = $request->input('thana_id');
        $union->save();
        return response()->json($union);

    }

    public function destroy($id){
        $union = Union::find($id);
        $union->delete();
        return response()->json($union);
    }
}
