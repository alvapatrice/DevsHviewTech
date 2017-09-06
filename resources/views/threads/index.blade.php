@extends('layouts.app')
@section('navbar')
    @include('layouts.partials.navbar')
@stop
@section('content')
    <div class="row header-top">
        <div class="container">
            <h1 class="pull-left">Forum</h1>
            <a class="btn btn-primary pull-right margin-top-10" href="{{ route('threads.new.create') }}">Create Thread</a>
        </div>
    </div>
    <div class="row">
        <div class="container margin-top-20">
            <div class="col-md-9">
                <div class="row">
                    <div class="thread-category-container">
                        <ul class="nav nav-pills forum-navigation">
                            <li class="@if(if_route(['home', 'threads.list'])) active @endif"><a href="{{ route('threads.list') }}">All</a></li>
                            @foreach($categories as $category)
                                <li class="@if(if_uri_pattern(['forum/'.$category->slug])) active @endif"><a href="{{ route('threads.list.single', [$category->slug]) }}">{{ $category->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="thread-list-container row">
                    <ul class="thread-list list-unstyled">
                        @if($threads->count() > 0)
                            @foreach($threads as $thread)
                                <li class="thread-item">
                                    <div class="col-md-1">
                                        <img class="img-responsive img-circle user-image"
                                             src="/images/logos/default-user.png"
                                             alt="Avatar of {{$thread->user->name}}"/>

                                    </div>
                                    <div class="col-md-11">
                                        <p class="user-info">
                                            <a class="user-name"
                                               href="{{ route('user.single', [ $thread->user->id]) }}">{{ $thread->user->name }}</a>
                                            <span class="user-comments">{{ $thread->user->comments->count() }}</span>
                                            <span class="reply-date">{{ $thread->updated_at->diffForHumans() }}</span>
                                        </p>

                                        <div class="thread-link">
                                            <a href="{{ route('threads.single.show', [ $thread->category->slug, $thread->slug]) }}">
                                                {{ $thread->title }}</a>
                                        </div>
                                        <div class="thread-tags">
                                            <span class="label label-{{ $thread->category->slug }}">{{ $thread->category->title }}</span>
                                        </div>
                                    </div>
                                    <h4 class="thread-replies">{{ $thread->comments->count() }}</span> replies</h4>
                                </li>
                            @endforeach
                            <div class="text-right pagination-sm"> {!! $threads->render() !!}</div>
                        @else
                            <li class="thread-item">
                                <div class="pull-left">
                                    <span>No Threads on this category yet.</span>
                                </div>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
@stop
