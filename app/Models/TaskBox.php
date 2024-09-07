<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sort_id',
        'user_id'
    ];

    public function tasks(){
        return $this->hasMany(Task::class,'taskbox_id','id');
    }

    protected static function booted () {
        static::deleting(function(TaskBox $taskBox) { 
            $taskBox->tasks()->delete();
        });
    }
}
