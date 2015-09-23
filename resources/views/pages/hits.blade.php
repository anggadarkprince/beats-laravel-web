@extends('template')

@section('page', $page)

@section('content')
    <h2 class="title">Top 10 Musics</h2>
    <p class="subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A autem culpa dolorum enim error non nostrum obcaecati officiis quisquam velit. At consequatur dicta impedit placeat soluta! Dicta dolor eligendi necessitatibus?</p>

    <div class="song">
        @foreach($hits as $hit)

            <div class="media song-list">
                <a class="pull-left" href="{{ route('public_song',[$hit->artist_slug, $hit->album_slug, $hit->song_slug]) }}">
                    <img class="media-object" src="/img/cover/{{ $hit->cover }}" style="width: 64px; height: 64px;">
                </a>
                <div class="media-body">
                    <div class="pull-left">
                        <h4 class="title">{!! link_to_route('public_song', $hit->title, [$hit->artist_slug, $hit->album_slug, $hit->song_slug]) !!}</h4>
                        <p class="artist">{{ $hit->name }}</p>
                    </div>
                    <div class="pull-right text-right">
                        <p class="album">{{ $hit->album }}</p>
                        <time class="duration">{{ $hit->duration }}</time>
                    </div>
                </div>
            </div>

        @endforeach

    </div>

@stop