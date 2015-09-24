<div class="media profile">
    <img class="img-responsive pull-left" src="/img/avatar/{{ $userData->avatar }}" style="width: 140px; height: 140px;">

    <div class="media-body">
        <h2 class="title">{!! $userData->name !!}</h2>
        <p>@if($userData->about == null) No profile description written @else {!! $userData->about !!} @endif</p>
        <p class="text-muted">@if($userData->status == null) No Status @else {!! $userData->status !!} @endif | {{ $userData->gender }} | Joined since {{ date_format(date_create($userData->created_at), 'Y') }}</p>
    </div>
</div>