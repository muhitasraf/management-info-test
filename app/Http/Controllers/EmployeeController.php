<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(){
        $sql = "SELECT ei.id, ei.name, ei.code, ei.father, ei.mother,ei.spouse, ei.no_of_child, ei.present_address, ei.permanent_address,
                ei.personal_mobile, ei.office_mobile, ei.status, dp.name department, dg.name designation
                FROM employee_info ei
                LEFT JOIN departments dp ON ei.department = dp.id
                LEFT JOIN designations dg ON ei.designation = dg.id";
        $mowza = DB::select($sql);
        return response()->json($mowza);
    }

    public function store(Request $request){

        // dd($request);
        // $request->validate([
        //     'name' => 'required | unique:employee',
        // ]);
        // dd($request->input('employee_name'));
        $employee = new Employee();

        $employee->name = $request->input('employee_name');
        $employee->designation = $request->input('designation_id');
        $employee->department = $request->input('department_id');
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
        $employee->designation = $request->input('designation_id');
        $employee->department = $request->input('department_id');
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
