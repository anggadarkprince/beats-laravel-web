@extends('master')

@section('page', 'Create New Artist')

@section('content')

    <div class="artists">
        <h2 class="table-title">New Artist</h2>

        {!! Form::open(['route' => 'admin::artists.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

        @include('artists._form')

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" onclick="window.history.back()">Back to Artist List</button>
                {!! Form::submit('Create Artist', ['class' => 'btn btn-info']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@stop

