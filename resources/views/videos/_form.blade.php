<div class="form-group {{ $errors->has('artist') ? 'has-error' : '' }}">
    {!! Form::label('artist', 'Related Artist', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('artist', $artists, null, ['class' => 'form-control', 'placeholder' => 'Select artist related this video']) !!}
    </div>
    {!! $errors->first('artist', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    {!! Form::label('title', 'Video Title', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('title', null, ['class'=>'form-control', 'placeholder' => 'Put video title', 'required' => true, 'maxlength' => "50"]) !!}
        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder' => 'Put video description', 'rows' => '5', 'required' => true]) !!}
        {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('poster_file') ? 'has-error' : '' }}">
    {!! Form::label('poster_file', 'Poster', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        @if(isset($video))
            <img src="\vid\{{ $video->poster }}" class="img-responsive" style="max-height: 108px; margin-bottom: 10px">
        @endif
        {!! Form::file('poster_file') !!}
        {!! $errors->first('poster_file', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('resource_file') ? 'has-error' : '' }}">
    {!! Form::label('resource_file', 'Video', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        @if(isset($video))
            <p>{{ $video->resource }}</p>
        @endif
        {!! Form::file('resource_file') !!}
        {!! $errors->first('resource_file', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
    {!! Form::label('slug', 'Video Slug', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder' => 'Eg. falling-skies', 'required' => true]) !!}
        {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
    </div>
</div>

