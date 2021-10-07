<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $attributes = [
        'completed' => false,
        'starred' => false
    ];
    protected $casts = [
        'completed' => 'boolean',
        'starred' => 'boolean'
    ];
}
