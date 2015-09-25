@extends('template')

@section('page', $songData->title)

@section('content')

    @include('pages._artist_profile')

    <h3 class="profile-label">
        {{ $songData->title }}
        @if(Auth::check())
            @if($savedPlaylist != null)
                {!! link_to('#playlistDeleteModal', 'SONG SAVED', ['class' => 'btn btn-info pull-right btnRemoveFromPlaylist', 'data-toggle' => 'modal']) !!}
            @else
                {!! link_to('#playlistModal', 'SAVE TO PLAYLIST', ['class' => 'btn btn-default pull-right btnSaveToPlaylist', 'data-toggle' => 'modal']) !!}
            @endif
        @else
            {!! link_to_route('public_sign_in', 'LOGIN TO SAVE', [], ['class' => 'btn btn-default pull-right btnSaveToPlaylist', 'data-toggle' => 'modal']) !!}
        @endif
    </h3>
    <p class="lead">
        <a href="{{ route('public_album', [$artistData->slug, $albumData->slug]) }}">
            Albums : {{ $albumData->title }} ({{ date_format(date_create($albumData->released), 'Y') }})
        </a>
    </p>
    <p class="text-muted">Lyrics : {{ $songData->writer }} | Music : {{ $songData->music }} | Label : {{ $albumData->label }}</p>
    <p class="subtitle">
        {!! $songData->lyrics !!}
    </p>

    @if(Auth::check())
    <!-- Modal -->
    <div class="modal fade" id="playlistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{ Auth::user()->name }}'s Playlist</h4>
                </div>
                <div class="modal-body">
                    <ul class="list-group playlist-list">
                        @forelse($playlistData as $playlist)

                            <li class="list-group-item playlist-item" data-id="{{ $playlist->id }}">{{ $playlist->list }}<span class="badge">{{ $playlist->song_total }}</span></li>

                        @empty

                        <li class="text-center center-block">No playlist available, {!! link_to_route('playlist_create', 'Create New Playlist') !!}</li>

                        @endforelse
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info save-playlist">Save To Playlist</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="playlistDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{ Auth::user()->name }}'s Playlist</h4>
                </div>
                <div class="modal-body">
                    Are you sure want to delete from playlist?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info delete-playlist">Delete From Playlist</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endif

@stop