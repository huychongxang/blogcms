@extends('layouts.backend.main')
@section('title','MyUser | Dashboar')
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
                My User
                <small>Delete Confirm</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{route('backend.users.index')}}">User</a></li>
                <li class="active">Delete confirm</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!! Form::open([
                'method'=>'delete',
                'route'=>['backend.users.destroy',$user->id],
                'files'=>TRUE,
                'id'=>'user-form'
                ]) !!}
                <div class="col-xs-9">
                    <div class="box">
                        <div class="body">
                            <p>
                                You have specified this user for deletion:
                            </p>
                            <p>
                                ID #{{$user->id}} : {{$user->name}}
                            </p>
                            <p>
                                What should be done with content own by this user?
                            </p>
                            <p>
                                <input type="radio" name="delete_option" value="delete" checked>Delete All Content
                            </p>
                            <p>
                                <input type="radio" name="delete_option" value="attribute"> Attribute content to:
                                {{Form::select('selected_user',$users,null)}}
                            </p>
                        </div>
                        <div class="footer">
                            <button type="submit" class="btn btn-danger">Confirm Delete</button>
                            <a href="{{route('backend.users.index')}}" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
