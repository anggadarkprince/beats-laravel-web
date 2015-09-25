@extends('master')

@section('page', 'Feedback '.$feedback->name)

@section('content')

    <div class="artists">
        <h2 class="table-title">Feedback {{ $feedback->name }}</h2>

        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-sm-2 control-label">ID</label>
                <div class="col-sm-10">
                    <p class="form-control-static">#{{ $feedback->id }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{ $feedback->name }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><a href="mailto:{{ $feedback->email }}">{{ $feedback->email }}</a></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Message</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{ $feedback->message }}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Sent At</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{ $feedback->created_at }}</p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-default" onclick="window.history.back()">Back to Feedback List</button>
                </div>
            </div>
        </form>
    </div>

@stop

