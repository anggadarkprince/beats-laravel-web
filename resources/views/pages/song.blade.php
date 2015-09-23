@extends('template')

@section('page', $songData->title)

@section('content')

    @include('pages._artist_profile')

    <h3 class="profile-label">{{ $songData->title }}</h3>
    <p class="lead">
        <a href="{{ route('public_album', [$artistData->slug, $albumData->slug]) }}">
            Albums : {{ $albumData->title }} ({{ date_format(date_create($albumData->released), 'Y') }})
        </a>
    </p>
    <p class="text-muted">Lyrics : {{ $songData->writer }} | Music : {{ $songData->music }} | Label : {{ $albumData->label }}</p>
    <p class="subtitle">
        {!! $songData->lyrics !!}
    </p>

@stop