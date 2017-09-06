@extends('layouts.app')
@section('navbar')
    @include('layouts.partials.navbar')
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Create A Thread</h2>
                <!-- Form for creating new thread -->
                {!! Form::open([ 'route' => [ 'threads.new.store'], 'id' => 'threadCreateForm' ]) !!}
                <!-- Title Form Input -->
                <div class="form-group">
                    {!! Form::label('title', 'Thread Subject:') !!}
                    {!! Form::text('title', null, ['class'=>'form-control']) !!}
                </div>

                <!-- Body Form Input -->
                <div class="form-group" ng-controller="ckEditorController" id="textareacontrainer">
                    {!! Form::label('body', 'Thread Description :') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'ckeditor' => 'editorOptionsLight', 'ng-model' => 'ckeditorModel', 'id' => 'body']) !!}
                </div>
                <div class="recaptcha padd-tb-15">
                    {!! Recaptcha::render() !!}
                </div>
                <!-- Category_id Form Input -->
                <div class="form-group">
                    {!! Form::label('category_id', 'Category :') !!}
                    {!! Form::select('category_id', $categoryList, null,['class'=>'form-control']) !!}
                </div>
                <!-- Submit Button Create Thread -->
                <div class="form-group">
                    {!! Form::submit('Create Thread', [ 'class' => 'btn btn-success' ]) !!}
                </div>
                @if(! Auth::check())
                    {!! Form::hidden('posttype', 'guest') !!}
                @endif
                {!! Form::close() !!}
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
@stop

@section('scripts')
    @include('layouts.partials.ckeditor')
@stop
