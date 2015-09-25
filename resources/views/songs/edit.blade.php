@extends('master')

@section('page', 'Edit Song')

@section('content')

    <div class="artists">
        <h2 class="table-title">Edit Song</h2>

        @if(Session::has('status'))
            <div class="alert alert-danger">
                {!! '<p>'.Session::get('status').'</p>' !!}
            </div>
        @endif

        {!! Form::model($song, ['route' => ['admin::songs.update', $song->slug], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}

        @include('songs._form')

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" onclick="window.history.back()">Back to Song List</button>
                {!! Form::submit('Update Song', ['class' => 'btn btn-info']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@stop

