<div class="col-md-4">
    <aside class="right-sidebar">
        <div class="search-widget">
            <form action="">
                <div class="input-group">
                    <input type="text" name="term" value="{{request('term')}}" class="form-control input-lg"
                           placeholder="Search for...">
                    <span class="input-group-btn">
                                <button class="btn btn-lg btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                    </span>
                </div>
            </form>
        </div>

        <div class="widget">
            <div class="widget-heading" id="category-heading">
                <h4>Categories</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach($categories as $key=>$category)
                        <li>
                            <a href="{{route('category',$category->slug)}}"><i
                                    class="fa fa-angle-right"></i>{{$category->title}}</a>
                            <span class="badge pull-right">{{$category->posts->count()}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading" id="popular-heading">
                <h4>Popular Posts</h4>
            </div>
            <div class="widget-body">
                <ul class="popular-posts">
                    @foreach($popularPosts as $post)
                        <li>
                            @if ($post->image_thumb_url)
                                <div class="post-image">
                                    <a href="{{route('blog.show',$post->slug)}}">
                                        <img src="{{$post->image_thumb_url}}"/>
                                    </a>
                                </div>
                            @endif
                            <div class="post-body">
                                <h6><a href="{{route('blog.show',$post->slug)}}">{{$post->title}}</a></h6>
                                <div class="post-meta">
                                    <span>{{$post->date}}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>

        <div class="widget" >
            <div class="widget-heading" id="tag-heading">
                <h4>Tags</h4>
            </div>
            <div class="widget-body">
                <ul class="tags">
                    @foreach($tags as $key=>$tag)
                        <li><a href="{{route('tag',$tag->slug)}}">{{$tag->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading" id="archives-heading">
                <h4>Archives</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach($archives as $archive)
                        <li>
                            <a href="{{route('blog',['month'=>$archive->month,'year'=>$archive->year])}}">{{$archive->month}} {{$archive->year}}</a>
                            <span class="badge pull-right">{{$archive->post_count}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </aside>
</div>
