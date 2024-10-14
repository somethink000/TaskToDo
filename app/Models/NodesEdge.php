<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NodesEdge extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'label',
        'source',
        'target',
        'user_id',
    ];
}
