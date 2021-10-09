@extends('layouts.table')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('add_task')
    <h2 class="font-semibold text-xl text-gray-600 ml-1 mb-3 leading-tight">
        Starred Tasks Lists
    </h2>
@endsection
@if($tasks_lists->count() !== 0)
    @section('starred')
        <div class="container mt-4">
            @foreach($tasks_lists->chunk(3) as $chunk)
            <div class="row mx-auto mb-4">
                @foreach($chunk as $tasks_list)
                <div class="bg-white w-25 h-25 mx-auto overflow-hidden shadow-sm sm:rounded-lg ">
                    <div class="bg-gray-100 text-center pt-2 pb-2">
                        <a href="/tasks-list/{{ $tasks_list->id }}">{{ $tasks_list->title }}</a>
                    </div>
                    <div class="p-6  bg-white border-b border-gray-200 {!! $tasks_list->tasks->count() !== 0 ? '' : 'text-center' !!} align-text-middle">
                        <div class="col vertical-center">
                            @if($tasks_list->tasks->count() !== 0)
                                <div>
                                    <ul>
                                        @foreach($tasks_list->tasks as $task)
                                            <li class="mb-2">
                                                <span class="px-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full {!! $task->completed ? 'bg-green-100' : 'bg-red-100' !!}">
                                                    {!! $task->compled ? 'Finished' : 'Unfinished' !!}
                                                </span>
                                                {{$task->name}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                    You don't any tasks.
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
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

