@extends('layouts.app')
@section('navbar')
    @include('layouts.partials.navbar')
@stop
@section('content')
    <div class="row header-top">
        <div class="container">
            <h1 class="pull-left">User</h1>
        </div>
    </div>
    <div class="container">
        <div class="row margin-top-20">

            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-1">
                        <div class="user-avatar">
                            <img class="img-responsive img-circle user-image margin-right-10"
                                 src="/images/logos/default-user.png"
                                 alt="Photo of {{ $user->name }}"/>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <ul>
                            <li>{{ $user->name }}</li>
                            @if(Auth::user()->type == 0 || Auth::user()->id == $user->id)
                            <li>{{ $user->email }}</li>
                            @endif
                            <li>Total Comments : {{ $user->comments->count() }}</li>
                            <li>User Threads : {{ $user->thread->count() }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-3">

            </div>

        </div>
    </div>
@stop