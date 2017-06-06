@extends('layouts.app', ['title' => $page->title])

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="container-fluid">
                <strong><a href="{{ route('projects.index') }}">{{ trans('projects.plural') }}</a></strong> /
                <strong><a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a></strong> /
                <strong><a href="{{ route('projects.pages.index', $project) }}">{{ trans('pages.plural') }}</a></strong> /
                <strong><a href="{{ route('projects.pages.show', [$project, $page]) }}">{{ $page->title }}</a></strong> /
                <strong>{{ trans('pages.actions.edit') }}</strong>

            </div>
        </div>

        <div class="panel-body">
            {{ Form::model($page, ['route' => ['projects.pages.update', $project, $page], 'method' => 'put']) }}
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {{ Form::label('title', trans('pages.attributes.title')) }}
                {{ Form::text('title', null, ['class' => 'form-control input-lg']) }}
                <strong class="help-block">{{ $errors->first('title') }}</strong>
            </div>


            <!-- TAB NAVIGATION -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#markdown" role="tab" data-toggle="tab">Markdown</a></li>
                <li><a href="#preview" role="tab" data-toggle="tab">Preview</a></li>
            </ul>

            <!-- TAB CONTENT -->
            <div class="tab-content">
                <div class="active tab-pane fade in" id="markdown">
                    <br>
                    <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                        {{ Form::label('body', trans('pages.attributes.body')) }}
                        {{ Form::textarea('body', null, ['class' => 'form-control input-lg']) }}
                        <strong class="help-block">{{ $errors->first('body') }}</strong>
                    </div>

                </div>
                <div class="tab-pane fade" id="preview">
                    <br>
                    <div class="body-result"></div>
                    <br>
                </div>

            </div>


            <button class="btn btn-primary" type="submit">{{ trans('global.save') }}</button>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $('a[data-toggle="tab"]').on('show.bs.tab', function () {
        if ($(this).attr('href') == '#preview'){
            $.post('{{ route('markdown') }}', {
                markdown: $('#body').val(),
                _token: '{{ csrf_token() }}',
            }, function (html) {
                $('.body-result').html(html);
            });
        }

    })
</script>
@endpush