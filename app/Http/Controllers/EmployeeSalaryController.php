<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeSalaryController extends Controller
{
    public function index(){
        $sql = "SELECT ei.id, ei.name, ei.code,es.*
                FROM employee_salary es
                LEFT JOIN employee_info ei ON ei.id = es.emp_id";
        $salary = DB::select($sql);
        return response()->json($salary);
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

    public function destroy($id){
        $employee = EmployeeSalary::find($id);
        $employee->delete();
        return response()->json($employee);
    }
}
