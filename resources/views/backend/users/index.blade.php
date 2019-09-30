@extends('layouts.backend.main')
@section('title','MyUser | Dashboar')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Category
                <small>Display All Users</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{route('backend.users.index')}}">Users</a></li>
                <li class="active">All Users</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a class="btn btn-success" href="{{route('backend.users.create')}}"><i
                                        class="fa fa-plus">Add New User</i></a>
                            </div>
                            <div class="pull-right">

                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">
                            @include('includes.backend.message')
                            @if (!$users->count())
                                <div class="alert alert-danger">
                                    <strong>No record found</strong>
                                </div>
                            @else
                                @include('backend.users.table')
                            @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                                {{$users->appends(request()->input())->links()}}
                            <div class="pull-right">
                                <small>{{$users->total()}} {{str_plural('user',$users->total())}}</small>
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
