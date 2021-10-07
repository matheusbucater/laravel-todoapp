@extends('layouts.table')
@section('title')
    <table>
        <td>

            {{ __('Tasks List') . ' - ' . \App\Models\TaskList::findOrFail($list_id)->title}}
        </td>
        <td>
            <form action="/edit-list/{{ $list_id }}" method="POST" class="form-inline ml-3">
                {{ csrf_field() }}
                <input type="text" name="new_title" id="new-tasks-list-title" class="form-control mr-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-pen-fill mr-1"></i>
                    Edit Title
                </button>
            </form>
        </td>
        <td>
            <form action="/tasks-list/{{ $list_id }}" name="red_button" method="POST" class="ml-3">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash-fill mr-1"></i>
                    Delete
                </button>
            </form>
        </td>
    </table>
@endsection
@section('add_task')
    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                New Task
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <form action="/add-task/{{ $list_id }}" method="POST" class="form-inline">
                                {{ csrf_field() }}

                                <!-- Task Name -->
                                    <div class="form-group">

                                        <div class="col-sm-6">
                                            <input type="text" name="name" id="task-name" class="form-control mt-4 mb-4 pr-5" value="{{ old('task') }}">
                                        </div>
                                    </div>

                                    <!-- Add Task Button -->
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-plus-lg mr-1"></i>
                                        Add Task
                                    </button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@if($tasks->count() !== 0)
    @section('ths')
        <th>
            &nbsp;
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Status
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Name
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Edit Task Name</span>
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Un/Finish</span>
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Delete</span>
        </th>
    @endsection
    @section('content')
        @foreach($tasks as $task)
            <tr>
                <th>
                    &nbsp;
                </th>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($task->completed)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Finished</span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-green-800">Unfinished</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $task->name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form action="/edit/{{ $task->id }}" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <input type="text" name="new_name" id="new-task-name" class="form-control mr-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-pen-fill mr-1"></i>
                            Edit Name
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form action="/task/{{ $task->id }}" name="yellow_button" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-warning">
                            {!! $task->completed ? '<i class="bi bi-x-lg mr-1"></i>' : '<i class="bi bi-check-lg mr-1"></i>' !!}
                            {{ $task->completed ? 'Unfinish' : 'Finish' }}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form action="/task/{{ $task->id }}" name="red_button" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash-fill mr-1"></i>
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    @endsection
    @section('pagination')
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    @endsection
@else
@section('content')
    <h3 class="font-semibold text-xl text-gray-500 ml-3 mt-3 mb-3 leading-tight">
        You don't have any tasks in this list.
        <br>
        Try adding one above.
    </h3>
@endsection
@endif
