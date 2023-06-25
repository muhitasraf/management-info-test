<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index(){
        $sql = "SELECT p.id, p.tran_id tran_id, p.jl_no, p.jot_no, p.dag_no, p.plot_no, p.cs, p.sa, p.rs, p.brs, p.type, p.east, p.west,
                p.north, p.south, p.qty, p.unit_price, p.total_price, p.remaining_qty, m.name mowza_name, dv.name division_name,
                dv.id division_id, dis.name district_name , dis.id district_id, th.id thana_id, th.name thana_name, un.id union_id,
                un.name union_name
                FROM purchase p
                LEFT JOIN mowzas m ON p.division = m.id
                LEFT JOIN divisions dv ON p.division = dv.id
                LEFT JOIN districts dis ON p.district = dis.id
                LEFT JOIN thanas th ON p.thana = th.id
                LEFT JOIN unions un ON p.union = un.id";
        $data = DB::select($sql);
        // dd($data);
        return response()->json($data);
    }

    public function store(Request $request){

        // dd($request->all());
        // $request->validate([
        //     'name' => 'required | unique:collection',
        // ]);
        $purchase = new Purchase();

        $purchase->unit = $request->input('unit_id');
        $purchase->division = $request->input('division_id');
        $purchase->district = $request->input('district_id');
        $purchase->thana = $request->input('thana_id');
        $purchase->union = $request->input('union_id');
        $purchase->mowja = $request->input('mowza_id');
        $purchase->type = $request->input('type_id');
        $purchase->jl_no = $request->input('jl_no');
        $purchase->jot_no = $request->input('jot_no');
        $purchase->dag_no = $request->input('dag_no');
        $purchase->plot_no = $request->input('plot_no');
        $purchase->cs = $request->input('cs');
        $purchase->sa = $request->input('sa');
        $purchase->rs = $request->input('rs');
        $purchase->brs = $request->input('brs');
        $purchase->east = $request->input('east');
        $purchase->west = $request->input('west');
        $purchase->north = $request->input('north');
        $purchase->south = $request->input('south');
        $purchase->qty = $request->input('qty');
        $purchase->unit_price = $request->input('unit_price');
        $purchase->total_price = $request->input('total_price');
        $purchase->remaining_qty = $request->input('remaining_qty');

        $purchase->save();
        return response()->json($purchase);
    }

    public function show($id){
        $sql = "SELECT c.*, b.booking_no, rg.registration_no FROM collections c
                LEFT JOIN bookings b ON b.id = c.booking
                LEFT JOIN registrations rg ON rg.id = c.registration WHERE c.id = $id";
        $single_collection = collect( DB::select($sql))->first();
        //$single_collection = Purchase::where('id',$id)->first();
        return response()->json($single_collection);
    }

    public function edit($id){
        $single_collection = Purchase::where('id',$id)->first();
        return response()->json($single_collection);
    }

    public function update($id, Request $request){

        $purchase = Purchase::find($id);
        $purchase->booking = $request->input('booking_id');
        $purchase->registration = $request->input('registration_id');
        $purchase->month = $request->input('month');
        $purchase->year = $request->input('year');
        $purchase->financial_year = $request->input('financial_year');
        $purchase->sales_man = $request->input('sales_man_id');
        $purchase->collection_by = $request->input('collection_by');
        $purchase->collection_date = $request->input('collection_date');
        $purchase->save();
        return response()->json($purchase);

    }

    public function destroy($id){
        $purchase = Purchase::find($id);
        $purchase->delete();
        return response()->json($purchase);
    }
}
