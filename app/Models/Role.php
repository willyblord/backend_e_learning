<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use \DateTimeInterface;

class Role extends Model
{ 
    use SoftDeletes;
    use HasFactory, Notifiable;
    public $table = 'role';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function permissions()
    {
        return $this->belongsToMany(User::class);

    }
}
