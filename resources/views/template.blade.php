<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta property="og:url"           content="{{Request::url()}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="BEATS - @yield('page')" />
    <meta property="og:description"   content="Music Discovery Website" />
    <meta property="og:image"         content="/img/avatar/avatar (1).jpg" />

    <title>BEATS - @yield('page')</title>
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '438533166330046',
                xfbml      : true,
                version    : 'v2.4'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <div class="container">
        <header class="header">
            <ul class="nav nav-pills navbar-right">
                <?php $segment = Request::segment(1) ?>
                <li class="{{ $segment == '' ? 'active' : '' }}">{!! link_to_route('public_home', 'Home') !!}</li>
                <li class="{{ $segment == 'hits' ? 'active' : '' }}">{!! link_to_route('public_hits', 'Hits') !!}</li>
                <li class="{{ $segment == 'artist' || $segment == 'album' || $segment == 'song' ? 'active' : '' }}">{!! link_to_route('public_artists', 'Artist') !!}</li>
                <li class="{{ $segment == 'video' ? 'active' : '' }}">{!! link_to_route('public_video', 'Video') !!}</li>
                <li class="hidden-xs {{ $segment == 'about' ? 'active' : '' }}">{!! link_to_route('public_about', 'About') !!}</li>
                <li id="fat-menu" class="dropdown">
                    <a href="#" id="dropmenu" role="button" class="dropdown-toggle" data-toggle="dropdown"><img src="/img/avatar/avatar (3).jpg" class="top-avatar"></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropmenu">
                        <li role="presentation"><a role="menuitem" href="{{ route('private_profile') }}"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
                        <li role="presentation"><a role="menuitem" href="{{ route('private_playlist') }}"><i class="glyphicon glyphicon-play"></i> Playlist</a></li>
                        <li role="presentation"><a role="menuitem" href="{{ route('private_favorite') }}"><i class="glyphicon glyphicon-heart"></i> Favorite</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" href="{{ route('public_sign_out') }}"><i class="glyphicon glyphicon-log-out"></i> Sign Out</a></li>
                    </ul>
                </li>
            </ul>
            <h3 class="text-muted"><span class="glyphicon glyphicon-headphones"></span> <span class="hidden-xs">THE BEATS</span></h3>
        </header>

        @yield('banner')

        @yield('content')

        <div class="footer">
            <p>&copy; Copyright {{ date("Y") }} BEATS All rights reserved.</p>
        </div>
    </div>

    <script src="/js/jquery/jquery.min.js"></script>
    <script src="/js/bootstrap/bootstrap.min.js"></script>
</body>
</html>