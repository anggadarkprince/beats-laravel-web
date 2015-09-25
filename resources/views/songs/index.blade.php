@extends('master')

@section('page', $page)

@section('content')

    <div class="artists">
        <h2 class="table-title">Song Data {!! link_to_route('admin::songs.create', 'NEW SONG', [], ['class' => 'btn btn-default pull-right']) !!}</h2>

        @if(Session::has('status'))
            <div class="alert alert-warning">
                {!! '<p>'.Session::get('status').'</p>' !!}
            </div>
        @endif

        <table class="table table-responsive table-striped table">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Title</th>
                <th>Album</th>
                <th>Artist</th>
                <th>Duration</th>
                <th class="text-center" width="180">Action</th>
            </tr>
            </thead>
            <tbody>

            <?php $no = isset($_GET['page']) ? $_GET['page'] * 10 : 1; ?>
            @forelse($songs as $song)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{!! link_to_route('public_song', $song->title, [$song->slugArtist, $song->slugAlbum, $song->slugSong], ['target' => '_blank']) !!}</td>
                    <td>
                        <img src="/img/cover/{{ $song->cover }}" class="top-avatar">
                        {!! link_to_route('public_album', $song->album, [$song->slugArtist, $song->slugAlbum], ['target' => '_blank']) !!}
                    </td>
                    <td>
                        <img src="/img/avatar/{{ $song->avatar }}" class="top-avatar">
                        {!! link_to_route('public_artist', $song->artist, [$song->slugArtist], ['target' => '_blank']) !!}
                    </td>
                    <td class="text-center">{{ $song->duration }}</td>
                    <td class="text-center">
                        {!! link_to_route('admin::songs.edit', 'EDIT', [$song->slugSong], ['class' => 'btn btn-sm btn-info']) !!}
                        {!! link_to('#deleteModal', 'DELETE',['class' => 'btn btn-danger btn-sm btn-delete', 'data-toggle' => 'modal', 'data-id' => $song->slugSong]) !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No song available, {!! link_to_route('admin::albums.create', 'Create New Album') !!}</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="center-block text-center">
            {!! $songs->render() !!}
        </div>
    </div>

    <?php $routeDelete = 'admin::songs.destroy' ?>
    @include('elements/_delete')

@stop

