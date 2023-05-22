<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        return Department::get();
    }

    public function store(Request $request){

        $department = new Department();
        $department->name = $request->input('department');
        $department->status = $request->input('status');

        $department->save();
        return response()->json($department);
    }

    public function edit($id){
        $single_department = Department::where('id',$id)->first();
        return response()->json($single_department);
    }

    public function update($id, Request $request){

        $department = Department::find($id);

        $department->name = $request->input('department');
        $department->status = $request->input('status');
        $department->save();
        return response()->json($department);

    }

    public function destroy($id){
        $department = Department::find($id);
        $department->delete();
        return response()->json($department);
    }
}
