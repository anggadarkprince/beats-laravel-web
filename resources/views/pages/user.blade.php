@extends('template')

@section('page', $userData->name)

@section('content')

    @include('pages._user_profile')

    <h3 class="profile-label">Playlist</h3>

    <div class="playlist">
        @forelse($playlistData as $playlist)

            <div class="media song-list">
                <div class="media-body">
                    <div class="pull-left">
                        <h4 class="title">{!! link_to_route('public_song', $playlist->list, [$playlist->id]) !!}</h4>
                        <p class="artist">{{ str_limit($playlist->description, 45) }}</p>
                    </div>
                    <div class="pull-right text-right">
                        <p class="album">Created at {{ $playlist->released }}</p>
                        <time class="duration text-muted">{{ $playlist->song_total }} Tracks</time>
                    </div>
                </div>
            </div>

        @empty

            <p class="text-center center-block">No playlist available</p>

        @endforelse
    </div>

@stop