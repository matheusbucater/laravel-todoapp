<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function tasksByList($id) {
        $tasks_list = TaskList::findOrFail($id);
        $list_id = $tasks_list->id;
        $tasks = $tasks_list->tasks()->paginate(10);
        return view('tasks.by_list', compact('tasks', 'list_id'));
    }

    public function index(Auth $auth) {
        $tasks = $auth::user()->tasks()->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function addTask (Request $request, Auth $auth, $list_id): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->task_list_id = $list_id;
        $task->name = $request->name;
        $task->save();
        return redirect()->back();
    }

    public function addTaskGivenAList (Request $request, Auth $auth): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'select' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->task_list_id = $request->post('select');
        $task->name = $request->name;
        $task->save();
        return redirect()->back();
    }

    public function renameTask (Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'new_name' => 'required|max:50'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
        $task = Task::findOrFail($id);
        $task->name = $request->new_name;
        $task->save();
        return redirect()->back();
    }

    public function FinishOrUnfinishTask ($id): \Illuminate\Http\RedirectResponse
    {
        $task = Task::findOrFail($id);
        $task->completed = !$task->completed;
        $task->save();
        return redirect()->back();
    }

    public function deleteTask ($id): \Illuminate\Http\RedirectResponse
    {
        Task::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function starOrUnstarTask ($id): \Illuminate\Http\RedirectResponse
    {
        $task = Task::findOrFail($id);
        $task->starred = !$task->starred;
        $task->save();
        return redirect()->back();
    }

}
