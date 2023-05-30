<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        return Customer::get();
    }

    public function store(Request $request){

        $request->validate([
            'nid' => 'required',
            'bin' => 'required',
            'present_address' => 'required',
            'mobile' => 'required',
            'DOB' => 'required',
            'is_alive' => 'required',
        ]);

        $customer = new Customer();

        $customer->name = $request->input('customer_name');
        $customer->nid = $request->input('nid');
        $customer->bin = $request->input('bin');
        $customer->present_address = $request->input('present_address');
        $customer->permanent_address = $request->input('permanent_address');
        $customer->mobile = $request->input('mobile');
        $customer->mobile_1 = $request->input('mobile_1');
        $customer->DOB = $request->input('DOB');
        $customer->father = $request->input('father');
        $customer->mother = $request->input('mother');
        $customer->spouse = $request->input('spouse');
        $customer->no_of_child = $request->input('no_of_child');
        $customer->occupation = $request->input('occupation');
        $customer->is_alive = $request->input('is_alive');

        $customer->save();
        return response()->json($customer);
    }

    public function show($id){
        $single_customer = Customer::where('id',$id)->first();
        return response()->json($single_customer);
    }

    public function edit($id){
        $single_customer = Customer::where('id',$id)->first();
        return response()->json($single_customer);
    }

    public function update($id, Request $request){

        $request->validate([
            'nid' => 'required',
            'bin' => 'required',
            'present_address' => 'required',
            'mobile' => 'required',
            'DOB' => 'required',
            'is_alive' => 'required',
        ]);
        
        $customer = Customer::find($id);
        $customer->name = $request->input('customer_name');
        $customer->nid = $request->input('nid');
        $customer->bin = $request->input('bin');
        $customer->present_address = $request->input('present_address');
        $customer->permanent_address = $request->input('permanent_address');
        $customer->mobile = $request->input('mobile');
        $customer->mobile_1 = $request->input('mobile_1');
        $customer->DOB = $request->input('DOB');
        $customer->father = $request->input('father');
        $customer->mother = $request->input('mother');
        $customer->spouse = $request->input('spouse');
        $customer->no_of_child = $request->input('no_of_child');
        $customer->occupation = $request->input('occupation');
        $customer->is_alive = $request->input('is_alive');
        $customer->save();
        return response()->json($customer);

    }

    public function destroy($id){
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json($customer);
    }
}
