<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){
        return Supplier::get();
    }

    public function store(Request $request){

        // $request->validate([
        //     'name' => 'required | unique:supplier',
        // ]);
        // dd($request->input('supplier_name'));
        $supplier = new Supplier();

        $supplier->name = $request->input('supplier_name');
        $supplier->nid = $request->input('nid');
        $supplier->bin = $request->input('bin');
        $supplier->present_address = $request->input('present_address');
        $supplier->permanent_address = $request->input('permanent_address');
        $supplier->mobile = $request->input('mobile');
        $supplier->mobile_1 = $request->input('mobile_1');
        $supplier->DOB = $request->input('DOB');
        $supplier->father = $request->input('father');
        $supplier->mother = $request->input('mother');
        $supplier->spouse = $request->input('spouse');
        $supplier->no_of_child = $request->input('no_of_child');
        $supplier->occupation = $request->input('occupation');
        $supplier->is_alive = $request->input('is_alive');

        $supplier->save();
        return response()->json($supplier);
    }

    public function show($id){
        $single_supplier = Supplier::where('id',$id)->first();
        return response()->json($single_supplier);
    }

    public function edit($id){
        $single_supplier = Supplier::where('id',$id)->first();
        return response()->json($single_supplier);
    }

    public function update($id, Request $request){

        $supplier = Supplier::find($id);
        $supplier->name = $request->input('supplier_name');
        $supplier->nid = $request->input('nid');
        $supplier->bin = $request->input('bin');
        $supplier->present_address = $request->input('present_address');
        $supplier->permanent_address = $request->input('permanent_address');
        $supplier->mobile = $request->input('mobile');
        $supplier->mobile_1 = $request->input('mobile_1');
        $supplier->DOB = $request->input('DOB');
        $supplier->father = $request->input('father');
        $supplier->mother = $request->input('mother');
        $supplier->spouse = $request->input('spouse');
        $supplier->no_of_child = $request->input('no_of_child');
        $supplier->occupation = $request->input('occupation');
        $supplier->is_alive = $request->input('is_alive');
        $supplier->save();
        return response()->json($supplier);

    }

    public function destroy($id){
        $supplier = Supplier::find($id);
        $supplier->delete();
        return response()->json($supplier);
    }
}
