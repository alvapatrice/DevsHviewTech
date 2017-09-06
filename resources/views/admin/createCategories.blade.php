@extends('admin.dashboard')

@section('admin-sections')

    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    @include('layouts.partials.errors_form')

                    {!! Form::open(['action' => 'CategoriesController@store', 'method' => 'post']) !!}

                    @include('layouts.partials.category_form_partials',[ $button_name='Create new category' ])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
