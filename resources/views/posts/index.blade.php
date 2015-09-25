@extends('master')

@section('page', $page)

@section('content')

    <div class="artists">
        <h2 class="table-title">Posts Data {!! link_to_route('admin::posts.create', 'NEW POST', [], ['class' => 'btn btn-default pull-right']) !!}</h2>

        @if(Session::has('status'))
            <div class="alert alert-warning">
                {!! '<p>'.Session::get('status').'</p>' !!}
            </div>
        @endif

        <table class="table table-responsive table-striped table">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Post Title</th>
                <th>Related Artist</th>
                <th>Author</th>
                <th class="text-center">Published At</th>
                <th class="text-center" width="150">Action</th>
            </tr>
            </thead>
            <tbody>

            <?php $no = isset($_GET['page']) ? $_GET['page'] * 10 : 1; ?>
            @forelse($posts as $post)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{!! link_to_route('public_post', $post->title, [$post->slug], ['target' => '_blank']) !!}</td>
                    <td>
                        <img src="/img/avatar/{{ $post->artistAvatar }}" class="top-avatar">
                        {!! link_to_route('public_artist', $post->artist, [$post->artistSlug], ['target' => '_blank']) !!}
                    </td>
                    <td>
                        <img src="/img/avatar/{{ $post->authorAvatar }}" class="top-avatar">
                        {!! link_to_route('private_profile', $post->author, [str_slug($post->author)], ['target' => '_blank']) !!}
                    </td>
                    <td class="text-center">{{ date_format(date_create($post->created_at), 'd-M-Y') }}</td>
                    <td class="text-center">
                        {!! link_to_route('admin::posts.edit', 'EDIT', [$post->slug], ['class' => 'btn btn-info btn-sm']) !!}
                        {!! link_to('#deleteModal', 'DELETE',['class' => 'btn btn-danger btn-sm btn-delete', 'data-toggle' => 'modal', 'data-id' => $post->slug]) !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No post available</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="center-block text-center">
            {!! $posts->render() !!}
        </div>
    </div>

    <?php $routeDelete = 'admin::posts.destroy' ?>
    @include('elements/_delete')

@stop

