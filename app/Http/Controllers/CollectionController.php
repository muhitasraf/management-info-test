<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    public function index(){
        $sql = "SELECT c.id, sal.name sales_man, coll.name collection_by, c.month, c.year, c.financial_year, c.collection_date, b.booking_no, rg.registration_no FROM collections c
                LEFT JOIN employee_info sal ON sal.id = c.sales_man
                LEFT JOIN employee_info coll ON coll.id = c.collection_by
                LEFT JOIN bookings b ON b.id = c.booking
                LEFT JOIN registrations rg ON rg.id = c.registration";
        $data = DB::select($sql);

        return response()->json($data);
    }

    public function store(Request $request){

        // dd($request);
        // $request->validate([
        //     'name' => 'required | unique:collection',
        // ]);
        // dd($request->input('collection_name'));
        $collection = new Collection();

        $collection->booking = $request->input('booking_id');
        $collection->registration = $request->input('registration_id');
        $collection->month = $request->input('month');
        $collection->year = $request->input('year');
        $collection->financial_year = $request->input('financial_year');
        $collection->sales_man = $request->input('customer_id');
        $collection->collection_by = $request->input('collection_by');
        $collection->collection_date = $request->input('collection_date');

        $collection->save();
        return response()->json($collection);
    }

    public function show($id){
        $sql = "SELECT c.*, b.booking_no, rg.registration_no FROM collections c
                LEFT JOIN bookings b ON b.id = c.booking
                LEFT JOIN registrations rg ON rg.id = c.registration WHERE c.id = $id";
        $single_collection = collect( DB::select($sql))->first();
        //$single_collection = Collection::where('id',$id)->first();
        return response()->json($single_collection);
    }

    public function edit($id){
        $single_collection = Collection::where('id',$id)->first();
        return response()->json($single_collection);
    }

    public function update($id, Request $request){

        $collection = Collection::find($id);
        $collection->booking = $request->input('booking_id');
        $collection->registration = $request->input('registration_id');
        $collection->month = $request->input('month');
        $collection->year = $request->input('year');
        $collection->financial_year = $request->input('financial_year');
        $collection->sales_man = $request->input('sales_man_id');
        $collection->collection_by = $request->input('collection_by');
        $collection->collection_date = $request->input('collection_date');
        $collection->save();
        return response()->json($collection);

    }

    public function destroy($id){
        $collection = Collection::find($id);
        $collection->delete();
        return response()->json($collection);
    }
}
