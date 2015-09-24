@extends('template')

@section('page', $userData->name.'\'s Playlist')

@section('content')

    @include('pages._user_profile')

    <h3 class="profile-label">
        Playlist : {{ $playlist->list }}
    </h3>

    <div class="song">
        @forelse($songs as $song)

            <div class="media song-list">
                <a class="pull-left" href="{{ route('public_song',[$song->artist_slug, $song->album_slug, $song->song_slug]) }}">
                    <img class="media-object" src="/img/cover/{{ $song->cover }}" style="width: 64px; height: 64px;">
                </a>
                <div class="media-body">
                    <div class="pull-left">
                        <h4 class="title">{!! link_to_route('public_song', $song->title, [$song->artist_slug, $song->album_slug, $song->song_slug]) !!}</h4>
                        <p class="artist">{{ $song->name }}</p>
                    </div>
                    <div class="pull-right text-right">
                        <p class="album">{{ $song->album }}</p>
                        <time class="duration">{{ $song->duration }}</time>
                    </div>
                </div>
            </div>

        @empty

            <p>No song available</p>

        @endforelse

    </div>


@stop