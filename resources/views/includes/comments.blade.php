<article class="post-comments" id="comment-label">
    <h3><i class="fa fa-comments"></i> {{$post->commentsNumber() }}</h3>

    <div class="comment-body padding-10">
        <ul class="comments-list">
            @foreach($postComments as $comment)
                <li class="comment-item">
                    <div class="comment-heading clearfix">
                        <div class="comment-author-meta">
                            <h4>{{$comment->user_name}}
                                <small>{{$comment->date}}</small>
                            </h4>
                        </div>
                    </div>
                    <div class="comment-content">
                        {!! $comment->body_html !!}
                    </div>
                </li>
            @endforeach
            {{--<li class="comment-item">--}}
            {{--<div class="comment-heading clearfix">--}}
            {{--<div class="comment-author-meta">--}}
            {{--<h4>John Doe--}}
            {{--<small>January 14, 2016</small>--}}
            {{--</h4>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="comment-content">--}}
            {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nesciunt nulla est, atque ratione--}}
            {{--nostrum cumque ducimus maxime, amet enim tempore ipsam. Id ea, veniam ipsam perspiciatis--}}
            {{--assumenda magnam doloribus!</p>--}}
            {{--<p>Quibusdam iusto culpa, necessitatibus, libero sequi quae commodi ea ab non facilis enim vitae--}}
            {{--inventore laborum hic unde esse debitis. Adipisci nostrum reprehenderit explicabo, non molestias--}}
            {{--aliquid quibusdam tempore. Vel.</p>--}}

            {{--<ul class="comments-list-children">--}}
            {{--<li class="comment-item">--}}
            {{--<div class="comment-heading clearfix">--}}
            {{--<div class="comment-author-meta">--}}
            {{--<h4>John Doe--}}
            {{--<small>January 14, 2016</small>--}}
            {{--</h4>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="comment-content">--}}
            {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nesciunt nulla est,--}}
            {{--atque ratione nostrum cumque ducimus maxime, amet enim tempore ipsam. Id ea, veniam--}}
            {{--ipsam perspiciatis assumenda magnam doloribus!</p>--}}
            {{--<p>Quibusdam iusto culpa, necessitatibus, libero sequi quae commodi ea ab non facilis--}}
            {{--enim vitae inventore laborum hic unde esse debitis. Adipisci nostrum reprehenderit--}}
            {{--explicabo, non molestias aliquid quibusdam tempore. Vel.</p>--}}
            {{--</div>--}}
            {{--</li>--}}

            {{--<li class="comment-item">--}}
            {{--<div class="comment-heading clearfix">--}}
            {{--<div class="comment-author-meta">--}}
            {{--<h4>John Doe--}}
            {{--<small>January 14, 2016</small>--}}
            {{--</h4>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="comment-content">--}}
            {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nesciunt nulla est,--}}
            {{--atque ratione nostrum cumque ducimus maxime, amet enim tempore ipsam. Id ea, veniam--}}
            {{--ipsam perspiciatis assumenda magnam doloribus!</p>--}}
            {{--<p>Quibusdam iusto culpa, necessitatibus, libero sequi quae commodi ea ab non facilis--}}
            {{--enim vitae inventore laborum hic unde esse debitis. Adipisci nostrum reprehenderit--}}
            {{--explicabo, non molestias aliquid quibusdam tempore. Vel.</p>--}}

            {{--<ul class="comments-list-children">--}}
            {{--<li class="comment-item">--}}
            {{--<div class="comment-heading clearfix">--}}
            {{--<div class="comment-author-meta">--}}
            {{--<h4>John Doe--}}
            {{--<small>January 14, 2016</small>--}}
            {{--</h4>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="comment-content">--}}
            {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nesciunt--}}
            {{--nulla est, atque ratione nostrum cumque ducimus maxime, amet enim--}}
            {{--tempore ipsam. Id ea, veniam ipsam perspiciatis assumenda magnam--}}
            {{--doloribus!</p>--}}
            {{--<p>Quibusdam iusto culpa, necessitatibus, libero sequi quae commodi ea ab--}}
            {{--non facilis enim vitae inventore laborum hic unde esse debitis. Adipisci--}}
            {{--nostrum reprehenderit explicabo, non molestias aliquid quibusdam--}}
            {{--tempore. Vel.</p>--}}
            {{--</div>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</li>--}}
        </ul>
        <nav>
            {!! $postComments->links() !!}
        </nav>

    </div>

    <div class="comment-footer padding-10">
        <h3>Leave a comment</h3>
        @include('includes.alert')
        {!! Form::open([
        'route'=>['blog.comments',$post->slug],
        'method'=>'POST'
            ]) !!}
        <div class="form-group required {{ $errors->has('user_name') ? 'has-error' : '' }}">
            <label for="name">Name</label>
            {!! Form::text('user_name',null,['class'=>'form-control']) !!}
            @if($errors->has('user_name'))
                <span class="help-block">{{$errors->first('user_name')}}</span>
            @endif
        </div>
        <div class="form-group required {{ $errors->has('user_email') ? 'has-error' : '' }}">
            <label for="email">Email</label>
            {!! Form::text('user_email',null,['class'=>'form-control']) !!}
            @if($errors->has('user_email'))
                <span class="help-block">{{$errors->first('user_email')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            {!! Form::text('user_url',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group required {{ $errors->has('body') ? 'has-error' : '' }}">
            <label for="comment">Comment</label>
            {!! Form::textarea('body',null,['rows'=>6,'class'=>'form-control']) !!}
            @if($errors->has('body'))
                <span class="help-block">{{$errors->first('body')}}</span>
            @endif
        </div>
        <div class="clearfix">
            <div class="pull-left">
                <button type="submit" class="btn btn-lg btn-success">Submit</button>
            </div>
            <div class="pull-right">
                <p class="text-muted">
                    <span class="required">*</span>
                    <em>Indicates required fields</em>
                </p>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

</article>
