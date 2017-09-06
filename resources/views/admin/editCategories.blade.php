@extends('admin.dashboard')

@section('admin-sections')
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    @include('layouts.partials.errors_form')

                    {!! Form::model($category,  ['route'=>[ 'admin.categories.update', $category->slug ], 'method'=>'put' ]) !!}

                    @include('layouts.partials.category_form_partials',[ $button_name='Update Category' ])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    {{--TODO : extract to partials --}}
@stop

@section('scripts')
    @include('layouts.partials.ckeditor')
@stop