@extends('template')

@section('page', $userData->name.'\'s Setting')

@section('content')

    @include('pages._user_profile')

    @if(Session::has('status'))
        <div class="alert alert-{{ Session::get('status') }}">
            {!! '<p>'.Session::get('message').'</p>' !!}
        </div>
    @endif

    <div class="row">
        {!! Form::model($userData, ['route' => ['user_update', $userData->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) !!}
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class'=>'form-control', 'placeholder' => 'Put your name']) !!}
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                {!! Form::label('male', 'Gender') !!}
                <p>
                    <label class="radio-inline">
                        {!! Form::radio('gender', 'MALE', true, ['id' => 'male', 'class' => 'required']) !!} Male
                    </label>
                    <label class="radio-inline">
                        {!! Form::radio('gender', 'FEMALE', false, ['id' => 'female']) !!} Female
                    </label>
                </p>
                {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                {!! Form::label('status', 'Status') !!}
                {!! Form::text('status', null, ['class'=>'form-control', 'placeholder' => 'Post a status']) !!}
                {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group {{ $errors->has('about') ? 'has-error' : '' }}">
                {!! Form::label('about', 'About') !!}
                {!! Form::textarea('about', null, ['class'=>'form-control', 'placeholder' => 'Caption or description', 'rows' => '7']) !!}
                {!! $errors->first('about', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('avatar_file', 'Avatar') !!}
                <img src="\img\avatar\{{ $userData->avatar }}" class="img-responsive" style="max-height: 108px; margin-bottom: 10px">
                {!! Form::file('avatar_file') !!}
            </div>
            <div class="form-group {{ $errors->has('password_old') ? 'has-error' : '' }}">
                {!! Form::label('password_old', 'Password') !!}
                {!! Form::password('password_old', ['class'=>'form-control', 'placeholder' => 'Put your current password']) !!}
                {!! $errors->first('password_old', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group {{ $errors->has('password_new') ? 'has-error' : '' }}">
                {!! Form::label('password_new', 'Password New') !!}
                {!! Form::password('password_new', ['class'=>'form-control', 'placeholder' => 'Put your new password']) !!}
                {!! $errors->first('password_new', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group {{ $errors->has('password_new_confirmation') ? 'has-error' : '' }}">
                {!! Form::label('password_new_confirmation', 'Password Confirm') !!}
                {!! Form::password('password_new_confirmation', ['class'=>'form-control', 'placeholder' => 'confirm your new password']) !!}
                {!! $errors->first('password_new_confirmation', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::submit('Update Playlist', ['class' => 'btn btn-info']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@stop