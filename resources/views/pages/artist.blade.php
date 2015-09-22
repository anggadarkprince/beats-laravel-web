@extends('template')

@section('page', $artistData->name)

@section('content')
    <div class="media profile">
        <a class="pull-left" href="#">
            <img class="img-responsive" src="/img/avatar/{{ $artistData->avatar }}" style="width: 140px; height: 140px;">
        </a>
        <div class="media-body">
            <h2 class="title">{{ $artistData->name }}</h2>
            <p>{{ $artistData->about }}</p>
            <p class="text-muted">{{ $artistData->birthplace }} | {{ $artistData->birthday }}</p>
        </div>
    </div>

    <h3 class="profile-label">Albums</h3>
    <div class="song">
        @forelse($albums as $album)

            <div class="media song-list">
                <a class="pull-left" href="{{ route('public_album',[Request::segment(2), $album->slug]) }}">
                    <img class="media-object" src="/img/cover/{{ $album->cover }}" style="width: 64px; height: 64px;">
                </a>
                <div class="media-body">
                    <div class="pull-left">
                        <h4 class="title">{{ $album->title }}</h4>
                        <p class="artist text-muted">{{ $artistData->name }}</p>
                    </div>
                    <div class="pull-right text-right">
                        <p class="album">Released at {{ $album->released }}</p>
                        <time class="duration text-muted">{{ $album->song_total }} Tracks</time>
                    </div>
                </div>
            </div>

        @empty

            <p class="text-center center-block">No album available</p>

        @endforelse

    </div>

    <h3 class="profile-label">Videos</h3>
    <div class="video">
        <div class="row">
            @forelse($videos as $video)

                <div class="col-md-3 col-sm-6">
                    <video src="/vid/{{ $video->resource }}" style="width: 140px; height: 140px;" controls></video>
                </div>

            @empty

                <p class="text-center center-block">No video available</p>

            @endforelse
        </div>
    </div>

    <h3 class="profile-label">Articles</h3>
    <div class="article">

        @forelse($posts as $post)

            <div class="post">
                <h1>{{ $post->title }}</h1>
                <p class="text-muted">{{ $post->author }} | Published at {{ $post->created_at }}</p>
                <p>{{ str_limit(strip_tags($post->content),200) }}</p>
                <p>{!! link_to_route('public_post', 'View Details', [$post->slug], ['class' => 'btn btn-default']) !!}</p>
            </div>

        @empty

            <p class="text-center center-block">No post available</p>

        @endforelse

    </div>
@stop