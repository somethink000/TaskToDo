<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sortid',
        'userId'
    ];

    public function tasks(){
        return $this->hasMany(Task::class,'taskboxId','id');
    }

    protected static function booted () {
        static::deleting(function(TaskBox $taskBox) { // before delete() method call this
            $taskBox->tasks()->delete();
             // do the rest of the cleanup...
        });
    }
}
