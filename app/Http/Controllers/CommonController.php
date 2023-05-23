<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    public function getData($table = null, $cloumn = null, $id = null){
        $data = '';
        if(!empty($table)){
            if(!empty($cloumn) && !empty($id)){
                $data = DB::select("SELECT * FROM $table WHERE $cloumn = $id");
            }else{
                $data = DB::select("SELECT * FROM $table");
            }
        }

        return response()->json($data);
    }
}
