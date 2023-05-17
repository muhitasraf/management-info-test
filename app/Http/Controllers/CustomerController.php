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

        // $request->validate([
        //     'name' => 'required | unique:customer',
        // ]);

        $customer_name = $request->input('customer_name');
        $display_name = $request->input('display_name');
        $status = $request->input('status');

        $customer = new Customer();

        $customer->name = $customer_name;
        $customer->display_name = $display_name;
        $customer->status = $status;

        $customer->save();
        return response()->json($customer);
    }

    public function edit($id){
        $single_customer = Customer::where('id',$id)->first();
        return response()->json($single_customer);
    }

    public function update($id, Request $request){

        $customer = Customer::find($id);
        $customer_name = $request->input('customer_name');
        $display_name = $request->input('display_name');
        $status = $request->input('status');

        $customer->name = $customer_name;
        $customer->display_name = $display_name;
        $customer->status = $status;
        $customer->save();
        return response()->json($customer);

    }

    public function destroy($id){
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json($customer);
    }
}