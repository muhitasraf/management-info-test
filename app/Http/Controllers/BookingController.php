<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(){
        $sql = "SELECT b.*, c.name customer_name, u.name unit_name FROM bookings b
                LEFT JOIN customers c ON c.id = b.customer
                LEFT JOIN units u ON u.id = b.unit";
        $data = DB::select($sql);
        return response()->json($data);
    }

    public function booking_no(){
        $prev_booking_no = collect(DB::select("SELECT booking_no FROM bookings ORDER BY id DESC LIMIT 1"))->first();
        if(!empty($prev_booking_no->booking_no)){
            $prev_booking_str = substr($prev_booking_no->booking_no,0,9);
            $prev_booking_num = substr($prev_booking_no->booking_no,9,strlen($prev_booking_no->booking_no));
            $new_booking_no = $prev_booking_str.sprintf('%08d', $prev_booking_num + 1);
        }else{
            $new_booking_no = "BOK-".date("Y")."-00000000";
        }
        return response()->json($new_booking_no);
    }

    public function store(Request $request){

        $req_data = $request->all();
        $data = [];

        foreach($req_data as $req){
            $data[] = [
                'customer' => $req['customer'],
                'unit' => $req['unit'],
                'qty' => $req['qty'],
                'unit_price' => $req['unit_price'],
                'total_price' => $req['total_price'],
                'booked_amt' => $req['booked_amt'],
                'booked_date' => $req['booked_date'],
                'remaining_amt' => $req['remaining_amt'],
                'booking_no' => $req['booking_no']
            ];
        }
        // dd($data);
        Booking::insert($data);
        return response()->json($data);
    }

    public function show($id){
        $sql = "SELECT b.*, c.name customer_name, u.name unit_name FROM bookings b
                LEFT JOIN customers c ON c.id = b.customer
                LEFT JOIN units u ON u.id = b.unit
                WHERE b.id = $id";
        $single_employee = DB::select($sql);
        return response()->json($single_employee);
    }

    public function edit($id){
        $single_employee = Booking::where('id',$id)->first();
        return response()->json($single_employee);
    }

    public function update($id, Request $request){
        // dd($request->all());
        $employee = Booking::find($id);

        $employee->customer = $request->input('customer');
        $employee->unit = $request->input('unit');
        $employee->qty = $request->input('qty');
        $employee->unit_price = $request->input('unit_price');
        $employee->total_price = $request->input('total_price');
        $employee->booked_amt = $request->input('booked_amt');
        $employee->booked_date = $request->input('booked_date');
        $employee->remaining_amt = $request->input('remaining_amt');

        $employee->save();
        return response()->json($employee);

    }

    public function destroy($id){
        $employee = Booking::find($id);
        $employee->delete();
        return response()->json($employee);
    }
}
