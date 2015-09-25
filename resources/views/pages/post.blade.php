@extends('template')

@section('page', $article->title)

@section('content')

    @if(Session::has('status'))
        <div class="alert alert-success">
            {!! '<p>'.Session::get('status').'</p>' !!}
        </div>
    @endif

    <article class="post">
        <header>
            <h1>{{ $article->title }}</h1>
            <p class="text-muted">{{ $author->name }} | Published at {{ date_format(date_create($article->created_at), 'd F Y - h:m A') }}</p>
        </header>
        <p>
            {!! $article->content !!}
        </p>
        <section class="share">
            <h4>Share This Post</h4>
            {!! link_to('https://www.facebook.com/dialog/feed?app_id=438533166330046&display=popup&caption='.urlencode($article->title).'&link='.urlencode('http://angga-ari.com').'&redirect_uri='.urlencode(Request::url()), 'Facebook', ['target' => '_blank']) !!} |
            {!! link_to('https://www.twitter.com/home?status='.urlencode("Hey check this awesome blog post - ".$article->title.' via @beats '.Request::url()), 'Twitter', ['target' => '_blank']) !!} |
            {!! link_to('https://plus.google.com/share?url='.urlencode(Request::url()), 'Google', ['target' => '_blank']) !!}
        </section>
    </article>

    <section class="comment">
        <h3>Leaves a Comment:</h3>

        <div class="form-comment">
            {!! Form::open(['route' => ['comment_store', Request::segment(2)]]) !!}

            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                <p class="form-control-static">@if(Auth::check()) {{ Auth::user()->email }} @else Please Login First @endif</p>
            </div>

            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                {!! Form::label('comment', 'Message') !!}
                @if(Auth::check()) {!! Form::textarea('comment', null, ['class'=>'form-control', 'placeholder' => 'Write your feedback or message', 'required' => true, 'rows' => 5]) !!}
                @else {!! Form::textarea('comment', null, ['class'=>'form-control', 'placeholder' => 'Write your feedback or message', 'required' => true, 'rows' => 5, 'readonly' => true]) !!}
                @endif

                {!! $errors->first('comment', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group">
                @if(Auth::check()) {!! Form::submit('Submit Comment', ['class' => 'btn btn-info']) !!}
                @else {!! Form::submit('Submit Comment', ['class' => 'btn btn-info', 'disabled']) !!}
                @endif
            </div>
        </div>


        {!! Form::close() !!}
        @forelse($comments as $comment)

            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="/img/avatar/{{ $comment->avatar }}" style="width: 64px; height: 64px;">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{ $comment->name }}</h4>
                    <p>{!! nl2br($comment->comment) !!}</p>
                    <span class="text-muted small">Posted at {{ $comment->created_at }}</span>
                </div>
            </div>

        @empty

            <p>No comment available</p>

        @endforelse
    </section>
@stop