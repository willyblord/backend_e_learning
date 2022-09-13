<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\Exam;
use Gate;
use DB;
use Illuminate\Http\Request;

class examController extends Controller
{
    //
    public function postExam(Request $request){
        $validator = Validator::make($request->all(), [
            'course_name' => 'required|string|min:2|max:100',
            'question' => 'required|string',
            'option1' => 'required|string|max:100',
            'option2' => 'required|string',
            'option3' => 'required|string',
            'option4' => 'required|string',
            'answer' => 'required|string',

        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = Exam::create([
            'course_name' => $request -> course_name,
            'question' => $request -> question,
            'option1' => $request -> option2,
            'option2' => $request -> option2,
            'option3' => $request -> option3,
            'option4' => $request -> option4,
            'answer' => $request -> answer,
            ]);
        return response()->json([
            'message' => 'Exam UPLOADED successfully registered',
            'exam' => $data
        ], 201);
    }
    public function getquestion(){
        return response()->json(Exam::all(),200);

    }

}
