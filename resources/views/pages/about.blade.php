@extends('template')

@section('page', $page)

@section('content')
    <h2 class="title">About Beats</h2>
    <p class="subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil non placeat quasi sunt tenetur? Labore, nam sunt. Exercitationem fuga harum ipsum, nobis odio quidem quisquam quod recusandae sed tenetur veritatis?</p>

    {!! Form::open(['route' => 'send_feedback']) !!}

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder' => 'Enter your complete name', 'required' => true, 'autofocus' => true]) !!}
        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email', null, ['class'=>'form-control', 'placeholder' => 'Put email address', 'required' => true]) !!}
        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
        {!! Form::label('message', 'Message') !!}
        {!! Form::textarea('message', null, ['class'=>'form-control', 'placeholder' => 'Write your feedback or message', 'required' => true]) !!}
        {!! $errors->first('message', '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Submit Feedback', ['class' => 'btn btn-info']) !!}
    </div>

    {!! Form::close() !!}
@stop