@extends('template')

@section('page', $userData->name)

@section('content')

    @include('pages._user_profile')

    <h3 class="profile-label">Playlist</h3>

@stop