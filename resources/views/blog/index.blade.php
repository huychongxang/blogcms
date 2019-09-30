@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if ( !$posts->count() )
                    <div class="alert alert-warning">
                        <p>Nothing found</p>
                    </div>
                @else
                    @include('includes.alert')

                    @foreach($posts as $key=>$post)
                        <article class="post-item">
                            @if ( $post->image )
                                <div class="post-item-image">
                                    <a href="{{route('blog.show',$post->slug)}}">
                                        <img src="{{$post->image_url}}" alt="">
                                    </a>
                                </div>
                            @endif
                            <div class="post-item-body">
                                <div class="padding-10">
                                    <h2><a href="{{route('blog.show',$post->slug)}}">{{$post->title}}</a></h2>
                                    <p>{{$post->excerpt}}</p>
                                </div>

                                <div class="post-meta padding-10 clearfix">
                                    <div class="pull-left">
                                        <ul class="post-meta-group">
                                            <li><i class="fa fa-user"></i><a
                                                    href="{{route('author',$post->user->slug)}}">{{$post->user->name}}</a>
                                            </li>
                                            <li><i class="fa fa-clock-o"></i>
                                                <time>{{$post->date}}</time>
                                            </li>
                                            <li><i class="fa fa-folder"></i><a
                                                    href="{{route('category',$post->category->slug)}}"> {{$post->category->title}}</a>
                                            </li>
                                            <li><i class="fa fa-tag"></i>{!! $post->tags_html !!}</li>
                                            <li><i class="fa fa-comments"></i><a
                                                    href="{{route('blog.show',$post->slug)}}#comment-label">{{$post->commentsNumber()}}</a></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{route('blog.show',$post->slug)}}">Continue Reading &raquo;</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @endif
                <nav>
                    {{$posts->appends(request()->only(['term','month','year']))->links()}}
                </nav>
            </div>
            @include('includes.sidebar')
        </div>
    </div>
@endsection
