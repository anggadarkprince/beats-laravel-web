@extends('template')

@section('page', $page)

@section('content')

    {!! Form::open(['route' => 'post_sign_in', 'class' => 'form-signin']) !!}

    <h2 class="form-signin-heading center-block text-center">RESET PASSWORD</h2>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        {!! Form::label('email', 'Email Address') !!}
        {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Input your email', 'required' => true]) !!}
        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Input your password', 'required' => true]) !!}
        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
        {!! Form::label('password_confirmation', 'Confirm password') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Repeat your password', 'required' => true]) !!}
        {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Reset Password', ['class' => 'btn btn-lg btn-info btn-block']) !!}
    </div>

    {!! Form::close() !!}

@stop