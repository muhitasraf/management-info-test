<?php

namespace App\Http\Controllers;

use App\Models\Thana;
use Illuminate\Http\Request;

class ThanaController extends Controller
{
    public function index(){
        $thana =  Thana::select('thanas.id', 'thanas.name AS thana_name', 'districts.name AS district_name')->leftJoin('districts', 'districts.id', '=', 'thanas.district_id')->get();
        return response()->json($thana);
    }

    public function store(Request $request){

        $thana = new Thana();
        $thana->name = $request->input('thana');
        $thana->district_id = $request->input('district_id');

        $thana->save();
        return response()->json($thana);
    }

    public function edit($id){
        $single_district = Thana::where('id',$id)->first();
        return response()->json($single_district);
    }

    public function update($id, Request $request){

        $thana = Thana::find($id);

        $thana->name = $request->input('thana');
        $thana->district_id = $request->input('district_id');
        $thana->save();
        return response()->json($thana);

    }

    public function destroy($id){
        $thana = Thana::find($id);
        $thana->delete();
        return response()->json($thana);
    }
}
