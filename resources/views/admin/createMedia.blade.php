@extends('admin.dashboard')

@section('admin-sections')
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <div class="row">

                        <div class="col-md-4">
                            <!-- Form for Saving Images -->
                            {!! Form::open([ 'route' => [ 'admin.media.store' ], 'files' => true, 'enctype' => 'multipart/form-data' ]) !!}

                                <!-- File Input for Image -->
                            <div class="form-group">
                                {!! Form::label('images[]', 'Choose File : ') !!}
                                {!! Form::file('images[]', ['class' => 'custom-file-input', 'multiple' => 'multiple', 'file-input-directive' => '' ]) !!}
                            </div>

                            <!-- Submit Button Upload Image -->
                            <div class="form-group">
                                {!! Form::submit('Upload Image', [ 'class' => 'btn btn-default' ]) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-4">
                            <ul class="list-group" id="filesInfo">
                                <li class="list-group-item"><strong>Selected Files Information</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

