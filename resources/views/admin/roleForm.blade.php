@extends('layouts.app')

@section('content')
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-10">
                    @include('layouts.partials.errors_form')

                    {!! Form::open(['action' => 'PostsController@store']) !!}
                    {!! Form::close() !!}

                </div>
                @include('layouts.partials.snippet_modal')
                </div>
                <div class="col-sm-2">
                    <h1>Post List</h1>
                    @include('layouts.partials.retreive_result_list',['routeName'=>'admin.posts.edit', 'results'=>$post_list ])
                </div>
            </div>
        </div>
    </div>
@stop