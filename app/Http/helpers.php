<?php

function delete_form($routeParams, $label = 'Delete', $class = '')
{
    $form = Form::open(['method' => 'DELETE', 'route' => $routeParams, 'style' => 'display:inline-block']);
    $form .= Form::submit($label, ['class' => 'btn btn-danger '.$class]);
    $form .= Form::close();

    return $form;
}

function upload_file($request, $source, $target, $filename = null)
{
    if ($request->hasFile($source)) {
        $upload = $request->file($source);
        if ($upload->isValid())
        {
            $fileName = $upload->getClientOriginalName().'.'.$upload->getClientOriginalExtension();
            if($filename != null){
                $fileName = $filename.'.'.$upload->getClientOriginalExtension();
                $upload->move($target, $fileName);
            }
            else{
                $upload->move($target);
            }

            return ['status' => true, 'filename' => $fileName];
        }
        return ['status' => false, 'filename' => ''];
    }
}