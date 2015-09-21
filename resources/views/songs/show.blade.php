@extends('master')

@section('content')

    <h2>{{ $song->title }}</h2>

    @if ($song->lyrics)
        <article class="lyrics">
            {!! nl2br($song->lyrics) !!}
        </article>
    @endif

    {!! link_to_route('songs_path', 'Go Back Home') !!}

@stop