<div class="modal fade" id="imageListModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="clearfix modal-imagelist" id="modalImageList" modal-imagelist-directive>
                    @include('layouts.partials.imagelist', ['className' => 'plr-15'])
                </div>
            </div>
            <div class="modal-footer">
                <form class="form-inline">
                    <!-- Imageurlpath Form Input -->
                    <div class="form-group">
                        {!! Form::label('imageurlpath', 'Image Url Path :') !!}
                        {!! Form::text('imageurlpath', null, ['class'=>'form-control textbox-400']) !!}
                    </div>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="imageSelectBtn" image-select-directive>Select</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>