@extends('template')

@section('page', $userData->name.'\'s Playlist')

@section('content')

    @include('pages._user_profile')

    {!! Form::model($playlist, ['route' => ['playlist_update', $playlist->id], 'method' => 'PATCH']) !!}

    @include('playlist._form')

    <div class="form-group">
        {!! Form::submit('Update Playlist', ['class' => 'btn btn-info']) !!}
    </div>

    {!! Form::close() !!}
@stop