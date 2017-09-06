@extends('layouts.app')

@section('navbar')
    @include('layouts.partials.navbar')
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Contact Us</h3>
                <p>If you have any request about some web technology that you find interesting? Tell us about it and if there is enough request we will try to cover it. Whatever you want to say you can say it in the tip form below.</p>
                <p>Take time to ensure you have included a link (if required). There is nothing worse than reading an awesome tip only to find no link!</p>
                <p>Please Tell us if you have any problem with site or have any suggestion for improvement, we are active team of developers and our first goal is to give you great user experience.</p>
                <p>Your e-mail address will not be shared with any third party nor will it be used to send you any form of unsolicited mail.</p>

            </div>
            <div class="col-md-12">
                <!-- Form for creating new thread -->
                {!! Form::open([ 'route' => [ 'contact.post'] ]) !!}
                    <!-- Name Form Input -->
                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control', 'required'=>'required']) !!}
                </div>

                <!-- Email Form Input -->
                <div class="form-group">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', null, ['class'=>'form-control', 'required'=>'required']) !!}
                </div>

                <!-- Subject Form Input -->
                <div class="form-group">
                    {!! Form::label('subject', 'Subject:') !!}
                    {!! Form::text('subject', null, ['class'=>'form-control', 'required'=>'required']) !!}
                </div>

                <!-- Body Form Input -->
                <div class="form-group">
                    {!! Form::label('message', 'Message :') !!}
                    {!! Form::textarea('message', null, ['class'=>'form-control', 'id' => 'body']) !!}
                </div>
                <div class="recaptcha padd-tb-15">
                    {!! Recaptcha::render() !!}
                </div>
                <!-- Submit Button Create Thread -->
                <div class="form-group">
                    {!! Form::submit('Send', [ 'class' => 'btn btn-primary' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop