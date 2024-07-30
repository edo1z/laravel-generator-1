<!-- Commenter Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('commenter_name', 'Commenter Name:') !!}
    {!! Form::text('commenter_name', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Post Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('post_id', 'Post Id:') !!}
    {!! Form::number('post_id', null, ['class' => 'form-control', 'required']) !!}
</div>