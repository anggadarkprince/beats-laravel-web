@extends('master')

@section('page', 'Create New Post')

@section('content')

    <div class="artists">
        <h2 class="table-title">New Post</h2>

        {!! Form::open(['route' => 'admin::posts.store', 'class' => 'form-horizontal']) !!}

        @include('posts._form')

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" onclick="window.history.back()">Back to Post List</button>
                {!! Form::submit('Create Post', ['class' => 'btn btn-info']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@stop

