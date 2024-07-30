<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="comments-table">
            <thead>
            <tr>
                <th>Commenter Name</th>
                <th>Content</th>
                <th>Post Id</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->commenter_name }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->post_id }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('comments.show', [$comment->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('comments.edit', [$comment->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $comments])
        </div>
    </div>
</div>
