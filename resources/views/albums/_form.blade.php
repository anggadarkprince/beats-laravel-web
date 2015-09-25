<div class="form-group {{ $errors->has('artist') ? 'has-error' : '' }}">
    {!! Form::label('artist', 'Related Artist', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('artist', $artists, null, ['class' => 'form-control', 'placeholder' => 'Select artist related this album']) !!}
    </div>
    {!! $errors->first('artist', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    {!! Form::label('title', 'Album Title', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('title', null, ['class'=>'form-control', 'placeholder' => 'Put album name', 'required' => true, 'maxlength' => "50"]) !!}
        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder' => 'Put album description', 'rows' => '5', 'required' => true]) !!}
        {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
    {!! Form::label('label', 'Label', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('label', null, ['class'=>'form-control', 'placeholder' => 'Put album label', 'required' => true, 'maxlength' => "50"]) !!}
        {!! $errors->first('label', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('released') ? 'has-error' : '' }}">
    {!! Form::label('released', 'Released', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('date', 'released', null, ['class'=>'form-control', 'placeholder' => 'Put album release date', 'required' => true]) !!}
        {!! $errors->first('released', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('cover_file') ? 'has-error' : '' }}">
    {!! Form::label('cover_file', 'Cover', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        @if(isset($album))
            <img src="\img\cover\{{ $album->cover }}" class="img-responsive" style="max-height: 108px; margin-bottom: 10px">
        @endif
        {!! Form::file('cover_file') !!}
        {!! $errors->first('cover_file', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
    {!! Form::label('slug', 'Album Slug', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder' => 'Eg. falling-skies', 'required' => true]) !!}
        {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
    </div>
</div>

