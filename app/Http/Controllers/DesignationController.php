<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index(){
        return Designation::get();
    }

    public function store(Request $request){

        $designation = new Designation();
        $designation->name = $request->input('designation');
        $designation->status = $request->input('status');

        $designation->save();
        return response()->json($designation);
    }

    public function edit($id){
        $single_designation = Designation::where('id',$id)->first();
        return response()->json($single_designation);
    }

    public function update($id, Request $request){

        $designation = Designation::find($id);

        $designation->name = $request->input('designation');
        $designation->status = $request->input('status');
        $designation->save();
        return response()->json($designation);

    }

    public function destroy($id){
        $designation = Designation::find($id);
        $designation->delete();
        return response()->json($designation);
    }
}
