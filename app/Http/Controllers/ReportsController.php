<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function monthly_purchase(){
        $purchase_data = DB::table('purchase')->get();
        return response()->json($purchase_data);
    }

}
