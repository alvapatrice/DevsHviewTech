@extends('layouts.app')
@section('navbar')
    @include('layouts.partials.navbar')
@stop
@section('content')
    <div class="header-top row">
        <div class="container">
            <div>
                <ul class="breadcrumb breadcrumb-lg">
                    <li>
                        <a href="{{ route('threads.list') }}">Forum</a>
                    </li>
                    <li>
                        <a href="{{ route('threads.list.single', [$thread->category->slug]) }}">{{ $thread->category->title}}</a>
                    </li>
                    <li>
                        {{$thread->title}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="forum-body">
        <div class="container">

            <div class="row">
                <div class="thread col-md-9">
                    <div class="thread-container row">

                        <div class="col-md-1">
                            <div class="user-avatar">
                                <img class="img-responsive img-circle user-image margin-right-10"
                                     src="/images/logos/default-user.png"
                                     alt="Photo of {{ $thread->user->name }}"/>
                            </div>
                        </div>
                        <!-- col-md-1 -->


                        <div class="col-md-11">
                            <p class="user-info">
                                <a class="user-name"
                                   href="{{ route('user.single', [ $thread->user->id]) }}">{{ $thread->user->name }}</a>
                                <span class="user-comments">{{ $thread->user->comments->count() }}</span>
                                <span class="thread-date" href="">{{ $thread->created_at->diffForHumans() }}</span>
                            </p>

                            <h1 class="thread-title">{{ $thread->title }}</h1>

                            <div class="thread-body">
                                <p>
                                    {!! $thread->body !!}
                                </p>
                            </div>

                            <div class="thread-options" ng-controller="AuthController">
                                @if(Auth::check())
                                    <button class="btn btn-success" id="showPostTextArea" focus-replyarea-directive>Post a reply</button>
                                @endif
                            </div>

                        </div>
                        <!-- col-md-11 ends -->
                    </div>
                    <!-- row inside col-md-9 ends -->

                    <h4 class="thread-replies">{{ $thread->comments->count() }} Replies</h4>

                </div>
                <!-- col-md-9 ends -->
            </div>
            <!-- row ends -->
            <!-- forum replies starts -->
            <div class="row">
                <div class="col-md-9">
                    <div class="replies">
                        @foreach($thread->comments as $comment)
                            <div class="row reply">
                                <div class="col-md-1">
                                    <img class="img-responsive img-circle user-image margin-right-10"
                                         src="/images/logos/default-user.png"
                                         alt="Photo of {{ $thread->user->name }}"/>
                                </div>
                                <div class="col-md-11" ng-controller="LikeController as like">
                                    <p class="user-info">
                                        <a class="user-name"
                                           @if($comment['user']->name != 'Guest' ) href="{{ route('user.single', [$comment['user']->id ]) }}" @endif>{{ $comment['user']->name }}</a>
                                            <span
                                                class="user-comments"> {{ $comment['user']->comments->count() }}</span>
                                            <span
                                                class="user-votes" ng-cloak> [[ (like.likes) ? like.likes : {{ $comment->likes }}
                                                ]]</span>
                                        <span class="reply-date">{{ $comment->updated_at->diffForHumans() }}</span>
                                        @if( Auth::check() )
                                            @if($comment['user']->id == Auth::user()->id)
                                                <span class="pull-right edit-comment clickable"
                                                      reply-id="{{ $comment->id }}" edit-comment-directive><i
                                                        class="fa fa-pencil"></i></span>
                                            @endif
                                            <span class="pull-right upvote-comment c7 lickable [[ like.className ]]"
                                                  ng-click="like.likeComment({{ $comment->id }})"><i
                                                    class="fa fa-heart-o"></i></span>
                                        @endif
                                    </p>

                                    <div class="reply-body">
                                        {!! $comment['body']
                                        !!}
                                    </div>
                                        <span class="reply-quote"><a href="#" class="replyQuote" reply-quote-directive>Reply with
                                                quote</a></span>
                                </div>
                            </div><!-- reply row ends -->
                        @endforeach
                    </div>

                        <div class="row">
                            <!-- Form for Saving new comment -->
                            {!! Form::open([ 'route' => [ 'comments.new.store' ], 'id' =>'replyForm' ]) !!}

                            <div class="reply-box">
                                <div class="form-group" ng-controller="ckEditorController" id="textareacontrainer">
                                    {!! Form::textarea('commentBody', null, ['class'=>'form-control', 'ckeditor' =>
                                    'editorOptionsLight', 'ng-model' => 'ckeditorModel', 'id' => 'body']) !!}
                                </div>
                                <!-- Submit Button Add Comment -->
                                <div class="form-group" ng-controller="AuthController">
                                    {!! Form::hidden('threadId', $thread->id) !!}
                                    @if(Auth::check())
                                    {!! Form::submit('Post Reply', [ 'class' => 'btn btn-success pull-right' ]) !!}
                                    @else
                                        <button type="button" class="btn btn-success pull-right" ng-click="promptAuthDialog($event)">Post Reply</button>
                                    @endif
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>

                </div>
                <div class="col-md-3">

                </div>
            </div>
            <!-- forum replies ends -->


        </div>
        <!-- container ends -->
    </div>
    <!-- forum-body-ends -->
    </div><!-- row ends -->
@stop


@section('scripts')
    @include('layouts.partials.ckeditor')
    @include('layouts.partials.aceui')
@stop

@section('modalbox')
    @include('layouts.partials.loginmodal')
    @include('layouts.partials.editcomment')
@stop
