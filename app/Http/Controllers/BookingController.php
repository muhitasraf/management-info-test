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
                'remaining_amt' => $req['remaining_amt']
            ];
        }
        Booking::insert($data);
        return response()->json($data);
    }
}
