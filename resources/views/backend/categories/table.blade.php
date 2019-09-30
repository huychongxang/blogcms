<table class="table table-bordered">
    <thread>
        <tr>
            <td width="80">Action</td>
            <td>Category Name</td>
            <td width="120">Post Count</td>
        </tr>
    </thread>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>
                {!! Form::open(['method'=>'DELETE','route'=>['backend.categories.destroy',$category->id]]) !!}
                <a href="{{route('backend.categories.edit',$category->id)}}"
                   class="btn btn-xs btn-default">
                    <i class="fa fa-edit"></i>
                </a>
                @if($category->id == config('cms.default_category_id'))
                    <button onclick="return false" type="submit" class="btn btn-xs btn-danger disabled">
                        <i class="fa fa-times"></i>
                    </button>
                @else
                    <button onclick="return confirm('Bạn chắc chắn muốn xóa')" type="submit"
                            class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                    </button>
                @endif
                {!! Form::close() !!}
            </td>
            <td>{{$category->title}}</td>
            <td>{{$category->posts->count()}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
