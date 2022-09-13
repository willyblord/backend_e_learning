<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\courses;
use App\Models\Chapter;
use App\Models\content;
use Illuminate\Http\Request;
use DB;
class JointableController extends Controller
{
    // get content
function getContent()
    {
    	$data=courses::join('chapter', 'chapter.course_id', '=', 'courses.course_id')
              		->join('content', 'content.chapter_id', '=', 'chapter.chapter_id')
              		->get(['courses.courses', 
                           'chapter.chapter_name', 
                           'content.content'
                         ]);
        //return view('join_table', compact('data'));
        return response()->json(['data'=>$data], 200);     

    }
    // getting all data
    public function getAllChapter(){
        $users = DB::select('select * from chapter where Course_id="chapter_id"');
        return response()->json(['data'=>$users], 200);     
        }
    // end f data
       // getting all data
       public function getAllContent(){
        $users = DB::select('select * from content where chapter_id="chapter_id"');
        return response()->json(['data'=>$users], 200);     
        }
    // end f data
    
    // GETTING chapter
    function getChapter(){
        $data=Chapter::join('chapter','chapter.course_id', '=', 'courses.course_id')
        ->get(['chapter.chapter_name']);
    }
    // end of Content
    // post courses
   
    
    
    // GETCOURSES
 public function getCourses(){
        return response()->json(courses::all(),200);
 }
 //getcourses By Id
 public function getCoursesById($course_id){
    $data = courses::find($course_id);
     if(is_null($data)){
        return response()->json(['message' => 'courses not found on this'],404);
     }
    return response()->json(courses::find($course_id),200);
}

    // delete courses
   public function deleteCourses(Request $request, $course_id){
    $cour = courses::find($course_id);
    if(is_null($cour)){
        return response()->json(['message' => 'Course not found'],404);
    }
    $cour->delete();
    return response(null,200);
}
// post Content
   public function contentCreater(Request $request){
    $content = content::create($request->all());
    return response($content,200);
    }
// post Content
   public function contentView(){
    return response()->json(content::all(),200);
    }
//getUser By Id
public function getContentById($content_id){
    $content = content::find($content_id);
    if(is_null($content)){
        return response()->json(['message' => 'content'],404);
    }
    return response()->json(content::find($content_id),200);
}

// getting chapter by id
public function getAllChapterbycourses($chapter_id){
    $chap = chapter::find($chapter_id);
    if(is_null($chap)){
        return response()->json(['message' => 'content'],404);
    }
    return response()->json(chapter::find($chapter_id),200);
}
}