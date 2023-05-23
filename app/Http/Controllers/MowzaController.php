<?php

namespace App\Http\Controllers;

use App\Models\Mowza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MowzaController extends Controller
{
    public function index(){
        $sql = "SELECT m.id, m.name mowza_name, dv.name division_name, dis.name district_name, un.name union_name FROM mowzas m
        LEFT JOIN divisions dv ON m.division_id = dv.id
        LEFT JOIN districts dis ON m.district_id = dis.id
        LEFT JOIN unions un ON m.union_id = un.id";
        $mowza = DB::select($sql);
        return response()->json($mowza);
    }

    public function store(Request $request){

        $mowza = new Mowza();
        $mowza->name = $request->input('union');
        $mowza->thana_id = $request->input('thana_id');

        $mowza->save();
        return response()->json($mowza);
    }

    public function edit($id){
        $single_union = Mowza::where('id',$id)->first();
        return response()->json($single_union);
    }

    public function update($id, Request $request){

        $mowza = Mowza::find($id);

        $mowza->name = $request->input('union');
        $mowza->thana_id = $request->input('thana_id');
        $mowza->save();
        return response()->json($mowza);

    }

    public function destroy($id){
        $mowza = Mowza::find($id);
        $mowza->delete();
        return response()->json($mowza);
    }
}
