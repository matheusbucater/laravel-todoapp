<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class TaskList extends Model
{
    use HasFactory;

    protected $table = 'tasks_lists';

    protected $attributes = [
        'starred' => false
    ];
    protected $casts = [
        'starred' => 'boolean'
    ];


    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function task() {
        return $this->hasOne(Task::class);
    }
}
