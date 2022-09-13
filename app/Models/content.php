<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class content extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = ['content_id','course_id','chapter_id'];
    public $incrementing = false;


    protected $fillable = [
        'course_id',
        'chapter_id',
        'content',
    ];
}
