<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table='tbl_questions';
    protected $fillable = [
        'course_name',
        'question',
        'option1',
        'option2',
        'option3',
        'option4',
        'answer'
    ];
    
        
}
