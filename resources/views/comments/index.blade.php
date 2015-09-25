@extends('master')

@section('page', $page)

@section('content')

    <div class="artists">
        <h2 class="table-title">Comments Data</h2>

        @if(Session::has('status'))
            <div class="alert alert-warning">
                {!! Session::get('status') !!}
                <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            </div>
        @endif

        <table class="table table-responsive table-striped table">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Name</th>
                <th>Comment</th>
                <th class="text-center">Commented At</th>
                <th class="text-center">Detail</th>
                <th class="text-center" width="100">Action</th>
            </tr>
            </thead>
            <tbody>

            <?php $no = isset($_GET['page']) ? $_GET['page'] * 10 : 1; ?>
            @forelse($comments as $comment)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>
                        <img src="/img/avatar/{{ $comment->avatar }}" class="top-avatar">
                        {!! link_to_route('private_profile', $comment->name, [str_slug($comment->name)], ['target' => '_blank']) !!}
                    </td>
                    <td>{{ str_limit($comment->comment, 30) }}</td>
                    <td class="text-center">{{ date_format(date_create($comment->created_at), 'd-M-Y | h:m A') }}</td>
                    <td class="text-center">{!! link_to_route('admin::comments.show', 'Detail', [$comment->id]) !!}</td>
                    <td class="text-center">{!! link_to('#deleteModal', 'DELETE',['class' => 'btn btn-danger btn-sm btn-delete', 'data-toggle' => 'modal', 'data-id' => $comment->id]) !!}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No comment available</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="center-block text-center">
            {!! $comments->render() !!}
        </div>
    </div>

    <?php $routeDelete = 'admin::comments.destroy' ?>
    @include('elements/_delete')

@stop

