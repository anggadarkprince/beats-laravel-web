@extends('master')

@section('page', 'Create New Song')

@section('content')

    <div class="artists">
        <h2 class="table-title">New Song</h2>

        {!! Form::open(['route' => 'admin::songs.store', 'class' => 'form-horizontal']) !!}

        @include('songs._form')

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" onclick="window.history.back()">Back to Songs List</button>
                {!! Form::submit('Create Song', ['class' => 'btn btn-info']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@stop

