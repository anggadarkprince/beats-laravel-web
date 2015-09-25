@extends('master')

@section('page', $page)

@section('content')

    <div class="artists">
        <h2 class="table-title">Album Data {!! link_to_route('admin::albums.create', 'NEW ALBUM', [], ['class' => 'btn btn-default pull-right']) !!}</h2>

        <table class="table table-responsive table-striped table">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Albums</th>
                <th>Artist</th>
                <th class="text-center">Released At</th>
                <th class="text-center">Detail</th>
                <th class="text-center" width="200">Action</th>
            </tr>
            </thead>
            <tbody>

            <?php $no = isset($_GET['page']) ? $_GET['page'] * 10 : 1; ?>
            @forelse($albums as $album)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>
                        <img src="/img/cover/{{ $album->cover }}" class="top-avatar">
                        {!! link_to_route('public_album', $album->title, [$album->slugArtist, $album->slugAlbum], ['target' => '_blank']) !!}
                    </td>
                    <td>{{ $album->name }}</td>
                    <td class="text-center">{{ date_format(date_create($album->created_at), 'd F Y') }}</td>
                    <td class="text-center">{!! link_to_route('admin::albums.show', 'Detail', [$album->slugAlbum]) !!}</td>
                    <td class="text-center">
                        {!! link_to_route('admin::albums.edit', 'EDIT', [$album->slug], ['class' => 'btn btn-sm btn-info']) !!}
                        {!! delete_form(['admin::albums.destroy', $album->slug], 'DELETE', 'btn-sm') !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No artist available, {!! link_to_route('admin::albums.create', 'Create New Album') !!}</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="center-block text-center">
            {!! $albums->render() !!}
        </div>
    </div>

@stop

