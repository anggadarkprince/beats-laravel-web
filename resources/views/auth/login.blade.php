@extends('template')

@section('page', $page)

@section('content')

    {!! Form::open(['route' => 'post_sign_in', 'class' => 'form-signin']) !!}
        <h2 class="form-signin-heading center-block text-center">SIGN IN</h2>

        <input type="text" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" class="form-control" placeholder="Password" required>

        <div class="form-group">
            {!! Form::submit('Sign In', ['class' => 'btn btn-lg btn-info btn-block']) !!}
            <br><p class="center-block text-center">{!! link_to_route('public_sign_up', 'Need an account?, Register Now') !!}</p>
        </div>
    {!! Form::close() !!}

@stop