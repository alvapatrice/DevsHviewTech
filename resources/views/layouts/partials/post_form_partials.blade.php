<div class="form-group">
    {!! Form::label('title', 'Post Title:') !!}
    {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter title here']) !!}
</div>
<div class="form-group">
    {!! Form::label('slug', 'Post Slug for URL: ') !!}
    {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder'=>'Enter your slug manually']) !!}
</div>
<div class="form-group">
    {!! Form::label('subtitle', 'Subtitle Post Heading (optional) :') !!}
    {!! Form::text('subtitle', null, ['class'=>'form-control', 'placeholder'=>'Enter Sub title here']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Post description:') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control','placeholder'=>'Enter title description','rows'=>5]) !!}
</div>
<div class="form-group" ng-controller="ckEditorController" id="textareacontrainer">
    {!! Form::label('body', 'Post Body:') !!}
    @if(isset($post))
    {!! Form::textarea('body', htmlspecialchars($post->body), ['class'=>'form-control', 'ckeditor' => 'editorOptions', 'ng-model' => 'ckeditorModel', 'id' => 'body']) !!}
    @else 
    {!! Form::textarea('body', null, ['class'=>'form-control', 'ckeditor' => 'editorOptions', 'ng-model' => 'ckeditorModel', 'id' => 'body']) !!}
    @endif
</div>
<div class="form-group">
    {!! Form::label('postCategory_id', 'Post Category:') !!}
    <select name="postCategory_id" id="postCategory_id" class="form-control">
        @foreach($categoryListForCombo as $id=>$title)
            @if(isset($post) && $post->category->title == $title)
            <option value="{{ $id }}" selected>{{ $title }}</option>
            @else
            <option value="{{ $id }}">{{ $title }}</option>
            @endif
        @endforeach
    </select>
</div>
<div class="form-group">
    {!! Form::label('tag_list[]', 'Tags:') !!}
    {{--{{ dd($post->tags[0]->title) }}--}}
    <select name="tag_list[]" id="tag_list[]" class="form-control" multiple>
        @foreach($tagListForCombo as $id=>$title)
            @if(isset($post))
                @if( in_array($id, $selected_tags))
                    <option value="{{$id}}" selected>{{ $title }}</option>
                @else
                    <option value="{{$id}}" >{{ $title }}</option>
                @endif
            @else
            <option value="{{$id}}">{{ $title }}</option>
            @endif
        @endforeach
    </select>
    {{--{!! Form::select('tag_list[]', $tagListForCombo, null,['class'=>'form-control','multiple']) !!}--}}
</div>
<!-- Poster Image Form Input -->
<div class="form-group">
    {!! Form::label('image', 'Poster Image :') !!}
    {!! Form::text('image', null, ['class'=>'form-control']) !!}
    <div class="padd-tb-15">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#imageListModal">Select Image</button>
    </div>
</div>
<div class="form-group">
    {!! Form::submit($button_name, ['class' => 'btn btn-default']) !!}
</div>
