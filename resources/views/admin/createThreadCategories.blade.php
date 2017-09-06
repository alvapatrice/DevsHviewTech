@extends('admin.dashboard')

@section('admin-sections')
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    @include('layouts.partials.errors_form')

                    {!! Form::open(['route' => ['admin.threads.category.store'], 'method' => 'post']) !!}

                    <div class="form-group">
                        {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder'=>'Slug']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit( 'Create New Thread Category' , [ 'class' => 'btn btn-default']) !!}
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop
