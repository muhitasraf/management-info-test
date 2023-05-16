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
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required | unique:company',
        // ]);

        $company_name = $request->input('company_name');
        $display_name = $request->input('display_name');
        $status = $request->input('status');

        $company = new Company();

        $company->name = $company_name;
        $company->display_name = $display_name;
        $company->status = $status;

        $company->save();
        return response()->json( $company);
    }
}
