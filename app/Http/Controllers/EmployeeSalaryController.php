<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeSalaryController extends Controller
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
        $employee = new EmployeeSalary();

        $employee->emp_id = $request->input('emp_id');
        $employee->gross = $request->input('gross');
        $employee->basic = $request->input('basic');
        $employee->house_rent = $request->input('house_rent');
        $employee->conveyance = $request->input('conveyance');
        $employee->allowance = $request->input('allowance');
        $employee->TA = $request->input('TA');
        $employee->mobile = $request->input('mobile');

        $employee->save();
        return response()->json($employee);
    }

    public function show($id){
        $single_employee = EmployeeSalary::where('id',$id)->leftJoin()->first();
        return response()->json($single_employee);
    }

    public function edit($id){
        $single_employee = EmployeeSalary::where('id',$id)->first();
        return response()->json($single_employee);
    }

    public function update($id, Request $request){

        $employee = EmployeeSalary::find($id);
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
        $employee = EmployeeSalary::find($id);
        $employee->delete();
        return response()->json($employee);
    }
}
