@extends('admin.dashboard')

@section('admin-sections')
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    @include('layouts.partials.errors_form')

                    {!! Form::model($tag, ['route'=>[ 'admin.tags.update', $tag->slug ], 'method'=>'put' ]) !!}

                    @include('layouts.partials.tag_form_partials',[ $button_name='Edit Tag' ])

                    {!! Form::close() !!}
                </div>
                </div>
            </div>
        </div>
    </div>
@stop
