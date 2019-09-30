@extends('layouts.backend.main')
@section('title','MyBlog | Dashboar')
@section('link')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="{{asset('/backend/plugins/tag-editor/jquery.tag-editor.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                My Blog
                <small>Edit post</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{route('backend.blog.index')}}">Blog</a></li>
                <li class="active">Edit Post</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!! Form::model($post,[
                'method'=>'PUT',
                'route'=>['backend.blog.update',$post->id],
                'files'=>TRUE,
                'id'=>'post-form'
                ]) !!}
                @include('backend.blog.form')
                {!! Form::close() !!}
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@include('backend.blog.script')
