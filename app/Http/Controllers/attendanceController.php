<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\Models\attendance;
use Gate;
use DB;
use Symfony\Component\HttpFoundation\Response;

class attendanceController extends Controller
{
    //
    public function postAttendance(Request $request)
    {
        $product = attendance::create($request->all());
        return response($product,200);
    }
    // get all student Attendance
    public function getAttendance(){
        $users = DB::select('select * from attendance');
        return response()->json(['data'=>$users], 200);
    }
}
