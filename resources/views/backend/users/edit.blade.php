@extends('layouts.backend.main')
@section('title','MyBlog | Dashboar')
@section('link')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                My Blog
                <small>Edit user</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{route('backend.users.index')}}">User</a></li>
                <li class="active">Edit User</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!! Form::model($user,[
                'method'=>'PUT',
                'route'=>['backend.users.update',$user->id],
                'files'=>TRUE,
                'id'=>'user-form'
                ]) !!}
                @include('backend.users.form')
                {!! Form::close() !!}
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
