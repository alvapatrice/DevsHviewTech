@extends('admin.dashboard')

@section('admin-sections')
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    {{--@include('layouts.partials.errors_form')--}}

                    {!! Form::model($thread, ['route'=>[ 'admin.threads.update', $thread->id ], 'method'=>'put' ]) !!}

                    <div class="form-group">
                        {!! Form::label('title', 'Title: ') !!}
                        {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('slug', 'Slug: ') !!}
                        {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                    </div>

                    <div class="form-group" ng-controller="ckEditorController">
                        {!! Form::label('body', 'Body: ') !!}
                        {!! Form::textarea('body', null, ['class'=>'form-control', 'ckeditor' => 'editorOptions', 'ng-model' => 'ckeditorModel', 'id' => 'body']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('category_id', 'Thread Category ID: ') !!}
                        {!! Form::text('category_id', null, ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('user_id', 'User ID: ') !!}
                        {!! Form::text('user_id', null, ['class'=>'form-control', 'placeholder'=>'Enter Title', 'disabled' => 'disabled']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('article_id', 'Article ID: ') !!}
                        {!! Form::text('article_id', null, ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Save Edit', [ 'class' => 'btn btn-default']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')
    @include('layouts.partials.ckeditor')
@stop