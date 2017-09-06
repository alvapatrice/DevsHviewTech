@extends('layouts.app')
@section('navbar')
    @include('layouts.partials.navbar')
@stop
@section('optionsbar')
    @include('layouts.partials.optionsbar')
@stop
@section('content')
    <div class="container-fluid body-width">
        <div class="row">
            <div class="col-md-12">
                @if($articles->count() > 0)
                <h4 class="category-list-heading">Showing Articles for {{ $articles[0]->category->title }}</h4>
                @else
                <h4 class="category-list-heading">No Articles Found In This Category</h4>
                @endif

            </div>
            @include('layouts.partials.articleslayout')
        </div>
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-success" href="{{ route('articles.list') }}">Explore More</a>
            </div>
        </div>
    </div>
@stop
