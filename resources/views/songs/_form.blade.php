<div class="form-group {{ $errors->has('album') ? 'has-error' : '' }}">
    {!! Form::label('album', 'Related Album', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('album', $albums, null, ['class' => 'form-control', 'placeholder' => 'Select album related this song']) !!}
    </div>
    {!! $errors->first('album', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    {!! Form::label('title', 'Song Title', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('title', null, ['class'=>'form-control', 'placeholder' => 'Put song name', 'required' => true, 'maxlength' => "50"]) !!}
        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('lyrics') ? 'has-error' : '' }}">
    {!! Form::label('lyrics', 'Lyrics', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('lyrics', null, ['class'=>'form-control', 'placeholder' => 'Put song lyrics', 'rows' => '5', 'required' => true]) !!}
        {!! $errors->first('lyrics', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('writer') ? 'has-error' : '' }}">
    {!! Form::label('writer', 'Writer', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('writer', null, ['class'=>'form-control', 'placeholder' => 'Put song writer', 'required' => true, 'maxlength' => "100"]) !!}
        {!! $errors->first('writer', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('music') ? 'has-error' : '' }}">
    {!! Form::label('music', 'Music', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('music', null, ['class'=>'form-control', 'placeholder' => 'Put song music or composer', 'required' => true, 'maxlength' => "100"]) !!}
        {!! $errors->first('music', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('duration') ? 'has-error' : '' }}">
    {!! Form::label('duration', 'Duration', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('text', 'duration', null, ['class'=>'form-control', 'placeholder' => 'Put song duration', 'required' => true]) !!}
        {!! $errors->first('duration', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('is_hits') ? 'has-error' : '' }}">
    {!! Form::label('yes', 'Is Hits', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <label class="radio-inline">
            {!! Form::radio('is_hits', '1', true, ['id' => 'yes', 'class' => 'required']) !!} YES
        </label>
        <label class="radio-inline">
            {!! Form::radio('is_hits', '0', false, ['id' => 'no']) !!} NO
        </label>
        {!! $errors->first('is_hits', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
    {!! Form::label('slug', 'Album Slug', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder' => 'Eg. when-you-are-gone', 'required' => true]) !!}
        {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
    </div>
</div>
