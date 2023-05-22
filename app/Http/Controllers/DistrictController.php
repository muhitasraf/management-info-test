<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index(){
        return District::select('divisions.name AS division_name','districts.id','districts.name AS district_name')->leftJoin('divisions', 'divisions.id', '=', 'districts.division_id')->get();
    }

    public function store(Request $request){

        $district = new District();
        $district->name = $request->input('district');
        $district->division_id = $request->input('division_id');

        $district->save();
        return response()->json($district);
    }

    public function edit($id){
        $single_district = District::where('id',$id)->first();
        return response()->json($single_district);
    }

    public function update($id, Request $request){

        $district = District::find($id);

        $district->name = $request->input('district');
        $district->division_id = $request->input('division_id');
        $district->save();
        return response()->json($district);

    }

    public function destroy($id){
        $district = District::find($id);
        $district->delete();
        return response()->json($district);
    }
}
