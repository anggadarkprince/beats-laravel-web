@extends('template')

@section('page', $page)

@section('banner')

    <div class="jumbotron">
        <h1>MUSICS ON WEB</h1>
        <p class="lead">
            Follow the updates and listen your favorite musics. Tons of playlist available everyday.
        </p>
        @if(!Auth::check())
            <p>{!! link_to_route('public_sign_up','Sign Up Today', [], ['class'=>'btn btn-lg btn-info']) !!}</p>
            <p>{!! link_to_route('public_sign_in','Have an account? Sign In') !!}</p>
        @else
            <p>Hi, {!! link_to_route('private_profile',Auth::user()->name, [str_slug(Auth::user()->name)]) !!} welcome back!</p>
            <span class="hidden-xs">
                <i class="glyphicon glyphicon-user"></i> {!! link_to_route('private_profile','PROFILE', [str_slug(Auth::user()->name)]) !!} &nbsp; | &nbsp;
                <i class="glyphicon glyphicon-play"></i> {!! link_to_route('private_playlist','PLAYLIST') !!} &nbsp; | &nbsp;
                <i class="glyphicon glyphicon-wrench"></i> {!! link_to_route('private_setting','SETTING') !!} &nbsp; | &nbsp;
                <i class="glyphicon glyphicon-log-out"></i> {!! link_to_route('private_sign_out','LOGOUT') !!}
            </span>
        @endif
    </div>

@stop

@section('content')

    <div class="row marketing">
        <div class="col-lg-6">
            <h4>{{ $featured[0] }}</h4>
            <p>We provide the best indie music, support the new band and promote their songs.</p>

            <h4>{{ $featured[1] }}</h4>
            <p>Collection of soundtrack film, game, anime and many more. Discover your favorite channels</p>

            <h4>{{ $featured[2] }}</h4>
            <p>Musics are reliable and touching. Find valuable collection of maestro.</p>
        </div>

        <div class="col-lg-6">
            <h4>{{ $featured[3] }}</h4>
            <p>The best of best bands and songs available every saturday and sunday.</p>

            <h4>{{ $featured[4] }}</h4>
            <p>Now it's a service as premium content. Dinner with singer or band which is you've likes.</p>

            <h4>{{ $featured[5] }}</h4>
            <p>Tour and concert schedule updates everyday, please check your notification periodically.</p>
        </div>
    </div>

@stop

