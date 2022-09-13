<?php

namespace App\Http\Controllers;
use App\Models\Chapter;
use App\Models\courses;
use App\Models\content;
use Validator;
use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ChapersController extends Controller
{
    //
    public function addChapters(Request $request){

        $validator = Validator::make($request->all(), [
            'chapter_name' => 'required|string|min:2|max:100',
            'course_id' => 'required|string|min:2|max:100',
            'file' => 'required|string',
            'chapterDetails' => 'string',
            'author' => 'string'


        ]);
        $input = $request->all();
         if ($file = $request->file('file')) {
         $destinationPath = 'public/image';
          $profileFile = date('YmdHis') . "." . $file->getClientOriginalExtension();
             $file->move($destinationPath, $profileFile);
             $input['file'] = "$profileFile";
        }
        Chapter::create($input);
             return response()->json([
               'message' => 'chapters has been registered'
            ], 200);
         }


 public function getChapter(){
    return response()->json(Chapter::all(),200);
}
public function getcby(){
    return response()->json(Chapter::with(['courses'])->get(),200);

}
// GETTNG CHAPTERS BY
public function getChapterById($chapter_id){
    $data = Chapter::find($chapter_id);
    if(is_null($data)){
        return response()->json(['message' => 'user'],404);
    }
    return response()->json(Chapter::find($chapter_id),200);
}

    // delete courses
    public function deleteChapter($chapter_id){
        $data = Chapter::find($chapter_id);
        if(is_null($data)){
            return response()->json(['message' => 'Chapter not found'],404);
        }
        $data->delete();
        return response(null,200);
    }

public function getChapterByCourse($course_id) {
    $data = courses::where('courses.course_id', '=', $course_id)
            ->JOIN('chapters', 'chapters.course_id', '=', 'courses.course_id')

    ->select(
        'chapter_name',
        'chapter_id',
        'chapterDetails'
    )
    ->get();

    return response()->json($data);
}
        // $userWithDoc = courses::where('courses.course_id', '=', $course_id)
        //      ->JOIN('chapters', 'chapters.course_id', '=', 'courses.course_id')
        //      ->get();
        // return response()->json($userWithDoc);
    }

