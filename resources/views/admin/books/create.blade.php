@extends('admin.dashboard')

@section('admin-sections')
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <div class="row">

                        <div class="col-md-6">
                            <!-- Form for Saving Images -->
                            {!! Form::open([ 'route' => [ 'admin.books.store' ], 'files' => true, 'enctype' => 'multipart/form-data', ]) !!}

                            <!-- Title Form Input -->
                            <div class="form-group">
                                {!! Form::label('title', 'Title :') !!}
                                {!! Form::text('title', null, ['class'=>'form-control']) !!}
                            </div>

                            <!-- Slug Form Input -->
                            <div class="form-group">
                                {!! Form::label('slug', 'Slug :') !!}
                                {!! Form::text('slug', null, ['class'=>'form-control']) !!}
                            </div>

                            <!-- Category_id Form Input -->
                            <div class="form-group">
                                {!! Form::label('category_id', 'Category:') !!}
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($categories as $id=>$title)
                                            <option value="{{ $id }}">{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>

                                <!-- File Input for PDF -->
                            <div class="form-group">
                                {!! Form::label('pdf', 'Select Book : ') !!}
                                {!! Form::file('pdf', ['class' => 'custom-file-input' ]) !!}
                            </div>

                            <!-- Cover Image Form Input -->
                            <div class="form-group">
                                {!! Form::label('cover_image', 'Cover Image Path: ') !!}
                                {!! Form::text('cover_image', null, ['class' => 'form-control' ]) !!}
                            </div>

                            <!-- Description Form Input -->
                            <div class="form-group">
                                {!! Form::label('description', 'Description :') !!}
                                {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
                            </div>

                            <!-- Category_id Form Input -->
                            <div class="form-group">
                                {!! Form::label('book_type', 'Book Type:') !!}
                               {!! Form::select('book_type', ['0' => 'Free', '1' => 'Paid'], null , ['class' => 'form-control']) !!}
                            </div>

                            <!-- Submit Button Upload Image -->
                            <div class="form-group">
                                {!! Form::submit('Upload Book', [ 'class' => 'btn btn-primary' ]) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::open([ 'route' => [ 'admin.media.store' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'book-image' ]) !!}
                                <div>
                                    <h3>Cover Image</h3>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script src="/js/bower_components/dropzone/dist/min/dropzone.min.js"></script>
    <script>
        (function() {
            Dropzone.options.bookImage = {
                paramName: "image", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                dictDefaultMessage : "Drop File here or Click to upload Image",
                thumbnailWidth : "300",
                thumbnailHeight : "300",
                accept: function(file, done) {
                    done();
                },
                success: function(message, file) {
                    var success_message = $('.dz-success-mark'),
                        cover_image_input = $('#cover_image'),
                        message = $('<p></p>', {
                        'text' : 'Image Uploaded Successfully'
                    })
                    message.appendTo(success_message);
                    success_message.addClass('show');

                    console.log(file);
                    cover_image_input.val(JSON.parse(file).original_path);
                },
                complete : function(data) {
                    if(data.status != "success")
                    {
                        var error_message = $('.dz-error-mark'),
                            message = $('<p></p>', {
                                'text' : 'Image Upload Failed'
                            })
                        message.appendTo(error_message);
                        error_message.addClass('show');
                        return;
                    }
                }
            };
        })();
    </script>
@stop
