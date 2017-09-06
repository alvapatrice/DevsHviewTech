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
                                    <th data-tablesaw-priority="3">Threads</th>
                                    <th data-tablesaw-priority="2">Date Modified</th>
                                    <th data-tablesaw-priority="3">Actions</th>

                                </tr>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $category->id }}
                                        </td>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->thread->count() }}</td>
                                        {{--                                    <td>{{ $category->tags }}</td>--}}
                                        <td>{{ $category->updated_at }}</td>
                                        <td>

                                            <div>

                                                <div class="btn-group btn-group-sm" role="group" aria-label="Post Options">
                                                        {!! Form::open([ 'route' => [ 'admin.threads.category.delete', $category->slug], 'method' => 'delete', 'class' =>'btn-group' ]) !!}
                                                        <a type="button" class="btn btn-primary" href="{{ route('admin.threads.category.edit', [$category->slug]) }}">
                                                            <i class="icon wb-pencil" aria-hidden="true"></i>
                                                        </a>

                                                        <button type="submit" class="btn btn-danger deletePost">
                                                            <i class="icon wb-trash" aria-hidden="true"></i>
                                                        </button>
                                                        {!! Form::close() !!}

                                                </div>
                                            </div>



                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div>
                                {!! $categories->render() !!}
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
@stop