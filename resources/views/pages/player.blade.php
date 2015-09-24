@extends('template')

@section('page', $videoData->title)

@section('content')
    <h2 class="title">{{ $videoData->title }}</h2>
    <p class="subtitle">{{ $videoData->description }}</p>

    <div class="video">
        <div class="featured video">
            <video id="featured_video"
                   class="video-js vjs-default-skin"
                   controls preload="none"
                   width="100%" height="420"
                   poster="\vid\{{ $videoData->poster }}"
                   data-setup="{}">
                <source src="\vid\{{ $videoData->resource }}" type='video/mp4' />
                <track kind="captions" src="\vid\demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
                <track kind="subtitles" src="\vid\demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
                <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
            </video>
        </div>

    </div>

@stop