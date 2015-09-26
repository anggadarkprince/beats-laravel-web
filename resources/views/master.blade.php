<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta property="og:url"           content="{{Request::url()}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="BEATS - @yield('page')" />
    <meta property="og:description"   content="Music Discovery Website" />
    <meta property="og:image"         content="/img/avatar/avatar (1).jpg" />

    <title>BEATS Administrator - @yield('page')</title>
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="/css/videojs/video-js.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body id="admin">
    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('public_home') }}" target="_blank">THE BEATS</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php $segment = Request::segment(1) ?>
                    <li class="{{ $segment == 'dashboard'  ? 'active' : '' }}"><a href="{{ route('admin::dashboard') }}"        >Dashboard</a></li>
                    <li class="{{ $segment == 'artists'     ? 'active' : '' }}"><a href="{{ route('admin::artists.index') }}"    >Artists</a></li>
                    <li class="{{ $segment == 'albums'     ? 'active' : '' }}"><a href="{{ route('admin::albums.index') }}"     >Albums</a></li>
                    <li class="{{ $segment == 'songs'      ? 'active' : '' }}"><a href="{{ route('admin::songs.index') }}"      >Songs</a></li>
                    <li class="{{ $segment == 'videos'     ? 'active' : '' }}"><a href="{{ route('admin::videos.index') }}"     >Videos</a></li>
                    <li class="{{ $segment == 'posts'      ? 'active' : '' }}"><a href="{{ route('admin::posts.index') }}"      >Posts</a></li>
                    <li class="{{ $segment == 'comments'   ? 'active' : '' }}"><a href="{{ route('admin::comments.index') }}"   >Comments</a></li>
                    <li class="{{ $segment == 'feedback'   ? 'active' : '' }}"><a href="{{ route('admin::feedback.index') }}"   >Feedback</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.html">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class="container">
        @yield('content')
        <div class="footer">
            <p>&copy; Copyright {{ date("Y") }} BEATS All rights reserved.</p>
        </div>
    </div>

    <script src="/js/jquery/jquery.min.js"></script>
    <script src="/js/bootstrap/bootstrap.min.js"></script>
    <script src="/js/videojs/video.js"></script>
    <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
    <script>
        videojs.options.flash.swf = "/js/videojs/video-js.swf";

        $(document).ready(function(){
            var url = $(".form-delete").attr('action');
            $(".btn-delete").click(function(){
                $(".form-delete").attr('action', url+"/"+$(this).data('id'));
            });
        });
    </script>
</body>
</html>