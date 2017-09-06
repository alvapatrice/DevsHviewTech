<div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <!-- Form for Save Edited Comment -->
                {!! Form::open([ 'route' => [ 'comment.update' ] ]) !!}
                <div class="modal-heading padding-left-20 padding-top-15">
                    <h4>Edit Your Comment</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" ng-controller="ckEditorReplyController" id="textareacontrainer">
                        {!! Form::textarea('editedComment', null, ['class'=>'form-control', 'ckeditor' =>
                        'editorOptionsLight', 'ng-model' => 'ckeditorModel', 'id' => 'editedComment']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Submit Button Update -->
                    <div class="form-group">
                        {!! Form::hidden('comment_id', null, ['id' => 'comment_id']) !!}
                        {!! Form::submit('Update', [ 'class' => 'btn btn-default', 'id' => 'commentUpdateBtn' ]) !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                {!! Form::close() !!}
        </div>
    </div>
</div>