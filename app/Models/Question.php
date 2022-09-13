<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'chapter_id',
        'question_text',
        'created_at',
        'updated_at'

    ];
    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }
    public function questionOptions(){
        return $this->hasMany(Option::class);
    }
}
