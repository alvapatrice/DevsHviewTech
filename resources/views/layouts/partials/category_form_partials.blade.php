<div class="form-group">
    {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
</div>

<div class="form-group">
    {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder'=>'Slug']) !!}
</div>

<div class="form-group">
    {!! Form::select('parent', ['default'=>'No parent','Select parent category'=>$categoryListForCombo], 'default',['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit( $button_name, [ 'class' => 'btn btn-default']) !!}
</div>
