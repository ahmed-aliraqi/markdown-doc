@extends('layouts.app', ['title' => trans('projects.plural')])

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="container-fluid">
                <strong>{{ trans('projects.plural') }}</strong>
                @if(auth()->check())
                    <a href="{{ route('projects.create') }}"
                       class="btn btn-success btn-sm pull-right">{{ trans('projects.actions.create') }}</a>
                @endif
            </div>
        </div>

        <div class="panel-body">
            <ul class="nav nav nav-pills nav-stacked">
                @forelse($projects as $project)
                    <li><a href="{{ route('projects.show', $project) }}">{{ $project->name }} <span class="pull-right">{{ trans_choice('projects.pages_count', $project->pages_count) }}</span></a></li>
                @empty
                    <li><a href="{{ route('projects.create') }}">{{ trans('projects.empty') }} - {{ trans('projects.actions.create') }}</a></li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection