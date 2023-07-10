<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function monthly_purchase(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $where = "";
        if(!empty($from_date) && !empty($to_date)){
            $where = "WHERE tm.tran_date BETWEEN '$from_date' AND '$to_date'";
        }
        $sql = "SELECT ei.name emp_name, c.name customer_name, s.name supplier_name, b.booking_no, rg.registration_no, p.id,
                u.name unit_name, p.tran_id tran_id, p.jl_no, p.jot_no, p.dag_no, p.plot_no, p.cs, p.sa, p.rs, p.brs,
                p.type, p.east, p.west, p.north, p.south, p.qty, p.unit_price, p.total_price, p.remaining_qty, m.name mowza_name,
                dv.name division_name, dis.name district_name , th.name thana_name, un.name union_name, tm.tran_date
                FROM purchase p
                LEFT JOIN tran_master tm ON p.tran_id = tm.id
                LEFT JOIN employee_info ei ON tm.emp_id = ei.id
                LEFT JOIN customers c ON tm.customer = c.id
                LEFT JOIN suppliers s ON tm.supplier = s.id
                LEFT JOIN bookings b ON tm.booking_id = b.id
                LEFT JOIN registrations rg ON tm.registration_id = rg.id
                LEFT JOIN units u ON p.unit = u.id
                LEFT JOIN mowzas m ON p.division = m.id
                LEFT JOIN divisions dv ON p.division = dv.id
                LEFT JOIN districts dis ON p.district = dis.id
                LEFT JOIN thanas th ON p.thana = th.id
                LEFT JOIN unions un ON p.union = un.id
                $where";
        $purchase_data = DB::select($sql);
        return response()->json($purchase_data);
    }

    public function monthly_sales(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $where = "";
        if(!empty($from_date) && !empty($to_date)){
            $where = "WHERE tm.tran_date BETWEEN '$from_date' AND '$to_date'";
        }
        $sql = "SELECT ei.name emp_name, c.name customer_name, sp.name supplier_name, b.booking_no, rg.registration_no, s.id,
                u.name unit_name, s.tran_id tran_id, s.jl_no, s.jot_no, s.dag_no, s.plot_no, s.cs, s.sa, s.rs, s.brs,
                s.type, s.east, s.west, s.north, s.south, s.qty, s.unit_price, s.total_price, s.remaining_qty, m.name mowza_name,
                dv.name division_name, dis.name district_name , th.name thana_name, un.name union_name, tm.tran_date
                FROM sales s
                LEFT JOIN tran_master tm ON s.tran_id = tm.id
                LEFT JOIN employee_info ei ON tm.emp_id = ei.id
                LEFT JOIN customers c ON tm.customer = c.id
                LEFT JOIN suppliers sp ON tm.supplier = sp.id
                LEFT JOIN bookings b ON tm.booking_id = b.id
                LEFT JOIN registrations rg ON tm.registration_id = rg.id
                LEFT JOIN units u ON s.unit = u.id
                LEFT JOIN mowzas m ON s.division = m.id
                LEFT JOIN divisions dv ON s.division = dv.id
                LEFT JOIN districts dis ON s.district = dis.id
                LEFT JOIN thanas th ON s.thana = th.id
                LEFT JOIN unions un ON s.union = un.id
                $where";
        $sales_data = DB::select($sql);
        return response()->json($sales_data);
    }

}
