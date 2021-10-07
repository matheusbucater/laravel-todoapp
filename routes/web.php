<?php

use App\Http\Controllers\TaskListController;
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['auth', 'web']], function () {

    // - - - - - - TASKS LISTS - - - - - - //

    /**
     * Dashboard - View
     */
    Route::get('/', [TaskListController::class, 'dashboard']);
    Route::get('/dashboard', [TaskListController::class, 'dashboard'])->name('dashboard');

    /**
     * Tasks Lists - View
     */
    Route::resource('tasks-lists', TaskListController::class);

    /**
     * Add A New Tasks List
     */
    Route::post('/tasks-list', function (Request $request, Auth $auth) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        $tasks_list = new TaskList;
        $tasks_list->user_id = $auth::id();
        $tasks_list->title = $request->title;
        $tasks_list->save();
        return redirect()->back();
    });

    /**
     * Edit Tasks List Title
     */
    Route::post('/edit-list/{id}', function (Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'new_title' => 'required|max:50'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
        $tasks_list = TaskList::findOrFail($id);
        $tasks_list->title = $request->new_title;
        $tasks_list->save();
        return redirect()->back();
    });

    /**
     * Delete Tasks List
     */
    Route::delete('/tasks-list/{id}', function ($id) {
        TaskList::findOrFail($id)->delete();
        return redirect('/tasks-lists');
    });

    /**
     * Un/Star Tasks List
     */
    Route::post('/star/{id}', function ($id) {
        $tasks_list = TaskList::findOrFail($id);
        $tasks_list->starred = !$tasks_list->starred;
        $tasks_list->save();
        return redirect()->back();
    });

    // - - - - - - TASKS - - - - - - //

    /**
     * Tasks by List - View
     */
    Route::get('/tasks-list/{id}', [TaskController::class, 'tasksByList']);

    /**
     * All Tasks - View
     */
    Route::resource('tasks', TaskController::class);

    /**
     * Add A New Task
     */
    Route::post('/add-task/{list_id}', function (Request $request, Auth $auth, $list_id) {
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
    });

    /**
     * Add A New Task with List
     */
    Route::post('/add-task', function (Request $request, Auth $auth) {
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
    });

    /**
     * Edit Task Name
     */
    Route::post('/edit/{id}', function (Request $request, $id) {
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
    });

    /**
     * Un/Finish Task
     */
    Route::post('/task/{id}', function ($id) {
        $task = Task::findOrFail($id);
        $task->completed = !$task->completed;
        $task->save();
        return redirect()->back();
    });

    /**
     * Delete Task
     */
    Route::delete('/task/{id}', function ($id) {
        Task::findOrFail($id)->delete();
        return redirect()->back();
    });
});

require __DIR__.'/auth.php';
