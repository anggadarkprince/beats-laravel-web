@extends('template')

@section('page', $page)

@section('content')

    {!! Form::open(['route' => 'post_sign_up', 'class' => 'form-signin']) !!}

        <h2 class="form-signin-heading center-block text-center">BEATS REGISTER</h2>

        @if(Session::has('status'))
            <div class="form-group">
                {!! '<p class="text-danger">*'.Session::get('status').'</p>' !!}
            </div>
        @endif

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', 'Full Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Input your name', 'required' => true, 'autofocus' => true]) !!}
            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {!! Form::label('email', 'Email Address') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Input your email', 'required' => true]) !!}
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

        <div class="form-group {{ $errors->has('agree') ? 'has-error' : '' }}">
            {!! Form::label('agree', 'Agreement') !!}
            <p>
                {!! Form::checkbox('agree', 'true', true, ['class' => 'required']) !!} I have read the user agreement
            </p>
            {!! $errors->first('agree', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Sign Up', ['class' => 'btn btn-lg btn-info btn-block']) !!}
            <br><p class="center-block text-center">{!! link_to_route('public_sign_in', 'Have an account? Sign In') !!}</p>
        </div>

    {!! Form::close() !!}
@stop