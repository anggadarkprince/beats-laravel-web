@extends('master')

@section('page', 'Create New Video')

@section('content')

    <div class="artists">
        <h2 class="table-title">New Video</h2>

        {!! Form::open(['route' => 'admin::videos.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

        @include('videos._form')

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" onclick="window.history.back()">Back to Videos List</button>
                {!! Form::submit('Create Video', ['class' => 'btn btn-info']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@stop

