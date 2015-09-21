<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BEATS - @yield('page')</title>
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

    <div class="container">
        <header class="header">
            <ul class="nav nav-pills pull-right">
                <?php $segment = Request::segment(1) ?>
                <li class="{{ $segment == '' ? 'active' : '' }}">{!! link_to_route('public_home', 'Home') !!}</li>
                <li class="{{ $segment == 'hits' ? 'active' : '' }}">{!! link_to_route('public_hits', 'Hits') !!}</li>
                <li class="{{ $segment == 'artist' ? 'active' : '' }}">{!! link_to_route('public_artists', 'Artist') !!}</li>
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