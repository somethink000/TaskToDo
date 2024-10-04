<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskNode extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'description',
        'done',
        'posx',
        'posy',
    ];
}
