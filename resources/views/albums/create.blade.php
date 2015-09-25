@extends('master')

@section('page', 'Create New Album')

@section('content')

    <div class="artists">
        <h2 class="table-title">New Album</h2>

        {!! Form::open(['route' => 'admin::albums.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

        @include('albums._form')

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" onclick="window.history.back()">Back to Albums List</button>
                {!! Form::submit('Create Album', ['class' => 'btn btn-info']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@stop

