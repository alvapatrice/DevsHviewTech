@extends('admin.dashboard')

@section('admin-sections')
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">

                    @include('layouts.partials.errors_form')

                    {!! Form::model($user, ['route'=>[ 'admin.user.update', $user->id ], 'method'=>'put' ]) !!}

                    <div class="form-group">
                        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'User Name']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('first_name', null, ['class'=>'form-control', 'placeholder'=>'First Name']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'Last Name']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::select('type', $user_type , null, ['class'=>'form-control', 'placeholder'=>'User Type']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::select('status', $user_status,  null, ['class'=>'form-control', 'placeholder'=>'User Status']) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::submit( 'Edit', [ 'class' => 'btn btn-default']) !!}
                    </div>

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