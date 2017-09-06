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
                                    <th data-tablesaw-priority="persist">First Name</th>
                                    <th data-tablesaw-priority="3">Last Name</th>
                                    <th data-tablesaw-priority="2">Email</th>
                                    <th data-tablesaw-priority="1">Type</th>
                                    <th data-tablesaw-priority="1">Status</th>
                                    <th data-tablesaw-priority="2">Date Modified</th>
                                    <th data-tablesaw-priority="2">Actions</th>
                                </tr>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->type }}</td>
                                        <td>{{ $user->status }}</td>
                                        {{--                                    <td>{{ $user->tags }}</td>--}}
                                        <td>{{ $user->updated_at }}</td>

                                        <td>
                                            <div>
                                                {!! Form::open([ 'route' => [ 'admin.user.delete', $user->id],
                                                'method' =>
                                                'delete' ]) !!}
                                                <div class="btn-group" role="group" aria-label="Post Options">
                                                    <a type="button" class="btn btn-primary" href="{{ route('admin.user.edit', [$user->id]) }}">
                                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="pull-right">
                                {!! $users->render() !!}
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