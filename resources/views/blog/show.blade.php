@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post-item post-detail">
                    @if( $post->image_url )
                        <div class="post-item-image">
                            <a href="#">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                            </a>
                        </div>
                    @endif
                    <div class="post-item-body">
                        <div class="padding-10">
                            <h1>{{ $post->title }}</h1>

                            <div class="post-meta no-border">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a
                                            href="{{route('author',$post->user->slug)}}">{{$post->user->name}}</a></li>
                                    <li><i class="fa fa-clock-o"></i>
                                        <time>{{ $post->date }}</time>
                                    </li>
                                    <li><i class="fa fa-folder"></i><a
                                            href="{{route('category',$post->category->slug)}}"> {{$post->category->title}}</a>
                                    </li>
                                    <li><i class="fa fa-tag"></i><a href="#">{!! $post->tags_html !!}</a></li>
                                    <li><i class="fa fa-comments"></i><a href="#comment-label">{{$post->commentsNumber()}}</a></li>
                                </ul>
                            </div>
                            {!! $post->body !!}
                        </div>
                    </div>
                </article>

                <article class="post-author padding-10">
                    <div class="media">
                        <div class="media-left">
                            <a href="{{route('author',$post->user->slug)}}">
                                <img alt="{{$post->user->name}}" src="{{asset('img/author.jpg')}}" class="media-object">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a
                                    href="{{route('author',$post->user->slug)}}">{{$post->user->name}}</a></h4>
                            <div class="post-author-count">
                                <a href="{{route('author',$post->user->slug)}}">
                                    <i class="fa fa-clone"></i>
                                    <?php $postCount = $post->user->posts()->published()->count() ?>
                                    {{$postCount}} {{str_plural('post',$postCount)}}
                                </a>
                            </div>
                            <p>{{$post->user->bio}}</p>
                        </div>
                    </div>
                </article>
                @include('includes.comments')
            </div>
            @include('includes.sidebar')
        </div>
    </div>
@endsection
