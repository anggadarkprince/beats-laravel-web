@extends('master')

@section('page', 'Edit Video')

@section('content')

    <div class="artists">
        <h2 class="table-title">Edit Video</h2>

        @if(Session::has('status'))
            <div class="alert alert-danger">
                {!! '<p>'.Session::get('status').'</p>' !!}
            </div>
        @endif

        {!! Form::model($video, ['route' => ['admin::videos.update', $video->slug], 'method' => 'PATCH', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

        @include('videos._form')

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" onclick="window.history.back()">Back to Video List</button>
                {!! Form::submit('Update Video', ['class' => 'btn btn-info']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@stop

