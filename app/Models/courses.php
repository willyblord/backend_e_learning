<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Conner\Tagging\Taggable;
use App\Models\Chapter;
use App\Models\courses;


class courses extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    protected $fillable = [
        'course_id',
        'courses',
        'language',
        'course_you_need1',
        'course_you_need2',
        'aboutCourses',
        'file',
        'author',
        'addedTime',
        'courseHours'

    ];

    public function chapter()
    {
        return $this->hasMany(Chapter::class, 'course_id');
    }
    public function file()
    {
        return $this->hasMany(File::class, 'course_id');
    }
}

