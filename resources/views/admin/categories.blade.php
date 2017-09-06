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
                                    <th data-tablesaw-priority="3">Parent ID</th>
                                    <th data-tablesaw-priority="2">Articles</th>
                                    <th data-tablesaw-priority="2">Date Modified</th>
                                    <th data-tablesaw-priority="2">Actions</th>
                                </tr>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $category->id }}

                                        </td>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->parent_id }}</td>
                                        <td>{{ $category->post->count() }}</td>
                                        {{--                                    <td>{{ $category->tags }}</td>--}}
                                        <td>{{ $category->updated_at }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-primary" href="{{ route('admin.categories.edit', [$category->slug]) }}">
                                                    <i class="icon wb-pencil" aria-hidden="true"></i>
                                                </a>
                                                <a class="btn btn-danger">
                                                    <i class="icon wb-trash" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="pull-right">
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