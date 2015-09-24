<div class="form-group {{ $errors->has('list') ? 'has-error' : '' }}">
    {!! Form::label('list', 'Playlist Name') !!}
    {!! Form::text('list', null, ['class'=>'form-control', 'placeholder' => 'Put your playlist name']) !!}
    {!! $errors->first('list', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder' => 'Playlist caption or description']) !!}
    {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
</div>