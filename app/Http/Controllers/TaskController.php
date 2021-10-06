<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function tasksByList($id) {
        $tasks_list = TaskList::findOrFail($id);
        $list_id = $tasks_list->id;
        $tasks = $tasks_list->tasks()->paginate(10);
        return view('tasks.by_list', compact('tasks', 'list_id'));
    }
    public function index(Auth $auth) {
//        $tasks = $auth::user()->tasks_lists()->tasks()->paginate(10);
        $tasks = $auth::user()->tasks()->paginate(10);
        return view('tasks.index', compact('tasks'));
    }
//    public function dashboard(Auth $auth) {
//        $tasks = $auth::user()->tasks()->paginate(10);
//        return view('tasks.dashboard', compact('tasks'));
//    }
//    public function index(Auth $auth) {
//        $tasks = $auth::user()->tasks()->paginate(10);
//        return view('tasks.index', compact('tasks'));
//    }
}
