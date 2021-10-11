@extends('layouts.table')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('section_title')
    <h2 class="font-semibold bg-gray-500 text-xl text-white mb-3 pt-4 pb-4 pl-4">
        Starred Tasks Lists
    </h2>

@endsection
@if($tasks_lists->count() !== 0)
    @section('starred')
        <div class="container mt-4">
            @foreach($tasks_lists->chunk(3) as $chunk)
            <div class="row mx-auto mb-4">
                @foreach($chunk as $tasks_list)
                <div class="bg-white h-25 mx-auto overflow-hidden shadow-sm sm:rounded-lg ">
                    <div class="bg-gray-100 text-center pt-2 pb-2">
                        <a href="/tasks-list/{{ $tasks_list->id }}">{{ $tasks_list->title }}</a>
                    </div>
                    <div class="p-6  bg-white border-b border-gray-200 {!! $tasks_list->tasks->count() !== 0 ? '' : 'text-center' !!} align-text-middle">
                        <div class="col w-30 vertical-center">
                            @if($tasks_list->tasks->count() !== 0)
                                @if($tasks_list->tasks->where('starred', true)->count() !== 0)
                                    <div>
                                        <ul>
                                            @foreach($tasks_list->tasks->where('starred', true)->take(3) as $task)
                                                <li class="mb-2">
                                                    <span class="px-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full {!! $task->completed ? 'bg-green-100' : 'bg-red-100' !!}">
                                                        {!! $task->completed ? 'Finished' : 'Unfinished' !!}
                                                    </span>
                                                    {{$task->name}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <div>
                                        <ul>
                                            @foreach($tasks_list->tasks->take(3) as $task)
                                                <li class="mb-2">
                                                    <span class="px-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full {!! $task->completed ? 'bg-green-100' : 'bg-red-100' !!}">
                                                        {!! $task->compled ? 'Finished' : 'Unfinished' !!}
                                                    </span>
                                                    {{$task->name}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                    @if($tasks_list->tasks->count() > 3 | ($tasks_list->tasks->where('starred', true)->count() !== 3 & $tasks_list->tasks->where('starred', true)->count() !== 0))
                                        <div class="text-left">
                                            <a href="/tasks-list/{{ $tasks_list->id }}"> . . . see more</a>
                                        </div>
                                    @endif
                            @else
                                You don't have any tasks.
                                <br>
                                Add some <a href="/tasks-list/{{ $tasks_list->id }}">here</a>.
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    @endsection
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
        @foreach($tasks_lists_paginated as $tasks_list)
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
            {{ $tasks_lists_paginated->links() }}
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


