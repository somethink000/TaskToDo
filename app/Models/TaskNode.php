<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskNode extends Model
{
    use HasFactory;

    protected $casts = [
        'props' => 'array',
    ];

    protected $fillable = [
        'type',
        'props',
        'done',
        'posx',
        'posy',
        'user_id',
    ];
}
