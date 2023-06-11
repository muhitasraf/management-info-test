<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Collator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function index(){
        $registration = Registration::get();
        return response()->json($registration);
    }

    public function store(Request $request){

        $registration = new Registration();

        $registration->booking_id = $request->input('booking_id');
        $registration->registration_no = $request->input('registration_no');
        $registration->customer = $request->input('customer_id');
        $registration->unit = $request->input('unit_id');
        $registration->qty = $request->input('qty');
        $registration->unit_price = $request->input('unit_price');
        $registration->total_price = $request->input('total_price');
        $registration->booked_amt = $request->input('booked_amt');
        $registration->down_payment = $request->input('down_payment');
        $registration->remaining_amt = $request->input('remaining_amt');
        $registration->registration_date = $request->input('registration_date');
        $registration->installment = $request->input('installment');
        $registration->duration = $request->input('duration');
        $registration->no_of_install = $request->input('no_of_install');
        $registration->per_month_install = $request->input('per_month_install');
        $registration->pay_install_date = $request->input('pay_install_date');
        $registration->mutation_type = $request->input('mutation_type');

        $registration->save();
        return response()->json($registration);
    }

    public function edit($id){
        $registration = Registration::where('id',$id)->first();
        return response()->json($registration);
    }

    public function update($id, Request $request){

        $registration = Registration::find($id);
        
        $registration->booking_id = $request->input('booking_id');
        $registration->customer = $request->input('customer_id');
        $registration->unit = $request->input('unit_id');
        $registration->qty = $request->input('qty');
        $registration->unit_price = $request->input('unit_price');
        $registration->total_price = $request->input('total_price');
        $registration->booked_amt = $request->input('booked_amt');
        $registration->down_payment = $request->input('down_payment');
        $registration->remaining_amt = $request->input('remaining_amt');
        $registration->registration_date = $request->input('registration_date');
        $registration->installment = $request->input('installment');
        $registration->duration = $request->input('duration');
        $registration->no_of_install = $request->input('no_of_install');
        $registration->per_month_install = $request->input('per_month_install');
        $registration->pay_install_date = $request->input('pay_install_date');
        $registration->mutation_type = $request->input('mutation_type');

        $registration->save();
        return response()->json($registration);
    }

    public function destroy($id){
        $employee = Registration::find($id);
        $employee->delete();
        return response()->json($employee);
    }

    public function registration_no(){
        $prev_registration_no = collect(DB::select("SELECT registration_no FROM registrations ORDER BY id DESC LIMIT 1"))->first();
        if(!empty($prev_registration_no->registration_no)){
            $prev_booking_str = substr($prev_registration_no->registration_no,0,9);
            $prev_booking_num = substr($prev_registration_no->registration_no,9,strlen($prev_registration_no->registration_no));
            $new_registration_no = $prev_booking_str.sprintf('%08d', $prev_booking_num + 1);
        }else{
            $new_registration_no = "REG-".date("Y")."-00000000";
        }
        return response()->json($new_registration_no);
    }
}
