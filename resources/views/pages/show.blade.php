@extends('layouts.app', ['title' => $page->title])

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="container-fluid">
                <strong><a href="{{ route('projects.index') }}">{{ trans('projects.plural') }}</a></strong> /
                <strong><a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a></strong> /
                <strong><a href="{{ route('projects.pages.index', $project) }}">{{ trans('pages.plural') }}</a></strong>
                /
                <strong>{{ $page->title }}</strong>

                @can('delete', $page)
                    <a class="btn btn-danger btn-sm pull-right" style="margin:0 5px;" data-toggle="modal"
                       href="#delete-{{ $page->id }}">{{ trans('pages.actions.delete') }}
                    </a>
                    <div class="modal fade" id="delete-{{ $page->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                    </button>
                                    <h4 class="modal-title text-danger">{{ trans('pages.delete.title') }}</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="lead text-danger">{{ trans('pages.delete.ask') }}</p>
                                </div>
                                <div class="modal-footer">
                                    {{ Form::open(['route' => ['projects.pages.destroy', $project, $page], 'method' => 'delete']) }}
                                    <a href="javascript:;" class="btn btn-default"
                                       data-dismiss="modal">{{ trans('pages.delete.buttons.cancel') }}</a>
                                    <button type="submit"
                                            class="btn btn-danger">{{ trans('pages.delete.buttons.confirm') }}</button>
                                    {{ Form::close() }}

                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                @endcan
                @can('update', $page)
                    <a href="{{ route('projects.pages.edit', [$project, $page]) }}"
                       class="btn btn-primary btn-sm pull-right"
                       style="margin:0 5px;">{{ trans('pages.actions.edit') }}
                    </a>
                @endcan
                @can('update', $project)
                    <a href="{{ route('projects.pages.create', $project) }}"
                       class="btn btn-success btn-sm pull-right"
                       style="margin:0 5px;">{{ trans('pages.actions.create') }}
                    </a>
                @endcan
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a
                                    href="{{ route('projects.show', $project) }}">{{ trans('projects.attributes.description') }}</a>
                        </li>
                        @foreach($project->pages as $pageItem)
                            <li class="{{ $pageItem->id == $page->id ? 'active' : '' }}">
                                <a href="{{ route('projects.pages.show', [$project, $pageItem]) }}">{{ $pageItem->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-9" style="min-height: 450px; border-left: 1px solid #d3e0e9;">
                    @markdown($page->body)
                </div>
            </div>
        </div>
    </div>
@endsection
