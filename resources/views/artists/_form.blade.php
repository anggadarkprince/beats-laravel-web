<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder' => 'Put artist name', 'required' => true, 'maxlength' => "255"]) !!}
        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('about') ? 'has-error' : '' }}">
    {!! Form::label('about', 'Content', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('about', null, ['class'=>'form-control', 'placeholder' => 'Put artist about', 'rows' => '5', 'required' => true]) !!}
        {!! $errors->first('about', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('birthday') ? 'has-error' : '' }}">
    {!! Form::label('birthday', 'Birthday', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('date', 'birthday', null, ['class'=>'form-control', 'placeholder' => 'Put artist birth date', 'required' => true]) !!}
        {!! $errors->first('birthday', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('birthplace') ? 'has-error' : '' }}">
    {!! Form::label('birthplace', 'Birthplace', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('birthplace', null, ['class'=>'form-control', 'placeholder' => 'Put artist birthplace', 'required' => true, 'maxlength' => "100"]) !!}
        {!! $errors->first('birthplace', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('avatar_file') ? 'has-error' : '' }}">
    {!! Form::label('avatar_file', 'Avatar', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        @if(isset($artist))
            <img src="\img\avatar\{{ $artist->avatar }}" class="img-responsive" style="max-height: 108px; margin-bottom: 10px">
        @endif
        {!! Form::file('avatar_file') !!}
        {!! $errors->first('avatar_file', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
    {!! Form::label('slug', 'Artist Slug', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder' => 'Eg. angga-ari-wijaya', 'required' => true]) !!}
        {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
    </div>
</div>

