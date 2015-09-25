@extends('master')

@section('page', $page)

@section('content')

    <div class="jumbotron">
        <h1>ADMINISTRATOR PAGE</h1>
        <p>This page is a quick feature to manage all <strong>The Beats</strong> data and component. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
        <p>
            <a class="btn btn-lg btn-info" href="{{ route('public_home') }}" role="button" target="_blank"><span class="glyphicon glyphicon-headphones"></span> VISIT THE BEATS &raquo;</a>
        </p>
    </div>
@stop

