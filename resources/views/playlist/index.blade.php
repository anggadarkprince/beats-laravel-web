@extends('template')

@section('page', $userData->name.'\'s Playlist')

@section('content')

    @include('pages._user_profile')

    <h3 class="profile-label">
        Playlist
        {!! link_to_route('playlist_create', 'NEW PLAYLIST', [], ['class' => 'btn btn-default pull-right']) !!}
    </h3>

    @if(Session::has('status'))
        <div class="alert alert-success">
            {!! '<p>'.Session::get('status').'</p>' !!}
        </div>
    @endif

    <div class="playlist">
        <table class="table table-responsive">
            <thead>
            <tr>
                <td>No</td>
                <td width="130">Playlist</td>
                <td>Description</td>
                <td class="text-center">Tracks</td>
                <td class="text-center" width="200">Action</td>
            </tr>
            </thead>
            <tbody>

            <?php $no = 1; ?>
            @forelse($playlistData as $playlist)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{!! link_to_route('playlist_show', $playlist->list, [$playlist->id]) !!}</td>
                    <td>{{ str_limit($playlist->description, 65) }}</td>
                    <td class="text-center">{{ $playlist->song_total }}</td>
                    <td class="text-center">
                        {!! link_to_route('playlist_edit', 'EDIT', [$playlist->id], ['class' => 'btn btn-info']) !!}
                        {!! delete_form(['playlist_destroy', $playlist->id], 'DELETE') !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No playlist available, {!! link_to_route('playlist_create', 'Create New Playlist') !!}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@stop