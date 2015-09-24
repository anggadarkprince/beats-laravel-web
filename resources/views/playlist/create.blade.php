@extends('template')

@section('page', $userData->name.'\'s Playlist')

@section('content')

    @include('pages._user_profile')

    {!! Form::open(['route' => 'playlist_store']) !!}

    @include('playlist._form')

    <div class="form-group">
        {!! Form::submit('Create Playlist', ['class' => 'btn btn-info']) !!}
    </div>

    {!! Form::close() !!}
@stop