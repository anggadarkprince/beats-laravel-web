<div class="media profile">
    <a class="pull-left" href="{{ route('public_artist', [$artistData->slug]) }}">
        <img class="img-responsive" src="/img/avatar/{{ $artistData->avatar }}" style="width: 140px; height: 140px;">
    </a>
    <div class="media-body">
        <h2 class="title">{!! link_to_route('public_artist', $artistData->name, [$artistData->slug]) !!}</h2>
        <p>{{ $artistData->about }}</p>
        <p class="text-muted">{{ $artistData->birthplace }} | {{ $artistData->birthday }}</p>
    </div>
</div>