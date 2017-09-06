<div class="modal fade" ng-controller="syntaxHighlightController" id="snippetModal" tabindex="-1" role="dialog" aria-labelledby="snippetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="snippetModalLabel">Paste Your Code Here</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => '#' ,'id' => 'snippetForm' ]) !!}
                {!! Form::select('langtype', ['html' => 'html', 'javascript' => 'javascript', 'php' => 'php', 'css' => 'css'], null, ['class' => 'form-control', 'id' => 'langtype']) !!}
                <hr>
                <code id="modal_textbox"></code>
                {!!Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="saveSnippet()">OK</button>
            </div>
        </div>
    </div>
</div>