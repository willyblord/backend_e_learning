<?php

namespace App\Http\Controllers;
use App\Models\Question;
use Illuminate\Http\Request;
use Gate;
use Validator;
use Symfony\Component\HttpFoundation\Response;
class questionController extends Controller
{

    public function postQuestion(Request $request)
    {
        {
        $validator = Validator::make($request->all(), [
            'chapter_id' => 'required',
            'question_text' => 'required',

        ]);
        if($validator->fails()) {
            return response()->json([
                'message' => 'role Exist'
            ], 201);
        }
        $quest = Question::create([
            'chapter_id' => $request -> chapter_id,
            'question_text' => $request -> question_text
            ]);
        return response()->json([
            'message' => 'role registered',
            'user' => $quest
        ], 201);
    }
}
public function getQuestion(){
    return response()->json(Question::all(),200);
}
}
