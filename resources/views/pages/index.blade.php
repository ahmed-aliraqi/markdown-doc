@extends('layouts.app', ['title' => trans('pages.plural')])

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="container-fluid">
                <strong><a href="{{ route('projects.index') }}">{{ trans('projects.plural') }}</a></strong> /
                <strong><a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a></strong> /
                <strong>{{ trans('pages.plural') }}</strong>

                <a href="{{ route('projects.pages.create', $project) }}"
                   class="btn btn-success btn-sm pull-right">{{ trans('pages.actions.create') }}</a>
            </div>
        </div>

        <div class="panel-body">
            <ul class="nav nav nav-pills nav-stacked">
                @forelse($pages as $page)
                    <li><a href="{{ route('projects.pages.show', [$project, $page]) }}">{{ $page->title }} </a></li>
                @empty
                    <li><a href="{{ route('projects.pages.create', $project) }}">{{ trans('pages.empty') }} - {{ trans('pages.actions.create') }}</a></li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection