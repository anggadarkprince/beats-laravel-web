@extends('master')

@section('page', 'Edit Artist')

@section('content')

    <div class="artists">
        <h2 class="table-title">Edit Artist</h2>

        @if(Session::has('status'))
            <div class="alert alert-danger">
                {!! '<p>'.Session::get('status').'</p>' !!}
            </div>
        @endif

        {!! Form::model($artist, ['route' => ['admin::artists.update', $artist->slug], 'method' => 'PATCH', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

        @include('artists._form')

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" onclick="window.history.back()">Back to Artist List</button>
                {!! Form::submit('Update Artist', ['class' => 'btn btn-info']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@stop

