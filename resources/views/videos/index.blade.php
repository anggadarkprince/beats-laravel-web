@extends('master')

@section('page', $page)

@section('content')

    <div class="artists">
        <h2 class="table-title">Video Data {!! link_to_route('admin::videos.create', 'NEW VIDEO', [], ['class' => 'btn btn-default pull-right']) !!}</h2>

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
                <th>Artist</th>
                <th class="text-center">Uploaded At</th>
                <th class="text-center" width="180">Action</th>
            </tr>
            </thead>
            <tbody>

            <?php $no = isset($_GET['page']) ? $_GET['page'] * 10 : 1; ?>
            @forelse($videos as $video)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>
                        <img src="/vid/{{ $video->poster }}" class="top-avatar">
                        {!! link_to_route('public_show_video', $video->title, [$video->videoSlug], ['target' => '_blank']) !!}
                    </td>
                    <td>
                        <img src="/img/avatar/{{ $video->avatar }}" class="top-avatar">
                        {!! link_to_route('public_artist', $video->name, [$video->artistSlug], ['target' => '_blank']) !!}
                    </td>
                    <td class="text-center">{{ date_format(date_create($video->uploaded_at), 'd F Y') }}</td>
                    <td class="text-center">
                        {!! link_to_route('admin::videos.edit', 'EDIT', [$video->videoSlug], ['class' => 'btn btn-sm btn-info']) !!}
                        {!! link_to('#deleteModal', 'DELETE',['class' => 'btn btn-danger btn-sm btn-delete', 'data-toggle' => 'modal', 'data-id' => $video->videoSlug]) !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No video available, {!! link_to_route('admin::videos.create', 'Create New Album') !!}</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="center-block text-center">
            {!! $videos->render() !!}
        </div>
    </div>

    <?php $routeDelete = 'admin::videos.destroy' ?>
    @include('elements/_delete')

@stop

