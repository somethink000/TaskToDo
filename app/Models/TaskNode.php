<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskNode extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
    ];

    protected $fillable = [
        'type',
        'data',
        'done',
        'posx',
        'posy',
        'user_id',
    ];
}
