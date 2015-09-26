@extends('master')

@section('page', $page)

@section('content')

    <div class="artists">
        <h2 class="table-title">User Data</h2>

        @if(Session::has('status'))
            <div class="alert alert-warning">
                {!! '<p>'.Session::get('status').'</p>' !!}
            </div>
        @endif

        <table class="table table-responsive table-striped table">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th class="text-center" width="100">Action</th>
            </tr>
            </thead>
            <tbody>

            <?php $no = isset($_GET['page']) ? $_GET['page'] * 10 : 1; ?>
            @forelse($users as $user)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>
                        <img src="/img/avatar/{{ $user->avatar }}" class="top-avatar">
                        {!! link_to_route('private_profile', $user->name, [str_slug($user->name)], ['target' => '_blank']) !!}
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->gender }}</td>
                    <td class="text-center">{!! link_to('#deleteModal', 'DELETE',['class' => 'btn btn-danger btn-sm btn-delete', 'data-toggle' => 'modal', 'data-id' => $user->id]) !!}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No user available</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="center-block text-center">
            {!! $users->render() !!}
        </div>
    </div>

    <?php $routeDelete = 'admin::users.destroy' ?>
    @include('elements/_delete')

@stop

