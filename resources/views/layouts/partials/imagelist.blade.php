   <div class="row">
    <div class="col-md-9 col-xs-6 imagelist-container">
        @foreach($images as $image)
            <div class=" row @if(isset($className)) {{ $className }} @endif col-md-3 padd-tb-15">
                <div class="col-md-12">
                    <a href="{{ $thumb_path . $image->image_name }}" class="downloaded-image" downloaded-image-directive>
                    <img src="{{ $thumb_path . $image->thumb_name }}" alt="{{ $image->image_original_name }}"
                         data-name="{{ $image_path. $image->image_name }}" class="img-responsive"/>
                    </a>

                    {{--<div class="caption text-center">--}}
                        {{--{{ $image_path. $image->image_name }}--}}
                    {{--</div>--}}
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-md-3 col-xs-6 image_details" id="image_details">
            <div>
                <div>
                    <img id="image_details_img" class="img-responsive image-border-shadow" img-details-directive>
                </div>
                <!-- Form for Editing Image Info -->
                {!! Form::open([ 'route' => [ 'admin.media.update' ], 'method' => 'put' ]) !!}
                        <!-- Image_name Form Input -->
                        <div class="form-group">
                            {!! Form::label('image_name', 'Image Name :') !!}
                            {!! Form::text('image_name', null, ['class'=>'form-control']) !!}
                        </div>
                        <!-- Thumb Name Form Input -->
                        <div class="form-group">
                            {!! Form::label('thumb_name', 'Thumb Name :') !!}
                            {!! Form::text('thumb_name', null, ['class'=>'form-control']) !!}
                        </div>
                            {!! Form::hidden('image_name_original', null, ['id' => 'image_name_original']) !!}
                            {!! Form::hidden('thumb_name_original', null, ['id' => 'thumb_name_original']) !!}
                        <!-- Submit Button Update -->
                        <div class="form-group">
                            {!! Form::submit('Update', [ 'class' => 'btn btn-danger' ]) !!}
                        </div>
                {!! Form::close() !!}
            </div>
    </div>
</div>
