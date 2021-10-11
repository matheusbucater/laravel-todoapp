<?php

use App\Http\Controllers\TaskListController;
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TaskController;
use Illuminate\Http\Request;

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
    Route::post('/tasks-list', [TaskListController::class, 'addList']);

    /**
     * Edit Tasks List Title
     */
    Route::post('/edit-list/{id}', [TaskListController::class, 'renameList']);

    /**
     * Delete Tasks List
     */
    Route::delete('/tasks-list/{id}', [TaskListController::class, 'deleteList']);

    /**
     * Un/Star Tasks List
     */
    Route::post('/star-list/{id}', [TaskListController::class, 'starOrUnstarList']);


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
    Route::post('/add-task/{list_id}', [TaskController::class, 'addTask']);

    /**
     * Add A New Task with List
     */
    Route::post('/add-task', [TaskController::class, 'addTaskGivenAList']);

    /**
     * Edit Task Name
     */
    Route::post('/edit/{id}', [TaskController::class, 'renameTask']);

    /**
     * Un/Finish Task
     */
    Route::post('/task/{id}', [TaskController::class, 'FinishOrUnfinishTask']);

    /**
     * Delete Task
     */
    Route::delete('/task/{id}', [TaskController::class, 'deleteTask']);

    /**
     * Un/Star Task
     */
    Route::post('/star-task/{id}', [TaskController::class, 'starOrUnstarTask']);
});

require __DIR__.'/auth.php';
