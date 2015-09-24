@extends('template')

@section('page', $page)

@section('content')
    <h2 class="title">Featured Videos</h2>
    <p class="subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum dicta, dolores earum esse est et eum expedita fuga incidunt iure magnam natus necessitatibus obcaecati repudiandae tempore, totam, unde voluptas voluptatibus.</p>
    <div class="video">
        <div class="featured video">
            <video id="featured_video"
                   class="video-js vjs-default-skin"
                   controls preload="none"
                   width="100%" height="420"
                   poster="\vid\echo-hereweare.jpg"
                   data-setup="{}">
                <source src="\vid\echo-hereweare.mp4" type='video/mp4' />
                <track kind="captions" src="\vid\demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
                <track kind="subtitles" src="\vid\demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
                <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
            </video>
        </div>
        <div class="row">
            @forelse($videoData as $video)

                <div class="col-md-6">
                    <div class="video">
                        <a href="{{ route('public_show_video', [$video->videoSlug]) }}">
                            <img src="\vid\{{ $video->poster }}" class="img-responsive">
                            <p class="lead title">{{ $video->title }}</p>
                            <p class="text-muted">{{ $video->name }}</p>
                        </a>
                    </div>
                </div>

            @empty

                <p class="text-center center-block">No video available</p>

            @endforelse

        </div>

        <div class="center-block text-center">
            {!! $videoData->render() !!}
        </div>
    </div>

@stop