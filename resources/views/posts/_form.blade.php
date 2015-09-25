<div class="form-group {{ $errors->has('artist') ? 'has-error' : '' }}">
    {!! Form::label('artist', 'Related Artist', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('artist', $artists, null, ['class' => 'form-control', 'placeholder' => 'Select artist related this post']) !!}
    </div>
    {!! $errors->first('artist', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    {!! Form::label('title', 'Post Title', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('title', null, ['class'=>'form-control', 'placeholder' => 'Put post title', 'required' => true, 'maxlength' => "255"]) !!}
        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    {!! Form::label('content', 'Content', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('content', null, ['class'=>'form-control', 'placeholder' => 'Put post content', 'required' => true]) !!}
        {!! $errors->first('content', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
    {!! Form::label('slug', 'Post Slug', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder' => 'Eg. brighter-than-sunshine', 'required' => true]) !!}
        {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
    </div>
</div>