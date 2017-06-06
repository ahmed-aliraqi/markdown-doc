@extends('layouts.app', ['title' => $project->name])

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="container-fluid">
                <strong><a href="{{ route('projects.index') }}">{{ trans('projects.plural') }}</a></strong> /
                <strong>{{ $project->name }}</strong>
                @can('delete', $project)
                    <a class="btn btn-danger btn-sm pull-right" style="margin:0 5px;" data-toggle="modal"
                       href="#delete-{{ $project->id }}">{{ trans('projects.actions.delete') }}
                    </a>
                    <div class="modal fade" id="delete-{{ $project->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                    </button>
                                    <h4 class="modal-title text-danger">{{ trans('projects.delete.title') }}</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="lead text-danger">{{ trans('projects.delete.ask') }}</p>
                                </div>
                                <div class="modal-footer">
                                    {{ Form::open(['route' => ['projects.destroy', $project], 'method' => 'delete']) }}
                                    <a href="javascript:;" class="btn btn-default"
                                       data-dismiss="modal">{{ trans('projects.delete.buttons.cancel') }}</a>
                                    <button type="submit"
                                            class="btn btn-danger">{{ trans('projects.delete.buttons.confirm') }}</button>
                                    {{ Form::close() }}

                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                @endcan
                @can('update', $project)
                    <a href="{{ route('projects.edit', $project) }}"
                       class="btn btn-primary btn-sm pull-right"
                       style="margin:0 5px;">{{ trans('projects.actions.edit') }}
                    </a>

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
                        <li class="active"><a
                                    href="{{ route('projects.show', $project) }}">{{ trans('projects.attributes.description') }}</a>
                        </li>
                        @foreach($pages as $page)
                            <li><a href="{{ route('projects.pages.show', [$project, $page]) }}">{{ $page->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-9" style="min-height: 300px; border-left: 1px solid #d3e0e9;">
                    @markdown($project->description)
                </div>
            </div>
        </div>
    </div>
@endsection
