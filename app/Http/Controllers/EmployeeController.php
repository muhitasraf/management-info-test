<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        return response()->json(Employee::get());
    }

    public function store(Request $request){

        // $request->validate([
        //     'name' => 'required | unique:employee',
        // ]);
        // dd($request->input('employee_name'));
        $employee = new Employee();

        $employee->name = $request->input('employee_name');
        $employee->designation = $request->input('designation');
        $employee->department = $request->input('department');
        $employee->code = $request->input('code');
        $employee->father = $request->input('father');
        $employee->mother = $request->input('mother');
        $employee->spouse = $request->input('spouse');
        $employee->no_of_child = $request->input('no_of_child');
        $employee->present_address = $request->input('present_address');
        $employee->permanent_address = $request->input('permanent_address');
        $employee->personal_mobile = $request->input('personal_mobile');
        $employee->office_mobile = $request->input('office_mobile');
        $employee->status = $request->input('status');

        $employee->save();
        return response()->json($employee);
    }

    public function show($id){
        $departments = Department::get();
        $desigmation = Designation::get();
        $single_employee = Employee::where('id',$id)->leftJoin()->first();
        return response()->json($single_employee);
    }

    public function edit($id){
        $single_employee = Employee::where('id',$id)->first();
        return response()->json($single_employee);
    }

    public function update($id, Request $request){

        $employee = Employee::find($id);
        $employee->name = $request->input('employee_name');
        $employee->designation = $request->input('designation');
        $employee->department = $request->input('department');
        $employee->code = $request->input('code');
        $employee->father = $request->input('father');
        $employee->mother = $request->input('mother');
        $employee->spouse = $request->input('spouse');
        $employee->no_of_child = $request->input('no_of_child');
        $employee->present_address = $request->input('present_address');
        $employee->permanent_address = $request->input('permanent_address');
        $employee->personal_mobile = $request->input('personal_mobile');
        $employee->office_mobile = $request->input('office_mobile');
        $employee->status = $request->input('status');
        $employee->save();
        return response()->json($employee);

    }

    public function destroy($id){
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json($employee);
    }
}
