@extends('template')

@section('page', $article->title)

@section('content')

    <article class="post">
        <header>
            <h1>{{ $article->title }}</h1>
            <p class="text-muted">{{ $author->name }} | Published at {{ date_format(date_create($article->created_at), 'd F Y - h:m A') }}</p>
        </header>
        <p>
            {!! $article->content !!}}
        </p>
        <section class="share">
            <h4>Share This Post</h4>
            {!! link_to('https://www.facebook.com/dialog/feed?app_id=438533166330046&display=popup&caption='.urlencode($article->title).'&link='.urlencode('http://angga-ari.com').'&redirect_uri='.urlencode(Request::url()), 'Facebook', ['target' => '_blank']) !!} |
            {!! link_to('https://www.twitter.com/home?status='.urlencode("Hey check this awesome blog post - ".$article->title.' via @beats '.Request::url()), 'Twitter', ['target' => '_blank']) !!} |
            {!! link_to('https://plus.google.com/share?url='.urlencode(Request::url()), 'Google', ['target' => '_blank']) !!}
        </section>
    </article>
@stop