<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index(){
        $sql = "SELECT s.id, u.name unit_name, s.tran_id tran_id, s.jl_no, s.jot_no, s.dag_no, s.plot_no, s.cs, s.sa, s.rs, s.brs, s.type, s.east, s.west,
                s.north, s.south, s.qty, s.unit_price, s.total_price, s.remaining_qty, m.name mowza_name, dv.name division_name,
                dv.id division_id, dis.name district_name , dis.id district_id, th.id thana_id, th.name thana_name, un.id union_id,
                un.name union_name
                FROM sales s
                LEFT JOIN units u ON s.unit = u.id
                LEFT JOIN mowzas m ON s.division = m.id
                LEFT JOIN divisions dv ON s.division = dv.id
                LEFT JOIN districts dis ON s.district = dis.id
                LEFT JOIN thanas th ON s.thana = th.id
                LEFT JOIN unions un ON s.union = un.id";
        $sales_data = DB::select($sql);
        return response()->json($sales_data);
    }

    public function store(Request $request)
    {
        $tran_data = [
            "emp_id" => $request->input('employee_id'),
            "customer" => $request->input('customer_id'),
            "supplier" => $request->input('supplier_id'),
            "booking_id" => $request->input('booking_id'),
            "registration_id" => $request->input('registration_id'),
            "tran_date" => $request->input('sales_date'),
            "unit" => $request->input('unit_id'),
            "tran_type" => 1,
            "financial_year" => "2023",
            "total_qty" => $request->input('qty'),
            "total_amt" => $request->input('total_price'),
        ];

        $tran_id = DB::table('tran_master')->insertGetId($tran_data);

        $sales = new Sales();

        $sales->unit = $request->input('unit_id');
        $sales->tran_id = $tran_id;
        $sales->division = $request->input('division_id');
        $sales->district = $request->input('district_id');
        $sales->thana = $request->input('thana_id');
        $sales->union = $request->input('union_id');
        $sales->mowja = $request->input('mowza_id');
        $sales->type = $request->input('type_id');
        $sales->jl_no = $request->input('jl_no');
        $sales->jot_no = $request->input('jot_no');
        $sales->dag_no = $request->input('dag_no');
        $sales->plot_no = $request->input('plot_no');
        $sales->cs = $request->input('cs');
        $sales->sa = $request->input('sa');
        $sales->rs = $request->input('rs');
        $sales->brs = $request->input('brs');
        $sales->east = $request->input('east');
        $sales->west = $request->input('west');
        $sales->north = $request->input('north');
        $sales->south = $request->input('south');
        $sales->qty = $request->input('qty');
        $sales->unit_price = $request->input('unit_price');
        $sales->total_price = $request->input('total_price');
        $sales->remaining_qty = $request->input('remaining_qty');

        $sales->save();
        return response()->json($sales);
    }

    public function show($id){
        $sql = "SELECT ei.name emp_name, s.id, u.name unit_name, s.tran_id tran_id, s.jl_no, s.jot_no, s.dag_no, s.plot_no, s.cs, s.sa, s.rs, s.brs,
                s.type, s.east, s.west, s.north, s.south, s.qty, s.unit_price, s.total_price, s.remaining_qty, m.name mowza_name,
                dv.name division_name, dis.name district_name , th.name thana_name, un.name union_name
                FROM sales s
                LEFT JOIN tran_master tm ON s.tran_id = tm.id
                LEFT JOIN employee_info ei ON tm.emp_id = ei.id
                LEFT JOIN units u ON s.unit = u.id
                LEFT JOIN mowzas m ON s.division = m.id
                LEFT JOIN divisions dv ON s.division = dv.id
                LEFT JOIN districts dis ON s.district = dis.id
                LEFT JOIN thanas th ON s.thana = th.id
                LEFT JOIN unions un ON s.union = un.id
                WHERE s.id = $id";
        $single_sales = collect( DB::select($sql))->first();
        return response()->json($single_sales);
    }

    public function edit($id){
        $single_sales = DB::table('sales')
        ->select('sales.*',
        'tran_master.emp_id',
        'tran_master.customer',
        'tran_master.supplier',
        'tran_master.tran_date',
        'tran_master.unit',
        'tran_master.booking_id',
        'tran_master.registration_id',
        'tran_master.tran_type',
        'tran_master.financial_year',
        'tran_master.total_qty',
        'tran_master.total_amt')
        ->leftJoin('tran_master','sales.tran_id','=','tran_master.id')
        ->where('sales.id',$id)->first();
        return response()->json($single_sales);
    }

    public function update($id, Request $request){

        $tran_data = [
            "emp_id" => $request->input('employee_id'),
            "customer" => $request->input('customer_id'),
            "supplier" => $request->input('supplier_id'),
            "booking_id" => $request->input('booking_id'),
            "registration_id" => $request->input('registration_id'),
            "tran_date" => $request->input('sales_date'),
            "unit" => $request->input('unit_id'),
            "tran_type" => 1,
            "financial_year" => "2023",
            "total_qty" => $request->input('qty'),
            "total_amt" => $request->input('total_price'),
        ];

        DB::table('tran_master')->where('id',$request->input('tran_id'))->update($tran_data);

        $sales = Sales::find($id);
        $sales->unit = $request->input('unit_id');
        $sales->division = $request->input('division_id');
        $sales->district = $request->input('district_id');
        $sales->thana = $request->input('thana_id');
        $sales->union = $request->input('union_id');
        $sales->mowja = $request->input('mowza_id');
        $sales->type = $request->input('type_id');
        $sales->jl_no = $request->input('jl_no');
        $sales->jot_no = $request->input('jot_no');
        $sales->dag_no = $request->input('dag_no');
        $sales->plot_no = $request->input('plot_no');
        $sales->cs = $request->input('cs');
        $sales->sa = $request->input('sa');
        $sales->rs = $request->input('rs');
        $sales->brs = $request->input('brs');
        $sales->east = $request->input('east');
        $sales->west = $request->input('west');
        $sales->north = $request->input('north');
        $sales->south = $request->input('south');
        $sales->qty = $request->input('qty');
        $sales->unit_price = $request->input('unit_price');
        $sales->total_price = $request->input('total_price');
        $sales->remaining_qty = $request->input('remaining_qty');
        $sales->save();
        return response()->json($sales);

    }

    public function destroy($id){
        $sales = Sales::find($id);
        $sales->delete();
        return response()->json($sales);
    }
}
