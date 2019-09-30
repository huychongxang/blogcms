<div class="col-xs-9">
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label('title') !!}
                {!! Form::text('title',null,['class'=>'form-control']) !!}
                @if($errors->has('title'))
                    <span class="help-block">{{$errors->first('title')}}</span>
                @endif
            </div>
        </div>
        <div class="box-footer">
            <div class="form-group">
                <button class="btn btn-primary">{{isset($category) ? "Update" : "Create"}}</button>
                <a class="btn btn-default" href="{{route('backend.categories.index')}}">Quay lại</a>
            </div>
        </div>
    </div>
    <!-- /.box -->
</div>
