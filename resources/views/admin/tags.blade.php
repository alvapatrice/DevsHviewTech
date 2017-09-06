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
                                    <th data-tablesaw-priority="4">Title</th>
                                    <th data-tablesaw-priority="4">Date Modified</th>
                                    <th data-tablesaw-priority="3">Actions</th>
                                </tr>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>
                                            {{ $tag->id }}
                                        </td>
                                        <td>{{ $tag->title }}</td>
                                        <td>{{ $tag->updated_at }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-primary" href="{{ route('admin.tags.edit', [$tag->slug]) }}">
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
                                {!! $tags->render() !!}
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