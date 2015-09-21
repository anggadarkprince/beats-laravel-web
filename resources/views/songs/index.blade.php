@extends('master')

@section('content')
    {!! link_to_route('song_create_path', 'CREATE') !!}
    @foreach($songs as $song)
        <li>
            {!! link_to_route('song_path', $song->title, [$song->slug]) !!}
            ({!! link_to_route('song_edit_path', 'Edit', [$song->slug]) !!})
        </li>
    @endforeach
@stop