@extends('layouts.app', ['title' => trans('projects.actions.create')])

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="container-fluid">
                <strong><a href="{{ route('projects.index') }}">{{ trans('projects.plural') }}</a></strong> /
                <strong>{{ trans('projects.actions.create') }}</strong>

            </div>
        </div>

        <div class="panel-body">
            {{ Form::open(['route' => 'projects.store']) }}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {{ Form::label('name', trans('projects.attributes.name')) }}
                {{ Form::text('name', null, ['class' => 'form-control input-lg']) }}
                <strong class="help-block">{{ $errors->first('name') }}</strong>
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
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        {{ Form::label('description', trans('projects.attributes.description')) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control input-lg']) }}
                        <strong class="help-block">{{ $errors->first('description') }}</strong>
                    </div>

                </div>
                <div class="tab-pane fade" id="preview">
                    <br>
                    <div class="description-result"></div>
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
                markdown: $('#description').val(),
                _token: '{{ csrf_token() }}',
            }, function (html) {
                $('.description-result').html(html);
            });
        }

    })
</script>
@endpush