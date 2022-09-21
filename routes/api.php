<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\JointableController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\ChapersController;
use App\Http\Controllers\courses;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\examController;
use App\Http\Controllers\attendanceController;
use App\Http\Controllers\PasswordResetRequestController;
use App\HTTP\Controllers\ChangePasswordController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SendMailreset;
use App\Http\Controllers\questionController;

use App\Models\User;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [JWTController::class, 'login']);
    Route::post('/register', [JWTController::class, 'register']);
    Route::post('/logout', [JWTController::class, 'logout']);
    Route::post('/refresh', [JWTController::class, 'refresh']);
    Route::post('/registerUser', [JWTController::class, 'registerUser']);
    Route::Delete('/destroy/{id}', [JWTController::class, 'destroy']);
    Route::get('profile', [JWTController::class,'Profile']);
    Route::post('/sendPasswordResetEmail', [PasswordResetRequestController::class, 'sendPasswordResetEmail']);
    Route::post('change-password',[ChangePasswordController::class, 'passwordResetProcess']);

});
// USER MGT API
Route::get('get-all-users', [CustomerAuthController::class, 'index']);
Route::get('getUserByuId/{id}',[CustomerAuthController::class,'getUserByuId']);
Route::put('updateUser/{id}',[CustomerAuthController::class,'updateUser']);
Route::get('getTrainer', [CustomerAuthController::class,'getTrainer']);
Route::get('getMe', [CustomerAuthController::class,'getMe']);
Route::get('getMentor', [CustomerAuthController::class,'getMentor']);
// forget password
Route::post('/forgetPasword', [PasswordResetRequestController::class, 'forgetPasword']);
//
Route::get('getContent',[JointableController::class, 'getContent']);
// post courses
Route::post('postCourses', [CoursesController::class, 'postCourses']);
Route::put('updateCourses/{course_id}', [CoursesController::class, 'updateCourses']);
// end of
Route::get('getCoursesById/{course_id}', [JointableController::class, 'getCoursesById']);

Route::get('getCourses', [JointableController::class, 'getCourses']);
Route::delete("deleteCourses/{course_id}",[JointableController::class,'deleteCourses']);
Route::get('paginationCourses', [CoursesController::class, 'paginationCourses']);
// CHAPTER MGT API
Route::post('addChapters', [ChapersController::class, 'addChapters']);
Route::get('getChapter', [ChapersController::class, 'getChapter']);
// getting chapter by id
Route::get("getChapterById/{chapter_id}",[ChapersController::class, 'getChapterById']);
Route::get('getCoursesbyid/{course_id}',[CoursesController::class,'getCoursesbyid']);

//Route::get("getAllChapterbycourses/{course_id}", [ChapersController::class,'getAllChapterbycourses']);
// Route::get("getAllChapterbycourses/{chapter_id}", [JointableController::class,'getAllChapterbycourses']);
Route::delete("deleteChapter/{id}",[ChapersController::class, 'deleteChapter']);


 Route::get("getcby",[ChapersController::class, 'getcby']);

// role MGT API
Route::post('roleCreate', [roleController::class, 'roleCreate']);
Route::get('getRole', [roleController::class, 'getRole']);
Route::delete("deleteRole/{id}",[roleController::class, 'deleteRole']);
Route::get("getRolebyId/{id}",[roleController::class, 'getRolebyId']);


// post conent db
Route::post('contentCreater', [JointableController::class, 'contentCreater']);
Route::get('contentView', [JointableController::class, 'contentView']);
Route::get('getContentById/{content_id}',[JointableController::class,'getContentById']);

// exam module
Route::post('postExam', [examController::class, 'postExam']);
Route::get('getquestion',[examController::class, 'getquestion']);
// attendance
Route::post('postAttendance', [attendanceController::class, 'postAttendance']);
Route::get('getAttendance', [attendanceController::class, 'getAttendance']);
Route::get('getChapterByCourse/{course_id}', [ChapersController::class,'getChapterByCourse']);

// quiz
Route::post('postQuestion', [questionController::class, 'postquestion']);
Route::get('getQuestion', [questionController::class, 'getQuestion']);
