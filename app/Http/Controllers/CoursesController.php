<?php
namespace App\Http\Controllers;
use App\Models\courses;
use App\Models\Chapters;
use App\Models\content;
use DB;
use Validator;
use Storage;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    //
    public function postCourses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'courses' => 'required|string|min:2|max:100',
            'file' => 'required|mimes:video/mp4|max:2048',
            'language' => 'required|string|min:2|max:100',
             'course_you_need1' => 'required|string|min:2|max:100',
             'course_you_need2' => 'required|string|min:2|max:100',
             'aboutCourses' => 'required|string|min:2|max:100',
             'author' => 'required|string|min:2|max:100',
             'courseHours' => 'required|string|min:2|max:100'
        ]);

        $input = $request->all();
        if ($file = $request->file('file')) {
           $destinationPath = 'public/image';
         $profileFile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileFile);
             $input['file'] = "$profileFile";
        }
            courses::create($input);
             return response()->json([
               'message' => 'Course has been registered'
            ], 200);
         }
         public function paginationCourses(){
          {
            $data = courses::latest()->paginate(5);
            return view('courses',compact('courses'));
        }
         }
         public function getCoursesbyid($course_id){
            $data = courses::find($course_id);
            if(is_null($data)){
                return response()->json(['message' => 'course list not found ', $course_id],404);
            }
            return response()->json(courses::find($content_id),200);
        }

        public function updateCourses(Request $request, $course_id){
            $data = courses::find($course_id);
            if(is_null($data)){
                return response()->json(['message' => 'Course Not FOUND'],404);
            }
            $data->update($request->all());
            return response($data,200);
        }
}

