@extends('template')

@section('content')

    {!! Form::open(['route' => 'post_register', 'class' => 'form-signin']) !!}
        <h2 class="form-signin-heading center-block text-center">BEATS REGISTER</h2>

        <div class="form-group">
            {!! Form::label('name', 'Full Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Input your name', 'required' => true, 'autofocus' => true]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email Address') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Input your email', 'required' => true]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Input your password', 'required' => true]) !!}
        </div>

    <!--
        <div class="form-group">
            {!! Form::label('male', 'Gender') !!}
            <p>
                <label class="radio-inline">
                    {!! Form::radio('gender', 'Male', true, ['id' => 'male', 'class' => 'required']) !!} Male
                </label>
                <label class="radio-inline">
                    {!! Form::radio('gender', 'Female', false, ['id' => 'female']) !!} Female
                </label>
            </p>
        </div>
    -->
        <div class="form-group">
            {!! Form::label('agree', 'Agreement') !!}
            <p>
                {!! Form::checkbox('agree', 'true', true, ['class' => 'required']) !!} I have read the user agreement
            </p>
        </div>

        <div class="form-group">
            {!! Form::submit('Sign Up', ['class' => 'btn btn-lg btn-info btn-block']) !!}
            <br><p class="center-block text-center">{!! link_to_route('public_sign_in', 'Have an account? Sign In') !!}</p>
        </div>

    {!! Form::close() !!}
@stop