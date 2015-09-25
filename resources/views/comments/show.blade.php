@extends('master')

@section('page', 'Comment '.$comment->name)

@section('content')

    <div class="artists">
        <h2 class="table-title">Comment {{ $comment->name }}</h2>

        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-sm-2 control-label">ID</label>
                <div class="col-sm-10">
                    <p class="form-control-static">#{{ $comment->id }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Sender</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{!! link_to_route('private_profile', $comment->name, [str_slug($comment->name)], ['target' => '_blank']) !!}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><a href="mailto:{{ $comment->email }}">{{ $comment->email }}</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Message</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{ $comment->comment }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Commented At</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{ $comment->created_at }}</p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-default" onclick="window.history.back()">Back to Comment List</button>
                </div>
            </div>
        </form>
    </div>

@stop

