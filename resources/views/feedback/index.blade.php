@extends('master')

@section('page', $page)

@section('content')

    <div class="artists">
        <h2 class="table-title">Feedback Data</h2>

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
                <th class="text-center">Sent At</th>
                <th class="text-center">Detail</th>
                <th class="text-center" width="200">Action</th>
            </tr>
            </thead>
            <tbody>

            <?php $no = isset($_GET['page']) ? $_GET['page'] * 10 : 1; ?>
            @forelse($feedback as $message)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td class="text-center">{{ date_format(date_create($message->created_at), 'd F Y') }}</td>
                    <td class="text-center">{!! link_to_route('admin::feedback.show', 'Detail', [$message->id]) !!}</td>
                    <td class="text-center">{!! link_to('#deleteModal', 'DELETE',['class' => 'btn btn-danger btn-sm btn-delete', 'data-toggle' => 'modal', 'data-id' => $message->id]) !!}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No feedback available</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="center-block text-center">
            {!! $feedback->render() !!}
        </div>
    </div>

    <?php $routeDelete = 'admin::feedback.destroy' ?>
    @include('elements/_delete')

@stop

