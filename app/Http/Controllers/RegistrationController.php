<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(){
        $registration = Registration::get();
        return response()->json($registration);
    }

    public function store(Request $request){
        // dd($request);
        $registration = new Registration();
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
}
