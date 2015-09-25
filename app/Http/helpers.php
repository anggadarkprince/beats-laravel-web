<?php

function delete_form($routeParams, $label = 'Delete', $class = '')
{
    $form = Form::open(['method' => 'DELETE', 'route' => $routeParams, 'style' => 'display:inline-block']);
    $form .= Form::submit($label, ['class' => 'btn btn-danger '.$class]);
    $form .= Form::close();

    return $form;
}