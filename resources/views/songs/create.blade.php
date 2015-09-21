@extends('master')

@section('content')
    <h2>Add new song</h2>

    {!! Form::open(['route' => 'song_store_path']) !!}

    @include('songs._form')

    {!! Form::close() !!}
@stop