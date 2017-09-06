@extends('admin.dashboard')

@section('admin-sections')

    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-sm-12">
                    @include('layouts.partials.imagelist')
                </div>
            </div>
        </div>
    </div>
@stop
@section('modalbox')
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <img src="" alt="" id="modalImage" class="img-responsive"/>
            </div>
        </div>
    </div>
@stop