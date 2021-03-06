@extends('master')

@section('page', 'Edit Post')

@section('content')

    <div class="artists">
        <h2 class="table-title">Edit Post</h2>

        @if(Session::has('status'))
            <div class="alert alert-danger">
                {!! '<p>'.Session::get('status').'</p>' !!}
            </div>
        @endif

        {!! Form::model($post, ['route' => ['admin::posts.update', $post->slug], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}

        @include('posts._form')

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" onclick="window.history.back()">Back to Post List</button>
                {!! Form::submit('Update Post', ['class' => 'btn btn-info']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@stop

