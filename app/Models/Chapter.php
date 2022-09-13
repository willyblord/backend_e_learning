<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chapter;
use App\Models\courses;
class Chapter extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'chapters';
    protected $primaryKey = 'chapter_id';
    protected $fillable = [
        'chapter_id',
        'chapter_name',
        'course_id',
        'file',
        'chapterDetails',
        'author'
    ];
public function course()
{
    return $this->belongsTo(courses::class, 'course_id');
}
}
