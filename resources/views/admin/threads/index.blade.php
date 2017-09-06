@extends('admin.dashboard')

@section('admin-sections')

    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-body">
                            <table class="tablesaw table-striped" data-tablesaw-mode="swipe" data-tablesaw-mode-switch data-tablesaw-minimap>
                                <tr>
                                    <th data-tablesaw-priority="1">Id</th>
                                    <th data-tablesaw-priority="persist">Title</th>
                                    <th data-tablesaw-priority="1">Category ID</th>
                                    <th data-tablesaw-priority="1">User ID</th>
                                    <th data-tablesaw-priority="1">Article ID</th>
                                    <th data-tablesaw-priority="2">Date Modified</th>
                                    <th data-tablesaw-priority="2">Actions</th>
                                </tr>
                                @foreach($threads as $thread)
                                    <tr>
                                        <td>
                                            {{ $thread->id }}
                                        </td>
                                        <td>{{ $thread->title }}</td>
                                        <td>{{ $thread->category_id }}</td>
                                        <td>{{ $thread->user_id }}</td>
                                        <td>{{ $thread->article_id }}</td>
                                        <td>{{ $thread->updated_at }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-primary btn-icon" href="{{ route('admin.threads.edit', [$thread->id]) }}">
                                                    <i class="icon wb-pencil" aria-hidden="true"></i>
                                                </a>
                                                <div class="btn-group">
                                                    {!! Form::open([ 'route' => [ 'admin.threads.delete',  $thread->id], 'method' => 'delete', 'class' => 'btn-group' ]) !!}
                                                    <button type="submit" class="btn btn-icon btn-danger deletePost">
                                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                                    </button>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="pull-right">
                                {!! $threads->render() !!}
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