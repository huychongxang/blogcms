@if (session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif
@if(session('fail'))
    <div class="alert alert-danger">{{session('success')}}</div>
@endif
@if(session('trash-message'))
    <div class="alert alert-success">
        <?php list($message, $postId) = session('trash-message'); ?>
        {!! Form::open([
        "method"=>"POST",
        "route"=>['backend.blog.restore',$postId],
        ]) !!}
        {{$message}}
        <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-undo"></i>Undo</button>
        {!! Form::close() !!}
    </div>
@endif
