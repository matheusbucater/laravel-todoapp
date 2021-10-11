<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskListController extends Controller
{
    public function index(Auth $auth) {
        $tasks_lists = $auth::user()->tasks_lists()->paginate(10);
        return view('tasks_lists.index', compact('tasks_lists'));
    }

    public function dashboard(Auth $auth) {
        $tasks_lists = $auth::user()->tasks_lists->where('starred', true);
        $tasks_lists_paginated = $auth::user()->tasks_lists()->where('starred', true)->paginate(10);
        return view('tasks_lists.dashboard', compact('tasks_lists', 'tasks_lists_paginated'));
    }

    public function addList (Request $request, Auth $auth): \Illuminate\Http\RedirectResponse
    {
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
    }

    public function renameList (Request $request, $id): \Illuminate\Http\RedirectResponse
    {
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
    }

    public function deleteList ($id) {
        TaskList::findOrFail($id)->delete();
        return redirect('/tasks-lists');
    }

    public function starOrUnstarList ($id): \Illuminate\Http\RedirectResponse
    {
        $tasks_list = TaskList::findOrFail($id);
        $tasks_list->starred = !$tasks_list->starred;
        $tasks_list->save();
        return redirect()->back();
    }


}
