@extends('master')

@section('content')
    <h2>{{ $song->title }}</h2>

    {!! Form::model($song, ['route' => ['song_update_path', $song->slug], 'method' => 'PATCH']) !!}

    @include('songs._form')

    {!! Form::close() !!}

    {!! delete_form(['song_destroy_path', $song->slug]) !!}

@stop