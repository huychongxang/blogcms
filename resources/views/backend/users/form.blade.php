<div class="col-xs-9">
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name') !!}
                {!! Form::text('name',null,['class'=>'form-control']) !!}
                @if($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('email') !!}
                {!! Form::email('email',null,['class'=>'form-control']) !!}
                @if($errors->has('email'))
                    <span class="help-block">{{$errors->first('email')}}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('password') !!}
                {!! Form::password('password',['class'=>'form-control']) !!}
                @if($errors->has('password'))
                    <span class="help-block">{{$errors->first('password')}}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                {!! Form::label('password_confirmation') !!}
                {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
                @if($errors->has('password_confirmation'))
                    <span class="help-block">{{$errors->first('password_confirmation')}}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                {!! Form::label('role') !!}
                <?php $defaultRole = !empty($user) ? $user->roles->first()->id : null; ?>
                @if(!empty($user) && ($user->id == config('cms.default_user_id')) || isset($hiddenRoleDropdown) )
                    {!! Form::hidden('role',$user->roles->first()->display_name) !!}
                    <p class="form-control-static">{{$user->roles->first()->display_name}}</p>
                @else
                    {!! Form::select('role',$roles,$defaultRole,['class'=>'form-control','placeholder'=>'Choose a role']) !!}
                @endif
                @if($errors->has('role'))
                    <span class="help-block">{{$errors->first('role')}}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('bio') ? 'has-error' : '' }}">
                {!! Form::label('bio') !!}
                {!! Form::textarea('bio',null,['class'=>'form-control']) !!}
                @if($errors->has('bio'))
                    <span class="help-block">{{$errors->first('bio')}}</span>
                @endif
            </div>
        </div>
        <div class="box-footer">
            <div class="form-group">
                <button class="btn btn-primary">{{isset($user) ? "Update" : "Create"}}</button>
                <a class="btn btn-default" href="{{route('backend.users.index')}}">Quay lại</a>
            </div>
        </div>
    </div>
    <!-- /.box -->
</div>
