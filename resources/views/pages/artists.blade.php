@extends('template')

@section('page', $page)

@section('content')
    <h2 class="title">Artists Discovery</h2>
    <p class="subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam assumenda labore rem reprehenderit unde! Et optio, ut. Autem beatae delectus enim expedita facere in laudantium, minima molestiae non, odit sapiente.</p>
    <div class="artists">
        <div class="row">

            @forelse ($artists as $artist)

                <div class="col-lg-4 col-sm-6">
                    <div class="artist text-center">
                        <img class="img-circle" src="/img/avatar/{{ $artist->avatar }}" style="width: 140px; height: 140px;">
                        <h3>{{ $artist->name }}</h3>
                        <p>{{ $artist->album_total }} Albums Released</p>
                        <p>{!! link_to_route('public_artist', 'View Details',[$artist->slug],['class'=>'btn btn-default']) !!}</p>
                    </div>
                </div><!-- /.col-lg-4 -->

            @empty

                <p class="text-center center-block">No artist available</p>

            @endforelse

        </div><!-- /.row -->

        <div class="center-block text-center">
            {!! $artists->render() !!}
        </div>

    </div>
@stop