@extends('master')

@section('page', $page)

@section('content')

    <div class="artists">
        <h2 class="table-title">Artist Data {!! link_to_route('admin::artists.create', 'NEW ARTIST', [], ['class' => 'btn btn-default pull-right']) !!}</h2>

        <table class="table table-responsive table-striped table">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Artist</th>
                <th>Birthplace</th>
                <th class="text-center">Birthday</th>
                <th class="text-center">Detail</th>
                <th class="text-center" width="200">Action</th>
            </tr>
            </thead>
            <tbody>

            <?php $no = isset($_GET['page']) ? $_GET['page'] * 10 : 1; ?>
            @forelse($artists as $artist)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>
                        <img src="/img/avatar/{{ $artist->avatar }}" class="top-avatar">
                        {!! link_to_route('public_artist', $artist->name, [$artist->slug], ['target' => '_blank']) !!}
                    </td>
                    <td>{{ $artist->birthplace }}</td>
                    <td class="text-center">{{ $artist->birthday }}</td>
                    <td class="text-center">{!! link_to_route('admin::artists.show', 'Detail', [$artist->slug]) !!}</td>
                    <td class="text-center">
                        {!! link_to_route('admin::artists.edit', 'EDIT', [$artist->slug], ['class' => 'btn btn-sm btn-info']) !!}
                        {!! delete_form(['admin::artists.destroy', $artist->slug], 'DELETE', 'btn-sm') !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No artist available, {!! link_to_route('admin::artists.create', 'Create New Artist') !!}</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="center-block text-center">
            {!! $artists->render() !!}
        </div>
    </div>

@stop

