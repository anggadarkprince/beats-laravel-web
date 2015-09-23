@extends('template')

@section('page', $page)

@section('content')

    {!! Form::open(['route' => 'post_sign_in', 'class' => 'form-signin']) !!}

    <h2 class="form-signin-heading center-block text-center">RESET LINK REQUEST</h2>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        {!! Form::label('email', 'Email Address') !!}
        {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Input your email', 'required' => true]) !!}
        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Reset Password', ['class' => 'btn btn-lg btn-info btn-block']) !!}
    </div>

    {!! Form::close() !!}

@stop