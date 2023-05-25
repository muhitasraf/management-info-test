<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){
        return response()->json(Booking::all()) ;
    }
    public function store(Request $request){
        // dd($request->all());
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
