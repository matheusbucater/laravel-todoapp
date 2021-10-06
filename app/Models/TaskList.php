<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    protected $table = 'tasks_lists';

    public function tasks() {
        return $this->hasMany(Task::class)->orderBy('created_at', 'desc');
    }
    public function task() {
        return $this->hasOne(Task::class);
    }
}
