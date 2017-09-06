@extends('admin.dashboard')

@section('admin-sections')
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    @include('layouts.partials.errors_form')

                    {!! Form::open(['action' => 'TagsController@store']) !!}

                    @include('layouts.partials.tag_form_partials',[ $button_name='Create new tag' ])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop