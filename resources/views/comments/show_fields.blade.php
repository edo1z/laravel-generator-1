<!-- Commenter Name Field -->
<div class="col-sm-12">
    {!! Form::label('commenter_name', 'Commenter Name:') !!}
    <p>{{ $comment->commenter_name }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $comment->content }}</p>
</div>

<!-- Post Id Field -->
<div class="col-sm-12">
    {!! Form::label('post_id', 'Post Id:') !!}
    <p>{{ $comment->post_id }}</p>
</div>

