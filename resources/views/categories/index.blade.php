@extends('layouts.app')
@section('navbar')
    @include('layouts.partials.navbar')
@stop
@section('optionsbar')
    @include('layouts.partials.optionsbar')
@stop
@section('content')
    <div class="container">
        <div class="row padd-tb-15">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.partials.category-partials')
            </div>
        </div>
    </div>
@stop
