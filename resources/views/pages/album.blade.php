@extends('template')

@section('page', $albumData->title)

@section('content')

    @include('pages._artist_profile')

    <?php $date = new DateTime($albumData->released) ?>
    <h3 class="profile-label">Albums : {{ $albumData->title }} ({{ $date->format('Y') }})</h3>
    <p class="subtitle">{{ $albumData->description }}</p>
    <div class="song">
        @forelse($songs as $song)

            <div class="media song-list">
                <a class="pull-left" href="{{ route('public_song',[Request::segment(2), Request::segment(3), $song->slug]) }}">
                    <img class="media-object" src="/img/cover/{{ $albumData->cover }}" style="width: 64px; height: 64px;">
                </a>
                <div class="media-body">
                    <div class="pull-left">
                        <h4 class="title">{!! link_to_route('public_song', $song->title, [Request::segment(2), Request::segment(3), $song->slug]) !!}</h4>
                        <p class="artist">{{ $artistData->name }}</p>
                    </div>
                    <div class="pull-right text-right">
                        <p class="album">{{ $albumData->title }}</p>
                        <time class="duration">{{ $song->duration }}</time>
                    </div>
                </div>
            </div>

        @empty

            <p class="text-center center-block">No song available</p>

        @endforelse

    </div>
@stop