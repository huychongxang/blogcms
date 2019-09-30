@extends('layouts.backend.main')
@section('title','MyBlog | Dashboar')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Category
                <small>Display All Categories</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li><a href="{{route('backend.categories.index')}}">Categories</a></li>
                <li class="active">All Categories</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a class="btn btn-success" href="{{route('backend.categories.create')}}"><i
                                        class="fa fa-plus">Add New Category</i></a>
                            </div>
                            <div class="pull-right">

                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">
                            @include('includes.backend.message')
                            @if (!$categories->count())
                                <div class="alert alert-danger">
                                    <strong>No record found</strong>
                                </div>
                            @else
                                @include('backend.categories.table')
                            @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                                {{$categories->appends(request()->input())->links()}}
                            <div class="pull-right">
                                <small>{{$categories->total()}} {{str_plural('category',$categories->total())}}</small>
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
