@extends('admin.dashboard')

@section('admin-sections')
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-body">
                            <table class="tablesaw table-striped" data-tablesaw-mode="swipe" data-tablesaw-mode-switch data-tablesaw-minimap >
                                <thead>
                                <tr>
                                    <th data-tablesaw-priority="1">Title</th>
                                    <th data-tablesaw-priority="3">Categories</th>
                                    <th data-tablesaw-priority="persist">Tags</th>
                                    <th data-tablesaw-priority="3">Published</th>
                                    <th data-tablesaw-priority="3">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>
                                            {{ $post->title }}
                                        </td>
                                        <td>{{ $post->category->title }}</td>
                                        <td style="width : 20%">
                                            @foreach($post->tags as $tag )
                                                <span class="label label-default margin-bottom-5 inline-block">{{ $tag->title}}</span>
                                            @endforeach
                                        </td>
                                        {{--                                    <td>{{ $post->tags }}</td>--}}
                                        @if($post->published_at <= Carbon\Carbon::now())
                                            <td>{{ $post->published_at->toFormattedDateString() }}</td>
                                        @else
                                            <td>
                                                <!-- Form for Publishing Articles -->
                                                {!! Form::open([ 'route' => [ 'admin.posts.publish' ] ]) !!}
                                                {!! Form::hidden('post_id', $post->id) !!}
                                                {!! Form::hidden('publish_date', date('Y-m-d')) !!}
                                                    <!-- Submit Button Publish -->
                                                <div>
                                                    {!! Form::submit('Publish', [ 'class' => 'btn btn-primary' ]) !!}
                                                </div>
                                                {!! Form::close() !!}
                                            </td>
                                        @endif
                                        <td>
                                            <div clas="btn-toolbar">

                                                <div class="btn-group" role="group">

                                                    <div class="btn-group" role="group">
                                                        <a class="btn btn-icon btn-primary" href="{{ route('admin.posts.edit', [$post->slug]) }}">
                                                            <i class="icon wb-pencil" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="btn btn-icon btn-success" target="_blank" href="{{ route('articles.single', [$post->slug]) }}">
                                                            <i class="icon wb-eye" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                        {!! Form::open([ 'route' => [ 'admin.posts.delete',  $post->slug], 'method' => 'delete', 'class' => 'btn-group' ]) !!}
                                                        <button type="submit" class="btn btn-icon btn-danger deletePost">
                                                            <i class="icon wb-trash" aria-hidden="true"></i>
                                                        </button>
                                                        {!! Form::close() !!}
                                                        {!! Form::open([ 'route' => [ 'admin.posts.unpublish' ], 'class' => 'btn-group' ]) !!}
                                                        {!! Form::hidden('post_id', $post->id) !!}
                                                            <!-- Submit Button Publish -->
                                                        <button type="submit" class="btn btn-icon btn-warning">
                                                            <i class="icon wb-eye-close" aria-hidden="true"></i>
                                                        </button>
                                                        {!! Form::close() !!}
                                                    </div>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pull-right">
                                {!! $posts->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @include('layouts.partials.ckeditor')
    <script>
        $('.deletePost').on('click', function(e) {
            var answer = confirm('Are You sure want to delete');
            if(!answer)
            {
                e.preventDefault();
            }
        });
    </script>
@stop