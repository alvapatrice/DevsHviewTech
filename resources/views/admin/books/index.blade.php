@extends('admin.dashboard')

@section('admin-sections')
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-12 imagelist-container">
                            @foreach($books as $book)
                                <div class=" row @if(isset($className)) {{ $className }} @endif col-md-3 padd-tb-15">
                                    <div>
                                        <a href="{{ route('admin.books.download', $book->id) }}">
                                            <img src="{{ $book->cover_image }}" alt="{{ $book->title }}"
                                                 data-name="{{ $book->book_path}}" class="img-responsive"/>
                                        </a>

                                        {{--<div class="caption text-center">--}}
                                        {{--{{ $image_path. $image->image_name }}--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        (function() {

        })();
    </script>
@stop
