<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index(){
        return Collection::get();
    }

    public function store(Request $request){

        // dd($request);
        // $request->validate([
        //     'name' => 'required | unique:supplier',
        // ]);
        // dd($request->input('supplier_name'));
        $supplier = new Collection();

        $supplier->booking = $request->input('booking_id');
        $supplier->registration = $request->input('registration_id');
        $supplier->month = $request->input('month');
        $supplier->year = $request->input('year');
        $supplier->financial_year = $request->input('financial_year');
        $supplier->sales_man = $request->input('customer_id');
        $supplier->collection_by = $request->input('collection_by');
        $supplier->collection_date = $request->input('collection_date');

        $supplier->save();
        return response()->json($supplier);
    }

    public function show($id){
        $single_supplier = Collection::where('id',$id)->first();
        return response()->json($single_supplier);
    }

    public function edit($id){
        $single_supplier = Collection::where('id',$id)->first();
        return response()->json($single_supplier);
    }

    public function update($id, Request $request){

        $supplier = Collection::find($id);
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
        $supplier = Collection::find($id);
        $supplier->delete();
        return response()->json($supplier);
    }
}
