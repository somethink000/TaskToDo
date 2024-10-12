<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskNode extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
        'position' => 'array'
    ];

    protected $fillable = [
        'type',
        'data',
        'done',
        'position',
        // 'posx',
        // 'posy',
        'user_id',
    ];
}
