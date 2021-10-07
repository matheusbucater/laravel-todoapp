@extends('layouts.table')
@section('title')
    {{ __('Dashboard') }}
@endsection
{{--@section('add_task')--}}
{{--    <div class="flex flex-col mb-4">--}}
{{--        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">--}}
{{--            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">--}}
{{--                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">--}}
{{--                    <table class="min-w-full">--}}
{{--                        <thead class="bg-gray-50">--}}
{{--                        <tr>--}}
{{--                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                New Tasks List--}}
{{--                            </th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <form action="/tasks-list" method="POST" class="form-inline">--}}
{{--                                {{ csrf_field() }}--}}

{{--                                <!-- Task Name -->--}}
{{--                                    <div class="form-group">--}}

{{--                                        <div class="col-sm-6">--}}
{{--                                            <input type="text" name="title" id="tasks-list-title" class="form-control mt-4 mb-4 pr-5" value="{{ old('task') }}">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <!-- Add Task Button -->--}}
{{--                                    <button type="submit" class="btn btn-success">--}}
{{--                                        <i class="bi bi-plus-lg mr-1"></i>--}}
{{--                                        Add List--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
@section('add_task')
    <h2 class="font-semibold text-xl text-gray-600 ml-1 mb-3 leading-tight">
        Starred Tasks Lists
    </h2>
@endsection
@if($tasks_lists->count() !== 0)
    @section('ths')
        <th>
            &nbsp;
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Title
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Tasks
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Finished Tasks
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Unfinished Tasks
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Show Tasks</span>
        </th>
    @endsection
    @section('content')
        @foreach($tasks_lists as $tasks_list)
            <tr>
                <td>&nbsp;</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <a href="/tasks-list/{{ $tasks_list->id }}">{{ $tasks_list->title }}</a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $tasks_list->tasks->count() }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $tasks_list->tasks->where('completed', true)->count() }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $tasks_list->tasks->where('completed', false)->count() }}
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
            You don't have any starred lists.
            <br>
            Add some <a href="/tasks-lists">here</a>.
        </h3>
    @endsection
@endif

