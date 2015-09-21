<?php

function delete_form($routeParams, $label = 'Delete')
{
    $form = Form::open(['method' => 'DELETE', 'route' => $routeParams]);
    $form .= Form::submit($label, ['class' => 'btn btn-danger']);
    $form .= Form::close();

    return $form;
    //{!! Form::open(['method' => 'DELETE', 'route' => ['song_destroy_path', $song->slug]]) !!}
    //<div class="form-group">
    //        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    //    </div>
    //{!! Form::close() !!}
}