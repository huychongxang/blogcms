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
                {!! Form::open(['method'=>'DELETE','route'=>['backend.blog.destroy',$post->id]]) !!}
                @if(checkUserPermissions(request(),"Blog@edit",$post))
                    <a href="{{route('backend.blog.edit',$post->id)}}"
                       class="btn btn-xs btn-default">
                        <i class="fa fa-edit"></i>
                    </a>
                @else
                    <a href="#"
                       class="btn btn-xs btn-default disabled">
                        <i class="fa fa-edit"></i>
                    </a>
                @endif
                @if(checkUserPermissions(request(),"Blog@destroy",$post))
                    <button onclick="return confirm('Bạn chắc chắn muốn xóa')" type="submit" class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                    </button>
                @else
                    <button type="button" onclick="return false;" class="btn btn-xs btn-danger disabled">
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
                {!! $post->publicationLabel() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
