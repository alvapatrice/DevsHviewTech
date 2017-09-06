@extends('layouts.app')
@section('navbar')
    @include('layouts.partials.navbar')
@stop
@section('optionsbar')
    @include('layouts.partials.optionsbar')
@stop
{{--@section('hero')--}}
    {{--@include('layouts.partials.hero')--}}
{{--@stop--}}
@section('content')
    <!-------------------------------------------- Articles Area Markup ------------------------------------------------------------->
    <div class="container-fluid body-width">
        <div class="row">
            @include('layouts.partials.articleslayout')
            {{--<div class="col-md-3">--}}
                {{-- place for ads and other right sidebar things--}}
            {{--</div>--}}
        </div>
    </div>
    <!-------------------------------------------- Articles Area Markup ends ------------------------------------------------------------->
@stop