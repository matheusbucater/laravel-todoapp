@extends('layouts.table')
@section('page_title', 'Tasks Lists')
@section('title')
    {{ __('Tasks Lists') }}
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
                                New Tasks List
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <form action="/tasks-list" method="POST" class="form-inline">
                                {{ csrf_field() }}

                                <!-- Task Name -->
                                    <div class="form-group">

                                        <div class="col-sm-6">
                                            <input type="text" name="title" id="tasks-list-title" class="form-control mt-4 mb-4 pr-5" value="{{ old('task') }}">
                                        </div>
                                    </div>

                                    <!-- Add Task Button -->
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-plus-lg mr-1"></i>
                                        Add List
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
@if($tasks_lists->count() !== 0)
    @section('ths')
        <th>
            &nbsp;
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Title
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Edit Tasks List Title</span>
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Delete</span>
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Show Tasks</span>
        </th>
    @endsection
    @section('content')
        @foreach($tasks_lists as $tasks_list)
            <tr>
                <td>
                    <form action="/star-list/{{ $tasks_list->id }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="ml-3">
                            {!! $tasks_list->starred ? '<i class="bi bi-star-fill"></i> ' : '<i class="bi bi-star"></i>' !!}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <a href="/tasks-list/{{ $tasks_list->id }}">{{ $tasks_list->title }}</a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form action="/edit-list/{{ $tasks_list->id }}" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <input type="text" name="new_title" id="new-tasks-list-title" class="form-control mr-2 mt-2">
                        <button type="submit" class="btn btn-primary mt-2">
                            <i class="bi bi-pen-fill mr-1"></i>
                            Edit Title
                        </button>
                    </form>

                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form action="/tasks-list/{{ $tasks_list->id }}" name="red_button" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash-fill mr-1"></i>
                            Delete
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="/tasks-list/{{ $tasks_list->id }}" class="text-indigo-600 hover:text-indigo-900">Show tasks</a>
                </td>
            </tr>
        @endforeach
    @endsection
    @section('pagination')
        <div class="mt-4">
            {{ $tasks_lists->links() }}
        </div>
    @endsection
@else
    @section('content')
        <h3 class="font-semibold text-xl text-gray-500 ml-3 mt-3 mb-3 leading-tight">
            You don't have any tasks lists.
            <br>
            Try adding one above.
        </h3>
    @endsection
@endif


