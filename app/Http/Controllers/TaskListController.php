<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskListController extends Controller
{
    public function index(Auth $auth) {
        $tasks_lists = $auth::user()->tasks_lists()->paginate(10);
        return view('tasks_lists.index', compact('tasks_lists'));
    }

    public function dashboard(Auth $auth) {
        $tasks_lists = $auth::user()->tasks_lists()->where('starred', true)->paginate(10);
        return view('tasks_lists.dashboard', compact('tasks_lists'));
    }
}
