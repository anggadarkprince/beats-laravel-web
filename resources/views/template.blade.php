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
            <ul class="nav nav-pills pull-right">
                <?php $segment = Request::segment(1) ?>
                <li class="{{ $segment == '' ? 'active' : '' }}">{!! link_to_route('public_home', 'Home') !!}</li>
                <li class="{{ $segment == 'hits' ? 'active' : '' }}">{!! link_to_route('public_hits', 'Hits') !!}</li>
                <li class="{{ $segment == 'artist' || $segment == 'album' || $segment == 'song' ? 'active' : '' }}">{!! link_to_route('public_artists', 'Artist') !!}</li>
                <li class="{{ $segment == 'video' ? 'active' : '' }}">{!! link_to_route('public_video', 'Video') !!}</li>
                <li class="{{ $segment == 'about' ? 'active' : '' }}">{!! link_to_route('public_about', 'About') !!}</li>
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