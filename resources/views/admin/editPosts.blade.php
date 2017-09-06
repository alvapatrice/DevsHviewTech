@extends('admin.dashboard')

@section('admin-sections')
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    @include('layouts.partials.errors_form')

                    {!! Form::model($post, ['route'=>[ 'admin.posts.update', $post->slug ], 'method'=>'put' ]) !!}

                    @include('layouts.partials.post_form_partials',[ $button_name='Update Post' ])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @include('layouts.partials.ckeditor')
@stop

@section('modalbox')
    @include('layouts.partials.imagemodal')
@stop