<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'chapterFile';
    protected $primaryKey = 'file_id';
    protected $fillable = [
        'file',
        'course_id'
        
    ];
    public function course()
{
    return $this->belongsTo(courses::class, 'course_id');
}
}
