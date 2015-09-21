@extends('template')

@section('content')

    <article class="post">
        <header>
            <h1>Avril lavigne is getting merrid next month</h1>
            <p class="text-muted">Administrator | Published at 14 January 2015 08:23 AM</p>
        </header>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt eligendi
            exercitationem fuga fugit illo modi nemo odit, optio quae quam quia quo sint sit.
            Eos id placeat similique soluta veniam.<br><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt eligendi
            exercitationem fuga fugit illo modi nemo odit, optio quae quam quia quo sint sit.
            Eos id placeat similique soluta veniam.<br><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt eligendi
            exercitationem fuga fugit illo modi nemo odit, optio quae quam quia quo sint sit.
            Eos id placeat similique soluta veniam.<br><br>
        </p>
        <h4>Share This Post</h4>
        {!! link_to('www.facebook.com', 'Facebook', ['target' => '_blank']) !!}
        {!! link_to('www.twitter.com', 'Twitter', ['target' => '_blank']) !!}
        {!! link_to('www.google.com', 'Google', ['target' => '_blank']) !!}
    </article>

@stop