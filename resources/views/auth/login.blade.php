@extends('template')

@section('page', $page)

@section('content')

    {!! Form::open(['route' => 'post_sign_in', 'class' => 'form-signin']) !!}
        <h2 class="form-signin-heading center-block text-center">SIGN IN</h2>

        @if(Session::has('status'))
            <div class="form-group">
                {!! '<p class="text-danger">*'.Session::get('status').'</p>' !!}
            </div>
        @endif

        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email address', 'required' => true]) !!}
        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}

        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Input your password', 'required' => true]) !!}
        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}

        <div class="form-group">
            {!! Form::submit('Sign In', ['class' => 'btn btn-lg btn-info btn-block']) !!}
            <br><p class="center-block text-center">{!! link_to_route('public_sign_up', 'Need an account?, Register Now') !!}</p>
        </div>
    {!! Form::close() !!}

@stop