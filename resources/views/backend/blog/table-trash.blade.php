<table class="table table-bordered">
    <thread>
        <tr>
            <td>Action</td>
            <td>Title</td>
            <td>Author</td>
            <td>Category</td>
            <td>Date</td>
        </tr>
    </thread>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td>
                {!! Form::open(['method'=>'POST','route'=>['backend.blog.restore',$post->id],'class'=>'my-form']) !!}
                @if(checkUserPermissions(request(),"Blog@restore",$post))
                    <button type="submit" title="Restore"
                            class="btn btn-xs btn-default">
                        <i class="fa fa-refresh"></i>
                    </button>
                @else
                    <button type="button" onclick="return false;" title="Restore"
                            class="btn btn-xs btn-default disabled">
                        <i class="fa fa-refresh"></i>
                    </button>
                @endif
                {!! Form::close() !!}
                {!! Form::open(['method'=>'DELETE','route'=>['backend.blog.force-destroy',$post->id],'class'=>'my-form']) !!}
                @if(checkUserPermissions(request(),"Blog@forceDestroy",$post))
                    <button title="Delete" onclick="return confirm('Bạn chắc chắn muốn xóa')" type="submit"
                            class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                    </button>
                @else
                    <button title="Delete" onclick="return false;" type="button"
                            class="btn btn-xs btn-danger disabled">
                        <i class="fa fa-times"></i>
                    </button>
                @endif
                {!! Form::close() !!}
            </td>
            <td>{{$post->title}}</td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->category->title}}</td>
            <td>
                <abbr
                    title="{{$post->dateFormatted(true)}}">{{$post->dateFormatted()}}</abbr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
