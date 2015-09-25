@extends('master')

@section('page', 'Edit Album')

@section('content')

    <div class="artists">
        <h2 class="table-title">Edit Album</h2>

        @if(Session::has('status'))
            <div class="alert alert-danger">
                {!! '<p>'.Session::get('status').'</p>' !!}
            </div>
        @endif

        {!! Form::model($album, ['route' => ['admin::albums.update', $album->slug], 'method' => 'PATCH', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

        @include('albums._form')

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" onclick="window.history.back()">Back to Album List</button>
                {!! Form::submit('Update Album', ['class' => 'btn btn-info']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@stop

