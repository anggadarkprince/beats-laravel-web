<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta property="og:url"           content="{{Request::url()}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="BEATS - @yield('page')" />
    <meta property="og:description"   content="Music Discovery Website" />
    <meta property="og:image"         content="/img/avatar/avatar (1).jpg" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BEATS - @yield('page')</title>
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="/css/videojs/video-js.css">
    <link rel="stylesheet" href="/css/styles.css">

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
</head>
<body>
    <div class="container">
        <header class="header">
            <ul class="nav nav-pills navbar-right">
                <?php $segment = Request::segment(1) ?>
                <li class="{{ $segment == '' ? 'active' : '' }}">{!! link_to_route('public_home', 'Home') !!}</li>
                <li class="{{ $segment == 'hits' ? 'active' : '' }}">{!! link_to_route('public_hits', 'Hits') !!}</li>
                <li class="{{ $segment == 'artist' || $segment == 'album' || $segment == 'song' ? 'active' : '' }}">{!! link_to_route('public_artists', 'Artist') !!}</li>
                <li class="{{ $segment == 'video' ? 'active' : '' }}">{!! link_to_route('public_video', 'Video') !!}</li>
                <li class="hidden-xs {{ $segment == 'about' ? 'active' : '' }}">{!! link_to_route('public_about', 'About') !!}</li>
                @if(Auth::check())
                <li id="fat-menu" class="dropdown">
                    <a href="#" id="dropmenu" role="button" class="dropdown-toggle" data-toggle="dropdown"><img src="/img/avatar/{{ Auth::user()->avatar }}" class="top-avatar"></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropmenu">
                        <li role="presentation"><a role="menuitem" href="{{ route('private_profile', [str_slug(Auth::user()->name)]) }}"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
                        <li role="presentation"><a role="menuitem" href="{{ route('private_playlist') }}"><i class="glyphicon glyphicon-play"></i> Playlist</a></li>
                        <li role="presentation"><a role="menuitem" href="{{ route('private_setting') }}"><i class="glyphicon glyphicon-wrench"></i> Setting</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" href="{{ route('private_sign_out') }}"><i class="glyphicon glyphicon-log-out"></i> Sign Out</a></li>
                    </ul>
                </li>
                @endif
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
    <script src="/js/videojs/video.js"></script>
    <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
    <script>
        videojs.options.flash.swf = "/js/videojs/video-js.swf";

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if($('.playlist-item').length){
                var playlist = "@if(isset($savedPlaylist)){{$savedPlaylist->id}}@endif";
                var list = $('.playlist-item');
                var playlistSelectedId;
                list.click(function(){
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');
                    playlistSelectedId = $(this).data('id');
                });

                $(document).on("click",".save-playlist",function(e){
                    if($('.playlist-list').find('.active').length){
                        saveToPlaylist();
                    }
                    else{
                        alert('Select a playlist first');
                    }
                });

                $(document).on('click', '.delete-playlist', function(){
                    deleteToPlaylist();
                });

                function saveToPlaylist(){
                    $(this).addClass('disabled');
                    $.ajax({
                        url: "{{ route('song_playlist_save') }}",
                        type: 'POST',
                        data: {playlist:playlistSelectedId, song:"{{ Request::segment(4) }}", _token:"{{ csrf_token()}}"},
                        success: function(data){
                            if(data){
                                $("#playlistModal").modal('hide');
                                $(".btnSaveToPlaylist")
                                        .text("SONG SAVED")
                                        .attr('href', '#playlistDeleteModal')
                                        .addClass('btnRemoveFromPlaylist')
                                        .addClass('btn-info')
                                        .removeClass('btnSaveToPlaylist')
                                        .removeClass('btn-default');
                                var badge = $('.playlist-list .active').find('.badge');
                                badge.text(parseInt(badge.text()) + 1);
                                playlist = playlistSelectedId;
                                $(this).removeClass('disabled');
                            }
                        },
                        error: function(e){
                            alert('Something is getting wrong '+ e.responseText);
                        }
                    });
                }

                function deleteToPlaylist(){
                    $(this).addClass('disabled');
                    $.ajax({
                        url: "{{ route('song_playlist_delete') }}",
                        type: 'POST',
                        data: {playlist:playlist, song:"{{ Request::segment(4) }}", _method: "delete", _token:"{{ csrf_token()}}"},
                        success: function(data){
                            if(data == "true"){
                                $("#playlistDeleteModal").modal('hide');
                                $(".btnRemoveFromPlaylist")
                                        .text("SAVE TO PLAYLIST")
                                        .attr('href', '#playlistModal')
                                        .removeClass('btnRemoveFromPlaylist')
                                        .removeClass('btn-info')
                                        .addClass('btnSaveToPlaylist')
                                        .addClass('btn-default');
                                $(this).removeClass('disabled');
                                var badge = $(".playlist-item[data-id='"+playlist+"']").find('.badge');
                                badge.text(parseInt(badge.text()) - 1);
                            }
                        },
                        error: function(e){
                            alert('Something is getting wrong '+ e.responseText);
                            $('.footer').html(e.responseText);
                        }
                    });
                }
            }


        });
    </script>
</body>
</html>