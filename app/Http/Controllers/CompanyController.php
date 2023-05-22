<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        return Company::get();
    }

    public function store(Request $request){

        // $request->validate([
        //     'name' => 'required | unique:company',
        // ]);
        
        $company = new Company();

        $company->name = $request->input('company_name');
        $company->display_name = $request->input('display_name');
        $company->status = $request->input('status');

        $company->save();
        return response()->json($company);
    }

    public function edit($id){
        $single_company = Company::where('id',$id)->first();
        return response()->json($single_company);
    }

    public function update($id, Request $request){

        $company = Company::find($id);
        $company_name = $request->input('company_name');
        $display_name = $request->input('display_name');
        $status = $request->input('status');

        $company->name = $company_name;
        $company->display_name = $display_name;
        $company->status = $status;
        $company->save();
        return response()->json($company);

    }

    public function destroy($id){
        $company = Company::find($id);
        $company->delete();
        return response()->json($company);
    }
}
