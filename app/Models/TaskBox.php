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
}
