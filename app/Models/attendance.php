<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{

    use HasFactory;
    public $table = 'attendance';
    protected $fillable = [
        'student_name',
        'course_name',
        'updated_at',
        'created_at'
    ];
    public function attendance()
{
    return $this->belongsTo(attendance::class);

}
}
