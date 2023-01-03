<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\unit_table;
use App\Models\time_table;

class play extends Controller
{
    //
    function sand_box(){
        $count_data=time_table::where([['year','=',"1"],['semester','=',"1"]])->get();
        $data=unit_table::select('unit_code','name','lecturer_id','lecturer')->where([['year','=','1'],['semester','=','1']])->get();
        return view('play',['data'=>$data]);
    }

    
}
