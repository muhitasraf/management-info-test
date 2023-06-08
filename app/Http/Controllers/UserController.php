<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(){
        $query = User::get();
        return response()->json($query);
        // dd(Datatables::of($query)->toJson());
        // return Datatables::of($query)->toJson();
    }

    public function store(Request $request){
        $user = new User();

        $user->name = $request->input('name');
        $user->user_name = $request->input('user_name');
        $user->email = $request->input('email');

        $user->save();
        return response()->json($user);
    }

    public function edit($id){
        $single_user = User::where('id',$id)->first();
        return response()->json($single_user);
    }

    public function update($id, Request $request){

        $user = User::find($id);

        $user->name = $request->input('name');
        $user->user_name = $request->input('user_name');
        $user->email = $request->input('email');

        $user->save();
        return response()->json($user);

    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return response()->json($user);
    }
}
