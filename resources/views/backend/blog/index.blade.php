@extends('layouts.backend.main')
@section('title','MyBlog | Dashboar')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                My Blog
                <small>Display All Posts</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{route('backend.blog.index')}}">Blog</a></li>
                <li class="active">All Posts</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a class="btn btn-success" href="{{route('backend.blog.create')}}"><i
                                        class="fa fa-plus">Add New Post</i></a>
                            </div>
                            <div class="pull-right" style="padding:7px 0">
                                <?php $list = []; ?>
                                @foreach($statusList as $key=>$value)
                                    @if($value)
                                        <?php $selected = Request::get('status') == $key ? 'selected-status' : ''  ?>
                                        <?php $list[] = "<a class=\"{$selected}\" href=\"?status={$key}\">" . ucwords($key) . "({$value})" . "</a>"  ?>
                                    @endif
                                @endforeach
                                {!! implode(' | ',$list) !!}
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">
                            @include('includes.backend.message')
                            @if (!$posts->count())
                                <div class="alert alert-danger">
                                    <strong>No record found</strong>
                                </div>
                            @else
                                @if($onlyTrashed)
                                    @include('backend.blog.table-trash')
                                @else
                                    @include('backend.blog.table')
                                @endif
                            @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            @if($onlyTrashed)
                                {{$posts->appends(request()->input())->links()}}
                            @else
                                {{$posts->links()}}
                            @endif
                            <div class="pull-right">
                                <small>{{$posts->total()}} {{str_plural('post',$posts->total())}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
